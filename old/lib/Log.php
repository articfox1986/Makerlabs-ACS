<?php
/**
 * Description of User
 *
 * @author devin
 */
class Log {

    private $db;
    private $id;
    private $description;
    private $userId;
    private $date;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $description, $userId, $date) {
        $this->id = $id;
        $this->description = $description;
        $this->userId = $userId;
        $this->date = $date;
    }
    
    function load($id) {
        $this->id = $id;

        try {
            $statement = $this->db->prepare("SELECT * FROM `log` WHERE id = :id LIMIT 1");
            $statement->execute(array(':id' => $this->id));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->description = $row['description'];
                $this->userId = $row['user_id'];
                $this->date = $row['date'];
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
            $statement = $this->db->prepare("INSERT INTO `log` (`description`, `user_id`, `date`) VALUES (:description, :userid, :date) ON DUPLICATE KEY UPDATE `description` = :description, `user_id` = :userid, `date` = :date");
            $statement->execute(array(':description' => $this->description, ':userid' => $this->userid, ':date' => $this->date));
            $this->id = $this->db->lastInsertId();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, 16, $e->getLine());
            return false;
        }
    }
    
    function asArray() {
        $result = array();
        $result['id'] = $this->id;
        $result['description'] = $this->name;
        $result['des'] = $this->email;
        $result['password'] = $this->password;
        $result['type'] = $this->type;
        $result['enable'] = $this->enable;
        $result['date'] = $this->date;
        return $result;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function getType() {
        return $this->type;
    }
    
    function getEnable() {
        return $this->enable;
    }
    
    function getDate() {
        return $this->date;
    }
    
    function getAccessLevel() {
        return $this->accessLevel;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setEmail($email) {
        $this->email = $email;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
    
    function setType($type) {
        $this->type = $type;
    }
    
    function setEnable($enable) {
        $this->enable = $enable;
    }
    
    function setDate($date) {
        $this->date = $date;
    }
    
    function setAccessLevel($accessLevel) {
        $this->accessLevel = $accessLevel;
    }
}