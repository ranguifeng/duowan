<?php
require_once(dirname(dirname(__FILE__)) . '/wap_app.php');

Session::Set($INI['system']['client_root'].'_return_url','/shop/home.php?uauid='.$uauid."&auid=".$auid);
require_once(dirname(dirname(__FILE__)) . '/weixin/jssdk/jssdk.php');
// need_wapcustomer(); 
$login_customer_uid='42a5a6177b724289d7c3da62935be859';
/*功能代码区*/

$condition=array();
$count =Table::Count('t_shop_good_list',$condition,'good_uid');
//查询所有商品信息
$goodlist = DB::LimitQuery('t_shop_good_list',array(
		'condition'=> $condition,
		'order'=> 'order by createdate desc',
		'count'=> $count,
	));
// var_dump($goodlist);
include template('wap_shop_home.html');


