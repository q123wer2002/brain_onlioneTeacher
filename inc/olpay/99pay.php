<?php
!function_exists('html') && exit('ERR');

$webdb[pay99_id] && $webdb[pay99_id]="{$webdb[pay99_id]}01";

if(!$webdb[pay99_id]){
	showerr('系统没有设置快钱收款商户编號,所以不能使用快钱在線支付');
}elseif(!$webdb[pay99_key]){
	showerr('系统没有设置快钱密钥,所以不能使用快钱在線支付');
}

if($signMsg){

	$key=$webdb[pay99_key];
	//生成加密串。必须保持如下顺序。
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"merchantAcctId",$merchantAcctId);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"version",$version);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"language",$language);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"signType",$signType);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"payType",$payType);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"bankId",$bankId);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"orderId",$orderId);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"orderTime",$orderTime);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"orderAmount",$orderAmount);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"dealId",$dealId);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"bankDealId",$bankDealId);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"dealTime",$dealTime);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"payAmount",$payAmount);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"fee",$fee);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"ext1",$ext1);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"ext2",$ext2);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"payResult",$payResult);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"errCode",$errCode);
	$merchantSignMsgVal=appendParam($merchantSignMsgVal,"key",$key);
	$merchantSignMsg= md5($merchantSignMsgVal);

	if( strtoupper($signMsg)!=strtoupper($merchantSignMsg) ){
		showerr( "验证MD5签名失败"); 
	}

	if( $webdb[pay99_id] != $merchantAcctId ){
		showerr( "错误的商户编號"); 
	}

	if($payResult != "10" ){
		showerr( "支付失败"); 
	}
	
	olpay_end($orderId);
}
else
{
	$array=olpay_send();
	$array[return_url] = substr($array[return_url],0,-1);
	//人民币網关账户號
	///請与快钱联系索取
	////账户號merchantAcctId的构成：
	////登錄快钱帐户，在“我的快钱”-“帐户首页”的中上位置显示“用户编號”。
	////商户如果接入的是快钱人民币支付網关，那么商户的帐户號merchantAcctId就为
	////用户编號後面附加数字01，即{用户编號}01
	$merchantAcctId=$webdb[pay99_id];

	//人民币網关密钥
	///区分大小寫.請与快钱联系索取
	////商户密钥（登錄快钱網站，在“快钱工具”-“设置产品参数”中获取和设置。
	////注意：商户密钥的长度只能是16位！商户密钥不应包含特殊字符，建议只使用数字和字母组合）。
	////如果在申請快钱帐户時没有收到快钱髮送的通知郵件（含有为妳们随机生成的密钥），
	////或者是忘記了密钥，請登錄妳们在快钱注册時使用的郵箱（即妳们的快钱帐户），
	////髮送郵件到“fsc@99bill.com”，申請重置妳们的商户密钥（可以在郵件中说明所需要设置成的密钥）。
	$key=$webdb[pay99_key];

	//字符集.固定选择值。可为空。
	///只能选择1、2、3.
	///1代表UTF-8; 2代表GBK; 3代表gb2312
	///默认值为1
	$inputCharset="3";

	//接受支付结果的页面地阯.与[bgUrl]不能同時为空。必须是绝对地阯。
	///如果[bgUrl]为空，快钱将支付结果Post到[pageUrl]对应的地阯。
	///如果[bgUrl]不为空，并且[bgUrl]页面指定的<redirecturl>地阯不为空，则转向到<redirecturl>对应的地阯
	$pageUrl='';
	//$pageUrl=urlencode($pageUrl);

	//服务器接受支付结果的後台地阯.与[pageUrl]不能同時为空。必须是绝对地阯。
	///快钱通过服务器连接的方式将交易结果髮送到[bgUrl]对应的页面地阯，在商户处理完成後输出的<result>如果为1，页面会转向到<redirecturl>对应的地阯。
	///如果快钱未接收到<redirecturl>对应的地阯，快钱将把支付结果post到[pageUrl]对应的页面。
	$bgUrl=$array[return_url];
	
	//網关版本.固定值
	///快钱会根据版本號來调用对应的接口处理程序。
	///本代碼版本號固定为v2.0
	$version="v2.0";

	//语言种类.固定选择值。
	///只能选择1、2、3
	///1代表中文；2代表英文
	///默认值为1
	$language="1";

	//签名类型.固定值
	///1代表MD5签名
	///當前版本固定为1
	$signType="1";	
   
	//支付人姓名
	///可为中文或英文字符
	$payerName="$lfjid";

	//支付人联系方式类型.固定选择值
	///只能选择1、2
	///1代表Email；2代表手机號
	$payerContactType="1";	

	//支付人联系方式
	///只能选择Email或手机號
	$payerContact="$lfjdb[email]";

	//商户訂單號
	///由字母、数字、或[-][_]组成
	$orderId=$array[numcode];		

	//訂單金額
	///以分为單位，必须是整型数字
	///比方2，代表0.02元
	$orderAmount=$array[money]*100;
	
	//訂單提交時間
	///14位数字。年[4位]月[2位]日[2位]時[2位]分[2位]秒[2位]
	///如；20080101010101
	$orderTime=date('YmdHis');

	//商品名称
	///可为中文或英文字符
	$productName=$array[title];

	//商品数量
	///可为空，非空時必须为数字
	$productNum="1";

	//商品代碼
	///可为字符或者数字
	$productId="3";

	//商品描述
	$productDesc=$array[content];
	
	//扩展字段1
	///在支付结束後原样返迴给商户
	$ext1="99pay";

	//扩展字段2
	///在支付结束後原样返迴给商户
	$ext2="";
	
	//支付方式.固定选择值
	///只能选择00、10、11、12、13、14
	///00：组合支付（網关支付页面显示快钱支持的各种支付方式，推荐使用）10：银行卡支付（網关支付页面只显示银行卡支付）.11：电话银行支付（網关支付页面只显示电话支付）.12：快钱账户支付（網关支付页面只显示快钱账户支付）.13：線下支付（網关支付页面只显示線下支付方式）.14：B2B支付（網关支付页面只显示B2B支付，但需要向快钱申請开通才能使用）
	$payType="00";

	//银行代碼
	///实现直接跳转到银行页面去支付,只在payType=10時才需设置参数
	///具体代碼参见 接口文档银行代碼列表
	$bankId="";

	//快钱的合作伙伴的账户號
	///如未和快钱签訂代理合作协议，不需要填寫本参数
	$pid=""; ///合作伙伴在快钱的用户编號


   
	//生成加密签名串
	///請务必按照如下顺序和规则组成加密串！
	$signMsgVal=appendParam($signMsgVal,"inputCharset",$inputCharset);
	$signMsgVal=appendParam($signMsgVal,"pageUrl",$pageUrl);
	$signMsgVal=appendParam($signMsgVal,"bgUrl",$bgUrl);
	$signMsgVal=appendParam($signMsgVal,"version",$version);
	$signMsgVal=appendParam($signMsgVal,"language",$language);
	$signMsgVal=appendParam($signMsgVal,"signType",$signType);
	$signMsgVal=appendParam($signMsgVal,"merchantAcctId",$merchantAcctId);
	$signMsgVal=appendParam($signMsgVal,"payerName",$payerName);
	$signMsgVal=appendParam($signMsgVal,"payerContactType",$payerContactType);
	$signMsgVal=appendParam($signMsgVal,"payerContact",$payerContact);
	$signMsgVal=appendParam($signMsgVal,"orderId",$orderId);
	$signMsgVal=appendParam($signMsgVal,"orderAmount",$orderAmount);
	$signMsgVal=appendParam($signMsgVal,"orderTime",$orderTime);
	$signMsgVal=appendParam($signMsgVal,"productName",$productName);
	$signMsgVal=appendParam($signMsgVal,"productNum",$productNum);
	$signMsgVal=appendParam($signMsgVal,"productId",$productId);
	$signMsgVal=appendParam($signMsgVal,"productDesc",$productDesc);
	$signMsgVal=appendParam($signMsgVal,"ext1",$ext1);
	$signMsgVal=appendParam($signMsgVal,"ext2",$ext2);
	$signMsgVal=appendParam($signMsgVal,"payType",$payType);	
	$signMsgVal=appendParam($signMsgVal,"bankId",$bankId);
	$signMsgVal=appendParam($signMsgVal,"pid",$pid);
	$geturl=$signMsgVal;
	$signMsgVal=appendParam($signMsgVal,"key",$key);	
	$signMsg= strtoupper(md5($signMsgVal));
	header("location:https://www.99bill.com/gateway/recvMerchantInfoAction.htm?$geturl&signMsg=$signMsg");
	exit;
}

//功能函数。将变量值不为空的参数组成字符串
Function appendParam($returnStr,$paramId,$paramValue){

	if($returnStr!=""){
			
		if($paramValue!=""){
					
			$returnStr.="&".$paramId."=".$paramValue;
		}
			
	}else{
		
		If($paramValue!=""){
			$returnStr=$paramId."=".$paramValue;
		}
	}
		
	return $returnStr;
}

?>