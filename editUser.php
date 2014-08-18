<?php

require 'config/database.php';
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession(2);

if (isset($_GET['id'])) {
    $userObj2 = new User($bootstrap->db);
    $result = $userObj2->load($_GET['id']);
    if ($result) {
        $user = $userObj2->asArray();
        if ($userObj2->getAccessLevel() > $bootstrap->userObj->getAccessLevel()) {
            header("Location: " . PATH . "index.php?nopermission");
                die();
        }
    }
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $user['name'] = $name;
    $userObj2->setName($name);
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $user['password'] = $password;
    $userObj2->setPassword($password);
}

if (isset($_POST['accessLevel'])) {
    $accessLevel = $_POST['accessLevel'];
    $user['accessLevel'] = $accessLevel;
    $userObj2->setAccessLevel($accessLevel);

    $userObj2->save();
    header("Location: " . PATH . "users.php");
    die();
}

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'users');

$bootstrap->smarty->assign('url', PATH . "editUser.php?id={$_GET['id']}");
$bootstrap->smarty->assign('user', $user);
$bootstrap->smarty->display('edit_user.tpl');
