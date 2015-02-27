<?php
require("global.php");

if(!$lfjuid){
	showerr("請先在前台登錄");
}

if($action=='get')
{
	if(!$atc_passwd){
		showerr("請输入充值卡密碼");
	}
	$rsdb=$db->get_one("SELECT * FROM {$pre}moneycard WHERE passwd='$atc_passwd'");
	if(!$rsdb){
		showerr("充值卡密碼不对");
	}elseif($rsdb[ifsell]){
		showerr("本充值卡已使用过,請不要重复充值");
	}
	$db->query("UPDATE {$pre}moneycard SET ifsell='1',uid='$lfjuid',username='$lfjid',posttime='$timestamp' WHERE id='$rsdb[id]'");

	add_user($lfjuid,$rsdb[moneycard],'充值卡(點卡)充值');

	refreshto("$webdb[www_url]/","恭喜妳,充值成功",2);
}

$lfjdb[money]=get_money($lfjdb[uid]);

require(ROOT_PATH."inc/head.php");
require(html("moneycard"));
require(ROOT_PATH."inc/foot.php");

?>