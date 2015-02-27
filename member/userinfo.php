<?php
require("global.php");
@include_once(ROOT_PATH."data/all_area.php");
if($lfjuid==$uid||!$uid){
	//$linkdb=array("查看個人信息"=>"?uid=$lfjuid","修改個人信息"=>"?job=edit");
}else{
	//$linkdb=array("查看個人信息"=>"?uid=$uid");
}


//修改用户信息
if($job=="edit")
{
	if(!$lfjid)
	{
		showerr("妳還沒登錄");
	}
	if($step==2)
	{
		//自定义用户字段
		require_once("../do/regfield.php");
		ck_regpost($postdb);

		if($email!=$lfjdb[email]||$password)
		{
			if( !is_array($userDB->check_password($lfjid,$old_password)) )
			{
				showerr("修改密碼或修改郵箱,請必须正确输入旧密碼");
			}
			elseif($password&&$password!=$password2)
			{
				showerr("新密碼与重复密碼不相同");
			}
			elseif ($email&&!ereg("^[-a-zA-Z0-9_\.]+\@([0-9A-Za-z][0-9A-Za-z-]+\.)+[A-Za-z]{2,5}$",$email))
			{
				showerr("郵箱不符合规则");
			}
		}
		if($oicq&&!ereg("^[0-9]{5,11}$",$oicq))
		{
			showerr("OICQ格式不符合规则");
		}
		if($bday&&!ereg("^([0-9]{4})-([0-9]{2})-([0-9]{2})$",$bday))
		{
			showerr("生日格式不符合规则");
		}
		if($postalcode&&!ereg("^[0-9]{6}$",$postalcode))
		{
			showerr("郵政编碼格式不符合规则");
		}
		if($mobphone&&!ereg("^[0-9]{11,12}$",$mobphone))
		{
			showerr("手机號碼格式不符合规则");
		}
		if ($homepage&&!ereg("^http:",$homepage))
		{
			showerr("個人主页不符合规则");
		}

		$truename=filtrate($truename);
		$idcard=filtrate($idcard);
		$telephone=filtrate($telephone);
		$address=filtrate($address);
		$introduce=filtrate($introduce);
		$homepage=filtrate($homepage);


		if($icon_type=='new'&&$postfile)
		{
			$array[name]=is_array($postfile)?$_FILES[postfile][name]:$postfile_name;
			$filetype=strtolower(strrchr($array[name],"."));
			if($filetype!='.gif'&&$filetype!='.jpg')
			{
				showerr("头像只能是.gif或.jpg格式");
			}
			$array[path]=$webdb[updir]."/icon";
			$array[size]=is_array($postfile)?$_FILES[postfile][size]:$postfile_size;
			if(($array[size]+$lfjdb[usespace])>($webdb[totalSpace]*1048576+$groupdb[totalspace]*1048576+$lfjdb[totalspace]))
			{
				showerr("妳的空間不足,上传失败,<A HREF='?uid=$lfjuid'>點擊查看妳的空間容量信息</A>");
			}
			$array[updateTable]=1;	//统计用户上传的文件占用空間大小
			$filename=upfile(is_array($postfile)?$_FILES[postfile][tmp_name]:$postfile,$array);
			$icon="icon/{$lfjuid}".strtolower(strrchr($filename,"."));
			@unlink(ROOT_PATH."$webdb[updir]/$icon");
			rename(ROOT_PATH."$webdb[updir]/icon/$filename",ROOT_PATH."$webdb[updir]/$icon");			
			
			$icon_array=getimagesize(ROOT_PATH."$webdb[updir]/$icon");
			if($icon_array[0]>150||$icon_array[1]>150){
				$icon_url="$webdb[www_url]/$webdb[updir]/$icon";
			}
		}
		if($icon)
		{
			$filetype=strtolower(strrchr($icon,"."));
			$icon=filtrate($icon);
			if($filetype!='.gif'&&$filetype!='.jpg')
			{
				showerr("头像只能是.gif或.jpg格式");
			}
		}
		
		//过滤不健康的字
		$truename=replace_bad_word($truename);
		$introduce=replace_bad_word($introduce);
		$address=replace_bad_word($address);

		if($cityid)
		{
			@extract($db->get_one("SELECT fup AS provinceid FROM {$pre}area WHERE fid='$cityid'"));
		}
		
		$array=array(
			"uid"=>$lfjuid,
			"username"=>$lfjid,
			"email"=>$email,
			"password"=>$password,
			"icon"=>$icon,
			"sex"=>$sex,
			"bday"=>$bday,
			"introduce"=>$introduce,
			"oicq"=>$oicq,
			"msn"=>$msn,
			"homepage"=>$homepage,
			"address"=>$address,
			"postalcode"=>$postalcode,
			"mobphone"=>$mobphone,
			"telephone"=>$telephone,
			"idcard"=>$idcard,
			"truename"=>$truename,
			"provinceid"=>$provinceid,
			"cityid"=>$cityid,
		);

		if($lfjdb[email_yz]&&$lfjdb[email]!=$email){
			if(!$webdb[EditYzEmail]){
				showerr("妳不可以再修改郵箱,因为已经审核过了.");
			}else{
				$array[email_yz]=0;
			}
		}
		if($lfjdb[mob_yz]&&$lfjdb[mobphone]!=$mobphone){
			if(!$webdb[EditYzMob]){
				showerr("妳不可以再修改手机號碼,因为已经审核过了.");
			}else{
				$array[mob_yz]=0;
			}			
		}
		if($lfjdb[idcard_yz]&&($lfjdb[idcard]!=$idcard||$lfjdb[truename]!=$truename)){
			if(!$webdb[EditYzIdcard]){
				showerr("妳不可以再修改身份证资料,因为已经审核过了.");
			}else{
				$array[idcard_yz]=0;
			}			
		}	

		$userDB->edit_user($array);

		//自定义用户字段
		Reg_memberdata_field($lfjuid,$postdb);
		
		//截取用户头像
		if($icon_url){
			$reurl=base64_encode("$webdb[www_url]/member/userinfo.php?uid=$lfjuid");
			header("location:$webdb[www_url]/do/cutimg.php?job=cutimg&width=150&height=150&srcimg=$icon_url&reurl=$reurl");
			exit;
		}
		refreshto("$FROMURL","脩改成功",1);
	}
	else
	{
		$sex_db[$lfjdb[sex]]=" checked ";

		if(!$webdb[EditYzEmail]&&$lfjdb[email_yz]){
			$ipunt_email=" readonly onclick=\"alert('郵箱已审核,不可再修改')\" ";
		}elseif($lfjdb[email_yz]){
			$ipunt_email=" onclick=\"alert('郵箱已审核,修改的话,会处于未审核狀态')\" ";
		}
		if(!$webdb[EditYzMob]&&$lfjdb[mob_yz]){
			$ipunt_mob=" readonly onclick=\"alert('手机已审核,不可再修改')\"  ";
		}elseif($lfjdb[mob_yz]){
			$ipunt_mob=" onclick=\"alert('手机已审核,修改的话,会处于未审核狀态')\"  ";
		}
		if(!$webdb[EditYzIdcard]&&$lfjdb[idcard_yz]){
			$ipunt_idcard=" readonly onclick=\"alert('身份证已审核,不可再修改')\"  ";
		}elseif($lfjdb[idcard_yz]){
			$ipunt_idcard=" onclick=\"alert('身份证已审核,修改的话,会处于未审核狀态')\"  ";
		}

		$lfjdb[postalcode]==0&&$lfjdb[postalcode]='';

		require(dirname(__FILE__)."/"."head.php");
		require(dirname(__FILE__)."/"."template/userinfo.htm");
		require(dirname(__FILE__)."/"."foot.php");
	}
}

//查看用户信息
else
{
	if(!$uid&&!$username)
	{
		$uid=$lfjuid;
	}
	header("location:homepage.php?uid=$uid");exit;
}
?>