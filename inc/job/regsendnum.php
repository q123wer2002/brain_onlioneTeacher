<?php
!function_exists('html') && exit('ERR');
//當前文件是注册時通过手机或郵箱获取注册碼的功能
if(!is_table("{$pre}regnum")){
	$db->query("CREATE TABLE `{$pre}regnum` (
	`sid` varchar( 8 ) NOT NULL default '',
	`num` varchar( 6 ) NOT NULL default '',
	`posttime` int( 10 ) NOT NULL default '0',
	UNIQUE KEY `sid` ( `sid` ) ,
	KEY `posttime` ( `num` , `posttime` ) 
	) TYPE = HEAP");
}
if(!$webdb[yzNumReg]){
	showerr('系统没开放这個功能！');
}
$time=$timestamp-60;
if($db->get_one("SELECT * FROM {$pre}regnum WHERE sid='$usr_sid' AND posttime>$time")){
	showerr("如果妳的注册碼还没有收到的话？請一分钟後再重髮！");
}
$sms = rands(4);
$content = $webdb['webname']."提供给您的注册碼是:(".$sms.")这四位数";
if($webdb[yzNumReg]==2){
	if(!ereg("^1([0-9]{10})$",$num)){
		showerr('手机號碼有误！'.$num);
	}
	if(sms_send($num,$sms)){
		$db->query("REPLACE INTO `{$pre}regnum` ( `sid` , `num` , `posttime` ) VALUES ('$usr_sid', '$sms', '$timestamp')");
		showerr("信息已经成功髮送到您指定的手机號碼中,請注意查收，有可能会延迟几分钟，請耐心等待！",1);
	}else{
		showerr("信息髮送失败，可能是手机短信接口有问題！");
	}
}elseif($webdb[yzNumReg]==1){
	$email=$num;
	$title = $webdb['webname']."提供给妳的注册碼信息";
	if(send_mail($email,$title,$content,$ifcheck=1)){
		$db->query("REPLACE INTO `{$pre}regnum` ( `sid` , `num` , `posttime` ) VALUES ('$usr_sid', '$sms', '$timestamp')");
		showerr("注册碼信息已经成功髮送到您的郵箱中,請注意查收",1);
	}else{
		showerr("信息髮送失败，可能是郵件髮送功能配置有误！");
	}
}
?>