<?php
require_once("global.php");

if(!$lfjid)
{
	showerr("����û�е��");
}

/**
*��ѡ�е�ģ���Ժ�ɫ������ʾ
**/
$colordb[$mid]="red;";

$SQL=" WHERE u_id='$lfjuid' ";


/**
*ÿҳ��ʾ40��
**/
$rows=15;

if(!$page)
{
	$page=1;
}
$min=($page-1)*$rows;

/*��ҳ����*/
$showpage=getpage("{$pre}course_u","$SQL","?","$rows");

$webdb[UpdatePostTime]>0 || $webdb[UpdatePostTime]=1;

unset($listdb,$i);

$query = $db->query("SELECT * FROM {$pre}course_u $SQL ORDER BY ktime DESC LIMIT $min,$rows");
while($rs = $db->fetch_array($query))
{
	$rss=$db->get_one("SELECT * FROM {$_pre}content WHERE id='$rs[t_id]'");
	$rsc=$db->get_one("SELECT * FROM {$pre}course WHERE t_id='$rs[t_id]' and id='$rs[c_id]'");

	$rs[id]=$rs[id];
	$rs[t_name]=$rs[t_name];
	
	if($timestamp>($rsc[ktime]-600)){
		$rs[del]='<span style="color:#FF0000">���</span>';
	}else{
		$rs[del]='<a href="../post.php?action=dels&fid=1&id='.$rs[id].'" onClick="return confirm(\'��ȷ��Ҫȡ��ԤԼ��?���ɻָ�\');" target="_parent" style="color:#999999">ȡ��</a>';
	}
	
	$rs[ktime]=date("Y��m��d�� H:i",$rs[ktime]);

	$i++;
	$rs[cl]=$i%2==0?'t2':'t1';
	$rs[url]=get_info_url($rss[id],$rss[fid],$rss[city_id]);

	$listdb[]=$rs;
}
$lfjdb[money]=intval(get_money($lfjuid));

require(ROOT_PATH."member/head.php");
require(dirname(__FILE__)."/"."template/list.htm");
require(ROOT_PATH."member/foot.php");
?>