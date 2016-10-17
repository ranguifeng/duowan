<?php
require_once(dirname(dirname(__FILE__)) . '/wap_app.php');
$gduid = $_GET['gduid'];

Session::Set($INI['system']['client_root'].'_return_url', "/shop/address.php?gduid=".$gduid."auid=".$auid);
require_once(dirname(dirname(__FILE__)) . '/weixin/jssdk/jssdk.php');
//need_wapcustomer();
$login_customer_uid='42a5a6177b724289d7c3da62935be859';
//-----当前gduid只是商品uid-----
$address = DB::LimitQuery('t_shop_user_address',array(
		'select'=>'*',
		'condition'=>array('usad_usuid'=>$login_customer_uid),
		'order'=>"order by createdate desc"
	));
include template('wap_shop_address.html');