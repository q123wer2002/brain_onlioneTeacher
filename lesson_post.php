<?php
require(dirname(__FILE__)."/f/global.php");
include_once(ROOT_PATH."data/guide_fid.php");

if(!$lfjid){
		showerr('Ո�ȵ��');
}
if($lfjdb[groupid]=='12'){
		showerr("�v�����T�������M�в�����");
}

$rsdb=$db->get_one("SELECT C.*,F.* FROM {$pre}course C LEFT JOIN {$pre}fenlei_content F ON C.t_id=F.id WHERE C.id='$id'");
$rsdbs=$db->get_one("SELECT * FROM {$pre}course WHERE id='$id'");
$count=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid'");
$countk=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid' and ktime='$rsdbs[ktime]'");
$countkc=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid' and data='$rsdb[data]'");
if(!$rsdb){
	showerr("�v��������");
}
if(!$rsdbs){
	showerr("�A�s�r�g������");
}
if($rsdb[book]>0){
	showerr("�v�������A�s��");
}
if($countk[Num]>0){
	showerr("�����@���r�g�ѽ��A�s���������v�����������A�s�˕r�g��");
}
if($count[Num]>=2&&$lfjdb[groupid]==8){
	showerr("�������M�A�s�Δ��ѽ����꣬Ո�m�M��");
}
if($countkc[Num]>=$webdb[kvips]){
	showerr("ÿ��H�����A�s$webdb[kvips]���n��");
}





    $rsdbs[ktimed]=date("Y��m��d�� H:i",$rsdbs[ktime]);
    $atc_email=$db->get_one("SELECT email from {$pre}memberdata WHERE uid='$lfjuid'");
	$atc_email=$atc_email[email];

	$Title="�n���A�s�ɹ����ѣ�";
	$Content="���ڡ�{$webdb[webname]}���ɹ��A�s���n�̡�<br><br>�v����<A HREF='$webdb[www_url]/bencandy.php?fid=1&id={$rsdb[id]}' target='_blank'>$rsdb[title]</a><br>�_�n�r�g��$rsdbs[ktimed]<br><br><br><br><A HREF='$webdb[www_url]/'>$webdb[www_url]</a>";

    $rsdbtid=$db->get_one("SELECT * FROM {$pre}fenlei_content WHERE id='$rsdbs[t_id]'");
    $atc_emails=$db->get_one("SELECT email from {$pre}memberdata WHERE uid='$rsdbtid[uid]'");
	$atc_emails=$atc_emails[email];
    $atc_lfj=$db->get_one("SELECT * from {$pre}memberdata WHERE uid='$lfjuid'");

	$Titles="�n���A�s�ɹ����ѣ�";
	$Contents="�n���A�s�ɹ����ѣ�<br>�_�n�r�g��$rsdbs[ktimed]<br><br>�W�T����: $atc_lfj[truename]<br>�]��: $atc_lfj[email]<br>Skype: $atc_lfj[msn]<br>�S�Ԓ: $atc_lfj[telephone]<br>�S�֙C: $atc_lfj[mobphone]<br>QQ: $atc_lfj[oicq]<br><br><br><br><A HREF='$webdb[www_url]/'>$webdb[www_url]</a>";

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
		if($smtp->sendmail($atc_emails,$webdb[MailId], $Titles, $Contents, "HTML"))
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
		if(mail($atc_emails, $Titles, $Contents))
		{
			$succeeNUM++;
		}
	}


	$db->query("INSERT INTO `{$pre}course_u` ( `id` , `data` , `time` , `ktime` , `c_id` , `t_id` , `u_id` , `t_name` , `u_name` , `request` , `post` ) VALUES ( '', '$rsdb[data]', '$rsdb[time]', '$rsdbs[ktime]', '$rsdbs[id]', '$rsdb[id]', '$lfjuid', '$rsdb[title]', '$lfjid', '$request', '$timestamp')");
	$db->query("UPDATE `{$pre}course` SET book='1' WHERE id='$rsdbs[id]'");

	refreshto("$webdb[www_url]/member/","���ѽ��ɹ��A�s��<br><br>Ո׼�r�����n��<br><br>�������_�nǰҼ��С�rȡ�������A�s��","10");
?>