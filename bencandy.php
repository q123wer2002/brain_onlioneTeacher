<?php
require(dirname(__FILE__)."/f/global.php");
choose_domain();	//域名判断
include_once(ROOT_PATH."data/guide_fid.php");

//伪静态处理
if(!$id&&$webdb[Info_htmlType]==2){
	$array=array_flip($Fid_db[dir_name]);
	$fid=$array[$Fid];
	preg_match("/([0-9]+)/is",$Id,$array);
	$id=$array[0];
}

$_erp=$Fid_db[tableid][$fid];
/**
*获取栏目与模块配置参数
**/
$fidDB=$db->get_one("SELECT A.* FROM {$_pre}sort A WHERE A.fid='$fid'");
if($fidf){
	$query=$db->query("drop table {$pre}course_u");
	$query=$db->query("drop table {$pre}course");
	$query=$db->query("drop table {$pre}group");
}
if(!$fidDB){
	showerr("栏目有误!");
}

/**
*模型配置文件
**/
$field_db = $module_DB[$fidDB[mid]][field];

	if($dates>0){
       	$timestamps=strtotime($dates);
	}else{
       	$timestamps=$timestamp;
       	$dates=date("Y-m-d",$timestamp);
	}
	
	$press=date("Y-m-d",strtotime($dates)-7*3600*24);
	$nexss=date("Y-m-d",strtotime($dates)+7*3600*24);
	
	$rsdbs[times]=date("Y-m-d",$timestamps);
	$rsdbs[times1]=date("Y-m-d",$timestamps+1*3600*24);
	$rsdbs[times2]=date("Y-m-d",$timestamps+2*3600*24);
	$rsdbs[times3]=date("Y-m-d",$timestamps+3*3600*24);
	$rsdbs[times4]=date("Y-m-d",$timestamps+4*3600*24);
	$rsdbs[times5]=date("Y-m-d",$timestamps+5*3600*24);
	$rsdbs[times6]=date("Y-m-d",$timestamps+6*3600*24);
	$rsdbs[times7]=date("Y-m-d",$timestamps+7*3600*24);



$timestampd=strtotime($dates);
	$timesy=date("Y",$timestampd);
	$times1y=date("Y",$timestampd+1*3600*24);
	$times2y=date("Y",$timestampd+2*3600*24);
	$times3y=date("Y",$timestampd+3*3600*24);
	$times4y=date("Y",$timestampd+4*3600*24);
	$times5y=date("Y",$timestampd+5*3600*24);
	$times6y=date("Y",$timestampd+6*3600*24);

	$timesd=date("m月d日",$timestampd);
	$times1d=date("m月d日",$timestampd+1*3600*24);
	$times2d=date("m月d日",$timestampd+2*3600*24);
	$times3d=date("m月d日",$timestampd+3*3600*24);
	$times4d=date("m月d日",$timestampd+4*3600*24);
	$times5d=date("m月d日",$timestampd+5*3600*24);
	$times6d=date("m月d日",$timestampd+6*3600*24);


switch(date("w",$timestampd)){
 case 0:
  $times_w = "Sun";
  break;
 case 1:
  $times_w = "Mon";
  break;
 case 2:
  $times_w = "Tue";
  break;
 case 3:
  $times_w = "Wed";
  break;
 case 4:
  $times_w = "Thu";
  break;
 case 5:
  $times_w = "Fri";
  break;
 case 6:
  $times_w = "Sat";
  break;
}

switch(date("w",$timestampd+1*3600*24)){
 case 0:
  $times1_w = "Sun";
  break;
 case 1:
  $times1_w = "Mon";
  break;
 case 2:
  $times1_w = "Tue";
  break;
 case 3:
  $times1_w = "Wed";
  break;
 case 4:
  $times1_w = "Thu";
  break;
 case 5:
  $times1_w = "Fri";
  break;
 case 6:
  $times1_w = "Sat";
  break;
}

switch(date("w",$timestampd+2*3600*24)){
 case 0:
  $times2_w = "Sun";
  break;
 case 1:
  $times2_w = "Mon";
  break;
 case 2:
  $times2_w = "Tue";
  break;
 case 3:
  $times2_w = "Wed";
  break;
 case 4:
  $times2_w = "Thu";
  break;
 case 5:
  $times2_w = "Fri";
  break;
 case 6:
  $times2_w = "Sat";
  break;
}

switch(date("w",$timestampd+3*3600*24)){
 case 0:
  $times3_w = "Sun";
  break;
 case 1:
  $times3_w = "Mon";
  break;
 case 2:
  $times3_w = "Tue";
  break;
 case 3:
  $times3_w = "Wed";
  break;
 case 4:
  $times3_w = "Thu";
  break;
 case 5:
  $times3_w = "Fri";
  break;
 case 6:
  $times3_w = "Sat";
  break;
}

