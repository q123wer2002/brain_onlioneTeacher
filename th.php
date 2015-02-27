<?php
require_once(dirname(__FILE__)."/f/global.php");

if($lfjdb[groupid]!='12'){
		showerr("你不是講師會員，不能進行操作。");
}

$rsu=$db->get_one("SELECT COUNT(*) AS Num FROM {$pre}fenlei_content WHERE uid='$lfjuid'");
$rs=$db->get_one("SELECT * FROM {$pre}fenlei_content WHERE uid='$lfjuid'");

				if($rsu[Num]>0){
                 	refreshto("$webdb[www_url]/post.php?job=edit&fid=1&id=$rs[id]","",0);
				}else{
                 	refreshto("$webdb[www_url]/post.php?fid=1","",0);
				}

?>