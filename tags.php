<?php

require 'config/database.php';
require ('./lib/Tags.php');
require ('./lib/Tag.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession(2);

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;

$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'users');

$tagsObj = new Tags($bootstrap->db);
$tags = $tagsObj->loadAsArray();

$bootstrap->smarty->assign('tags', $tags);
$bootstrap->smarty->display('tags.tpl');
