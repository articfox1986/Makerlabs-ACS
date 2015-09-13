<?php

require 'config/database.php';
require 'Bootstrap.php';
require './lib/Tag.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession(2);

if (isset($_GET['id'])) {
    $tagObj2 = new Tag($bootstrap->db);
    $result = $tagObj2->load($_GET['id']);
    if ($result) {
        $tag = $tagObj2->asArray();
        
    }
}
/*if (isset($_POST['name'])) {
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
    header("Location: " . PATH . "tags.php");
    die();
}*/

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'admin');

$bootstrap->smarty->assign('url', PATH . "editTag.php?id={$_GET['id']}");
$bootstrap->smarty->assign('tag', $tag);
$bootstrap->smarty->display('edit_tag.tpl');
