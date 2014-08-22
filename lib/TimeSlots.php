<?php

/**
 * Description of TimeSlots
 *
 * @author devin
 */
class TimeSlots {

    private $db;
    private $results = array();

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

    function load($day = null) {
        if  (!is_null($day)) {
            $filterSql = "AND day = '{$day}'";
        } else {
            $filterSql = "";
        }
        try {
            $statement = $this->db->query("SELECT * FROM `time_slot` WHERE 1 {$filterSql}");
            while (($row = $statement->fetch()) != false) {
                $timeslotObj = new TimeSlot($this->db);
                $timeslotObj->create($row['id'], $row['day'], $row['start_time'], $row['end_time'], $row['is_active'], $row['recurring']);
                $this->results[] = $timeslotObj;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function loadAsArray($day = null) {
        if  (!is_null($day)) {
            $filterSql = "AND day = '{$day}'";
        } else {
            $filterSql = "";
        }
        try {
            $statement = $this->db->query("SELECT * FROM `time_slot` WHERE 1 {$filterSql}");
            while (($row = $statement->fetch()) != false) {
                $timeslot = array();
                $timeslot['id'] = $row['id'];
                $timeslot['day'] = $row['day'];
                $timeslot['startTime'] = $row['start_time'];
                $timeslot['endTime'] = $row['end_time'];
                $timeslot['isActive'] = $row['is_active'];
                $timeslot['recurring'] = $row['recurring'];
                $this->results[] = $timeslot;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

}
