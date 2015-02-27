<?php
require("global.php");

if(in_array($banktype,array('alipay','tenpay','99pay','yeepay'))){
	include(ROOT_PATH."inc/olpay/{$banktype}.php");
}elseif($banktype){
	showerr("֧����������!");	
}

require(ROOT_PATH."inc/head.php");
require(html("olpay"));
require(ROOT_PATH."inc/foot.php");

function olpay_send(){
	global $db,$pre,$webdb,$banktype,$atc_moeny,$timestamp,$lfjuid,$lfjid,$pay_code;
	
	if(!$pay_code){
		showerr("��������!");
	}
	list($type,$atc_moeny,$numcode,$mid)=explode("\t",mymd5($pay_code,'DE'));
	
	while(strlen($numcode)<10){
		$numcode="0$numcode";
	}

	$array[money]=$atc_moeny;
	$pay_code = str_replace('=','QIBO',$pay_code);	//�₀��̖��=�����׳����}
	$array[return_url]="$webdb[www_url]/do/olpay.php?banktype=$banktype&pay_code=$pay_code&";
	$array[title]="�ھ�����";
	$array[content]="Ϊ��̖:$lfjid,�ھ�����";
	$array[numcode]=$numcode;
	
	//���ܱ��ӆ��
	if($type=='form'){
		$db->query("INSERT INTO {$pre}olpay (`numcode` , `money` , `posttime` , `uid` , `username`, `banktype`, `formid` ) VALUES ('$array[numcode]','$array[money]','$timestamp','$lfjuid','$lfjid','$banktype','$mid')");
	
	//�̳�ӆ��
	}elseif($type=='module'){
		$db->query("INSERT INTO {$pre}olpay (`numcode` , `money` , `posttime` , `uid` , `username`, `banktype`, `moduleid` ) VALUES ('$array[numcode]','$array[money]','$timestamp','$lfjuid','$lfjid','$banktype','$mid')");
	}

	return $array;
}

function olpay_end($numcode){
	global $db,$pre,$webdb,$banktype,$pay_code,$lfjuid;
	
	$pay_code = str_replace('QIBO','=',$pay_code);	//�₀��̖��=�����׳����}

	if(!$pay_code){
		showerr("��������!!");
	}
	list($type,$atc_moeny,$atc_numcode,$mid,$shopmoney)=explode("\t",mymd5($pay_code,'DE'));
	if($atc_numcode!=intval($numcode)){
		showerr("���ݱ��޸Ĺ�!!");
	}

	//��Ҫ�����֧�������܆δ�һλ���ֵ����},inc/olpay/alipay.php,�ļ��������޸�
	$numcode=str_replace("code","",$numcode);

	//���ܱ��ӆ��
	if($type=='form'){
		$rt = $db->get_one("SELECT * FROM {$pre}olpay WHERE numcode='$numcode' AND `formid`='$mid'");

	//�̳�ӆ��
	}elseif($type=='module'){
		$rt = $db->get_one("SELECT * FROM {$pre}olpay WHERE numcode='$numcode' AND `moduleid`='$mid'");
		$db->query("UPDATE {$pre}shoporderuser SET ifpay='1' WHERE id='$atc_numcode'");
		//��������
		if($shopmoney){
			add_user($lfjuid,$shopmoney,'ُ�I��Ʒ�÷�');
		}
	}	
	if(!$rt){
		showerr('ϵͳ��û������ӆ�Σ��޷����֧����');
	}
	if($rt['ifpay'] == 1){
		showerr('��ӆ���Ѿ�֧���ɹ���');
	}
	$db->query("UPDATE {$pre}olpay SET ifpay='1' WHERE id='$rt[id]'");

	refreshto("$webdb[www_url]/","��ϲ��֧���ɹ�",60);
}

?>