<?php
!function_exists('html') && exit('ERR');
header('Content-Type: text/html; charset=gb2312');
if($type=='name'){
	if($name==''){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> Ո������̖,����Ϊ��");
	}
	if (strlen($name)>30 || strlen($name)<3){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> С��3�������30����");
	}
	$S_key=array('|',' ','��',"'",'"','/','*',',','~',';','<','>','$',"\\","\r","\t","\n","`","!","?","%","^");
	foreach($S_key as $value){
		if (strpos($name,$value)!==false){ 
			die("<img src=$webdb[www_url]/images/default/check_error.gif> �û����а����н�ֹ�ķ�̖��{$value}��"); 
		}
	}
	if($userDB->get_passport($name,'name')){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> �Ѿ���ע����,Ո����һ��");
	}
	die("<img src=$webdb[www_url]/images/default/check_right.gif> <font color=red>��ϲ��,����̖����ʹ��!</font>");
}elseif($type=='email'){
	if($name==''){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> Ո�����]��,����Ϊ��");
	}
	if (!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$name)) {
		die("<img src=$webdb[www_url]/images/default/check_error.gif> �]�䲻���Ϲ���"); 
	}
	if( $webdb[emailOnly] && $userDB->check_emailexists($name) ){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> �]���ѱ�ע����,Ո����һ��!"); 
	}
	die("<img src=$webdb[www_url]/images/default/check_right.gif> <font color=red>��ϲ��,���]�����ʹ��!</font>");
}elseif($type=='pwd'){
	if($name==''){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> Ո�����ܴa,����Ϊ��");
	}
	if (strlen($name)>30 || strlen($name)<6){
		die("<img src=$webdb[www_url]/images/default/check_error.gif> С��6�������30����");
	}
	$S_key=array('|',' ','��',"'",'"','/','*',',','~',';','<','>','$',"\\","\r","\t","\n","`","!","?","%","^");
	foreach($S_key as $value){
		if (strpos($name,$value)!==false){ 
			die("<img src=$webdb[www_url]/images/default/check_error.gif> �����н�ֹ�ķ�̖��{$value}��"); 
		}
	}
	die("<img src=$webdb[www_url]/images/default/check_right.gif> <font color=red>��ϲ��,���ܴa����ʹ��!</font>");
}
?>