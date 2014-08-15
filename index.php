<?php

require 'config/database.php';
require 'Bootstrap.php';
require 'lib/TimeSlot.php';

try {
    $bootstrap = new Bootstrap();

    Session::init();
    if (($id = Session::get('id')) != null) {
        $userObj = new User($bootstrap->db);
        $result = $userObj->load($id);
        if ($result) {
            //echo "Welcome back <br />";
            if ($userObj->getEnable() != 1) {
                //echo "sorry you are not authorised to open the gate yet!";
            } else {
                //echo "hey would you like to open the gate";
            }
        } else {
            //echo "hmm...";
        }
    } else {
        header("Location: " . PATH . "login.php?noaccess");
        die();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//level from the form post
        $level = $_POST["level"];

        $my_access_token = ACCESS_TOKEN;
        $my_device = DEVICE_ID;
        $output_pin = "r1";

        $url = SPARK_PATH . $my_device . "/relay2";
        $fields = array();
        $fields['access_token'] = $my_access_token;
        //$fields['args'] = $output_pin . "," . $level;
        $fields['args'] = "r2,HIGH";
        $accessLogObj = new AccessLog($bootstrap->db);
        $service = json_decode(Tools::curl_download($url, $fields));
        if (is_null($service)) {
            //echo "CoRe not ReSpOnDinG!";
            $accessLogObj->create(null, "Onsite device not responding", $userObj->getId(), time());
        } else {
            //var_dump($service);
            if ($service->return_value == 1) {
                //echo "Open Sesame";

                $accessLogObj->create(null, "Opened Gate", $userObj->getId(), time());
            } else {
                //echo "something aint right";
                $accessLogObj->create(null, "Failed to Open", $userObj->getId(), time());
            }
        }
        $accessLogObj->save();
    }
    $timeSlotObj = new TimeSlot($bootstrap->db);
    if ($timeSlotObj->isItTime(time())) {
        //echo "<br />It is time!<br />";
    } else {
        //echo "<br />Its not time!<br />";
    }
    $isAdmin = ($userObj->getAccessLevel() > 1) ? 1 : 0;
    $bootstrap->smarty->assign('isAdmin', $isAdmin);
    $bootstrap->smarty->assign('menuSelected', 'home');
    $nav = $bootstrap->smarty->fetch('menu.tpl');
    $header = $bootstrap->smarty->fetch('header.tpl');
    $footer = $bootstrap->smarty->fetch('footer.tpl');

    $bootstrap->smarty->assign('header', $header);
    $bootstrap->smarty->assign('nav', $nav);
    $bootstrap->smarty->assign('footer', $footer);
    $bootstrap->smarty->assign('url', PATH."index.php");
    $bootstrap->smarty->display('test.tpl');
} catch (SmartyException $e) {
    echo 'Templating engine problem';
    die();
}