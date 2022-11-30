<?php
$user = $_REQUEST['user'];
$pwd = urlencode($_REQUEST['pwd']);

if(isset($user)){
    $url = "http://搭建的接口地址/login/cellphone?phone=$user&password=$pwd";//此处为登录接口 以github上nodejsApi项目为例
    $ip = '';#你的IP
    $header = array('Content-Type:'.'application/x-www-form-urlencoded;charset=UTF-8','X-FORWARDED-FOR:'.$ip,'User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36','Upgrade-Insecure-Requests: 1');
    $output = curl_get($url,$header,$cookie='');
    $output = json_decode($output,1);
    if(!empty($output['cookie'])){
        $cookie = $output['cookie'];
        $url = "http://你的域名/Score.php?do=dask";
        $output = curl_get($url,$header,$cookie);
        print_r($output);
    }else{
        echo "{'code':'202','msg':'登陆失败'}";
    }
}else{
    echo "{'code':'203','msg':'本接口暂时免费使用，会自动关注作者网易云，介意勿用。简要使用说明：参数：user(账号)/pwd(密码) 方式：GET/POST'}";
}





function curl_get($url,$headers,$cookie=FALSE){
		$curl=curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
        if($cookie){
		     curl_setopt($curl, CURLOPT_COOKIE,$cookie);
        }
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1800);
		//curl_setopt($curl, CURLOPT_POST, 1);
		
        //curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		
        $output = curl_exec($curl);
		
        curl_close($curl);
		//$output=json_decode($output,true);
        return $output;
		//print_r($output);
}
