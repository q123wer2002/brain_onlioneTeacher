<?php
require(dirname(__FILE__)."/"."global.php");

$linkdb=array("郵箱驗證"=>"?job=email");

if(!$lfjid){
	showerr("妳還沒登錄");
}

if($action=='email')
{
	if (!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email)) {
		showerr("郵箱不符郃規則"); 
	}
	$Title="來自<$webdb[webname]>的郵箱驗證信息!";
	$eid=str_replace('+','%2B',mymd5("$lfjid\t$lfjuid\t$email"));
	$Content="請點擊以下網阯,以完成郵箱的驗證:<br><A HREF='$webdb[www_url]/do/job.php?job=yzemail&eid=$eid'>$webdb[www_url]/do/job.php?job=yzemail&eid=$eid</A>";
	if($webdb[MailType]=='smtp')
	{
		if(!$webdb[MailServer]||!$webdb[MailPort]||!$webdb[MailId]||!$webdb[MailPw])
		{
			showmsg("請琯理員設置郵件服務器");
		}
		require_once(ROOT_PATH."inc/class.mail.php");
		$smtp = new smtp($webdb[MailServer],$webdb[MailPort],true,$webdb[MailId],$webdb[MailPw]);
		$smtp->debug = false;
		if($smtp->sendmail($email,$webdb[MailId], $Title, $Content, "HTML")){
			$succeed=1;
		}
	}
	elseif(mail($email, $Title, $Content))
	{
		$succeed=1;
	}

	if($succeed){
		refreshto("$FROMURL","係統剛剛髮了一封驗證信息到妳郵箱,請儘快查收,以完成郵件驗證",10);
	}else{
		showerr("郵件髮送失敗.請琯理員检查郵箱服務器設置");
	}

}
elseif($action=='idcard')
{
	if(!$truename){
		showerr("真實姓名不能為空!");
	}
	if(!$idcard){
		showerr("身份證號碼不能為空!");
	}
	if($idcardpic){
		if(!is_file(ROOT_PATH."$webdb[updir]/$idcardpic")){
			showerr("請上传身份证复印件,不能引用其它網阯!");
		}
		if(!eregi("^{$lfjuid}_",basename($idcardpic))&&$idcardpic!="idcard/$lfjuid.jpg"){
			showerr("請上传身份证复印件,不能引用其它图片!");
		}
		if($idcardpic!="idcard/$lfjuid.jpg"){
			unlink(ROOT_PATH."$webdb[updir]/idcard/$lfjuid.jpg");
			rename(ROOT_PATH."$webdb[updir]/$idcardpic",ROOT_PATH."$webdb[updir]/idcard/$lfjuid.jpg");
		}		
	}
	$db->query("UPDATE {$pre}memberdata SET idcard='$idcard',truename='$truename',idcard_yz='-1' WHERE uid='$lfjuid'");
	refreshto("$FROMURL","請等待琯理員審覈",10);
}
elseif($action=='mobphone')
{
	$code=rand(1000,9999);
	if( !eregi("^1(3|5|8)([0-9]{9})$",$mobphone) ){
		showerr("手机號碼有误!");
	}
	$msg=sms_send($mobphone,"妳的验证碼是:$code");

	if($msg!==1){
		showerr("系统髮送短信失败,有可能是妳的手机號碼有误,也有可能是系统的短信接口平台出现故障,請联系琯理员在後台检查短信平台接口!");
	}
	$md5code=str_replace('+','%2B',mymd5("$code\t$mobphone\t$lfjuid","EN"));
	require(dirname(__FILE__)."/"."head.php");
	require(dirname(__FILE__)."/"."template/yz.htm");
	require(dirname(__FILE__)."/"."foot.php");
}
elseif($action=='mobphone2')
{
	if($lfjdb[mob_yz]){
		showerr("請不要重复验证手机號碼!");
	}
	if(!$yznum){
		showerr("請输入验证碼");
	}elseif(!$md5code){
		showerr("资料有误");
	}else{
		unset($code,$mobphone,$uid);
		list($code,$mobphone,$uid)=explode("\t",mymd5($md5code,"DE") );
		if($code!=$yznum||$uid!=$lfjuid){
			showerr("验证碼不对");
		}
	}
	add_user($lfjuid,$webdb[YZ_MobMoney],'手机號碼审核奖分');
	$db->query("UPDATE {$pre}memberdata SET mobphone='$mobphone',mob_yz='1' WHERE uid='$lfjuid'");
	refreshto("yz.php?job=mob","恭喜妳,妳的手机號碼成功通过审核,妳同時得到 {$webdb[YZ_MobMoney]} 個积分奖励!",10);
}
else
{	
	unset($idcardpic);
	if($job=='idcard'){
		if(is_file(ROOT_PATH."$webdb[updir]/idcard/$lfjuid.jpg")){
			$idcardpic="idcard/$lfjuid.jpg";
		}
	}
	require(dirname(__FILE__)."/"."head.php");
	require(dirname(__FILE__)."/"."template/yz.htm");
	require(dirname(__FILE__)."/"."foot.php");
}
?>