<?php

class Database extends PDO
{
	
	public function __construct($db_name=null,$db_user=null,$db_pass=null, $db_host=null, $db_type=null, $db_port=null)
	{
            $db_name = ($db_name == null ? API_DB_NAME:$db_name);
            $db_user = ($db_user == null ? API_DB_USER:$db_user);
            $db_pass = ($db_pass == null ? API_DB_PASS:$db_pass);
            $db_host = ($db_host == null ? API_DB_HOST:$db_host);
            $db_type = ($db_type == null ? API_DB_TYPE:$db_type);
            $db_port = ($db_port == null ? API_DB_PORT:$db_port);
            try {
                parent::__construct($db_type.':dbname='.$db_name.';host='.$db_host.';port='.$db_port, $db_user, $db_pass);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
		//$this->setAttribute(PDO::ATTR_TIMEOUT, 10);
		//$this->setAttribute(PDO::ATTR_PERSISTENT, true);
            } catch (PDOException $e)
            {
                //echo $e->getMessage();
            }
	}
	
	
}
