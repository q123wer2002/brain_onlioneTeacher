<?php
require("global.php");

if(!$lfjid){
	showerr("妳還沒登錄");
}

if($job=="eva"||$action=='eva')
{
	$rsdb=$db->get_one("SELECT * FROM {$pre}course_u WHERE id='$id'");

	$db->query("UPDATE `{$pre}course_u` SET eva='$eva',evas='$evas' WHERE id='$id'");
	refreshto("$webdb[www_url]/member/","操作完成",1);
}

if($job=="quality"||$action=='quality')
{
	$rsdb=$db->get_one("SELECT * FROM {$pre}course_u WHERE id='$id'");

	$db->query("UPDATE `{$pre}course_u` SET quality='$quality' WHERE id='$id'");
	refreshto("$webdb[www_url]/member/","操作完成",1);
}

require(dirname(__FILE__)."/"."head.php");
require(get_member_tpl('map'));
require(dirname(__FILE__)."/"."foot.php");

?>