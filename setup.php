<?php
require 'config/database.php';
require ('./lib/SparkAPI.php');
require ('./lib/SparkToken.php');
require ('./lib/SparkDevice.php');
require ('./lib/SparkFunction.php');
require ('./lib/SparkUser.php');
require 'Bootstrap.php';
try {
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
    $bootstrap->smarty->display('login_setup.tpl');
    die();
}



$sparkApi = new SparkAPI();
$tokens = $sparkApi->getTokens($sparkUserObj->getUsername(), $sparkUserObj->getPassword());
$bootstrap->smarty->assign('tokens', $tokens);

foreach ($tokens as $value) {
    $tokenObj = new SparkToken($bootstrap->db);
    $tokenObj->create(null, $value->token, $value->expires_at, 0);
    $tokenObj->save();
}




// load the latest token
$tokenObj = new SparkToken($bootstrap->db);
if ($tokenObj->loadLatest()) {
    
    $sparkApi->setToken($tokenObj->getToken());
    $cores = $sparkApi->getCores();
    $bootstrap->smarty->assign('cores', $cores);
    $ids = array();
    // save the spark devices
    foreach ($cores as $device) {
        $deviceObj = new SparkDevice($bootstrap->db);
        if ($deviceObj->load($deviceId)) {
            
        } else {
            $deviceObj->create(null, $tokenObj->getId(), $device->name, $device->id, 1);
            $deviceObj->save();
        }
        $ids[] = $device->id;
        //var_dump($device);
    }
    
    
    
    
    $functions = array();
    $variables = array();
    
    $fields = array();
    $nodes = array();
    foreach ($ids as $id) {

        $nodes[$id] = $sparkApi->getCoreDetails($id);
    }

    foreach ($nodes as $key=>$node) {
        if (!$node)
        {
            continue;
        }
		if (!is_null($node->functions))
		{
			foreach ($node->functions as $key=>$f) {
				$sparkFunctionObj = new SparkFunction($bootstrap->db);
				$sparkFunctionObj->create(null, $f, $key);
				$sparkFunctionObj->save();
				// check relayX
			}
		}
		//var_dump($node->variables);
        foreach ($node->variables as $key=>$vars) {
			if (strpos($key,'temp') !== false) {
				echo 'There is a temp';
				// show that the core has a temp
			}
			if (strpos($key,'temp') !== false) {
				echo 'There is a humi';
				// show the core has humidity
			}
			//var_dump($key);
            //foreach ($vars as $v) {
                //if ()
                // check if tempX
                // check if humiX
                // check boolX
            //}
        }
    }

    $bootstrap->smarty->assign('nodes', $nodes);
    
    
    
    
    
    
    $webhooks = $sparkApi->getWebhooks();
    
    $bootstrap->smarty->assign('webhooks', $webhooks);
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

// add delete webhook
// add create webhook
// 
// 
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
