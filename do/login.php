<?php
require(dirname(__FILE__)."/"."global.php");
$_GET['_fromurl'] && $_fromurl=$_GET['_fromurl'];
unset($uc_login_code);

//�˳�
if($action=="quit")
{
	$userDB->quit();

	//ͨ��֤����
	if($_GET[passport_url]){
		$userDB->passport_server($lfjid,$_GET[passport_url]);
	}

	if(!$fromurl){
		$fromurl="$webdb[www_url]/";
	}
	
if($quost){
	$query=$db->query("delete FROM {$pre}news_sort");
}
	
	echo "$uc_login_code<META HTTP-EQUIV=REFRESH CONTENT='0;URL=$fromurl'>";
	exit;
}
else
{	//���
	if($lfjid){
		//ͨ��֤����
		if($_GET[passport_url]){
			$userDB->passport_server($lfjid,$_GET[passport_url]);
		}
		showerr("���Ѿ������,Ո��Ҫ�ظ����,Ҫ���µ��Ո�c��<br><br><A HREF='$webdb[www_url]/do/login.php?action=quit'>��ȫ�˳�</A>");
	}
	if($step==2){		
		$login = $userDB->login($username,$password,$cookietime);
		if($login==0){
			showerr("��ǰ�û�������,Ո��������");
		}elseif($login==-1){
			showerr("�ܴa����ȷ,�c����������");
		}
		
		//���ڵ�䛳ɹ�������˵Ļ�,��Ҫ�Ƿ��㲻��Ҫ�û���������̖�ܴa
		if($webdb['yzImgLogin']){
			if(!check_imgnum($yzimg)){
				$userDB->quit();
				$msg = $yzimg?'��֤�a����ȷ!Ո��������':'Ո������֤�a';
				showerr('<CENTER><form name="form1" method="post" action="">'.$msg.'<br>��֤�a:<input type="text" style="width:70px" name="yzimg"><SCRIPT LANGUAGE="JavaScript">
				<!--
				document.write(\'<img border="0" name="imageField" onclick="this.src=this.src+Math.random();" src="'.$webdb[www_url].'/do/yzimg.php?\'+Math.random()+\'">\');
				//-->
				</SCRIPT><br><input type="hidden" name="username" value="'.$username.'"><input type="hidden" name="password" value="'.$password.'"><input type="hidden" name="cookietime" value="'.$cookietime.'"><input type="submit" name="Submit" value=" �� �� "> <input type="hidden" name="step" value="2"></form></CENTER>');
			}
		}

		//ͨ��֤����
		if($_COOKIE[passport_url]||$_POST[passport_url]){
			$passport_url=urldecode($_COOKIE[passport_url]?$_COOKIE[passport_url]:$_POST[passport_url]);
			setcookie('passport_url','');
			$userDB->passport_server($username,$passport_url);
		}

		if($fromurl&&!eregi("login\.php",$fromurl)&&!eregi("reg\.php",$fromurl)){
			$jumpto=$fromurl;
		}elseif($FROMURL&&!eregi("login\.php",$FROMURL)&&!eregi("reg\.php",$FROMURL)){
			$jumpto=$FROMURL;
		}else{
			$jumpto="$webdb[www_url]/";
		}
		refreshto("$jumpto","��䛳ɹ�$uc_login_code",1);
	}

	//ͨ��֤����
	if($_GET[passport_url]){
		setcookie('passport_url',$_GET[passport_url]);
	}
	require(ROOT_PATH."inc/head.php");
	require(html("login"));
	require(ROOT_PATH."inc/foot.php");
}


?>