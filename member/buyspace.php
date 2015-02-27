<?php
require("global.php");

if(!$lfjid){
	showerr("妳還沒登錄");
}

$lfjdb[money]=get_money($lfjuid);

$webdb[BuySpacesizeMoney]>0 || $webdb[BuySpacesizeMoney]=100;
if($action=='buy')
{
	if($spacesize<1){
		showerr("購買的空間容量不能小于1M");
	}
	if(!is_numeric($spacesize)){
		showerr("購買的空間容量必须是整数多少M");
	}
	$spacesize=intval($spacesize);
	$totalmoney=$spacesize*$webdb[BuySpacesizeMoney];
	if( $lfjdb[money]<$totalmoney ){
		showerr("妳的积分不足$totalmoney");
	}
	$spacesize=$spacesize*1024*1024;
	$db->query("UPDATE {$pre}memberdata SET totalspace=totalspace+$spacesize WHERE uid='$lfjuid'");
	add_user($lfjuid,-$totalmoney,'購買空間奖分');
	refreshto("$FROMURL","恭喜妳,購買空間成功,共消费了妳 {$totalmoney} 個积分",10);
}

 
//已使用空間
$lfjdb[usespace]=number_format($lfjdb[usespace]/(1024*1024),3);

//系统允许使用空間
$space_system=number_format($webdb[totalSpace],3);

//用户组允许使用空間
$space_group=number_format($groupdb[totalspace],3);

//用户本身具有的空間
$space_user=number_format($lfjdb[totalspace]/(1024*1024),3);

//用户余下空間
$lfjdb[totalspace]=number_format($webdb[totalSpace]+$groupdb[totalspace]+$lfjdb[totalspace]/(1024*1024)-$lfjdb[usespace],3);

require(dirname(__FILE__)."/"."head.php");
require(dirname(__FILE__)."/"."template/buyspace.htm");
require(dirname(__FILE__)."/"."foot.php");

?>