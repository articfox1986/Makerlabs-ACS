<?php

require 'config/database.php';
require('./lib/TimeSlots.php');
require('./lib/TimeSlot.php');
require 'Bootstrap.php';

$bootstrap = new Bootstrap();
$bootstrap->initSession(2);

$values = array();
if (isset($_GET['day'])) {
    $timeslotsObj = new TimeSlots($bootstrap->db);
    $timeslots = $timeslotsObj->load($_GET['day']);
    if (!$result) {
        // error handling
    }
    /*for ($i = 0; $i < 24; $i++) {
        if (isset($_POST[$i])) {
            $values[$i] = $_POST[$i];
            //$timeslots[$i] = $_POST[$i];
            //$userObj2->setName($name);
        }
    }*/
    //var_dump($timeslots);
    foreach ($timeslots as $ts) {
        $values[$ts->getStartTime()] = (int) $ts->getIsActive();
    }
    //var_dump($values);
    //die();
}



if (isset($_POST['submitted'])) {
    foreach ($timeslots as $ts) {
        if (isset($_POST[$ts->getStartTime()])) {
            $ts->setIsActive($_POST[$ts->getStartTime()]);
        } else {
            $ts->setIsActive(0);
        }
        $ts->save();
        //var_dump($ts->getStartTime());
        $values[$ts->getStartTime()] = (int) $ts->getIsActive();
    }
    header("Location: " . PATH . "timeslots.php");
    die();
}

$isAdmin = ($bootstrap->userObj->getAccessLevel() > 1) ? 1 : 0;
$bootstrap->smarty->assign('isAdmin', $isAdmin);
$bootstrap->smarty->assign('menuSelected', 'admin');

$bootstrap->smarty->assign('url', PATH . "timeslotEdit.php?day={$_GET['day']}");
$bootstrap->smarty->assign('timeslots', $values);
$bootstrap->smarty->display('timeslot_edit.tpl');
