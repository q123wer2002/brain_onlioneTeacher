<?php
require("global.php");

if(!$lfjid){
	showerr("��߀�]���");
}

$lfjdb[money]=get_money($lfjuid);

$webdb[BuySpacesizeMoney]>0 || $webdb[BuySpacesizeMoney]=100;
if($action=='buy')
{
	if($spacesize<1){
		showerr("ُ�I�Ŀ��g��������С��1M");
	}
	if(!is_numeric($spacesize)){
		showerr("ُ�I�Ŀ��g������������������M");
	}
	$spacesize=intval($spacesize);
	$totalmoney=$spacesize*$webdb[BuySpacesizeMoney];
	if( $lfjdb[money]<$totalmoney ){
		showerr("���Ļ��ֲ���$totalmoney");
	}
	$spacesize=$spacesize*1024*1024;
	$db->query("UPDATE {$pre}memberdata SET totalspace=totalspace+$spacesize WHERE uid='$lfjuid'");
	add_user($lfjuid,-$totalmoney,'ُ�I���g����');
	refreshto("$FROMURL","��ϲ��,ُ�I���g�ɹ�,�������ˊ� {$totalmoney} ������",10);
}

 
//��ʹ�ÿ��g
$lfjdb[usespace]=number_format($lfjdb[usespace]/(1024*1024),3);

//ϵͳ����ʹ�ÿ��g
$space_system=number_format($webdb[totalSpace],3);

//�û�������ʹ�ÿ��g
$space_group=number_format($groupdb[totalspace],3);

//�û�������еĿ��g
$space_user=number_format($lfjdb[totalspace]/(1024*1024),3);

//�û����¿��g
$lfjdb[totalspace]=number_format($webdb[totalSpace]+$groupdb[totalspace]+$lfjdb[totalspace]/(1024*1024)-$lfjdb[usespace],3);

require(dirname(__FILE__)."/"."head.php");
require(dirname(__FILE__)."/"."template/buyspace.htm");
require(dirname(__FILE__)."/"."foot.php");

?>