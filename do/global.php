<?php
require(dirname(__FILE__)."/../f/global.php");

$IS_BIZ && Limt_IP('AllowVisitIp');		//允许哪些IP访问

unset($listdb,$rs);

//加载JS時的提示语,妳可以换成图片,'號要加\
$Load_Msg="<img alt=\"内容加载中,請稍候...\" src=\"$webdb[www_url]/images/default/ico_loading3.gif\">";


?>