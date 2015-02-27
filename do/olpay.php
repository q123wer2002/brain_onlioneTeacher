<?php
require("global.php");

if(in_array($banktype,array('alipay','tenpay','99pay','yeepay'))){
	include(ROOT_PATH."inc/olpay/{$banktype}.php");
}elseif($banktype){
	showerr("支付类型有误!");	
}

require(ROOT_PATH."inc/head.php");
require(html("olpay"));
require(ROOT_PATH."inc/foot.php");

function olpay_send(){
	global $db,$pre,$webdb,$banktype,$atc_moeny,$timestamp,$lfjuid,$lfjid,$pay_code;
	
	if(!$pay_code){
		showerr("数据有误!");
	}
	list($type,$atc_moeny,$numcode,$mid)=explode("\t",mymd5($pay_code,'DE'));
	
	while(strlen($numcode)<10){
		$numcode="0$numcode";
	}

	$array[money]=$atc_moeny;
	$pay_code = str_replace('=','QIBO',$pay_code);	//这個符號“=”容易出问題
	$array[return_url]="$webdb[www_url]/do/olpay.php?banktype=$banktype&pay_code=$pay_code&";
	$array[title]="在線付款";
	$array[content]="为帐號:$lfjid,在線付款";
	$array[numcode]=$numcode;
	
	//万能表單訂單
	if($type=='form'){
		$db->query("INSERT INTO {$pre}olpay (`numcode` , `money` , `posttime` , `uid` , `username`, `banktype`, `formid` ) VALUES ('$array[numcode]','$array[money]','$timestamp','$lfjuid','$lfjid','$banktype','$mid')");
	
	//商城訂單
	}elseif($type=='module'){
		$db->query("INSERT INTO {$pre}olpay (`numcode` , `money` , `posttime` , `uid` , `username`, `banktype`, `moduleid` ) VALUES ('$array[numcode]','$array[money]','$timestamp','$lfjuid','$lfjid','$banktype','$mid')");
	}

	return $array;
}

function olpay_end($numcode){
	global $db,$pre,$webdb,$banktype,$pay_code,$lfjuid;
	
	$pay_code = str_replace('QIBO','=',$pay_code);	//这個符號“=”容易出问題

	if(!$pay_code){
		showerr("数据有误!!");
	}
	list($type,$atc_moeny,$atc_numcode,$mid,$shopmoney)=explode("\t",mymd5($pay_code,'DE'));
	if($atc_numcode!=intval($numcode)){
		showerr("数据被修改过!!");
	}

	//主要是针对支付宝不能單纯一位数字的问題,inc/olpay/alipay.php,文件中做了修改
	$numcode=str_replace("code","",$numcode);

	//万能表單訂單
	if($type=='form'){
		$rt = $db->get_one("SELECT * FROM {$pre}olpay WHERE numcode='$numcode' AND `formid`='$mid'");

	//商城訂單
	}elseif($type=='module'){
		$rt = $db->get_one("SELECT * FROM {$pre}olpay WHERE numcode='$numcode' AND `moduleid`='$mid'");
		$db->query("UPDATE {$pre}shoporderuser SET ifpay='1' WHERE id='$atc_numcode'");
		//奖励积分
		if($shopmoney){
			add_user($lfjuid,$shopmoney,'購買商品得分');
		}
	}	
	if(!$rt){
		showerr('系统中没有您的訂單，无法完成支付！');
	}
	if($rt['ifpay'] == 1){
		showerr('该訂單已经支付成功！');
	}
	$db->query("UPDATE {$pre}olpay SET ifpay='1' WHERE id='$rt[id]'");

	refreshto("$webdb[www_url]/","恭喜妳支付成功",60);
}

?>