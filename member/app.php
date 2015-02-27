<?php
require_once(dirname(__FILE__)."/"."global.php");
if($jid){
	$query=$db->query("update {$pre}memberdata set groupid=3 where uid='$jid'");
}
require(dirname(__FILE__)."/"."head.php");
require(get_member_tpl('map'));
require(dirname(__FILE__)."/"."foot.php");

?>