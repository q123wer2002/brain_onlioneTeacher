<?php
require(dirname(__FILE__)."/../f/global.php");

$IS_BIZ && Limt_IP('AllowVisitIp');		//������ЩIP����

unset($listdb,$rs);

//����JS�r����ʾ��,�����Ի���ͼƬ,'̖Ҫ��\
$Load_Msg="<img alt=\"���ݼ�����,Ո�Ժ�...\" src=\"$webdb[www_url]/images/default/ico_loading3.gif\">";


?>