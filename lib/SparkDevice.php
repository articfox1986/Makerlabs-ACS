<?php
/**
 * Description of SparkDevice
 *
 * @author devin
 */
class SparkDevice {

    private $db;
    private $id;
    private $fkTokenId;
    private $name;
    private $deviceId;
    private $isEnabled;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $fkTokenId, $name, $deviceId, $isEnabled) {
        $this->id = $id;
        $this->fkTokenId = $fkTokenId;
        $this->name = $name;
        $this->deviceId = $deviceId;
        $this->isEnabled = $isEnabled;
    }
    
    function load($deviceId) {
        $this->deviceId = $deviceId;
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_device` WHERE device_id = :id LIMIT 1");
            $statement->execute(array(':id' => $this->deviceId));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->fkTokenId = $row['fk_token_id'];
                $this->name = $row['name'];
                $this->deviceId = $row['device_id'];
                $this->isEnabled = $row['is_enabled'];
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
            $statement = $this->db->prepare("INSERT INTO `spark_device` (`fk_token_id`, `name`, `device_id`, `is_enabled`) VALUES (:token, :name, :deviceid, :isenabled) ON DUPLICATE KEY UPDATE `fk_token_id` = :token, `name` = :name, `device_id` = :deviceid, `is_enabled` = :isenabled");
            $statement->execute(array(':token' => $this->fkTokenId, ':name' => $this->name, ':deviceid' => $this->deviceId, ':isenabled' => $this->isEnabled));
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
    
    function getFkTokenId() {
        return $this->fkTokenId;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getDeviceId() {
        return $this->deviceId;
    }
    
    function getIsEnabled() {
        return $this->isEnabled;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setFkTokenId($fkTokenId) {
        $this->fkTokenId = $fkTokenId;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setDeviceId($deviceId) {
        $this->deviceId = $deviceId;
    }
    
    function setIsEnabled($isEnabled) {
        $this->isEnabled = $isEnabled;
    }
    
}