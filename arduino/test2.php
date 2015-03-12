<?php

require '../config/database.php';
require '../Bootstrap.php';
require '../lib/TimeSlot.php';
require ('../lib/SparkToken.php');
require ('../lib/SparkDevice.php');
require ('../lib/SparkFunction.php');
require ('../lib/SparkUser.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
require ('../lib/Tools.php');
        require ('../lib/Database.php');
        $db = new Database();
//level from the form post
            $tokenObj = new SparkToken($db);
            if ($tokenObj->loadLatest()) {
                
                /*$deviceObj = new SparkDevice($bootstrap->db);
                if ($deviceObj->load($deviceId)) {
                    
                }*/
                
                $my_device = DEVICE_ID;
                $output_pin = "r1";

                $url = SPARK_PATH . "devices/" . $my_device . "/relay";
                $fields = array();
                $fields['access_token'] = $tokenObj->getToken();
                //$fields['args'] = $output_pin . "," . $level;
                    // gate
                    $fields['args'] = "r2,HIGH";
                
                //$accessLogObj = new AccessLog($bootstrap->db);
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
            //$accessLogObj->create(null, $message, $bootstrap->userObj->getId(), time());
            //$accessLogObj->save();
        }
        
        echo 1;
   