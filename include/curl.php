<?php

function CurlApi($url_p,$arr)
{
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
    $url = "https://";   
else  
    $url = "http://";     
$url.= $_SERVER['HTTP_HOST']; 
$url .= $_SERVER['REQUEST_URI']; 
$url = str_replace(basename($url),$url_p,$url);
// var_dump($url);exit;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$arr);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
// return $data;
return $error = json_decode($data,true);

}

function CurlApiget($url_p)
{ 
    // session_start();
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
    $url = "https://";   
else  
    $url = "http://";     
$url.= $_SERVER['HTTP_HOST']; 
$url .= $_SERVER['REQUEST_URI']; 
$url = str_replace(basename($url),$url_p,$url); 
$url = $url.'&token='.$_SESSION['token'].'&uid='.$_SESSION['id'];
// var_dump($url);exit;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_COOKIEJAR, $_SESSION['id']);  //tell cUrl where to write cookie data
curl_setopt($ch,CURLOPT_COOKIEFILE, $_SESSION['token']); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
// return $data;
return $error = json_decode($data,true);
$_SESSION['msg'] = $error['msg'];
$_SESSION['status'] = $error['status'];

}

?>