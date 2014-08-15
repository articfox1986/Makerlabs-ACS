<?php

require 'config/database.php';
require ('./lib/Users.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();

Session::init();
if (($id = Session::get('id')) == null) {
    header("Location: http://gate.makerlabs.co.za/index.php?noaccess");
    die();
} else {
    $userObj = new User($bootstrap->db);
        $result = $userObj->load($id);
        if (!$result) {
            header("Location: http://gate.makerlabs.co.za/index.php?noaccess");
            die();
        }
}
$isAdmin = ($userObj->getAccessLevel() > 1) ? 1: 0;
    $bootstrap->smarty->assign('isAdmin', $isAdmin);
    $bootstrap->smarty->assign('menuSelected', 'users');
$nav = $bootstrap->smarty->fetch('menu.tpl');
$header = $bootstrap->smarty->fetch('header.tpl');
$footer = $bootstrap->smarty->fetch('footer.tpl');

$bootstrap->smarty->assign('header', $header);
$bootstrap->smarty->assign('nav', $nav);
$bootstrap->smarty->assign('footer', $footer);
$usersObj = new Users($bootstrap->db);
$users = $usersObj->loadAsArray($userObj->getAccessLevel());
$bootstrap->smarty->assign('users', $users);
$bootstrap->smarty->display('admin.tpl');    