<?php
require(dirname(__FILE__)."/"."global.php");

if($job=='apply'){
	if(!$lfjid){
		showerr('Ո�ȵ��');
	}
}


$SQL="WHERE yz=1 AND (endtime=0 OR endtime>$timestamp) ";
$SQL.=" AND city_id IN('$city_id',0) ";

$rows=50;
if(1>$page){
	$page=1;
}
$min=($page-1)*$rows;

$showpage=getpage("{$_pre}friendlink","$SQL","?","$rows");
$query = $db->query("SELECT * FROM {$_pre}friendlink $SQL LIMIT $min,$rows");
while($rs = $db->fetch_array($query)){
	$rs[logo]=tempdir($rs[logo]);
	$_listdb[]=$rs;
}

$num=5-count($_listdb)%5;
for($i=0;$i<$num;$i++ ){
	$_listdb[]=array('display'=>'none');
}
$listdb=array_chunk($_listdb,5);


if($_POST)
{
	if(!$lfjid){
		showerr('Ո�ȵ��');
	}
	if(!check_imgnum($yzimg))
	{
		showerr("��֤�a������");
	}
	
	if(!$postdb[name]){
		showerr("վ�c���Ʋ���Ϊ��");
	}
	if(!$postdb[city_id])
	{
		showerr("Ոѡ��һ������");
	}
	if(!$postdb[url]){
		showerr("վ�c���n����Ϊ��");
	}

	foreach( $_FILES AS $key=>$value ){

		if(is_array($value)){
			$postfile=$value['tmp_name'];
			$array[name]=$value['name'];
			$array[size]=$value['size'];
		} else{
			$postfile=$$key;
			$array[name]=${$key.'_name'};
			$array[size]=${$key.'_size'};
		}
		if($ftype[1]=='in'&&$array[name]){

			if(!eregi("(gif|jpg|png)$",$array[name])){
				showerr("LOGO,ֻ���ϴ�GIF,JPG,PNG��ʽ���ļ�,�������ϴ����ļ�:$array[name]");
			}
			$array[path]=$webdb[updir]."/friendlink";
	
			$array[updateTable]=1;	//ͳ���û��ϴ����ļ�ռ�ÿ��g��С
			$filename=upfile($postfile,$array);
			$postdb[logo]="friendlink/$filename";
		}

	}
	if($postdb[logo]&&!eregi("(gif|jpg|png)$",$postdb[logo])){
		showerr("LOGO,ֻ���ϴ�GIF,JPG,PNG��ʽ���ļ�,�������ϴ����ļ�:$array[name]");
	}
	
	if(!strstr($postdb[url],'htttp://')){
		$postdb[url]="htttp://".$postdb[url];
	}
	$postdb[name]=filtrate($postdb[name]);
	$postdb[url]=filtrate($postdb[url]);
	$postdb[descrip]=filtrate($postdb[descrip]);
	$postdb[logo]=filtrate($postdb[logo]);
}

if($action=='reg')
{
	if(!$lfjid){
		showerr('Ո�ȵ��');
	}
	$db->query("INSERT INTO `{$_pre}friendlink` (`name` , `url` ,`city_id` , `logo` , `descrip` , `list`,ifhide,yz,iswordlink,uid,username ) VALUES ('$postdb[name]','$postdb[url]','$postdb[city_id]','$postdb[logo]','$postdb[descrip]','0','1','0','0','$lfjuid','$lfjid')");
	refreshto("$webdb[www_url]/","������Ո�����Ѿ��ύ�ɹ�,Ո�ȴ��g��Ա�����,�ſ�����ʾ����",'10');
}
else
{
	$select_fid=select_fsort("postdb[city_id]","");
	require(ROOT_PATH."inc/head.php");
	require(html("friendlink"));
	require(ROOT_PATH."inc/foot.php");
}




function select_fsort($name,$ckfid){
	global $db,$pre,$_pre;
	$show="<select name='$name'><option value=''>ȫ��</option>";
	$query = $db->query("SELECT * FROM {$_pre}city ORDER BY list DESC");
	while($rs = $db->fetch_array($query)){
		$ckk=$ckfid==$rs[fid]?' selected ':'';
		$show.="<option value='$rs[fid]' $ckk>$rs[name]</option>";
	}
	$show.="</select>";
	return $show;
}


?>