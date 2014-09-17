<?php
/**
 * Description of TimeSlot
 *
 * @author devin
 */
class TimeSlot {

    private $db;
    private $id;
    private $day;
    private $startTime;
    private $endTime;
    private $isActive;
    private $recurring;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $day, $startTime, $endTime, $isActive, $recurring) {
        $this->id = $id;
        $this->day = $day;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->isActive = $isActive;
        $this->recurring = $recurring;
    }
    
    function load($id) {
        $this->id = $id;
        try {
            $statement = $this->db->prepare("SELECT * FROM `time_slot` WHERE id = :id LIMIT 1");
            $statement->execute(array(':id' => $this->id));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->day = $row['day'];
                $this->startTime = $row['start_time'];
                $this->end_time = $row['end_time'];
                $this->is_active = $row['is_active'];
                $this->recurring = $row['recurring'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function save() {
        try {
            $statement = $this->db->prepare("INSERT INTO `time_slot` (`day`, `start_time`, `end_time`, `is_active`, `recurring`) VALUES (:day, :starttime, :endtime, :isactive, :recurring) ON DUPLICATE KEY UPDATE `day` = :day, `start_time` = :starttime, `end_time` = :endtime, `is_active` = :isactive, `recurring` = :recurring");
            $statement->execute(array(':day' => $this->day, ':starttime' => $this->startTime, ':endtime' => $this->endTime, ':isactive' => $this->isActive, ':recurring' => $this->recurring));
            $this->id = $this->db->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, 16, $e->getLine());
            return false;
        }
    }
    
    function isItTime($timestamp) {
        $day = date("l", $timestamp);
        $hour = date("G", $timestamp);
        try {
            $statement = $this->db->prepare("SELECT * FROM `time_slot` WHERE start_time = :hour AND day = :day AND is_active = 1 LIMIT 1");
            $statement->execute(array(':hour' => $hour, ':day' => $day));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->startTime = $row['start_time'];
                $this->end_time = $row['end_time'];
                $this->is_active = $row['is_active'];
                $this->recurring = $row['recurring'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }
    
    function getId() {
        return $this->id;
    }
    
    function getDay() {
        return $this->day;
    }
    
    function getStartTime() {
        return $this->startTime;
    }
    
    function getEndTime() {
        return $this->endTime;
    }
    
    function getIsActive() {
        return $this->isActive;
    }
    
    function getRecurring() {
        return $this->recurring;
    }
    
    function setDay($day) {
        $this->day = $day;
    }
    
    function setStartTime($startTime) {
        $this->startTime = $startTime;
    }
    
    function setEndTime($endTime) {
        $this->endTime = $endTime;
    }
    
    function setIsActive($isActive) {
        $this->isActive = $isActive;
    }
    
    function setRecurring($recurring) {
        $this->recurring = $recurring;
    }
    
}