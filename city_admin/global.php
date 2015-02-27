<?php
define('Memberpath',dirname(__FILE__).'/');
require(Memberpath."../f/global.php");



if(!$webdb[web_open])
{
	$webdb[close_why] = str_replace("\n","<br>",$webdb[close_why]);
	showerr("網站暂時关闭:$webdb[close_why]");
}


if(!$lfjid){
	showerr("妳還沒登錄");
}elseif($_GET['admin_city']){
	if(!$city_DB[name][$_GET['admin_city']]){
		showerr('當前城市不存在');
	}
	setcookie('admin_cityid',$_GET['admin_city']);
	$_COOKIE['admin_cityid']=$_GET['admin_city'];
}
elseif(!$_COOKIE['admin_cityid']){
	if(count($city_DB[name])<2){
		showerr('單城市版没有城市琯理功能!');
	}
	$show='';
	foreach( $city_DB[name] AS $key=>$value){
		$show.="<option value='$key'>$value</option>";
	}
	foreach( $city_DB[name] AS $key=>$value){
	}
	showerr("<select name='select' onChange=\"window.location.href='?admin_city='+this.options[this.selectedIndex].value\"><option value=''>請选择一個妳要琯理的城市</option>$show</select>");
}
if($city_id=$_COOKIE['admin_cityid']){
	$cityDB=$db->get_one("SELECT * FROM {$pre}fenlei_city WHERE fid='$city_id'");
	$detail=explode(',',$cityDB[admin]);
	if(!$web_admin&&!in_array($lfjid,$detail)){
		setcookie('admin_cityid','');
		showerr("<A HREF='?'>妳不是本城市的琯理员,點擊返迴选择城市!</A>");
	}
}

$id=intval($id);
$aid=intval($aid);
$tid=intval($tid);


?>