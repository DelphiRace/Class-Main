<?php
	session_start();
	$System_APServicePath = 'include/System_APService/System_APService.php';
	include($System_APServicePath);
	
	use System_APService\clsSystem;
	//宣告物件
	$VTs = new clsSystem;
	$VTs->initialization();
	//取得OAUTH回來的CODE，準備進行驗證
	$code = $_GET["login_code"];
	
	$url="http://127.0.0.1:99/decode.php";
	$postArr = array("login_code"=>$code);
	//取得Access Token
	$response = $VTs->UrlDataPost($url, $postArr);
	$tokenArr = $VTs->Json2Data($response);
	$access_token = $tokenArr->access_token;
	//$VTs->debug($tokenArr);
	
	//使用Access Token取資料
	$postArr = array("access_token"=>$access_token);
	$url="http://127.0.0.1:99/token.php";
	$response = $VTs->UrlDataPost($url, $postArr);
	$userInfo = $VTs->Json2Data($response);
	//$VTs->debug($userInfo);
	$_SESSION["uuid"] = $userInfo->uuid;
	$_SESSION["userName"] = $userInfo->userName;
	$_SESSION["userMail"] = $userInfo->userMail;
	
	//取得Classroom系統權限
	$strSQL = "select * from account_position_list a ";
	$strSQL .= "left join position b on a.position_uid = b.uid ";
	$strSQL .= "where a.uuid='".$userInfo->uuid."'";
	$data = $VTs->QueryData($strSQL);
	//$VTs->debug($data);
	$position = '';
	foreach($data as $content){
		$position .= $content["position_uid"].',';
	}
	$position = substr($position,0,strlen($position)-1);
	//放到SESSION中
	$_SESSION["position"] = $position;
	//$VTs->debug($_SESSION);
    //exit();
	//導回首頁
	header("location: ./");
	//print_r($_SESSION);
?>
