<?php
define('Memberpath',dirname(__FILE__).'/');
require(Memberpath."../global.php");

if(!$lfjid){
	showerr("��߀�]���");
}

/**
*��Ҫ�ṩ������,����,�ضε�ѡ��ʹ��
**/
function select_where2($table,$name='fup',$ck='',$fup=''){
	global $db;
	if($fup){
		$SQL=" WHERE fup='$fup' ";
	}
	$query = $db->query("SELECT * FROM $table $SQL ORDER BY list DESC");
	while($rs = $db->fetch_array($query)){
		$ckk=$ck==$rs[fid]?" selected ":" ";
		$show.="<option value='$rs[fid]' $ckk>$rs[name]</option>";
	}
	return "<select id='$table' name=$name><option value=''>Ոѡ��</option>$show</select>";
}

?>