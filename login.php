<?php
require 'config/database.php';
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
if ($_REQUEST['action'] == 'logout') {
    //echo 1;
    Session::init();
    Session::destroy();
    //header("Location: http://gate.makerlabs.co.za/index.php?logout");
    //die();
}
//$bootstrap->smarty->assign('url', htmlspecialchars($_SERVER["PHP_SELF"]));
$bootstrap->smarty->display('index.tpl');
