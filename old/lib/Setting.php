<?php

/**
 * Description of Setting
 *
 * @author devin
 */
class Setting {

    private $db;
    private $id;
    private $name;
    private $value;

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }
    
    function create($id, $name, $value) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
    }
    
    function load($name) {
        $this->name = $name;

        try {
            $statement = $this->db->prepare("SELECT * FROM `setting` WHERE name = :name LIMIT 1");
            $statement->execute(array(':name' => $this->name));
            if (($row = $statement->fetch()) != false) {
                $this->id = $row['id'];
                $this->name = $row['name'];
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
            $statement = $this->db->prepare("INSERT INTO `setting` (`name`, `value`) VALUES (:name, :value) ON DUPLICATE KEY UPDATE `name` = :name, `value` = :value");
            $statement->execute(array(':name' => $this->name, ':value' => $this->value));
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
        $result['value'] = $this->value;
        return $result;
    }
    
    function getId() {
        return $this->id;
    }
    
    function getName() {
        return $this->name;
    }
    
    function getValue() {
        return $this->value;
    }
    
    function setName($name) {
        $this->name = $name;
    }
    
    function setValue($value) {
        $this->value = $value;
    }
    
}
