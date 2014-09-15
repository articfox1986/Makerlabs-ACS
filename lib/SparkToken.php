<?php
/**
 * Description of SparkToken
 *
 * @author devin
 */
class SparkToken {

    private $db;
    private $id;
    private $token;
    private $expiryDate;
    private $isEnabled;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $token, $expiryDate, $isEnabled) {
        $this->id = $id;
        $this->token = $token;
        $this->expiryDate = $expiryDate;
        $this->isEnabled = $isEnabled;
    }
    
    function load($id) {
        $this->id = $id;
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_token` WHERE id = :id LIMIT 1");
            $statement->execute(array(':id' => $this->id));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->token = $row['token'];
                $this->expiryDate = $row['expiry_date'];
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

    function loadLatest() {
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_token` WHERE 1 ORDER BY expiry_date DESC LIMIT 1");
            $statement->execute(array(':id' => $this->id));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->token = $row['token'];
                $this->expiryDate = $row['expiry_date'];
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
            $statement = $this->db->prepare("INSERT INTO `spark_token` (`token`, `expiry_date`, `is_enabled`) VALUES (:token, :expirydate, :isenabled) ON DUPLICATE KEY UPDATE `token` = :token, `expiry_date` = :expirydate, `is_enabled` = :isenabled");
            $statement->execute(array(':token' => $this->token, ':expirydate' => $this->expiryDate, ':isenabled' => $this->isEnabled));
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
    
    function getToken() {
        return $this->token;
    }
    
    function getExpiryDate() {
        return $this->expiryDate;
    }
    
    function getIsEnabled() {
        return $this->isEnabled;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setToken($token) {
        $this->token = $token;
    }
    
    function setIsEnabled($isEnabled) {
        $this->isEnabled = $isEnabled;
    }
    
}