<?php
/**
 * Description of Tag
 *
 * @author devin
 */
class Tag {

    private $db;
    private $id;
    private $tag;
    private $name;
	private $userId;
    private $enabled;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $tag, $name, $enabled, $userId = null) {
        $this->id = $id;
        $this->tag = $tag;
        $this->name = $name;
        $this->enabled = $enabled;
        $this->userId = $userId;
    }
    
    function load($id) {
        $this->id = $id;

        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_tag` WHERE id = :id LIMIT 1");
            $statement->execute(array(':id' => $this->id));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->tag = $row['tag'];
                $this->name = $row['name'];
				$this->userId = $row['user_id'];
                $this->enabled = $row['enabled'];
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
	
	function loadByTag($tag) {
        $this->tag = $tag;

        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_tag` WHERE tag = :tag LIMIT 1");
            $statement->execute(array(':tag' => $this->tag));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->tag = $row['tag'];
                $this->name = $row['name'];
				$this->userId = $row['user_id'];
                $this->enabled = $row['enabled'];
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
            $statement = $this->db->prepare("INSERT INTO `spark_tag` (`tag`, `name`, `user_id`, `enabled`) VALUES (:tag, :name, :userid, :enabled)");
            $statement->execute(array(':tag' => $this->tag, ':name' => $this->name, ':userid' => $this->userid, ':enabled' => $this->enabled));
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
        $result['name'] = $this->name;
        $result['tag'] = $this->tag;
        $result['userId'] = $this->userId;
        $result['enabled'] = $this->enabled;
        return $result;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getTag() {
        return $this->tag;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getUserId() {
        return $this->userId;
    }
    
    function getEnabled() {
        return $this->enabled;
    }
    
    function setTag($tag) {
        $this->tag = $tag;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setUserId($userId) {
        $this->userId = $userId;
    }
    
    function setEnabled($enabled) {
        $this->enabled = $enabled;
    }
}