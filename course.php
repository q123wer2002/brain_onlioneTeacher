<?php
require(dirname(__FILE__)."/f/global.php");

if($lfjdb[groupid]!='12'){
		showerr("�㲻���v�����T�������M�в�����");
}

$rsu=$db->get_one("SELECT COUNT(*) AS Num FROM {$pre}fenlei_content WHERE uid='$lfjuid'");

				if($rsu[Num]==0){
				  showerr("Ո������v���Y�ϣ�");
				}


	$rsdb=$db->get_one("SELECT * FROM `{$pre}fenlei_content` WHERE uid='$lfjuid'");
	$t_id=$rsdb[id];

	$rsdb[times]=date("Y-m-d",$timestamp);
	$rsdb[times1]=date("Y-m-d",$timestamp+1*3600*24);
	$rsdb[times2]=date("Y-m-d",$timestamp+2*3600*24);
	$rsdb[times3]=date("Y-m-d",$timestamp+3*3600*24);
	$rsdb[times4]=date("Y-m-d",$timestamp+4*3600*24);
	$rsdb[times5]=date("Y-m-d",$timestamp+5*3600*24);
	$rsdb[times6]=date("Y-m-d",$timestamp+6*3600*24);
	$rsdb[times7]=date("Y-m-d",$timestamp+7*3600*24);

if($job=="setbookadd")
{
    $kotime=filtrate(strip_tags("$data $time"));
    $ktime=strtotime($kotime);
	
    $dates=$dates;
	$db->query("insert into {$pre}course(`data`, `time`, `t_id`, `book`, `ktime`) values('$data','$time','$t_id','$book','$ktime')");
	refreshto("$webdb[www_url]/course.php#$time","Ñ�ĳɹ�",0);
}
elseif($job=="setbookdel")
{
    $dates=$dates;
	$db->query("delete from {$pre}course WHERE t_id='$t_id' and data='$data' and time='$time'");
	refreshto("$webdb[www_url]/course.php#$time","Ñ�ĳɹ�",0);
}
elseif($job=="setbooka")
{

$rsdb=$db->get_one("SELECT * from {$pre}course_u WHERE t_id='$t_id' and data='$data' and time='$time'");

if($rsdb[id]){
	showerr('�Ѿ����û�ԤԼ�����ܸı�ˠ�̬��');
}

    $dates=$dates;
	$db->query("UPDATE `{$pre}course` SET book='0' WHERE t_id='$t_id' and data='$data' and time='$time'");
	refreshto("$webdb[www_url]/course.php#$time","Ñ�ĳɹ�",0);
}
elseif($job=="setbookb")
{
    $dates=$dates;
	$db->query("UPDATE `{$pre}course` SET book='$book' WHERE t_id='$t_id' and data='$data' and time='$time'");
	refreshto("$webdb[www_url]/course.php#$time","Ñ�ĳɹ�",0);
}

//ÿ����Ŀ����Ϣ��
require(Mpath."inc/head.php");
require(html("course",$main_tpl));
require(Mpath."inc/foot.php");



?>