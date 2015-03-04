<?php

/**
 * Description of User
 *
 * @author devin
 */
class Tags {

    private $db;
    private $results = array();

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

    function load() {

        try {
            $statement = $this->db->prepare("SELECT * FROM `spark_tag`");
            $statement->execute(array());
            while (($row = $statement->fetch()) != false) {
                $tagObj = new Tag($this->db);
                $tagObj->create($row['id'], $row['tag'], $row['name'], $row['enabled'], $row['user_id']);
                $this->results[] = $tagObj;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function loadAsArray($type = 'all') {

        try {
            switch ($type)
            {
                case 'unused':
                    $typeSql = 'user_id IS NULL';
                default:
                    $typeSql = '1';
            }
            $statement = $this->db->prepare("SELECT * FROM `spark_tag` WHERE {$typeSql}");
            $statement->execute(array());
            while (($row = $statement->fetch()) != false) {
                $tag = array();
                $tag['id'] = $row['id'];
                $tag['tag'] = $row['tag'];
                $tag['name'] = $row['name'];
                $tag['enabled'] = $row['enabled'];
                $tag['userId'] = $row['user_id'];
                $this->results[] = $tag;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

}
