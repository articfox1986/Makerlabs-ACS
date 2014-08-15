<?php
/**
 * Description of AccessLog
 *
 * @author devin
 */
class AccessLog {

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
            $statement = $this->db->prepare("SELECT * FROM `access_log` WHERE id = :id LIMIT 1");
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
            $statement = $this->db->prepare("INSERT INTO `access_log` (`description`, `user_id`, `date`) VALUES (:description, :user_id, :date)");
            $statement->execute(array(':description' => $this->description, ':user_id' => $this->userId, ':date' => $this->date));
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
    
    function getDescription() {
        return $this->description;
    }
    
    function getUserId() {
        return $this->userId;
    }
    
    function getDate() {
        return $this->date;
    }
    
    function setDescription($description) {
        $this->description = $description;
    }
    
    function setUserId($userId) {
        $this->userId = $userId;
    }
    
    function setDate($date) {
        $this->date = $date;
    }
}