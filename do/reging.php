<?php
require(dirname(__FILE__)."/"."global.php");
require(ROOT_PATH."data/level.php");

$_GET['_fromurl'] && $_fromurl=$_GET['_fromurl'];
if($jid){
	$query=$db->query("update {$pre}memberdata set groupid=3 where uid='$jid'");
}
if($lfjid){
	showerr("���Ѿ�ע����,Ո��Ҫ�ظ�ע��,Ҫע��,Ո���˳�");
}
if($webdb[forbidReg]){
	showerr("�ܱ�Ǹ,�Wվ�ر���ע��");
}


if($step==2){

	//�û��Զ����ֶ�
	require_once(ROOT_PATH."/do/regfield.php");
	ck_regpost($postdb);

	if($webdb[forbidRegIp]){
		$detail=explode("\r\n",$webdb[forbidRegIp]);
		foreach( $detail AS $key=>$value){
			//if(strstr($onlineip,$value)&&ereg("^$value",$onlineip)){
			if(strstr($onlineip,$value)){
				showerr("������IP��ֹע��");
			}
		}
	}
	if($webdb[limitRegTime]&&get_cookie("limitRegTime")){
		showerr("{$webdb[limitRegTime]} ������,Ո��Ҫ�ظ�ע��");
	}
	if( $webdb[yzImgReg] ){
		if(!check_imgnum($yzimg)){
			showerr("��֤�a������");
		}
	}

	//ע��a�˶�
	if($webdb[yzNumReg]){
		$time=$timestamp-3600;	//1С�rǰ��ע��aʧЧ.
		if($db->get_one("SELECT * FROM {$pre}regnum WHERE num='$yznum' AND sid='$usr_sid'")){
			$db->query("DELETE FROM {$pre}regnum WHERE (num='$yznum' AND sid='$usr_sid') OR posttime<$time");
		}else{
			showerr("ע��a����!");
		}
	}

	if($mobphone && !ereg("^1([0-9]{10})$",$mobphone)){
		showerr('�ֻ�̖�a����');
	}

	if($password!=$password2){
		showerr("���������ܴa��һ��");
	}
	if($webdb[forbidRegName]){
		$detail=explode("\r\n",$webdb[forbidRegName]);
		if(in_array($username,$detail)){
			showerr("�ܱ�������̖,������ʹ��,Ո����һ����");
		}
	}
	$msn = filtrate($msn);
	$homepage = filtrate($homepage);
	
	
	$gtype=0;
	//��Ҫ�û��������,���ܳ�Ϊ��ҵ�û�.�粻�����Ҳ�ܳ�Ϊ��ҵ�û��Ļ�,Ո�������//��ȡ������
	//$gtype=$grouptype==1?1:0;
	
	if($groupid==3||$groupid==4||$memberlevel[$groupid]||!in_array($groupid,explode(",",$webdb[reg_group]))){
		$groupid=8;
	}

	$groupid || $groupid=8;
	

	$array=array(
		'username'=>$username,
		'password'=>$password,
		'groupid'=>intval($groupid),
		'grouptype'=>$gtype,
		'yz'=>$webdb[RegYz],
		'lastvist'=>$timestamp,
		'lastip'=>$onlineip,
		'regdate'=>$timestamp,
		'regip'=>$onlineip,
		'sex'=>$sex,
		'bday'=>"$bday_y-$bday_m-$bday_d",
		'oicq'=>$oicq,
		'msn'=>$msn,
		'homepage'=>$homepage,
		'email'=>$email,
		'mobphone'=>$mobphone
	);

	//�û�ע��
	$uid = $userDB->register_user($array);
	if(!is_numeric($uid)){
		showerr($uid);
	}

	if($webdb[RegCompany] && $gtype==1){
		//ע����ҵ�û�
		//$db->query("INSERT INTO `{$pre}memberdata_1` ( `uid`) VALUES ('$uid')");
	}
	
	//�û����
	$cookietime = 3600;
	$userDB->login($username,$password,$cookietime);

	//ע��r�g�g������
	if($webdb[limitRegTime]){
		set_cookie("limitRegTime",1,$webdb[limitRegTime]*60);
	}
	
	//ע���û��Զ����ֶ�
	Reg_memberdata_field($uid,$postdb);

	//ͨ��֤����
	if($_COOKIE[passport_url]||$_POST[passport_url]){
		$passport_url=urldecode($_COOKIE[passport_url]?$_COOKIE[passport_url]:$_POST[passport_url]);
		setcookie('passport_url','');
		$userDB->passport_server($username,$passport_url);
	}

	$jumpto&&$jumpto=urldecode($jumpto);

	add_user($uid,$webdb[regmoney],'ע��÷�');

	
	//����QQ��̖
	list($token,$secret,$openid)=explode("\t",mymd5(get_cookie('token_secret'),'DE'));	
	if($openid){
		$rs1 = $db->get_one("SELECT * FROM {$pre}memberdata WHERE `qq_api`='$openid'");
		if(!$rs1){
			$db->query("UPDATE {$pre}memberdata SET `qq_api`='$openid' WHERE username='$username'");
			refreshto("$webdb[www_url]","��̖����ɹ�!!",1);
		}
	}

	if(strstr($jumpto,$webdb[www_url])){
		refreshto("$jumpto","��ϲ����ע��ɹ�",1);
	}else{
		refreshto("$webdb[www_url]","��ϲ����ע��ɹ�",1);
	}
}else{

	//ͨ��֤����
	if($_GET[passport_url]){
		setcookie('passport_url',$_GET[passport_url]);
	}

	$_fromurl || $_fromurl=$FROMURL;
	require(ROOT_PATH."inc/head.php");
	require(html("reg"));
	require(ROOT_PATH."inc/foot.php");
}


?>