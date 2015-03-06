<?php
/**
 * Description of SparkFunction
 *
 * @author devin
 */
class SparkFunction {

    private $db;
    private $id;
    private $name;
    private $deviceId;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $name, $deviceId) {
        $this->id = $id;
        $this->name = $name;
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
            $statement = $this->db->prepare("INSERT INTO `spark_function` (`name`, `device_id`) VALUES (:name, :deviceid) ON DUPLICATE KEY UPDATE `name` = :name, `device_id` = :deviceid");
            $statement->execute(array(':name' => $this->name, ':deviceid' => $this->deviceId));
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
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setDeviceId($deviceId) {
        $this->deviceId = $deviceId;
    }
}