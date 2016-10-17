<?php
require_once(dirname(dirname(__FILE__)) . '/wap_app.php');
$oduid = $_GET['oduid'];
$auid = $_GET['auid'];
Session::Set($INI['system']['client_root'].'_return_url', "/shop/qrdd02.php?oduid=".$oduid."&auid=".$auid);
require_once(dirname(dirname(__FILE__)) . '/weixin/jssdk/jssdk.php');
//need_wapcustomer();
$login_customer_uid='42a5a6177b724289d7c3da62935be859';
//-----当前oduid只是商品uid----- 
if(is_post()){
	$order = $_POST;
	$order['orde_uid'] = __newid();
	$sumprice = 0;
	foreach($order['goodlist'] as $v){
		// 查询某个字段数据   表名 + 条件
		$good = DB::LimitQuery('t_shop_good_list',array(	
				'select'=>'*',
				'condition'=>array('good_uid'=>$v['uid']), 
				'one'=>true
			));
		//----现在没有库存限制----	
		$remind = true;
		if($good && $remind){
			$money = $good['good_price']*$v['count'];
			// 插入一条数据  __newid() 自增id 
			DB::Insert('t_shop_orderdetail_list',array('oddt_uid'=>__newid(),'oddt_oduid'=>$order['orde_uid'],'oddt_gduid'=>$v['uid'],'oddt_count'=>$v['count'],'oddt_price'=>$good['good_price'],'oddt_money'=>$money));
			$sumprice += $money;
		}
	};
	$auid = $order['auid'];
	$address = DB::LimitQuery('t_shop_user_address',array(
			'select'=>'*',
			'condition'=>array('usad_uid'=>$auid,'usad_usuid'=>$login_customer_uid),
			'one'=>true
		));
	DB::Insert('t_shop_order_list',array('orde_uid'=>$order['orde_uid'],'orde_usuid'=>$login_customer_uid,'orde_address'=>$address['usad_address'],'orde_name'=>$address['usad_name'],'orde_tel'=>$address['usad_tel'],'orde_money'=>$sumprice,'orde_state'=>0));
	json(array('status'=>'ok','uid'=>$order['orde_uid']));
}else{
if($auid){
	$address = DB::LimitQuery('t_shop_user_address',array(
			'select'=>'*',
			'condition'=>array('usad_uid'=>$auid,'usad_usuid'=>$login_customer_uid),
			'one'=>true
		));
}
$good = DB::LimitQuery('t_shop_good_list',array(
		'select'=>'*',
		'condition'=>array('good_uid'=>$oduid),
		'one'=>true
	));

}

include template('wap_shop_index.html'); // 导入模版