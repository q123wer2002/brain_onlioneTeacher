<?php
!function_exists('html') && exit('ERR');
//��ǰ�ļ���ע��rͨ���ֻ����]���ȡע��a�Ĺ���
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
	showerr('ϵͳû�����₀���ܣ�');
}
$time=$timestamp-60;
if($db->get_one("SELECT * FROM {$pre}regnum WHERE sid='$usr_sid' AND posttime>$time")){
	showerr("�������ע��a��û���յ��Ļ���Ոһ����������󌣡");
}
$sms = rands(4);
$content = $webdb['webname']."�ṩ������ע��a��:(".$sms.")����λ��";
if($webdb[yzNumReg]==2){
	if(!ereg("^1([0-9]{10})$",$num)){
		showerr('�ֻ�̖�a����'.$num);
	}
	if(sms_send($num,$sms)){
		$db->query("REPLACE INTO `{$pre}regnum` ( `sid` , `num` , `posttime` ) VALUES ('$usr_sid', '$sms', '$timestamp')");
		showerr("��Ϣ�Ѿ��ɹ���͵���ָ�����ֻ�̖�a��,Ոע����գ��п��ܻ��ӳټ����ӣ�Ո���ĵȴ���",1);
	}else{
		showerr("��Ϣ���ʧ�ܣ��������ֻ����Žӿ������}��");
	}
}elseif($webdb[yzNumReg]==1){
	$email=$num;
	$title = $webdb['webname']."�ṩ������ע��a��Ϣ";
	if(send_mail($email,$title,$content,$ifcheck=1)){
		$db->query("REPLACE INTO `{$pre}regnum` ( `sid` , `num` , `posttime` ) VALUES ('$usr_sid', '$sms', '$timestamp')");
		showerr("ע��a��Ϣ�Ѿ��ɹ���͵������]����,Ոע�����",1);
	}else{
		showerr("��Ϣ���ʧ�ܣ��������]����͹�����������");
	}
}
?>