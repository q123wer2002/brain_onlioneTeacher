<?php
require_once("global.php");

if($action=='send')
{
	$rs=$userDB->get_allInfo($atc_username,'name');
	if(!$rs){
		showerr("��̖������");
	}elseif($rs[yz]){
		showerr("��ǰ��̖�Ѿ�������,�������ظ�����!");
	}elseif(!$atc_email){
		showerr("Ո�����]��!");
	}
	if (!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$atc_email)) {
		showerr("�]�䲻���Ϲ���"); 
	}
	if(!$webdb[mymd5])
	{
		$webdb[mymd5]=rands(10);
		$db->query("REPLACE INTO {$pre}config (`c_key`,`c_value`) VALUES ('mymd5','$webdb[mymd5]')");
		write_file(ROOT_PATH."data/config.php","\$webdb['mymd5']='$webdb[mymd5]';",'a');
	}
	$md5_id=str_replace('+','%2B',mymd5("{$rs[username]}\t{$rs[password]}"));
	$Title="���ԡ�{$webdb[webname]}�����]��,Ո������̖!!";
	$Content="���ڡ�{$webdb[webname]}������̖�ǡ�{$rs[$TB[username]]}����û����,Ո�c�������¾W�n,�������̖��<br><br><A HREF='$webdb[www_url]/do/activate.php?job=activate&md5_id=$md5_id' target='_blank'>$webdb[www_url]/do/activate.php?job=activate&md5_id=$md5_id</A>";

	if($webdb[MailType]=='smtp')
	{
		if(!$webdb[MailServer]||!$webdb[MailPort]||!$webdb[MailId]||!$webdb[MailPw])
		{
			showmsg("Ո�g��Ա�������]��������");
		}
		require_once(ROOT_PATH."inc/class.mail.php");
		$smtp = new smtp($webdb[MailServer],$webdb[MailPort],true,$webdb[MailId],$webdb[MailPw]);
		$smtp->debug = false;

		if($smtp->sendmail($atc_email,$webdb[MailId], $Title, $Content, "HTML"))
		{
			$succeeNUM++;
		}
	}
	else
	{
		if(mail($atc_email, $Title, $Content))
		{
			$succeeNUM++;
		}
	}
	if($succeeNUM)
	{
		refreshto("/","ϵͳ�Ѿ��ɹ�����]���������]��:��{$atc_email}����Ոע�����!",5);
	}
	else
	{
		showerr("�]�����ʧ�ܣ����܊����]������,�����Ƿ���������]�����������}����");
	}
}
elseif($job=='activate')
{
	list($username,$password)=explode("\t",mymd5($md5_id,'DE'));

	$rs=$userDB->get_allInfo($username,'name');

	if($rs&&$rs[password]==$password)
	{
		$db->query("UPDATE {$pre}memberdata SET `yz`='1' WHERE uid='$rs[uid]'");
		refreshto("login.php","��ϲ����������̖��{$username}������ɹ���Ո������䛣������Ա���еĹ���!",10);
	}
	else
	{
		showerr("��̖����ʧ��!");
	}
}

if($username){
	$rs=$userDB->get_allInfo($username,'name');
	$email=$rs[email];
}
require(ROOT_PATH."inc/head.php");
require(html("activate"));
require(ROOT_PATH."inc/foot.php");
?>