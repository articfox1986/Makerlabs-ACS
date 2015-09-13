<?php
require 'config/database.php';
require('./lib/SparkAPI.php');
require('./lib/SparkToken.php');
require('./lib/SparkDevice.php');
require('./lib/SparkFunction.php');
require('./lib/SparkVariable.php');
require('./lib/SparkReading.php');
require('./lib/SparkUser.php');
require 'Bootstrap.php';
try {
$bootstrap = new Bootstrap();

// load spark user closer
$sparkUserObj = new SparkUser($bootstrap->db);
// load first user
if ($sparkUserObj->loadFirst()) {
    
} else {
    echo "No user saved";
    die();
}

$sparkApi = new SparkAPI();

// load the latest token
$tokenObj = new SparkToken($bootstrap->db);
if ($tokenObj->loadLatest()) {
    
    $sparkApi->setToken($tokenObj->getToken());
    
    $sparkVariableObj = new SparkVariable($bootstrap->db);
    $variables = $sparkVariableObj->loadAll();
    
    //var_dump($variables);
    foreach($variables as $v)
    {
        $result = $sparkApi->getVariable($v['deviceId'],$v['name']);
        //var_dump($result);
        $sparkReadingObj = new SparkReading($bootstrap->db);
        $sparkReadingObj->create(null, $result->result, $v['type'], $v['name'], $v['deviceId']);
        $sparkReadingObj->save();
        echo "{$v['deviceId']} - {$result->result}<br />";
    }
    
    die();
    
    $bootstrap->smarty->display('setup.tpl');
} else {
    echo "No tokens!";
    die();
}
} catch (SmartyException $e)
{
    echo $e->getMessage();
    echo $e->getLine();
}