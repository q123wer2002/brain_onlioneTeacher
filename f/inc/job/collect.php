<?php
if(!function_exists('html')){
die('F');
}
if(!$lfjid){
	showerr("Ո�ȵ��");
}elseif(!$id){
	showerr("ID������");
}
if($db->get_one("SELECT * FROM `{$_pre}collection` WHERE `id`='$id' AND uid='$lfjuid'")){
	showerr("Ո��Ҫ���}�ղ��v��",1); 
}
if(!$web_admin){
	if($webdb[Info_CollectArticleNum]<1){
		$webdb[Info_CollectArticleNum]=50;
	}
	$rs=$db->get_one("SELECT COUNT(*) AS NUM FROM `{$_pre}collection` WHERE uid='$lfjuid'");
	if($rs[NUM]>=$webdb[Info_CollectArticleNum]){
		showerr("������b���ղ� {$webdb[Info_CollectArticleNum]} λ�v��",1);
	}
}
$db->query("INSERT INTO `{$_pre}collection` (  `id` , `uid` , `posttime`) VALUES ('$id','$lfjuid','$timestamp')");

refreshto("$webdb[www_url]//bencandy.php?fid=1&id=$id","�ղسɹ�!",1);
?>