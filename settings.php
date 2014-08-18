<?php

require 'config/database.php';
require ('./lib/Setting.php');
require ('./lib/Settings.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession(2);

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'logs');

$settingsObj = new Settings($bootstrap->db);
$settings = $settingsObj->loadAsArray(0);
$bootstrap->smarty->assign('settings', $settings);
$bootstrap->smarty->display('settings.tpl');
