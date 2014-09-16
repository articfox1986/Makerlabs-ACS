<?php

require 'config/database.php';
require ('./lib/SparkToken.php');
require ('./lib/SparkDevice.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();

// load spark user closer
$sparkUserObj = new SparkUser($bootstrap->db);
// create spark user
$sparkUserObj->create(null, '*******', '*****');
$sparkUserObj->save();
// load first user
$sparkUserObj->loadFirst();

// get tokens
$url = SPARK_PATH . "access_tokens";
$service = json_decode(Tools::curl_download($url, $fields, 'get', 'basic', $sparkUserObj->getUsername(), $sparkUserObj->getPassword()));
foreach ($service as $value) {
    $tokenObj = new SparkToken($bootstrap->db);
    $tokenObj->create(null, $value->token, $value->expires_at, 0);
    $tokenObj->save();
    echo "token - $value->token, expiry date - $value->expires_at, client - $value->client <br/>";
}
// load the latest token
$tokenObj = new SparkToken($bootstrap->db);
$tokenObj->loadLatest();

//var_dump($tokenObj);
/*
// create token
$fields = array('grant_type' => 'password', 'username' => $sparkUserObj->getUsername(), 'password' => $sparkUserObj->getPassword());
$url = "https://api.spark.io/oauth/token";
$service = json_decode(Tools::curl_download($url, $fields, 'post', 'basic', 'spark', 'spark'));
var_dump($service);/**/
// delete token
/*$token = "*********";
$url = SPARK_PATH . "access_tokens/$token";
var_dump($url);
$service = json_decode(Tools::curl_download($url, $fields, 'delete', 'basic', $sparkUserObj->getUsername(), $sparkUserObj->getPassword()));
var_dump($service);*/
die();
// get list of spark cores
$url = SPARK_PATH . "devices?access_token=". $tokenObj->getToken();
$service = json_decode(Tools::curl_download($url, $fields, 'get'));
if (is_null($service)) {
    $message = "Onsite device not responding";
}
// open spark token
$tokenObj = new SparkToken($bootstrap->db);
$tokenObj->loadLatest();

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