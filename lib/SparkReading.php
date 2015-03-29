<?php
/**
 * Description of SparkFunction
 *
 * @author devin
 */
class SparkReading {

    private $db;
    private $id;
    private $reading;
    private $type;
    private $variableName;
    private $deviceId;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $reading, $type, $variableName, $deviceId) {
        $this->id = $id;
        $this->reading = $reading;
        $this->type = $type;
        $this->variableName = $variableName;
        $this->deviceId = $deviceId;
    }
    
    function load($name) {
        $this->name = $name;
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_function` WHERE name = :name LIMIT 1");
            $statement->execute(array(':name' => $this->name));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->deviceId = $row['device_id'];
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            var_dump($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function save() {
        try {
            $statement = $this->db->prepare("INSERT INTO `spark_reading` (`reading`,`type`, `variable_name`, `device_id`) VALUES (:reading, :type, :variablename, :deviceid) ON DUPLICATE KEY UPDATE `reading` = :reading, `type` = :type, `variable_name` = :variablename, `device_id` = :deviceid");
            $statement->execute(array(':reading' => $this->reading, ':type' => $this->type, ':variablename' => $this->variableName, ':deviceid' => $this->deviceId));
            $this->id = $this->db->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            var_dump($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, 16, $e->getLine());
            return false;
        }
    }
    
    function getId() {
        return $this->id;
    }
    
    function getReading() {
        return $this->reading;
    }
    
    function getType() {
        return $this->type;
    }
    
    function getVariableName() {
        return $this->variableName;
    }
    
    function getDeviceId() {
        return $this->deviceId;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setReading($reading) {
        $this->reading = $reading;
    }
    
    function setType($type) {
        $this->type = $type;
    }
    
    function setVariableName($variableName) {
        $this->variableName = $variableName;
    }
    
    function setDeviceId($deviceId) {
        $this->deviceId = $deviceId;
    }
}