<?php
!function_exists('html') && exit('ERR');
if($job=="list"&&$Apower[alonepage_list])
{
	$rows=30;
	if(!$page){
		$page=1;
	}
	if($id){
		$SQL.="and A.id='$id' ";
	}
	if($t_id){
		$SQL.="and A.t_id='$t_id' ";
	}
	if($t_name){
		$SQL.="and A.t_name LIKE '%$t_name%'  ";
	}
	if($u_id){
		$SQL.="and A.u_id='$u_id' ";
	}
	if($u_name){
		$SQL.="and A.u_name LIKE '%$u_name%'  ";
	}
	if($data){
		$SQL.="and A.data='$data' ";
	}
	if($time){
		$SQL.="and A.time='$time' ";
	}
	if($yz){
		$SQL.="and A.yz='$yz' ";
	}
	if($off==1){
		$SQL.="and A.ktime<$timestamp ";
	}elseif($off==2){
		$SQL.="and A.ktime>$timestamp ";
	}

	if($order==1){
		$ORDER.=" A.ktime DESC,A.id DESC ";
	}elseif($order==2){
		$ORDER.=" A.ktime ASC,A.id DESC ";
	}elseif($order==3){
		$ORDER.=" A.post DESC,A.id DESC ";
	}elseif($order==4){
		$ORDER.=" A.post ASC,A.id DESC ";
	}else{
		$ORDER.=" A.id DESC ";
	}


	$min=($page-1)*$rows;
	$showpage=getpage("`{$pre}course_u` A","WHERE data>0 $SQL","?lfj=$lfj&job=$job&t_id=$t_id&id=$id&t_name=$t_name&data=$data&time=$time&yz=$yz&off=$off&order=$order",$rows);
	$query=$db->query("SELECT A.*,B.username AS username FROM `{$pre}course_u` A LEFT JOIN {$pre}memberdata B ON A.u_id=B.uid WHERE data>0 $SQL ORDER BY $ORDER LIMIT $min,$rows");
	while($rs=$db->fetch_array($query)){
	
	    $rs[post]=date("Y-m-d H:i:s",$rs[post]);
	    $rs[ktime]=$rs[ktime];
		
		if($rs[ktime]>$timestamp){
			$rs[ya]='未開課';
			$rs[ys]=' ';
		}elseif($rs[ktime]<$timestamp){
			$rs[ya]='<font color=#FF0000>已開課</font>';
			if($rs[yz]==0){
				$rs[ys]='<a href="index.php?lfj='.$lfj.'&job=setyz&yz=1&id='.$rs[id].'" style="color:red;"><font color=#0000FF>登記缺席</font></a>';
			}elseif($rs[yz]==1){
				$rs[ys]=' <font color=#FFBB04>已缺席</font> ';
			}else{
				$rs[ys]=' ';
			}
		}


		$listdb[]=$rs;
	}
	require(dirname(__FILE__)."/"."head.php");
	require(dirname(__FILE__)."/"."template/course_u/list.htm");
	require(dirname(__FILE__)."/"."foot.php");
}
elseif($job=="setyz"&&$Apower[alonepage_list])
{
	$rs=$db->get_one("SELECT * FROM `{$pre}course_u` WHERE id='$id'");
	unlink(ROOT_PATH.$rs[filename]);
	$db->query("UPDATE `{$pre}course_u` SET yz='1' WHERE id='$id'");
	jump("操作成功","index.php?lfj=$lfj&job=list",2);
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