<?php

/**
 * Description of Settings
 *
 * @author devin
 */
class Settings {

    private $db;
    private $results = array();

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

    function load() {

        try {
            $statement = $this->db->query("SELECT * FROM `setting` WHERE 1");
            while (($row = $statement->fetch()) != false) {
                $settingObj = new Setting($this->db);
                $settingObj->create($row['id'], $row['name'], $row['value']);
                $this->results[] = $settingObj;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function loadAsArray() {

        try {
            $statement = $this->db->query("SELECT * FROM `setting` WHERE 1");
            while (($row = $statement->fetch()) != false) {
                $setting = array();
                $setting['id'] = $row['id'];
                $setting['name'] = $row['name'];
                $setting['value'] = $row['value'];
                $this->results[] = $setting;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

}
