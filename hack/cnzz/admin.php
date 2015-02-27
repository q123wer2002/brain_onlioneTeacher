<?php
!function_exists('html') && exit('ERR');
if($job=='set')
{
	if($webdb[cnzz_pwd]=='no'){
		$display='';
		$webdb[cnzz_pwd]='';
	}else{
		$display='none;';
	}
	$cnzz_open[intval($webdb[cnzz_open])]=' checked ';

	hack_admin_tpl('set');
}
elseif($action=='set')
{
	if($webdbs[cnzz_open]&&!$webdbs[cnzz_id]){
		showmsg("统计帐號不存在");
	}
	write_config_cache($webdbs);
	jump("脩改成功",$FROMURL,1);
}
elseif($job=='ask')
{
	if($webdb[cnzz_id]&&$webdb[cnzz_pwd]){
		echo "<META HTTP-EQUIV=REFRESH CONTENT='0;URL=index.php?lfj=cnzz&job=set'>";
		exit;
	}
	$mydomain=preg_replace("/http:\/\/([^\/]+)\/(.*)/is","\\1",$WEBURL);

	hack_admin_tpl('ask');
}
elseif($action=='ask')
{
	if(!$mydomain)
	{
		showmsg("域名不能为空");
	}
	$key = md5("{$mydomain}A4bkJUxm");
	$url="http://intf.cnzz.com/user/companion/php168.php?domain=$mydomain&key=$key";
	if( ini_get('allow_url_fopen') && $code=file_get_contents($url) )
	{
	}
	elseif( $code=sockOpenUrl($url) )
	{
	}
	
	if(!strstr($code,'@'))
	{
		echo '<meta http-equiv="Content-Type" content="text/html; charset=gb2312">';
		if($code=='-1'){
			die("KEY值有误");
		}elseif($code=='-2'){
			die("域名长度有误（1~64）");
		}elseif($code=='-3'){
			die("域名输入有误");
		}elseif($code=='-4'){
			die("域名插入数据库有误");
		}elseif($code=='-5'){
			echo("同一個IP,用户申請次数过多<hr>");
		}else{
			echo $code;
		}
		$webdbs[cnzz_pwd]='no';
		write_config_cache($webdbs);
		echo "<A HREF='$url'>妳的服务器不支持远程获取数据,請點擊手工获取数据,然後把页面显示的结果复制出來,在<统计帐號琯理>那手工输入,@前面的数字是统计代碼的帐號,@後面部份的数字是统计代碼的琯理密碼,點擊获取资料</A>";
		exit;
	}
	list($webdbs[cnzz_id],$webdbs[cnzz_pwd])=explode("@",$code);

	write_config_cache($webdbs);
	jump("恭喜妳,统计帐號申請成功","index.php?lfj=cnzz&job=set",2);
}

?>