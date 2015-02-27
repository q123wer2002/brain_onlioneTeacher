<?php
require(dirname(__FILE__)."/f/global.php");

    if($lfjdb[groupid]!='12'){
		showerr("你不是講師會員，不能進行操作。");
    }

    $rsu=$db->get_one("SELECT COUNT(*) AS Num FROM {$pre}fenlei_content WHERE uid='$lfjuid'");

				if($rsu[Num]==0){
				  showerr("請先錄入講師資料！");
				}
				
    $rst=$db->get_one("SELECT * FROM {$pre}fenlei_content WHERE uid='$lfjuid'");
	$rst[id]=$rst[id];
	
	
	if($rst[uid]){
		$SQL.=" WHERE D.t_id=$rst[id] ";
	}
	
	if(!$page){
		$page=1;
	}
	$rows=20;
	$min=($page-1)*$rows;
	$showpage=getpage("{$pre}course_u D","$SQL","index.php?lfj=$lfj&job=$job&type=$type&T=$T&keywords=$keywords&groupid=$groupid",$rows);
	$query=$db->query("SELECT D.* FROM {$pre}course_u D $SQL ORDER BY D.ktime DESC LIMIT $min,$rows ");
	while($rs=$db->fetch_array($query)){

		
		if($rs[yz]=='0'&&$rs[ktime]<$timestamp+60*15&&$rs[records]==''){
			$rs[yz]="<a href='?job=setyz&yz=1&id=$rs[id]'>登記缺席</a>";
			$rs[records_a]="<a href=\"###\" onclick=\"openShutManager(this,'box$rs[id]',false,'錄入','錄入')\">錄入</a>";
			$rs[students_a]="<a href=\"###\" onclick=\"openShutManager(this,'boxs$rs[id]',false,'錄入','錄入')\">錄入</a>";
		}elseif($rs[yz]=='0'&&$rs[ktime]<$timestamp+60*15&&$rs[records]!=''){
			$rs[yz]="<font color='#6EA702'>出席</font>";
			$rs[records_a]="<a href=\"###\" onclick=\"openShutManager(this,'box$rs[id]',false,'錄入','錄入')\">錄入</a>";
			$rs[students_a]="<a href=\"###\" onclick=\"openShutManager(this,'boxs$rs[id]',false,'錄入','錄入')\">錄入</a>";
		}elseif($rs[yz]=='1'&&$rs[ktime]<$timestamp+60*15){
			$rs[yz]="<font color='#FFCC00'>已缺席</font>";
		}elseif($timestamp>$rs[ktime]&&$rs[ktime]<$timestamp+60*15){
			$rs[yz]="<font color='#FE0000'>上課中</font>";
		}else{
			$rs[yz]="<font color='#FE0000'>未開課</font>";
			$rs[records_a]="<font color='#FE0000'>未開課</font>";
			$rs[students_a]="<font color='#FE0000'>未開課</font>";
		}
		
		
		
		
		$rs[ktime]=date("Y年m月d日 H:i",$rs[ktime]);
		
		$listdb[]=$rs;
	}
	
if($job=="setyz")
{
    $id=$id;
	$rsz=$db->get_one("SELECT * FROM `{$pre}course_u` WHERE id='$id'");
    if($rsz[ktime]>$timestamp+60*15){
	showerr('課程還沒有結束不能進行操作。');
    }
	$db->query("UPDATE `{$pre}course_u` SET yz='1' WHERE id='$id'");
	refreshto("$FROMURL","脩改成功",0);
}
elseif($job=="records")
{
	$db->query("UPDATE `{$pre}course_u` SET records='$records' WHERE id='$id'");
	refreshto("$FROMURL","脩改成功",0);
}
elseif($job=="students")
{
	$db->query("UPDATE `{$pre}course_u` SET students='$students' WHERE id='$id'");
	refreshto("$FROMURL","脩改成功",0);
}
	
	
	

require(Mpath."inc/head.php");
require(html("course_u"));
require(Mpath."inc/foot.php");
?>