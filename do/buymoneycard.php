<?php
require("global.php");

if(in_array($banktype,array('alipay','tenpay','99pay','yeepay'))){
	include(ROOT_PATH."inc/olpay/{$banktype}.php");
}elseif($banktype){
	showerr("支付类型有误!");	
}

$lfjdb[money]=get_money($lfjuid);

require(ROOT_PATH."inc/head.php");
require(html("buymoneycard"));
require(ROOT_PATH."inc/foot.php");


function olpay_send(){
	global $db,$pre,$webdb,$banktype,$atc_moeny,$timestamp,$lfjuid,$lfjid,$webdb;
	
	$atc_moeny = intval($atc_moeny);
	if($atc_moeny<1){
		showerr("妳输入的充值金額不能小于1");
	}

	$array[money]=$atc_moeny;
	$array[return_url]="$webdb[www]/do/buymoneycard.php?banktype=$banktype&";
	$array[title]="購買{$webdb[MoneyName]},为{$lfjid}在線充值";
	$array[content]="为帐號:$lfjid,在線付款購買{$webdb[MoneyName]}";
	$array[numcode]=strtolower(rands(10));

	$db->query("INSERT INTO {$pre}olpay (`numcode` , `money` , `posttime` , `uid` , `username`, `banktype`, `paytype` ) VALUES ('$array[numcode]','$array[money]','$timestamp','$lfjuid','$lfjid','$banktype','1')");

	return $array;
}

function olpay_end($numcode){
	global $db,$pre,$webdb,$banktype;

	$rt = $db->get_one("SELECT * FROM {$pre}olpay WHERE numcode='$numcode' AND `paytype`=1");
	if(!$rt){
		showerr('系统中没有您的充值訂單，无法完成充值！');
	}
	if($rt['ifpay'] == 1){
		showerr('该訂單已经充值成功！');
	}
	$db->query("UPDATE {$pre}olpay SET ifpay='1' WHERE id='$rt[id]'");

	$num=$rt[money]*$webdb[alipay_scale];
	
	add_user($rt[uid],$num,'在線充值');

	refreshto("$webdb[www_url]/","恭喜妳充值成功",10);
}

?>