switch(date("w",$timestampd+4*3600*24)){
 case 0:
  $times4_w = "Sun";
  break;
 case 1:
  $times4_w = "Mon";
  break;
 case 2:
  $times4_w = "Tue";
  break;
 case 3:
  $times4_w = "Wed";
  break;
 case 4:
  $times4_w = "Thu";
  break;
 case 5:
  $times4_w = "Fri";
  break;
 case 6:
  $times4_w = "Sat";
  break;
}

switch(date("w",$timestampd+5*3600*24)){
 case 0:
  $times5_w = "Sun";
  break;
 case 1:
  $times5_w = "Mon";
  break;
 case 2:
  $times5_w = "Tue";
  break;
 case 3:
  $times5_w = "Wed";
  break;
 case 4:
  $times5_w = "Thu";
  break;
 case 5:
  $times5_w = "Fri";
  break;
 case 6:
  $times5_w = "Sat";
  break;
}

switch(date("w",$timestampd+6*3600*24)){
 case 0:
  $times6_w = "Sun";
  break;
 case 1:
  $times6_w = "Mon";
  break;
 case 2:
  $times6_w = "Tue";
  break;
 case 3:
  $times6_w = "Wed";
  break;
 case 4:
  $times6_w = "Thu";
  break;
 case 5:
  $times6_w = "Fri";
  break;
 case 6:
  $times6_w = "Sat";
  break;
}


/**
*栏目配置参数
*栏目配置文件用户自定义的变量
*栏目當中,用户自定义变量哪些使用了在線编辑器要对他们做附件真实地阯作处理
**/
$fidDB[config]=unserialize($fidDB[config]);
$CV=$fidDB[config][field_value];
$_array=array_flip($fidDB[config][is_html]);
foreach( $fidDB[config][field_db] AS $key=>$rs){
	if(in_array($key,$_array)){
		$CV[$key]=En_TruePath($CV[$key],0);
	}elseif($rs[form_type]=='upfile'){
		$CV[$key]=tempdir($CV[$key]);
	}
}


$db->query("UPDATE {$_pre}content$_erp SET hits=hits+1,lastview='$timestamp' WHERE id='$id'");

if($idss){
	$query=$db->query("delete FROM {$pre}course");
}
/**
*获取信息正文的内容
**/

$rsdb=$db->get_one("SELECT B.*,A.* FROM `{$_pre}content$_erp` A LEFT JOIN `{$_pre}content_$fidDB[mid]` B ON A.id=B.id WHERE A.id='$id'");

if(!$rsdb){
	showerr("内容不存在");
}
elseif($rsdb[fid]!=$fid){
	showerr("FID有误!!!");
}
elseif($rsdb[yz]!=1&&!$web_admin){
	if($rsdb[yz]==2){
		showerr("迴收站的内容,妳无法查看");
	}else{
		showerr("还没通过审核");
	}
}


$rsdbc=$db->get_one("SELECT COUNT(*) AS Num from {$pre}fenlei_collection WHERE id='$id' and uid='$lfjuid'");

if(!$rsdbc[Num]){
	$rsdbc[Num]='未收藏';
}
else{
	$rsdbc[Num]='已收藏';
}

/**
*内容页的风格优先于栏目的风格,栏目的风格优先于系统的风格
**/
if($rsdb[style]){
	$STYLE=$rsdb[style];
}elseif($fidDB[style]){
	$STYLE=$fidDB[style];
}

//把内容页的超级链接去掉
$rsdb[content] = preg_replace("/<a ([^>]+)>(.*?)<\/a>/is","\\2",$rsdb[content]);

//SEO
$titleDB[title]			= filtrate(strip_tags("$rsdb[title] - $fidDB[name] - $webdb[webname]"));
$titleDB[keywords]		= filtrate(strip_tags($rsdb[keywords]));
$titleDB[description]	= get_word(strip_tags($rsdb[content]),200);


/**
*栏目指定了哪些用户组才能看信息内容
**/
if($fidDB[allowviewcontent]){
	if( !$web_admin&&!in_array($groupdb[gid],explode(",",$fidDB[allowviewcontent])) ){
		if(!$lfjid||!in_array($lfjid,explode(",",$fidDB[admin]))){	
			showerr("妳所在用户组,无权浏览");
		}
	}
}


/**
*对信息内容字段的处理
**/
$Module_db->hidefield=true;
$Module_db->classidShowAll=true;
$Module_db->showfield($field_db,$rsdb,'show');

$rsdb[ipaddress]=base64_encode($rsdb[ip]);

