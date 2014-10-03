<?php

require 'config/database.php';
require 'Bootstrap.php';
require 'lib/TimeSlot.php';
require ('./lib/SparkToken.php');
require ('./lib/SparkDevice.php');
require ('./lib/SparkFunction.php');
require ('./lib/SparkUser.php');

try {
    $bootstrap = new Bootstrap();
    $bootstrap->initSession();
    $timeSlotObj = new TimeSlot($bootstrap->db);
    if ($timeSlotObj->isItTime(time())) {
        $timeslot = 1;
        //echo "<br />It is time!<br />";
    } else {
        $timeslot = 0;
        //echo "<br />Its not time!<br />";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

//level from the form post
        if ($bootstrap->userObj->getAccessLevel() > 0) {
            // Check time slots

            $level = $_POST["level"];
            $tokenObj = new SparkToken($bootstrap->db);
            if ($tokenObj->loadLatest()) {
                
                /*$deviceObj = new SparkDevice($bootstrap->db);
                if ($deviceObj->load($deviceId)) {
                    
                }*/

                $my_device = DEVICE_ID;
                $output_pin = "r1";

                $url = SPARK_PATH . "devices/" . $my_device . "/relay2";
                $fields = array();
                $fields['access_token'] = $tokenObj->getToken();
                //$fields['args'] = $output_pin . "," . $level;
                $fields['args'] = "r1,HIGH";
                $accessLogObj = new AccessLog($bootstrap->db);
                $service = json_decode(Tools::curl_download($url, $fields));
                if (is_null($service)) {
                    $message = "Onsite device not responding";
                } else {
                    //var_dump($service);
                    if ($service->return_value == 1) {
                        $message = "Opened Gate";
                    } else {
                        $message = "Failed to Open";
                    }
                }
            } else {
                $message = "Access Token not found";
            }
            $accessLogObj->create(null, $message, $bootstrap->userObj->getId(), time());
            $accessLogObj->save();
        }
    }
    $isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
    $bootstrap->smarty->assign('isAdmin', $isAdmin);
    $bootstrap->smarty->assign('accessLevel', $bootstrap->userObj->getAccessLevel());
    $bootstrap->smarty->assign('timeslot', $timeslot);
    $bootstrap->smarty->assign('menuSelected', 'home');

    $bootstrap->smarty->assign('url', PATH . "index.php");
    $bootstrap->smarty->display('test.tpl');
} catch (SmartyException $e) {
    echo 'Templating engine problem';
    die();
}