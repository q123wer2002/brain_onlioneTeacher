<?php
!function_exists('html') && exit('ERR');
if($job=="edit"&&$Apower[alonepage_list])
{

	$rsdb=$db->get_one("SELECT * FROM `{$pre}fenlei_content` WHERE id='$id'");
	//真实地阯还原
	$rsdb[content]=En_TruePath($rsdb[content],0);

	$rsdb[content]=editor_replace($rsdb[content]);
	
	$timestamps=strtotime($dates);
	$rs[pre]=date("Y-m-d",strtotime($dates)-7*3600*24);
	$rs[nex]=date("Y-m-d",strtotime($dates)+7*3600*24);
	
	$rsdb[times]=date("Y-m-d",$timestamps);
	$rsdb[times1]=date("Y-m-d",$timestamps+1*3600*24);
	$rsdb[times2]=date("Y-m-d",$timestamps+2*3600*24);
	$rsdb[times3]=date("Y-m-d",$timestamps+3*3600*24);
	$rsdb[times4]=date("Y-m-d",$timestamps+4*3600*24);
	$rsdb[times5]=date("Y-m-d",$timestamps+5*3600*24);
	$rsdb[times6]=date("Y-m-d",$timestamps+6*3600*24);
	$rsdb[times7]=date("Y-m-d",$timestamps+7*3600*24);

	require(dirname(__FILE__)."/"."head.php");
	require(dirname(__FILE__)."/"."template/course/menu.htm");
	require(dirname(__FILE__)."/"."template/course/edit.htm");
	require(dirname(__FILE__)."/"."foot.php");
}
elseif($action=="setbookadd"&&$Apower[alonepage_list])
{
    $kotime=filtrate(strip_tags("$data $time"));
    $ktime=strtotime($kotime);
	
    $dates=$dates;
	$db->query("insert into {$pre}course(`data`, `time`, `t_id`, `book`, `ktime`) values('$data','$time','$t_id','$book','$ktime')");
	refreshto("index.php?lfj=course&job=edit&id=$t_id&dates={$dates}#$time","脩改成功",0);
}
elseif($action=="setbookdel"&&$Apower[alonepage_list])
{
    $dates=$dates;
	$db->query("delete from {$pre}course WHERE t_id='$t_id' and data='$data' and time='$time'");
	refreshto("index.php?lfj=course&job=edit&id=$t_id&dates={$dates}#$time","脩改成功",0);
}
elseif($action=="setbooka"&&$Apower[alonepage_list])
{

$rsdb=$db->get_one("SELECT * from {$pre}course_u WHERE t_id='$t_id' and data='$data' and time='$time'");

if($rsdb[id]){
	showmsg('已经有用户预约，不能改变此狀态！');
}

    $dates=$dates;
	$db->query("UPDATE `{$pre}course` SET book='0' WHERE t_id='$t_id' and data='$data' and time='$time'");
	refreshto("index.php?lfj=course&job=edit&id=$t_id&dates={$dates}#$time","脩改成功",0);
}
elseif($action=="setbookb"&&$Apower[alonepage_list])
{
    $dates=$dates;
	$db->query("UPDATE `{$pre}course` SET book='1' WHERE t_id='$t_id' and data='$data' and time='$time'");
	refreshto("index.php?lfj=course&job=edit&id=$t_id&dates={$dates}#$time","脩改成功",0);
}
elseif($action=="list"&&$Apower[alonepage_list])
{
	if(!$iddb[0]){
		showmsg('請选择一条!');
	}
	$id = $iddb[0];
	unset($iddb[0]);
	if($iddb[1])$ids = implode(',',$iddb);
	echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$webdb[www_url]/do/course.php?id=$id&ids=$ids&job=makehtml&adminurl=$webdb[admin_url]'>";
	exit;
}
elseif($action=="check"&&$Apower[alonepage_list])
{
	if($ifclose){
		$rsdb=$db->get_one("SELECT * FROM {$pre}fenlei_content WHERE id='$id'");
		unlink(ROOT_PATH."$rsdb[filename]");
	}
	$db->query("UPDATE `{$pre}fenlei_content` SET `ifclose`='$ifclose' WHERE id='$id'");
	jump("设置成功",$FROMURL,0);
}
elseif($job=="list"&&$Apower[alonepage_list])
{
	if(!table_field("{$pre}fenlei_content",'ifclose')){
		$db->query("ALTER TABLE `{$pre}fenlei_content` ADD `ifclose` TINYINT( 1 ) NOT NULL");
	}
	!$page && $page=1;
	$rows=50;
	$min=($page-1)*$rows;
	$showpage=getpage("`{$pre}fenlei_content`","","index.php?lfj=alonepage&job=list",$rows);
	$query=$db->query("SELECT * FROM `{$pre}fenlei_content` ORDER BY id DESC LIMIT $min,$rows");
	while($rs=$db->fetch_array($query)){
		$rs[posttime]=date("Y-m-d H:i",$rs[posttime]);
		$rs[dates]=date("Y-m-d",$timestamp);
		if($rs[ifclose]){
			$rs[_ifclose]="<A HREF='?lfj=$lfj&action=check&id=$rs[id]&ifclose=0'><img alt='當前处于关闭狀态' src='../member/images/check_no.gif' border=0></A>";
			$rs[checked]='';
		}else{
			$rs[checked]=' checked ';
			$rs[_ifclose]="<A HREF='?lfj=$lfj&action=check&id=$rs[id]&ifclose=1'><img alt='當前处于开放狀态' src='../member/images/check_yes.gif' border=0></A>";
		}
		$listdb[]=$rs;
	}
	require(dirname(__FILE__)."/"."head.php");
	require(dirname(__FILE__)."/"."template/course/menu.htm");
	require(dirname(__FILE__)."/"."template/course/list.htm");
	require(dirname(__FILE__)."/"."foot.php");
}
elseif($action=="delete"&&$Apower[alonepage_list])
{
	$rs=$db->get_one("SELECT * FROM `{$pre}alonepage` WHERE id='$id'");
	unlink(ROOT_PATH.$rs[filename]);
	$db->query("DELETE FROM `{$pre}alonepage` WHERE id='$id'");
	jump("删除成功","index.php?lfj=alonepage&job=list",2);
}
elseif($action=="edit"&&$Apower[alonepage_list])
{
	if($postdb[filename]&&!eregi("(\.html|\.htm)$",$postdb[filename])){
		showmsg("静态網页名只能是.html或者是.htm文件");
	}
	$postdb[content]=En_TruePath($postdb[content]);
	$db->query("UPDATE `{$pre}alonepage` SET fid='$postdb[fid]',name='$postdb[name]',title='$postdb[title]',posttime='$timestamp',uid='$postdb[uid]',username='$postdb[username]',style='$postdb[style]',tpl_head='$postdb[tpl_head]',tpl_foot='$postdb[tpl_foot]',tpl_main='$postdb[tpl_main]',filename='$postdb[filename]',filepath='$postdb[filepath]',keywords='$postdb[keywords]',content='$postdb[content]',descrip='$postdb[descrip]' WHERE id='$id' ");
	jump("脩改成功","index.php?lfj=alonepage&job=edit&id=$id",1);
}