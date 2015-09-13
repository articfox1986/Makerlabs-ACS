<?php

require 'config/database.php';
require('./lib/SparkToken.php');
require('./lib/SparkDevice.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$tokenObj = new SparkToken($bootstrap->db);
$tokenObj->create(null, $_POST['data'], 1);
$tokenObj->save();