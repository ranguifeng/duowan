<?php
require_once(dirname(dirname(__FILE__)) . '/wap_app.php');
//-----当前gduid只是商品uid-----
$gduid = $_GET['gduid'];
//
Session::Set($INI['system']['client_root'].'_return_url', "/shop/new_address.php?gduid=".$gduid);
require_once(dirname(dirname(__FILE__)) . '/weixin/jssdk/jssdk.php');
//need_wapcustomer();
//登录uid
$login_customer_uid='42a5a6177b724289d7c3da62935be859'; 
//添加地址操作
if(is_post()){
	$address = $_POST;
	var_dump($address);die;
	$auid = __newid();
	DB::Insert('t_shop_user_address',array(
		'usad_uid'=>$auid,
		'usad_usuid'=>$login_customer_uid,
		'usad_name'=>$address['usad_name'],
		'usad_tel'=>$address['usad_tel'],
		'usad_address'=>$address['usad_address']
		));
	//添加成功 定向指定地址
	redirect(WEB_ROOT ."/shop/address.php?gduid=".$gduid."&auid=".$auid);
}else{
	include template('wap_shop_new_address.html');
}