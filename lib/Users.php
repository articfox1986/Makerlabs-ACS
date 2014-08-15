<?php

/**
 * Description of User
 *
 * @author devin
 */
class Users {

    private $db;
    private $results = array();

    function __construct($db) {
        //parent::__construct();
        $this->db = $db;
    }

    function load($accessLevel) {

        try {
            $statement = $this->db->prepare("SELECT * FROM `user` WHERE access_level <= :accesslevel");
            $statement->execute(array(':accesslevel' => $accessLevel));
            while (($row = $statement->fetch()) != false) {
                $userObj = new User($this->db);
                $userObj->create($row['id'], $row['name'], $row['email'], $row['password'], $row['type'], $row['enable'], $row['date'], $row['access_level']);
                $this->results[] = $userObj;
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
            $statement = $this->db->prepare("SELECT * FROM `user` WHERE access_level <= :accesslevel");
            $statement->execute(array(':accesslevel' => $accessLevel));
            while (($row = $statement->fetch()) != false) {
                $user = array();
                $user['id'] = $row['id'];
                $user['name'] = $row['name'];
                $user['email'] = $row['email'];
                $user['password'] = $row['password'];
                $user['type'] = $row['type'];
                $user['enable'] = $row['enable'];
                $user['date'] = $row['date'];
                $user['accessLevel'] = $row['access_level'];
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
