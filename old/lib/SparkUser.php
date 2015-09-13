<?php

/**
 * Description of SparkUser
 *
 * @author devin
 */
class SparkUser {
 
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
    
    function create($id, $username, $password) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }
    
    function load($id) {
        $this->id = $id;
        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_user` WHERE id = :id LIMIT 1");
            $statement->execute(array(':id' => $this->id));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->password = $row['password'];
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

    function loadFirst() {
        try {
            $statement = $this->db->query("SELECT * FROM `spark_user` WHERE 1 LIMIT 1");
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->username = $row['username'];
                $this->password = $row['password'];
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
            $statement = $this->db->prepare("INSERT INTO `spark_user` (`username`, `password`) VALUES (:username, :password) ON DUPLICATE KEY UPDATE `username` = :username, `password` = :password");
            $statement->execute(array(':username' => $this->username, ':password' => $this->password));
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
    
    function getUsername() {
        return $this->username;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setUsername($username) {
        $this->username = $username;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
    
}