<?php
/**
 * Description of Action
 *
 * @author devin
 */
class Action {

    private $db;
    private $id;
    private $name;
    private $functionId;
    private $timeSlots;
    private $value;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $name, $functionId, $timeSlots, $value) {
        $this->id = $id;
        $this->name = $name;
        $this->functionId = $functionId;
        $this->timeSlots = $timeSlots;
        $this->value = $value;
    }
    
    function load($name) {
        $this->name = $name;
        try {
            $statement = $this->db->prepare("SELECT * FROM `action` WHERE name = :name LIMIT 1");
            $statement->execute(array(':name' => $this->name));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->functionId = $row['function_id'];
                $this->timeSlots = $row['time_slots'];
                $this->value = $row['value'];
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
            $statement = $this->db->prepare("INSERT INTO `action` (`name`, `function_id`, `time_slots`, `value`) VALUES (:name, :functionid, :timeslots, :value) ON DUPLICATE KEY UPDATE `name` = :name, `function_id` = :functionid, `time_slots` = :timeslots, `value` = :value");
            $statement->execute(array(':name' => $this->name, ':functionid' => $this->functionId, ':timeslots' => $this->timeslots, ':value' => $this->value));
            $this->id = $this->db->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, 16, $e->getLine());
            return false;
        }
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getFunctionId() {
        return $this->functionId;
    }
    
    function getTimeSlots() {
        return $this->timeSlots;
    }
    
    function getValue() {
        return $this->value;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setFunctionId($functionId) {
        $this->functionId = $functionId;
    }
    
    function setTimeSlots($timeSlots) {
        $this->timeSlots = $timeSlots;
    }
    
    function setValue($value) {
        $this->value = $value;
    }
}