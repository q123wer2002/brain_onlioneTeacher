<?php
if(!function_exists('html')){
die('F');
}
if(!$lfjuid){
	showerr('請先登錄');
}

$rs=$db->get_one("SELECT admin FROM {$_pre}city WHERE fid='$city_id'");
$detail=explode(',',$rs[admin]);
if(in_array($lfjid,$detail)){
	$web_admin=1;
}


$_erp=$Fid_db[tableid][$fid];
$rs=$db->get_one("SELECT * FROM {$_pre}content$_erp WHERE id='$id'");
if($rs[uid]!=$lfjuid&&!$web_admin){
	showerr('妳无权限');
}
$webdb[UpdatePostTime]>0 || $webdb[UpdatePostTime]=1;
if($timestamp-$rs[posttime]<(3600*$webdb[UpdatePostTime])){
	showerr("距离上次更新時間{$webdb[UpdatePostTime]}小時後,才可以操作!");
}
if($rs['list']>$timestamp){
	$list=$rs['list'];
}else{
	$list=$timestamp;
}
$db->query("UPDATE {$_pre}content$_erp SET list='$list',posttime='$timestamp' WHERE id='$id'");
refreshto("$FROMURL","操作成功,本条信息被顶在列表页的前面了!",1);
?>