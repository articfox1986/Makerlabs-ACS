<?php

require 'config/database.php';
require ('./lib/AccessLogs.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession();

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'logs');

$logsObj = new AccessLogs($bootstrap->db);
$logs = $logsObj->loadAsArray(0);
$bootstrap->smarty->assign('logs', $logs);
$bootstrap->smarty->display('log.tpl');
