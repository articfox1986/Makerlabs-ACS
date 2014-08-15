<?php

require 'config/database.php';
require ('./lib/AccessLogs.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();

Session::init();
if (($id = Session::get('id')) == null) {
    header("Location: " . PATH . "login.php?noaccess");
    die();
} else {
    $userObj = new User($bootstrap->db);
    $result = $userObj->load($id);
    if (!$result) {
        header("Location: " . PATH . "login.php?noaccess");
        die();
    }
}
$isAdmin = ($userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'logs');
$nav = $bootstrap->smarty->fetch('menu.tpl');

$header = $bootstrap->smarty->fetch('header.tpl');
$footer = $bootstrap->smarty->fetch('footer.tpl');

$bootstrap->smarty->assign('header', $header);
$bootstrap->smarty->assign('nav', $nav);
$bootstrap->smarty->assign('footer', $footer);
$logsObj = new AccessLogs($bootstrap->db);
$logs = $logsObj->loadAsArray(0);
$bootstrap->smarty->assign('logs', $logs);
$bootstrap->smarty->display('log.tpl');
