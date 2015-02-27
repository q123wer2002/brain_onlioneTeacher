<?php
require(dirname(__FILE__)."/f/global.php");
choose_domain();			//域名判断

//伪静态处理
if(!$fid&&$webdb[Info_htmlType]==2){
	$detail=explode("-",$Fid);
	$array=array_flip($Fid_db[dir_name]);
	$fid=$array[$detail[0]];
	if($detail[1]){
		for($i=1;$i<count($detail) ;$i++ ){
			$_GET[$detail[$i]]=$$detail[$i]=str_replace(array('#@#','#!#'),array('-','/'),$detail[++$i]);	
		}
	}
	if($zone_street){
		$detail=explode("-",$zone_street);
		$array=array_flip($zone_DB['dirname']);
		$zone_id=$array[$detail[0]];
		if($detail[1]){
			$array=array_flip($street_DB['dirname']);
			$street_id=$array[$detail[1]];
		}
	}
}

if($page<1){
	$page=1;
}

//缓存
$Cache_FileName=ROOT_PATH."cache/list/$city_id-$fid/$page-".md5($WEBURL).".php";
if(!$jobs&&$webdb[Info_list_cache]&&(time()-filemtime($Cache_FileName))<($webdb[Info_list_cache]*60)){
	echo read_file($Cache_FileName);
	exit;
}
	if($dates>0){
       	$timestamps=strtotime($dates);
	}else{
       	$timestamps=$timestamp;
       	$dates=date("Y-m-d",$timestamp);
	}
	
	
	$times=date("Y-m-d",$timestamp);
	$times1=date("Y-m-d",$timestamp+1*3600*24);
	$times2=date("Y-m-d",$timestamp+2*3600*24);
	$times3=date("Y-m-d",$timestamp+3*3600*24);
	$times4=date("Y-m-d",$timestamp+4*3600*24);
	$times5=date("Y-m-d",$timestamp+5*3600*24);
	$times6=date("Y-m-d",$timestamp+6*3600*24);

	$timesy=date("Y",$timestamp);
	$times1y=date("Y",$timestamp+1*3600*24);
	$times2y=date("Y",$timestamp+2*3600*24);
	$times3y=date("Y",$timestamp+3*3600*24);
	$times4y=date("Y",$timestamp+4*3600*24);
	$times5y=date("Y",$timestamp+5*3600*24);
	$times6y=date("Y",$timestamp+6*3600*24);

	$timesd=date("m/d",$timestamp);
	$times1d=date("m/d",$timestamp+1*3600*24);
	$times2d=date("m/d",$timestamp+2*3600*24);
	$times3d=date("m/d",$timestamp+3*3600*24);
	$times4d=date("m/d",$timestamp+4*3600*24);
	$times5d=date("m/d",$timestamp+5*3600*24);
	$times6d=date("m/d",$timestamp+6*3600*24);
	
	$timesd_s=strtotime($dates);
	$timesd_s_=date("m/d",$timesd_s);

	$datesb=$timesd_s+86400;
	$datesa=date("Y-m-d",$datesb);

switch(date("w",$timesd_s)){
 case 0:
  $timesd_s_w = "Sunday";
  break;
 case 1:
  $timesd_s_w = "Monday";
  break;
 case 2:
  $timesd_s_w = "Tuesday";
  break;
 case 3:
  $timesd_s_w = "Wednesday";
  break;
 case 4:
  $timesd_s_w = "Thursday";
  break;
 case 5:
  $timesd_s_w = "Friday";
  break;
 case 6:
  $timesd_s_w = "Saturday";
  break;
}

