<?php
require_once(dirname(__FILE__)."/"."global.php");

if(!$lfjid){
	showerr("妳還沒登錄");
}

if($web_admin){
	$power=3;
}else{
	$power=1;
}



preg_match("/(.*)\/(index\.php|)\?main=(.+)/is",$WEBURL,$UrlArray);
$MainUrl=$UrlArray[3]?$UrlArray[3]:"map.php?uid=$lfjuid";
if(eregi('^http',$MainUrl)&&!eregi("^$webdb[www_url]",$MainUrl)){
	showerr('URL被禁止的!');
}

unset($menudb);

//设法获取後台自定义菜單
$query = $db->query("SELECT * FROM {$pre}admin_menu WHERE groupid='-$lfjdb[groupid]' AND fid=0 ORDER BY list DESC");
while($rs = $db->fetch_array($query)){
	$query2 = $db->query("SELECT * FROM {$pre}admin_menu WHERE fid='$rs[id]' ORDER BY list DESC");
	while($rs2 = $db->fetch_array($query2)){
		$menudb[$rs[name]][$rs2[name]]['link']=$rs2['linkurl'];
	}
}

//後台不存在自定义菜單,则用默认的
if(!$menudb){

	require_once(dirname(__FILE__)."/"."menu.php");

	//获取模块系统的会员菜單
	$query = $db->query("SELECT * FROM {$pre}module WHERE type=2 AND ifclose=0 ORDER BY list DESC");
	while($rs = $db->fetch_array($query)){
		$array=@include(ROOT_PATH."$rs[dirname]/member/menu.php");
		foreach($array AS $key=>$value){
			eregi("^http",$value['link'])||$value['link']="$webdb[www_url]/$rs[dirname]/member/".$value['link'];
			$menudb["$rs[name]"][$key]=$value;
		}
	}
}


require(dirname(__FILE__)."/"."head.php");
require(get_member_tpl('map'));
require(dirname(__FILE__)."/"."foot.php");


//处理内網的问題,内網的话$webdb[www_url]='/.';
if($webdb[www_url]=='/.'){
	$content=str_replace('/./','/',ob_get_contents());
	ob_end_clean();
	echo $content;
}

?>