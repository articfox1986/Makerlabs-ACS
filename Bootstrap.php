<?php

/**
 * Description of Bootstrap
 *
 * @author devin
 */
class Bootstrap {

    var $smarty;
    var $db;
    var $userObj;

    public function __construct() {
        require ('./lib/Tools.php');
        require ('./lib/Database.php');
        require ('./lib/Session.php');
        require ('./lib/User.php');
        require ('./lib/AccessLog.php');
        $this->initTemplateEngine();
        $this->initDB();
    }

    public function initTemplateEngine() {
        require_once './lib/Smarty/libs/Smarty.class.php';
        $this->smarty = new Smarty();
        $template_folders = array('core' => './templates');
        $this->smarty->setTemplateDir($template_folders);
        $this->smarty->setCompileDir('./lib/Smarty/templates_c');
        $this->smarty->setCacheDir('./lib/Smarty/cache');
        //$smarty->force_compile = true;
        //$this->smarty->debugging = true;
        //$this->smarty->caching = true;
        //$this->smarty->cache_lifetime = 120;
    }

    public function initDB() {
        $this->db = new Database();
    }

    public function initSession() {
        Session::init();
        if (($id = Session::get('id')) == null) {
            header("Location: " . PATH . "login.php?noaccess");
            die();
        } else {
            $this->userObj = new User($this->db);
            $result = $this->userObj->load($id);
            if (!$result) {
                header("Location: " . PATH . "login.php?noaccess");
                die();
            }
        }
    }

}
