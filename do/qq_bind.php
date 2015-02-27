<?php
require(dirname(__FILE__)."/global.php");
if($lfjid){
	showerr("妳已经登錄了,請不要重复登錄,要重新登錄請點擊<br><br><A HREF='$webdb[www_url]/do/login.php?action=quit'>安全退出</A>");
}elseif(!$webdb[QQ_login]){
	showerr('该功能已关闭!');
}

if($step==2){		
	$login = $userDB->login($username,$password,intval($webdb[QQ_logintime]*3600));
	if($login==0){
		showerr("當前用户不存在,請重新输入");
	}elseif($login==-1){
		showerr("密碼不正确,點擊重新输入");
	}

	list($token,$secret,$openid)=explode("\t",mymd5(get_cookie('token_secret'),'DE'));
	
	$MSG='帐號捆绑失败!!';

	if($openid){
		$rs1 = $db->get_one("SELECT * FROM {$pre}memberdata WHERE `qq_api`='$openid'");
		$rs2 = $db->get_one("SELECT * FROM {$pre}memberdata WHERE username='$username'");
		if(!$rs1&&!$rs2[qq_api]){
			$db->query("UPDATE {$pre}memberdata SET `qq_api`='$openid' WHERE username='$username'");
			$MSG='帐號捆绑成功!!';
		}else{
			$MSG="帐號捆绑失败,因为帐號{$username}已经绑定了其它QQ號碼!!";
		}
	}	

	refreshto("$webdb[www_url]/","$MSG{$uc_login_code}",3);
}
	
require(ROOT_PATH."inc/head.php");
require(html("qq_bind"));
require(ROOT_PATH."inc/foot.php");

?>