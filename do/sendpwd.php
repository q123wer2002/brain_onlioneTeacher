<?php
require_once("global.php");

if($action=='send')
{
	$rs = $userDB->get_allInfo($atc_username,'name');
	if(!$rs){
		showerr("��̖����,������");
	}elseif(!$rs[email]){
		showerr("��ǰ��̖û�������]��,Ո��ϵͳ�g��Ա��޸��ܴa!");
	}
	if(!$webdb[mymd5])
	{
		$webdb[mymd5]=rands(10);
		$db->query("REPLACE INTO {$pre}config (`c_key`,`c_value`) VALUES ('mymd5','$webdb[mymd5]')");
		write_file(ROOT_PATH."data/config.php","\$webdb['mymd5']='$webdb[mymd5]';",'a');
	}
	$newpwd=strtolower(rands(8));
	$md5_id=str_replace('+','%2B',mymd5("{$rs[username]}\t{$rs[password]}\t$newpwd"));
	$Title="���ԡ�{$webdb[webname]}�����]��,ȡޒ�ܴa!!";
	$Content="���ڡ�{$webdb[webname]}������̖�ǡ�{$rs[$TB[username]]}��,�������ܴa�ǣ���{$newpwd}��,Ո�c�������¾W�n,�������ܴa,�c��������,�ſ�����Ч��<br><br><A HREF='$webdb[www_url]/do/sendpwd.php?job=getpwd&md5_id=$md5_id' target='_blank'>$webdb[www_url]/do/sendpwd.php?job=getpwd&md5_id=$md5_id</A>";

	if($webdb[MailType]=='smtp')
	{
		if(!$webdb[MailServer]||!$webdb[MailPort]||!$webdb[MailId]||!$webdb[MailPw])
		{
			showerr("Ո�g��Ա�������]��������");
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
		refreshto("../","���ܴa�Ѿ��ɹ���͵������]��:��{$rs[email]}����Ոע�����!",5);
	}
	else
	{
		showerr("�]�����ʧ�ܣ����܊����]������,�����Ƿ���������]�����������}����");
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
		refreshto("login.php","��ϲ�������ܴa����ɹ���Ո�������޸��ܴa!",10);
	}
	else
	{
		if($lfjid){
			echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=./'>";
			exit;
		}
		refreshto("$webdb[www_url]/","���ܴa����ʧ��!",1);
	}
}

require(ROOT_PATH."inc/head.php");
require(html("sendpwd"));
require(ROOT_PATH."inc/foot.php");
?>