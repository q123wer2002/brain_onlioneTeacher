<?php
!function_exists('html') && exit('ERR');
header('Content-Type: text/html; charset=gb2312');
if($type=='name'){
	if($name==''){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 請输入帐號,不能为空");
	}
	if (strlen($name)>30 || strlen($name)<3){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 小于3個或大于30個字");
	}
	$S_key=array('|',' ','',"'",'"','/','*',',','~',';','<','>','$',"\\","\r","\t","\n","`","!","?","%","^");
	foreach($S_key as $value){
		if (strpos($name,$value)!==false){ 
			die("<img src=$webdb[www_url]/images/default/check_error.gif> 用户名中包含有禁止的符號“{$value}”"); 
		}
	}
	if($userDB->get_passport($name,'name')){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 已经被注册了,請更换一個");
	}
	die("<img src=$webdb[www_url]/images/default/check_right.gif> <font color=red>恭喜妳,此帐號可以使用!</font>");
}elseif($type=='email'){
	if($name==''){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 請输入郵箱,不能为空");
	}
	if (!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$name)) {
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 郵箱不符合规则"); 
	}
	if( $webdb[emailOnly] && $userDB->check_emailexists($name) ){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 郵箱已被注册了,請更换一個!"); 
	}
	die("<img src=$webdb[www_url]/images/default/check_right.gif> <font color=red>恭喜妳,此郵箱可以使用!</font>");
}elseif($type=='pwd'){
	if($name==''){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 請输入密碼,不能为空");
	}
	if (strlen($name)>30 || strlen($name)<6){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> 小于6個或大于30個字");
	}
	$S_key=array('|',' ','',"'",'"','/','*',',','~',';','<','>','$',"\\","\r","\t","\n","`","!","?","%","^");
	foreach($S_key as $value){
		if (strpos($name,$value)!==false){ 
			die("<img src=$webdb[www_url]/images/default/check_error.gif> 包含有禁止的符號“{$value}”"); 
		}
	}
	die("<img src=$webdb[www_url]/images/default/check_right.gif> <font color=red>恭喜妳,此密碼可以使用!</font>");
}
?>