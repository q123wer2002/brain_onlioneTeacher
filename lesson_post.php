<?php
require(dirname(__FILE__)."/f/global.php");
include_once(ROOT_PATH."data/guide_fid.php");

if(!$lfjid){
		showerr('請先登錄');
}
if($lfjdb[groupid]=='12'){
		showerr("講師會員，不能進行操作。");
}

$rsdb=$db->get_one("SELECT C.*,F.* FROM {$pre}course C LEFT JOIN {$pre}fenlei_content F ON C.t_id=F.id WHERE C.id='$id'");
$rsdbs=$db->get_one("SELECT * FROM {$pre}course WHERE id='$id'");
$count=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid'");
$countk=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid' and ktime='$rsdbs[ktime]'");
$countkc=$db->get_one("SELECT COUNT(*) AS Num from {$pre}course_u WHERE u_id='$lfjuid' and data='$rsdb[data]'");
if(!$rsdb){
	showerr("講師不存在");
}
if(!$rsdbs){
	showerr("預約時間不存在");
}
if($rsdb[book]>0){
	showerr("講師已有預約！");
}
if($countk[Num]>0){
	showerr("妳在這個時間已經預約了其它的講師，不能再預約此時間！");
}
if($count[Num]>=2&&$lfjdb[groupid]==8){
	showerr("妳的免費預約次數已經用完，請續費！");
}
if($countkc[Num]>=$webdb[kvips]){
	showerr("每天僅限制預約$webdb[kvips]堂課！");
}





    $rsdbs[ktimed]=date("Y年m月d日 H:i",$rsdbs[ktime]);
    $atc_email=$db->get_one("SELECT email from {$pre}memberdata WHERE uid='$lfjuid'");
	$atc_email=$atc_email[email];

	$Title="課程預約成功提醒！";
	$Content="妳在“{$webdb[webname]}”成功預約了課程。<br><br>講師：<A HREF='$webdb[www_url]/bencandy.php?fid=1&id={$rsdb[id]}' target='_blank'>$rsdb[title]</a><br>開課時間：$rsdbs[ktimed]<br><br><br><br><A HREF='$webdb[www_url]/'>$webdb[www_url]</a>";

    $rsdbtid=$db->get_one("SELECT * FROM {$pre}fenlei_content WHERE id='$rsdbs[t_id]'");
    $atc_emails=$db->get_one("SELECT email from {$pre}memberdata WHERE uid='$rsdbtid[uid]'");
	$atc_emails=$atc_emails[email];
    $atc_lfj=$db->get_one("SELECT * from {$pre}memberdata WHERE uid='$lfjuid'");

	$Titles="課程預約成功提醒！";
	$Contents="課程預約成功提醒！<br>開課時間：$rsdbs[ktimed]<br><br>學員姓名: $atc_lfj[truename]<br>郵箱: $atc_lfj[email]<br>Skype: $atc_lfj[msn]<br>聯係電話: $atc_lfj[telephone]<br>聯係手機: $atc_lfj[mobphone]<br>QQ: $atc_lfj[oicq]<br><br><br><br><A HREF='$webdb[www_url]/'>$webdb[www_url]</a>";

	if($webdb[MailType]=='smtp')
	{
		if(!$webdb[MailServer]||!$webdb[MailPort]||!$webdb[MailId]||!$webdb[MailPw])
		{
			showmsg("請琯理员先设置郵件服务器");
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

	refreshto("$webdb[www_url]/member/","您已經成功預約！<br><br>請准時參加課程<br><br>可以在開課前壹個小時取消本次預約。","10");
?>