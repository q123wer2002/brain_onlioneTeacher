<?php
if(!function_exists('html')){
die('F');
}
if($fup){
	$show=select_where("{$_pre}street","'postdb[street_id]'",$fid,$fup);
	$show=str_replace("\r","",$show);
	$show=str_replace("\n","",$show);
	$show=str_replace("'","\'",$show);
	echo "<SCRIPT LANGUAGE=\"JavaScript\">
	<!--
	parent.document.getElementById(\"{$typeid}showstreet\").innerHTML='$show';
	//-->
	</SCRIPT>";
}
?>