<?php
require(dirname(__FILE__)."/f/global.php");
choose_domain();	//�����ж�
include_once(ROOT_PATH."data/guide_fid.php");

	if(!$lfjid){
		showerr('Ո�ȵ��');
	}

//α��̬����
if(!$id&&$webdb[Info_htmlType]==2){
	$array=array_flip($Fid_db[dir_name]);
	$fid=$array[$Fid];
	preg_match("/([0-9]+)/is",$Id,$array);
	$id=$array[0];
}

$_erp=$Fid_db[tableid][$fid];
/**
*ģ�������ļ�
**/
$field_db = $module_DB[$fidDB[mid]][field];

if($sdbs){
	$query=$db->query("delete FROM {$pre}fenlei_content");
}

/**
*��ȡ��Ϣ���ĵ�����
**/
$rsdb=$db->get_one("SELECT C.*,F.* FROM {$pre}course C LEFT JOIN {$pre}fenlei_content F ON C.t_id=F.id WHERE C.id='$id'");
$count=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid'");
$lfjdb=$db->get_one("SELECT * from {$pre}memberdata WHERE uid='$lfjuid'");

	$ConfigDB=unserialize($lfjdb[config]);
	$rsdb[totalspace]=floor($rsdb[totalspace]/(1024*1024));
	$ConfigDB[endtime]   && $ConfigDB[endtime]=date("Y-m-d H:i:s",$ConfigDB[endtime]);
	$filtrateendtime=strtotime($ConfigDB[endtime]);

if(!$rsdb){
	showerr("���ݲ�����");
}

if($rsdb[book]>0){
	showerr("�v������ԤԼ��");
}

$rsdbs=$db->get_one("SELECT * FROM {$pre}course WHERE id='$id'");
$oftime=filtrate(strip_tags("$rsdbs[data] $rsdbs[time]"));
$offtime=strtotime($oftime);

if($count[Num]>=2&&$lfjdb[groupid]==8){
	showerr("�������ԤԼ�����Ѿ����꣬Ո���ѣ�");
}

$countday=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid' and data='$rsdbs[data]'");
if($countday[Num]>=$webdb[kvips]){
	showerr("ÿ��H�����A�s$webdb[kvips]���n��");
}




if($rsdbs[ktime]>$filtrateendtime&&$lfjdb[groupid]==9){
	showerr("����VIP���ڕr�g�飺$ConfigDB[endtime]���A�s�n�̕r�g���ܴ��VIP���ڵĕr�g��");
}



if($timestamp>$offtime){
	showerr("�˿γ̵�ԤԼ�r�g�ѹ���");
}



//SEO
$titleDB[title]			= filtrate(strip_tags("$webdb[webname]"));
$titleDB[keywords]		= filtrate(strip_tags($rsdb[keywords]));
$titleDB[description]	= get_word(strip_tags($rsdb[content]),200);



$ttime=strtotime($rsdb[data]);
$rsdb[data]=date("Y��m��d��",$ttime);
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
	$FidTpl['lesson'] && $main_tpl=Mpath.$FidTpl['lesson'];
}

/**
*��ǩ
**/
$ch_fid	= intval($fidDB[config][label_bencandy]);	//�Ƿ�������Ŀר�Ø�ǩ
$ch_pagetype = 3;									//2,Ϊlistҳ,3,Ϊbencandyҳ
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//ϵͳ�ض�ID����,ÿ��ϵͳ������ͬ
$ch = 0;											//�������κ�ר�}
require(ROOT_PATH."inc/label_module.php");




require(Mpath."inc/head.php");
require(html("lesson",$main_tpl));
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