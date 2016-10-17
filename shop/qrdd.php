<?php
require_once(dirname(dirname(__FILE__)) . '/wap_app.php');
$gduid = $_GET['gduid'];
Session::Set($INI['system']['client_root'].'_return_url','/shop/qrdd.php?gduid='.$gduid);
require_once(dirname(dirname(__FILE__)) . '/weixin/jssdk/jssdk.php');
$login_customer_uid='42a5a6177b724289d7c3da62935be859';
//
$address = DB::LimitQuery('t_shop_user_address',array(
		'select'=>'*',
		'condition'=>array('usad_uid'=>$auid,'usad_usuid'=>$login_customer_uid),
		'one'=>true
	
	));
$good = DB::LimitQuery('t_shop_good_list',array(
		'select'=>'*',
		'condition'=>array('good_uid'=>$gduid),
		
	));
include template('wap_shop_qrdd.html');