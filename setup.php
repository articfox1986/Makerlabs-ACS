<?php

require 'config/database.php';
require ('./lib/SparkToken.php');
require ('./lib/SparkDevice.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();

$my_access_token = ACCESS_TOKEN;
$my_device = DEVICE_ID;

$sparkUsername = "myemail@addre.ss";
$sparkPassword = "password";

$url = SPARK_PATH . "access_tokens";
$service = json_decode(Tools::curl_download($url, $fields, 'get', 'basic', $sparkUsername, $sparkPassword));
foreach ($service as $value) {
    $tokenObj = new SparkToken($bootstrap->db);
    $tokenObj->create(null, $value->token, $value->expires_at, 0);
    $tokenObj->save();
    echo "token - $value->token, expiry date - $value->expires_at, client - $value->client <br/>";
}
$tokenObj = new SparkToken($bootstrap->db);
$tokenObj->loadLatest();
var_dump($tokenObj);
/*
// create token
$fields = array('grant_type' => 'password', 'username' => $sparkUsername, 'password' => $sparkPassword);
$url = "https://api.spark.io/oauth/token";
$service = json_decode(Tools::curl_download($url, $fields, 'post', 'basic', 'spark', 'spark'));
var_dump($service);/**/
// delete token
/*$token = "*********";
$url = SPARK_PATH . "access_tokens/$token";
var_dump($url);
var_dump(Tools::curl_download($url, $fields, 'delete', 'basic', $sparkUsername, $sparkPassword));
$service = json_decode(Tools::curl_download($url, $fields, 'delete', 'basic', $sparkUsername, $sparkPassword));
var_dump($service);*/
die();
$output_pin = "r1";
$url = SPARK_PATH . "devices?access_token=". $my_access_token;
//var_dump($url);
$fields = array();
//$fields['access_token'] = $my_access_token;
//$fields['args'] = $output_pin . "," . $level;
$fields['args'] = "r1,HIGH";
$service = json_decode(Tools::curl_download($url, $fields, 'get'));
if (is_null($service)) {
    $message = "Onsite device not responding";
}
$tokenObj = new SparkToken($bootstrap->db);
$tokenObj->load(1);
//var_dump($tokenObj->getId());
//$tokenObj->save();
foreach ($service as $device) {
    $deviceObj = new SparkDevice($bootstrap->db);
    if ($deviceObj->load($deviceId)) {
        
    } else {
        $deviceObj->create(null, $tokenObj->getId(), $device->name, $device->id, 1);
        $deviceObj->save();
    }
    
    //$deviceObj-
    //var_dump($device);
    var_dump($device->id);
    var_dump($device->name);
    var_dump($device->last_heard);
    var_dump($device->connected);
}
//var_dump($service);