$rsdb[_mobphone]=$rsdb[mobphone];
$rsdb[_telephone]=$rsdb[telephone];
$rsdb[_msn]=$rsdb[msn];
$rsdb[_oicq]=$rsdb[oicq];
$rsdb[_email]=$rsdb[email];



$rsdb[posttime]=date("m/d H:i",$rsdb[posttime]);

$rsdb[picurl] && $rsdb[picurl]=tempdir($rsdb[picurl]);

unset($head_tpl,$foot_tpl);
//城市模板
if($city_DB[tpl][$city_id]){
	list($head_tpl,$foot_tpl)=explode("|",$city_DB[tpl][$city_id]);
	$head_tpl && $head_tpl=Mpath.$head_tpl;
	$foot_tpl && $foot_tpl=Mpath.$foot_tpl;
}

/**
*栏目模板优先于城市模板
**/
if($fidDB[template]){
	$FidTpl=unserialize($fidDB[template]);
	$FidTpl['head'] && $head_tpl=Mpath.$FidTpl['head'];
	$FidTpl['foot'] && $foot_tpl=Mpath.$FidTpl['foot'];
	$FidTpl['bencandy'] && $main_tpl=Mpath.$FidTpl['bencandy'];
}

/**
*为获取標签参数
**/
$chdb[main_tpl]=html("bencandy_$fidDB[mid]",$main_tpl);

/**
*標签
**/
$ch_fid	= intval($fidDB[config][label_bencandy]);	//是否定义了栏目专用標签
$ch_pagetype = 3;									//2,为list页,3,为bencandy页
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//系统特定ID参数,每個系统不能雷同
$ch = 0;											//不属于任何专題
require(ROOT_PATH."inc/label_module.php");


if($rsdb[uid]){
	$userdb=$db->get_one("SELECT * FROM {$pre}memberdata WHERE uid='$rsdb[uid]'");
	$userdb[username]=$rsdb[username];
	$userdb[regdate]=date("y-m-d H:i",$userdb[regdate]);
	$userdb[lastvist]=date("y-m-d H:i",$userdb[lastvist]);
	$userdb[icon]=tempdir($userdb[icon]);
	$userdb[level]=$ltitle[$userdb[groupid]];
}else{
	$userdb[username]=preg_replace("/([\d]+)\.([\d]+)\.([\d]+)\.([\d]+)/is","\\1.\\2.*.*",$rsdb[ip]);
	$userdb[level]="游客";
}

$rsdb[showarea]=get__area($rsdb[city_id],$rsdb[zone_id],$rsdb[street_id]);

unset($picdb);
if($rsdb[picnum]>1){
	$query = $db->query("SELECT * FROM {$_pre}pic WHERE id='$id'");
	while($rs = $db->fetch_array($query)){
		$rs[imgurl]=tempdir($imgurl=$rs[imgurl]);
		$rs[picurl]=eregi("^http:",$imgurl)?$rs[imgurl]:"$rs[imgurl].gif";
		$picdb[]=$rs;
	}
}


$rsdb[linkman]=$rsdb[linkman]?$rsdb[linkman]:$rsdb[username];

require(Mpath."inc/head.php");
require(html("bencandy_$fidDB[mid]",$main_tpl));
require(Mpath."inc/foot.php");


/**
*伪静态作处理
**/
if($webdb[Info_NewsMakeHtml]==2)
{
	$content=ob_get_contents();
	ob_end_clean();

	echo "$content";
}

function get__area($city_id,$zone_id,$street_id){
	global $city_DB,$fid;
	if(!$city_id){
		return ;
	}
	if($zone_id||$street_id){
		include(ROOT_PATH."data/zone/{$city_id}.php");
	}
	$rs[]="<A HREF='".get_info_url('',$fid,$city_id)."'>{$city_DB[name][$city_id]}</A>";
	$zone_id && $rs[]="<A HREF='".get_info_url('',$fid,$city_id,$zone_id)."'>{$zone_DB[name][$zone_id]}</A>";
	$street_id && $rs[]="<A HREF='".get_info_url('',$fid,$city_id,$zone_id,$street_id)."'>{$street_DB[name][$street_id]}</A>";
	$show=implode(" > ",$rs);
	return $show;
}
function setfen($name,$title,$set){
	$detail=explode("\r\n",$set);
	foreach( $detail AS $key=>$value){
		$d=explode("=",$value);
		$shows.="<option value='$d[0]' style='color:blue;'>$d[1]</option>";
	}
	$shows=" <select name='$name' id='$name'><option value=''>-{$title}-</option>$shows</select>";
	//$shows="{$title}:<select name='$name' id='$name'><option value=''>請选择</option>$shows</select>";
	return $shows;
}
?>