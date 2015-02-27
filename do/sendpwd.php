<?php
require_once("global.php");

if($action=='send')
{
	$rs = $userDB->get_allInfo($atc_username,'name');
	if(!$rs){
		showerr("帐號有误,不存在");
	}elseif(!$rs[email]){
		showerr("當前帐號没有设置郵箱,請联系统琯理员帮妳修改密碼!");
	}
	if(!$webdb[mymd5])
	{
		$webdb[mymd5]=rands(10);
		$db->query("REPLACE INTO {$pre}config (`c_key`,`c_value`) VALUES ('mymd5','$webdb[mymd5]')");
		write_file(ROOT_PATH."data/config.php","\$webdb['mymd5']='$webdb[mymd5]';",'a');
	}
	$newpwd=strtolower(rands(8));
	$md5_id=str_replace('+','%2B',mymd5("{$rs[username]}\t{$rs[password]}\t$newpwd"));
	$Title="來自“{$webdb[webname]}”的郵件,取迴密碼!!";
	$Content="妳在“{$webdb[webname]}”的帐號是“{$rs[$TB[username]]}”,妳的新密碼是：“{$newpwd}”,請點擊此以下網阯,激活新密碼,點擊激活後,才可以生效。<br><br><A HREF='$webdb[www_url]/do/sendpwd.php?job=getpwd&md5_id=$md5_id' target='_blank'>$webdb[www_url]/do/sendpwd.php?job=getpwd&md5_id=$md5_id</A>";

	if($webdb[MailType]=='smtp')
	{
		if(!$webdb[MailServer]||!$webdb[MailPort]||!$webdb[MailId]||!$webdb[MailPw])
		{
			showerr("請琯理员先设置郵件服务器");
		}
		require_once(ROOT_PATH."inc/class.mail.php");
		$smtp = new smtp($webdb[MailServer],$webdb[MailPort],true,$webdb[MailId],$webdb[MailPw]);
		$smtp->debug = false;

		if($smtp->sendmail($rs[email],$webdb[MailId], $Title, $Content, "HTML"))
		{
			$succeeNUM++;
		}
	}
	else
	{
		if(mail($rs[email], $Title, $Content))
		{
			$succeeNUM++;
		}
	}
	if($succeeNUM)
	{
		refreshto("../","新密碼已经成功髮送到妳的郵箱:“{$rs[email]}”，請注意查收!",5);
	}
	else
	{
		showerr("郵件髮送失败，可能妳的郵箱有误,或者是服务器髮送郵件功能有问題！！");
	}
}
elseif($job=='getpwd')
{
	if(substr($FROMURL,"$webdb[www_url]/")){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$webdb[www_url]/'>";
		exit;
	}
	list($username,$password,$newpassword)=explode("\t",mymd5($md5_id,'DE'));
	$rs = $userDB->get_allInfo($username,'name');
	if($rs && $rs[password]==$password)
	{
		$userDB->edit_user( array('password'=>$newpassword,'username'=>$username) );
		refreshto("login.php","恭喜妳，新密碼激活成功，請尽快登錄修改密碼!",10);
	}
	else
	{
		if($lfjid){
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=./'>";
			exit;
		}
		refreshto("$webdb[www_url]/","新密碼激活失败!",1);
	}
}

require(ROOT_PATH."inc/head.php");
require(html("sendpwd"));
require(ROOT_PATH."inc/foot.php");
?>