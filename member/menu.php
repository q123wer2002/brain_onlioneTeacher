<?php
!function_exists('html') && exit('ERR');

unset($menudb,$base_menudb);

$menudb['�����Y��']['Ñ�Ă����Y��']['link']='userinfo.php?job=edit';
$menudb['�����Y��']['վ�ڶ���Ϣ']['link']='pm.php?job=list';
$menudb['�����Y��']['�e�ֳ�ֵ']['link']='money.php?job=list';
$menudb['�����Y��']['���T�N��']['link']='buygroup.php?job=list';
$menudb['�����Y��']['�]����C']['link']='yz.php?job=email';

 


//����ˆ�
$query = $db->query("SELECT * FROM {$pre}hack ORDER BY list DESC");
while($rs = $db->fetch_array($query)){
	if(is_file(ROOT_PATH."hack/$rs[keywords]/member_menu.php")){
		$array = include(ROOT_PATH."hack/$rs[keywords]/member_menu.php");
		$menudb['�������']["$array[name]"]['link']=$array['url'];
	}
}

?>