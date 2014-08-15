<?php

require 'config/database.php';
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
if (isset($_GET['id'])) {
    $userObj = new User($bootstrap->db);
    $result = $userObj->load($_GET['id']);
    if ($result) {
        $user = $userObj->asArray();
    }
}
$test = '';
if (isset($_POST['name'])) {
    $name = $_POST['name'];
	$user['name'] = $name;
	$userObj->setName($name);
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
	$user['password'] = $password;
	$userObj->setPassword($password);
}

if (isset($_POST['accessLevel'])) {
    $accessLevel = $_POST['accessLevel'];
	$user['accessLevel'] = $accessLevel;
	$userObj->setAccessLevel($accessLevel);
	
	if (isset($_POST['enable'])) {
    $verify = $_POST['enable'];
	$user['enable'] = $verify;
	} else {
		$user['enable'] = 0;
		$verify = 0;
	}
	$userObj->setEnable($verify);
	$userObj->save();
}

$isAdmin = ($userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'users');
$nav = $bootstrap->smarty->fetch('menu.tpl');
$header = $bootstrap->smarty->fetch('header.tpl');
$footer = $bootstrap->smarty->fetch('footer.tpl');

$bootstrap->smarty->assign('header', $header);
$bootstrap->smarty->assign('nav', $nav);
$bootstrap->smarty->assign('footer', $footer);
$bootstrap->smarty->assign('test', $test);
$bootstrap->smarty->assign('url', PATH."editUser.php?id={$_GET['id']}");
$bootstrap->smarty->assign('user', $user);
$bootstrap->smarty->display('edit_user.tpl');
