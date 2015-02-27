<?php
require("global.php");

if(!$lfjid){
	showerr("妳還沒登錄");
}

$lfjdb[money]=get_money($lfjuid);

if($job=="buy"||$action=='buy'){
	$rsdb=$db->get_one("SELECT * FROM {$pre}group WHERE gid='$gid'");
	if(!$rsdb){
		showerr("资料有误");
	}	
}

if($action=='buy')
{
	if($rsdb[gptype]){
		showerr("系统級別,妳不能購買!");
	}
	if($lfjdb[groupid]==3||$lfjdb[groupid]==4){
		showerr("妳是琯理员,不可以購買比妳低的級別");
	}
	if($lfjdb[money]<$rsdb[levelnum]){
		showerr("妳的积分不足$rsdb[levelnum]");
	}
	$lfjdb[C][endtime]=$timestamp+$webdb[groupTime]*3600*24;
	$config=addslashes(serialize($lfjdb[C]));
	$db->query("UPDATE {$pre}memberdata SET config='$config',groupid='$gid' WHERE uid='$lfjuid'");
	add_user($lfjuid,-$rsdb[levelnum],'購買会员級別扣分');
	refreshto("$FROMURL","恭喜妳,升级成功",1);
}

 
$query = $db->query("SELECT * FROM {$pre}group WHERE gptype=0");
while($rs = $db->fetch_array($query)){
	$rs[g]=@include_once(ROOT_PATH."data/group/$rs[gid].php");
	$listdb[]=$rs;
}

if($lfjdb[C][endtime]&&$lfjdb[groupid]!=8){
	$lfjdb[C][endtime]=date("Y-m-d",$lfjdb[C][endtime]);
	$lfjdb[C][endtime]="截止日期为:{$lfjdb[C][endtime]}，";
}else{
	$lfjdb[C][endtime]='';
}

require(dirname(__FILE__)."/"."head.php");
require(dirname(__FILE__)."/"."template/buygroup.htm");
require(dirname(__FILE__)."/"."foot.php");

?>