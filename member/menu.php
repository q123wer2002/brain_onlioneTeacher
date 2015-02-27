<?php
!function_exists('html') && exit('ERR');

unset($menudb,$base_menudb);

$menudb['個人資料']['脩改個人資料']['link']='userinfo.php?job=edit';
$menudb['個人資料']['站内短消息']['link']='pm.php?job=list';
$menudb['個人資料']['積分充值']['link']='money.php?job=list';
$menudb['個人資料']['會員昇級']['link']='buygroup.php?job=list';
$menudb['個人資料']['郵箱驗證']['link']='yz.php?job=email';

 


//插件菜單
$query = $db->query("SELECT * FROM {$pre}hack ORDER BY list DESC");
while($rs = $db->fetch_array($query)){
	if(is_file(ROOT_PATH."hack/$rs[keywords]/member_menu.php")){
		$array = include(ROOT_PATH."hack/$rs[keywords]/member_menu.php");
		$menudb['插件功能']["$array[name]"]['link']=$array['url'];
	}
}

?>