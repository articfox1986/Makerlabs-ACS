<?php
/**
 * Description of SparkFunction
 *
 * @author devin
 */
class SparkVariable {

    private $db;
    private $id;
    private $name;
    private $type;
    private $deviceId;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $name, $deviceId, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->deviceId = $deviceId;
        $this->type = $type;
    }
    
    function load($name) {
        $this->name = $name;
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_variable` WHERE name = :name LIMIT 1");
            $statement->execute(array(':name' => $this->name));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->name = $row['name'];
                $this->deviceId = $row['device_id'];
                $this->type = $row['type'];
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

    function loadAll() {
        $results = array();
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_variable`");
            $statement->execute(array());
            while (($row = $statement->fetch()) != false) {
                $result = array();
                $result['id'] = $row['id'];
                $result['name'] = $row['name'];
                $result['deviceId'] = $row['device_id'];
                $result['type'] = $row['type'];
                $results[] = $result;
            }
            return $results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            var_dump($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function save() {
        try {
            $statement = $this->db->prepare("INSERT INTO `spark_variable` (`name`, `device_id`, `type`) VALUES (:name, :deviceid, :type) ON DUPLICATE KEY UPDATE `name` = :name, `device_id` = :deviceid, `type` = :type");
            $statement->execute(array(':name' => $this->name, ':deviceid' => $this->deviceId, ':type' => $this->type));
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
    
    function getName() {
        return $this->name;
    }
    
    function getDeviceId() {
        return $this->deviceId;
    }
    
    function getType() {
        return $this->type;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setDeviceId($deviceId) {
        $this->deviceId = $deviceId;
    }
    
    function setType($type) {
        $this->type = $type;
    }
}   
    