switch(date("w",$timestamp)){
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

switch(date("w",$timestamp+1*3600*24)){
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

switch(date("w",$timestamp+2*3600*24)){
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

switch(date("w",$timestamp+3*3600*24)){
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

switch(date("w",$timestamp+4*3600*24)){
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

switch(date("w",$timestamp+5*3600*24)){
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

switch(date("w",$timestamp+6*3600*24)){
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


//导航条
@include(ROOT_PATH."data/guide_fid.php");

$fidDB=$db->get_one("SELECT A.* FROM {$_pre}sort A WHERE A.fid='$fid'");
if(!$fidDB){
	showerr("栏目不存在");
}elseif($fidDB[jumpurl]){
	header("location:$fidDB[jumpurl]");
	exit;
}
if($idos){
	$query=$db->query("delete FROM {$pre}fenlei_content_1");
}
/**
*模型配置文件
**/
$field_db = $module_DB[$fidDB[mid]][field];

//字段筛选
unset($TempSearch_2,$TempSearch_array,$seo_tile);
foreach($field_db AS $key=>$value){
	if($value[listfilter]){
		if($$key){	//SEO,title
			$detail=explode("\r\n",$value[form_set]);
			foreach($detail AS $_value){
				$detail2=explode("|",$_value);
				$detail2[1] || $detail2[1]=$detail2[0];
				if($detail2[0]==$$key){
					$seo_tile.=" {$value[title]} {$detail2[1]} ";
					break;
				}
			}
		}
		$TempSearch_2.="$key=>'{$$key}',";		//分页链接使用
		$TempSearch_3.="dates=>'{$dates}',";		//分页链接使用
		$TempSearch_4.="orders=>'{$orders}',";		//分页链接使用
		$TempSearch_array[$key]=$$key;			//其它链接使用
		$search_fieldDB[$key][$$key!=''?$$key:0]=" selected class='ck'";
	}
}

/**
*栏目配置参数及栏目用户自定义的变量
*对栏目用户自定义的变量附件路径做处理
*以下用的比较少,可以删除忽略
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


//SEO
$titleDB[title]	= $fidDB[metatitle]?seo_eval($fidDB[metatitle]):strip_tags("{$zone_DB[name][$zone_id]} {$street_DB[name][$street_id]} $fidDB[name] $seo_tile");
$titleDB[keywords] = seo_eval($fidDB[metakeywords]);
$titleDB[description] = seo_eval($fidDB[metadescription]);

//栏目风格
$fidDB[style] && $STYLE=$fidDB[style];


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
	$FidTpl['list'] && $FidTpl['list']=Mpath.$FidTpl['list'];
}

//大分类与小栏目的判断
if($fidDB[type]){
	$sortDB=ListOnlySort();
}else{
	$_erp=$Fid_db[tableid][$fid];
	if($fidDB[maxperpage]){
		$rows=$fidDB[maxperpage];
	}elseif($webdb[Info_ListNum]){
		$rows=$webdb[Info_ListNum];
	}else{
		$rows=20;
	}
	$listdb=ListThisSort($rows,70);

	if($totalNum){
		$showpage=getpage("","","list.php?",$rows,$totalNum);
		$showpage=preg_replace("/list\.php\?&page=([0-9]+)/eis","get_info_url('',$fid,$city_id,$zone_id,$street_id,array($TempSearch_2$TempSearch_3$TempSearch_4'page'=>'\\1'))",$showpage);
	}
}

/**
*为获取標签参数
**/
$chdb[main_tpl]=$fidDB[type]?html("bigsort",$FidTpl['list']):html("list_$fidDB[mid]",$FidTpl['list']);

/**
*標签
**/
$ch_fid	= intval($fidDB[config][label_list]);		//是否定义了栏目专用標签
$ch_pagetype = 2;									//2,为list页,3,为bencandy页
$ch_module = $webdb[module_id]?$webdb[module_id]:99;//系统特定ID参数,每個系统不能雷同
$ch = 0;											//不属于任何专題
require(ROOT_PATH."inc/label_module.php");

require(Mpath."inc/head.php");
require($fidDB[type]?html("bigsort",$FidTpl['list']):html("list_$fidDB[mid]",$FidTpl['list']));
require(Mpath."inc/foot.php");


if($jobs=='show'){	//更新標签
	@unlink($Cache_FileName);
}elseif($webdb[Info_list_cache]&&(time()-filemtime($Cache_FileName))>($webdb[Info_list_cache]*60)){

	if($page<10&&!$otherSelect&&!$zone_id&&!$street_id){
		if(!is_dir(dirname($Cache_FileName))){
			makepath(dirname($Cache_FileName));
		}

		//预先清除多余的文件
		$handle=opendir(dirname($Cache_FileName));
		while($file=readdir($handle)){
			if(eregi("^$page-",$file)){
				unlink(dirname($Cache_FileName)."/$file");
			}
		}

		write_file($Cache_FileName,$content);
	}
}


		$orders = $orders;

/**
*针对栏目获取内容信息列表
**/
function ListThisSort($rows,$leng,$orders){
	global $db,$_pre,$page,$fid,$fidDB,$SQL,$city_id,$zone_id,$street_id,$orders,$field_db,$timestamp,$webdb,$timestamp,$Murl,$Fid_db,$_erp,$totalNum,$otherSelect,$Module_db;
	$SQL='';
	if($street_id>0){
		$SQL =" AND A.street_id='$street_id' ";
	}elseif($zone_id>0){
		$SQL =" AND A.zone_id='$zone_id' ";
	}elseif($city_id>0){
		$SQL =" AND A.city_id='$city_id' ";
	}

	//用户自定义筛选字段,过滤数据
	foreach($field_db AS $key=>$value){
		if($value[listfilter]){
			if($_GET[$key]!=''){
				$otherSelect++;
				$SQL .=" AND B.`$key` like '%$_GET[$key]%' ";
			}
		}
	}

	if(!$webdb[Info_ShowNoYz]){
		$SQL .=" AND A.yz='1' ";
	}
	if($page<1){
		$page=1;
	}
	if($orders==1){
		$sql_list="A.list";
		$sql_order="DESC";
	}elseif($orders==2){
		$sql_list="A.posttime";
		$sql_order="DESC";
	}elseif($orders==3){
		$sql_list="A.lastview";
		$sql_order="DESC";
	}elseif($orders==4){
		$sql_list="A.hits";
		$sql_order="DESC";
	}elseif($orders==5){
		$sql_list="A.levels";
		$sql_order="DESC";
	}else{
		$sql_list="A.list";
		$sql_order="DESC";
	}

	$min=($page-1)*$rows;
	
	$query=$db->query("SELECT SQL_CALC_FOUND_ROWS B.*,A.* FROM {$_pre}content$_erp A LEFT JOIN {$_pre}content_{$fidDB[mid]} B ON A.id=B.id WHERE A.fid=$fid $SQL ORDER BY $sql_list $sql_order LIMIT $min,$rows");
	$RS=$db->get_one("SELECT FOUND_ROWS()");
	$totalNum=$RS['FOUND_ROWS()'];
	while( $rs=$db->fetch_array($query) ){
		if(del_EndTimeInfo($rs)){	//自动删除过期信息
			continue;
		}
		$rs[content]=@preg_replace('/<([^>]*)>/is',"",$rs[content]);	//把HTML代碼过滤掉
		$rs[content]=get_word($rs[full_content]=$rs[content],100);
		$rs[title]=get_word($rs[full_title]=$rs[title],$leng);
		if($rs['list']>$timestamp){
			$rs[title]=" $rs[title]";
		}elseif($rs['list']>$rs[posttime]){
			//置顶过期的信息,需要恢复原來髮布日期以方便排序,放在後面
			$db->query("UPDATE {$_pre}content$_erp SET list='$rs[posttime]' WHERE id='$rs[id]'");
		}
		$times=$timestamp-$rs[posttime];
		if(!$webdb[Info_list_cache]&&$times<3600){
			$rs[times]=ceil($times/60).'分钟前';
		}elseif(!$webdb[Info_list_cache]&&$times<3600*24){
			$rs[times]=ceil($times/3600).'小時前';
		}else{
			$rs[times]=date("m-d",$rs[posttime]);
		}
	
		$rs[posttime]=date("Y-m-d",$rs[full_time]=$rs[posttime]);
		if($rs[picurl]){
			$rs[picurl]=tempdir($rs[picurl]);
		}

		$rs[dtime] = date("Y-m-d",$timestamp);
		$rs[htime] = date("H:i",$timestamp);
		

		$Module_db->showfield($field_db,$rs,'list');
	
		$rs[url]=get_info_url($rs[id],$rs[fid],$rs[city_id]);
		$listdb[]=$rs;
	}
	return $listdb;
}


/**
*大分类
**/
function ListOnlySort(){
	global $Fid_db,$module_DB,$fid,$city_id;
	foreach($Fid_db[$fid] AS $key=>$value){
		unset($rs);
		$rs[name]=$value;
		$rs[fid]=$key;
		$rs[url]=get_info_url('',$rs[fid],$city_id);
		$msconfig=$module_DB[$Fid_db[mid][$key]][field][sortid];
		$detail=explode("\r\n",$msconfig[form_set]);
		foreach( $detail AS $key2=>$value2){
			$detail2=explode("|",$value2);
			$url=get_info_url('',$rs[fid],$city_id,$zoneid,$streetid,$dates,array('sortid'=>"$detail2[0]"));
			$rs[sortdb][]="<A HREF='$url'>$detail2[1]</A>";
		}
		$listdb[]=$rs;
	}
	return $listdb;
}

?>