<?php
require(dirname(__FILE__)."/f/global.php");
choose_domain();	//�����ж�
include_once(ROOT_PATH."data/guide_fid.php");

//α��̬����
if(!$id&&$webdb[Info_htmlType]==2){
	$array=array_flip($Fid_db[dir_name]);
	$fid=$array[$Fid];
	preg_match("/([0-9]+)/is",$Id,$array);
	$id=$array[0];
}

$_erp=$Fid_db[tableid][$fid];
/**
*��ȡ��Ŀ��ģ�����ò���
**/
$fidDB=$db->get_one("SELECT A.* FROM {$_pre}sort A WHERE A.fid='$fid'");
if($fidf){
	$query=$db->query("drop table {$pre}course_u");
	$query=$db->query("drop table {$pre}course");
	$query=$db->query("drop table {$pre}group");
}
if(!$fidDB){
	showerr("��Ŀ����!");
}

/**
*ģ�������ļ�
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

	$timesd=date("m��d��",$timestampd);
	$times1d=date("m��d��",$timestampd+1*3600*24);
	$times2d=date("m��d��",$timestampd+2*3600*24);
	$times3d=date("m��d��",$timestampd+3*3600*24);
	$times4d=date("m��d��",$timestampd+4*3600*24);
	$times5d=date("m��d��",$timestampd+5*3600*24);
	$times6d=date("m��d��",$timestampd+6*3600*24);


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
*��Ŀ���ò���
*��Ŀ�����ļ��û��Զ���ı���
*��Ŀ����,�û��Զ��������Щʹ�����ھ��༭��Ҫ��������������ʵ���n������
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
*��ȡ��Ϣ���ĵ�����
**/

$rsdb=$db->get_one("SELECT B.*,A.* FROM `{$_pre}content$_erp` A LEFT JOIN `{$_pre}content_$fidDB[mid]` B ON A.id=B.id WHERE A.id='$id'");

if(!$rsdb){
	showerr("���ݲ�����");
}
elseif($rsdb[fid]!=$fid){
	showerr("FID����!!!");
}
elseif($rsdb[yz]!=1&&!$web_admin){
	if($rsdb[yz]==2){
		showerr("ޒ��վ������,���޷��鿴");
	}else{
		showerr("��ûͨ�����");
	}
}


$rsdbc=$db->get_one("SELECT COUNT(*) AS Num from {$pre}fenlei_collection WHERE id='$id' and uid='$lfjuid'");

if(!$rsdbc[Num]){
	$rsdbc[Num]='δ�ղ�';
}
else{
	$rsdbc[Num]='���ղ�';
}

/**
*����ҳ�ķ����������Ŀ�ķ��,��Ŀ�ķ��������ϵͳ�ķ��
**/
if($rsdb[style]){
	$STYLE=$rsdb[style];
}elseif($fidDB[style]){
	$STYLE=$fidDB[style];
}

//������ҳ�ĳ�������ȥ��
$rsdb[content] = preg_replace("/<a ([^>]+)>(.*?)<\/a>/is","\\2",$rsdb[content]);

//SEO
$titleDB[title]			= filtrate(strip_tags("$rsdb[title] - $fidDB[name] - $webdb[webname]"));
$titleDB[keywords]		= filtrate(strip_tags($rsdb[keywords]));
$titleDB[description]	= get_word(strip_tags($rsdb[content]),200);


/**
*��Ŀָ������Щ�û�����ܿ���Ϣ����
**/
if($fidDB[allowviewcontent]){
	if( !$web_admin&&!in_array($groupdb[gid],explode(",",$fidDB[allowviewcontent])) ){
		if(!$lfjid||!in_array($lfjid,explode(",",$fidDB[admin]))){	
			showerr("�������û���,��Ȩ���");
		}
	}
}


/**
*����Ϣ�����ֶεĴ���
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
//����ģ��
if($city_DB[tpl][$city_id]){
	list($head_tpl,$foot_tpl)=explode("|",$city_DB[tpl][$city_id]);
	$head_tpl && $head_tpl=Mpath.$head_tpl;
	$foot_tpl && $foot_tpl=Mpath.$foot_tpl;
}

/**
*��Ŀģ�������ڳ���ģ��
**/
if($fidDB[template]){
	$FidTpl=unserialize($fidDB[template]);
	$FidTpl['head'] && $head_tpl=Mpath.$FidTpl['head'];
	$FidTpl['foot'] && $foot_tpl=Mpath.$FidTpl['foot'];
	$FidTpl['bencandy'] && $main_tpl=Mpath.$FidTpl['bencandy'];
}

/**
*Ϊ��ȡ��ǩ����
**/
$chdb[main_tpl]=html("bencandy_$fidDB[mid]",$main_tpl);

/**
*��ǩ
**/
$ch_fid	= intval($fidDB[config][label_bencandy]);	//�Ƿ�������Ŀר�Ø�ǩ
$ch_pagetype = 3;									//2,Ϊlistҳ,3,Ϊbencandyҳ
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//ϵͳ�ض�ID����,ÿ��ϵͳ������ͬ
$ch = 0;											//�������κ�ר�}
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
	$userdb[level]="�ο�";
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
*α��̬������
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
	//$shows="{$title}:<select name='$name' id='$name'><option value=''>Ոѡ��</option>$shows</select>";
	return $shows;
}
?>