<?php
require_once(dirname(dirname(__FILE__)) . '/wap_app.php');
$gduid = $_GET['gduid'];
$auid = $_GET['auid'];
Session::Set($INI['system']['client_root'].'_return_url',"/shop/qrdd02.php?gduid=".$gduid."&auid=".$auid);
require_once(dirname(dirname(__FILE__)).'/weixin/jssdk/jssdk.php');
//
$login_customer_uid='42a5a6177b724289d7c3da62935be859';

//查询地址信息

$address = DB::LimitQuery('t_shop_user_address',array(
	'select'=>'*',
	'condition'=>array('usad_uid'=>$auid,'usad_usuid'=>$login_customer_uid),
	'one'=>true,
));


//查询商品信息
$good = DB::LimitQuery('t_shop_good_list',array(
		'select'=>'*',
		'condition'=>array('good_uid'=>$gduid),
		'one'=>true,
	));	

include template('wap_shop_qrdd02.html');