<?php

/**
 * Description of User
 *
 * @author devin
 */
class AccessLogs {

    private $db;
    private $results = array();

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

    function load($userId = 0) {
        if ($userId != 0) {
            $userSQL = "AND user_id = {$userId}";
        } else {
            $userSQL = '';
        }
        try {
            $statement = $this->db->query("SELECT * FROM `access_log` WHERE 1 {$userSQL}");
            while (($row = $statement->fetch()) != false) {
                $accessLogObj = new AccessLog($this->db);
                $accessLogObj->create($row['id'], $row['description'], $row['user_id'], $row['date']);
                $this->results[] = $accessLogObj;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

    function loadAsArray($accessLevel) {

        try {
            $statement = $this->db->query("SELECT `access_log`.id, `access_log`.description, `access_log`.user_id, name, `access_log`.date FROM `access_log`, `user` u WHERE user_id = u.id ORDER BY access_log.`date` DESC LIMIT 50");
            while (($row = $statement->fetch()) != false) {
                $user = array();
                $user['id'] = $row['id'];
                $user['description'] = $row['description'];
                $user['userId'] = $row['user_id'];
                $user['name'] = $row['name'];
                $user['date'] = date("Y-m-d H:i:s", $row['date']);
                $this->results[] = $user;
            }
            return $this->results;
        } catch (PDOException $e) {
            echo $e->getMessage();
            //ErrorLog::log($e->getMessage(), __DIR__, __CLASS__, __FUNCTION__, $this->code, $e->getLine());
            return false;
        }
    }

}
