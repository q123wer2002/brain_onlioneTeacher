<?php
function_exists('html') OR exit('ERR');

ck_power('comment');

if($job=="list")
{
	!$page&&$page=1;
	$rows=20;
	$min=($page-1)*$rows;
	$showpage=getpage("{$_pre}comments","","$admin_path&job=$job","$rows");
	$query=$db->query(" SELECT * FROM {$_pre}comments ORDER BY cid DESC LIMIT $min,$rows ");
	while($rs=$db->fetch_array($query)){
		$rs[content]=preg_replace("/<([^<]+)>/is","",$rs[content]);
		$rs[content]=get_word($rs[content],80);
		$rs[posttime]=date("m-d",$rs[posttime]);
		$rs[username]=$rs[username]?$rs[username]:$rs[ip];
		$rs[ifgood]=$rs[type]==1?'<font color=red>����</font>':'��ͨ';
		if($rs[yz]==1){
			$rs[yz]="<A HREF='$admin_path&action=list&jobs=unyz&ciddb[{$rs[cid]}]=$rs[cid]' style='color:blue;'>�����</A>";
		}elseif($rs[yz]==0){
			$rs[yz]="<A HREF='$admin_path&action=list&jobs=yz&ciddb[{$rs[cid]}]=$rs[cid]' style='color:red;'>δ���</A>";
		}

		$_erp=$Fid_db[tableid][$rs[fid]];
		$_rs=$db->get_one("SELECT * FROM {$_pre}content$_erp WHERE id='$rs[id]'");
		$rs[title]=$_rs[title];
		$rs[city_id]=$_rs[city_id];

		$listdb[]=$rs;
	}

	get_admin_html('list');
}
elseif($action=="list")
{
	if(!$ciddb){
		showmsg("Ոѡ��һ���u�r");
	}
	if($jobs=="delete")
	{
		foreach($ciddb AS $key=>$rs){
			$rs=$db->get_one("SELECT fid,id FROM {$_pre}comments WHERE cid='$key' ");
			$_erp=$Fid_db[tableid][$rs[fid]];
			$db->query(" UPDATE {$_pre}content$_erp SET comments=comments-1 WHERE id='$rs[id]' ");
			$db->query("DELETE FROM {$_pre}comments WHERE cid='$key' ");
			$ck++;
		}
	}
	elseif($jobs=="yz"||$jobs=="unyz")
	{
		if($jobs=="yz"){
			$yz=1;
		}else{
			$yz=0;
		}
		foreach($ciddb AS $key=>$rs){
			$db->query(" UPDATE {$_pre}comments SET yz='$yz' WHERE cid='$key' ");
			$ck++;
		}
	}
	elseif($jobs=="good"||$jobs=="ungood")
	{
		foreach($ciddb AS $key=>$rs){
			$rs=$db->get_one("SELECT * FROM {$_pre}comments WHERE cid='$key'");
			if($jobs=="good"&&$rs[type]!=1){
				$db->query(" UPDATE {$_pre}comments SET type='1' WHERE cid='$key' ");
				add_user($rs[uid],abs($webdb[GoodCommentMoney]));
			}elseif($jobs=="ungood"&&$rs[type]==1){
				$db->query(" UPDATE {$_pre}comments SET type='0' WHERE cid='$key' ");
				add_user($rs[uid],-abs($webdb[GoodCommentMoney]));
			}			
			$ck++;
		}
	}
	$retime=$ck==1?0:1;
	refreshto("$FROMURL","�����ɹ�",$retime);
}
elseif($job=="show")
{
	$rsdb=$db->get_one("SELECT * FROM {$_pre}comments WHERE cid='$cid' ");
	$rsdb[content]=str_replace("\r\n","<br>",$rsdb[content]);

	get_admin_html('show');
}