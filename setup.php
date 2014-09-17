<?php
require 'config/database.php';
require ('./lib/SparkToken.php');
require ('./lib/SparkDevice.php');
require ('./lib/SparkUser.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();

// load spark user closer
$sparkUserObj = new SparkUser($bootstrap->db);
if (isset($_POST['username'])) {
    $sparkUserObj->create(null, $_POST['username'], $_POST['password']);
    $sparkUserObj->save();
}
// load first user
if ($sparkUserObj->loadFirst()) {
    
} else {
    ?>
    <form method="POST">
        Username: <input type="text" name="username"><br />
        Password: <input type="text" name="password"><br />
        <input type="submit" value="Submit">
    </form>
    <?php
    die();
}

// get tokens
function getTokens($username, $password) {
    
}

$url = SPARK_PATH . "access_tokens";
$service = json_decode(Tools::curl_download($url, $fields, 'get', 'basic', $sparkUserObj->getUsername(), $sparkUserObj->getPassword()));
//var_dump($service);
if (isset($service->ok) && $service->ok == false) {
    echo "Failed";
    var_dump($service);
    die();
}
echo "<h2>Tokens</h2>";
echo "<table><tr><th>Token</th><th>Expiry Date</th><th>Client</th></tr>";
foreach ($service as $value) {
    $tokenObj = new SparkToken($bootstrap->db);
    $tokenObj->create(null, $value->token, $value->expires_at, 0);
    $tokenObj->save();
    echo "<tr><td>{$value->token}</td><td>{$value->expires_at}</td><td>{$value->client}</td></tr>";
}
echo "</table>";

//die();
// load the latest token
$tokenObj = new SparkToken($bootstrap->db);
if ($tokenObj->loadLatest()) {
    // get a list of spark cores
    $url = SPARK_PATH . "devices?access_token=" . $tokenObj->getToken();
    $service = json_decode(Tools::curl_download($url, $fields, 'get'));
    if (is_null($service)) {
        $message = "Cloud cannot be reached";
    }
    $ids = array();
    echo "<h2>Sparks</h2>";
    echo "<table><tr><th>ID</th><th>Name</th><th>Last Heard</th><th>Connected</th></tr>";
    foreach ($service as $device) {
        $deviceObj = new SparkDevice($bootstrap->db);
        if ($deviceObj->load($deviceId)) {
            
        } else {
            $deviceObj->create(null, $tokenObj->getId(), $device->name, $device->id, 1);
            $deviceObj->save();
        }
        $ids[] = $device->id;
        echo "<tr><td>{$device->id}</td><td>{$device->name}</td><td>{$device->last_heard}</td><td>{$device->connected}</td></tr>";
        //var_dump($device);
    }
    echo "</table>";
    $functions = array();
    $variables = array();
    
    $fields = array();
    
    foreach ($ids as $id) {
        $url = SPARK_PATH . "devices/{$id}/?access_token=" . $tokenObj->getToken();
            $nodes[] = array('url' => $url, 'fields' => $fields, 'name' => $id);
    }
// fire off all the curl requests at the same time using multi curl
    $results = Tools::curlMulti($nodes);
    foreach ($results as $key => $value) {
        $response = json_decode($value);
        if (is_null($response)) {
            continue;
        }
        $functions[$response->id] = $response->functions;
        $variables[$response->id] = $response->variables;
        //var_dump($response);
    }
    echo "<h2>Functions</h2>";
    foreach ($functions as $key=>$funcs) {
        echo "<h3>$key</h3>";
        echo "<ul>";
        foreach ($funcs as $f) {
            echo "<li>$f</li>";
        }
        echo "</ul>";
    }
    
    echo "<h2>Variables</h2>";
    foreach ($variables as $key=>$vars) {
        echo "<h3>$key</h3>";
        echo "<ul>";
        foreach ($vars as $v) {
            echo "<li>$v</li>";
        }
        echo "</ul>";
    }
    //var_dump($functions);
    $url = SPARK_PATH . "webhooks?access_token=" . $tokenObj->getToken();
    $service = json_decode(Tools::curl_download($url, $fields, 'get'));
    if (is_null($service)) {
        $message = "Cloud cannot be reached";
    }
    echo "<h2>Webhooks</h2>";
    echo "<table><tr><th>ID</th><th>Url</th><th>deviceID</th><th>event</th><th>created_at</th></tr>";
    foreach ($service as $webhooks) {
        echo "<tr><td>{$webhooks->id}</td><td>{$webhooks->url}</td><td>{$webhooks->deviceID}</td><td>{$webhooks->event}</td><td>{$webhooks->created_at}</td></tr>";
    }
    echo "</table>";
    //var_dump($service);
} else {
    echo "No tokens!";
    die();
}


//var_dump($tokenObj);
/*
  // create token
  $fields = array('grant_type' => 'password', 'username' => $sparkUserObj->getUsername(), 'password' => $sparkUserObj->getPassword());
  $url = "https://api.spark.io/oauth/token";
  $service = json_decode(Tools::curl_download($url, $fields, 'post', 'basic', 'spark', 'spark'));
  var_dump($service);/* */


// delete token
/* $token = "178c6bdef901ea3db1d3dd2e8fc65866ceed4c09";
  $url = SPARK_PATH . "access_tokens/$token";
  //var_dump($url);
  $service = json_decode(Tools::curl_download($url, $fields, 'delete', 'basic', $sparkUserObj->getUsername(), $sparkUserObj->getPassword()));
  var_dump($service);/* */
  //var_dump($service->ok);/* */
