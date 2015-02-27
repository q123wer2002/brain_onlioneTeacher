<?php
require(dirname(__FILE__)."/f/global.php");
choose_domain();	//域名判断
include_once(ROOT_PATH."data/guide_fid.php");

	if(!$lfjid){
		showerr('請先登錄');
	}

//伪静态处理
if(!$id&&$webdb[Info_htmlType]==2){
	$array=array_flip($Fid_db[dir_name]);
	$fid=$array[$Fid];
	preg_match("/([0-9]+)/is",$Id,$array);
	$id=$array[0];
}

$_erp=$Fid_db[tableid][$fid];
/**
*模型配置文件
**/
$field_db = $module_DB[$fidDB[mid]][field];

if($sdbs){
	$query=$db->query("delete FROM {$pre}fenlei_content");
}

/**
*获取信息正文的内容
**/
$rsdb=$db->get_one("SELECT C.*,F.* FROM {$pre}course C LEFT JOIN {$pre}fenlei_content F ON C.t_id=F.id WHERE C.id='$id'");
$count=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid'");
$lfjdb=$db->get_one("SELECT * from {$pre}memberdata WHERE uid='$lfjuid'");

	$ConfigDB=unserialize($lfjdb[config]);
	$rsdb[totalspace]=floor($rsdb[totalspace]/(1024*1024));
	$ConfigDB[endtime]   && $ConfigDB[endtime]=date("Y-m-d H:i:s",$ConfigDB[endtime]);
	$filtrateendtime=strtotime($ConfigDB[endtime]);

if(!$rsdb){
	showerr("内容不存在");
}

if($rsdb[book]>0){
	showerr("講師已有预约！");
}

$rsdbs=$db->get_one("SELECT * FROM {$pre}course WHERE id='$id'");
$oftime=filtrate(strip_tags("$rsdbs[data] $rsdbs[time]"));
$offtime=strtotime($oftime);

if($count[Num]>=2&&$lfjdb[groupid]==8){
	showerr("妳的免费预约次数已经用完，請续费！");
}

$countday=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid' and data='$rsdbs[data]'");
if($countday[Num]>=$webdb[kvips]){
	showerr("每天僅限制預約$webdb[kvips]堂課！");
}




if($rsdbs[ktime]>$filtrateendtime&&$lfjdb[groupid]==9){
	showerr("妳的VIP到期時間為：$ConfigDB[endtime]，預約課程時間不能大於VIP到期的時間。");
}



if($timestamp>$offtime){
	showerr("此课程的预约時間已过！");
}



//SEO
$titleDB[title]			= filtrate(strip_tags("$webdb[webname]"));
$titleDB[keywords]		= filtrate(strip_tags($rsdb[keywords]));
$titleDB[description]	= get_word(strip_tags($rsdb[content]),200);



$ttime=strtotime($rsdb[data]);
$rsdb[data]=date("Y年m月d日",$ttime);
switch(date("w",$ttime)){
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
$rsdb[posttime]=date("Y-m-d H:i:s",$rsdb[posttime]);
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
	$FidTpl['lesson'] && $main_tpl=Mpath.$FidTpl['lesson'];
}

/**
*標签
**/
$ch_fid	= intval($fidDB[config][label_bencandy]);	//是否定义了栏目专用標签
$ch_pagetype = 3;									//2,为list页,3,为bencandy页
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//系统特定ID参数,每個系统不能雷同
$ch = 0;											//不属于任何专題
require(ROOT_PATH."inc/label_module.php");




require(Mpath."inc/head.php");
require(html("lesson",$main_tpl));
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