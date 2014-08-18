<?php

require 'config/database.php';
require ('./lib/Users.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession();

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;

$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'users');

$usersObj = new Users($bootstrap->db);
$users = $usersObj->loadAsArray($bootstrap->userObj->getAccessLevel());
$bootstrap->smarty->assign('users', $users);
$bootstrap->smarty->display('users.tpl');
