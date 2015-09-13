<?php

require 'config/database.php';
//require ('./lib/Setting.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession(2);

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'admin');

$bootstrap->smarty->display('timeslot.tpl');