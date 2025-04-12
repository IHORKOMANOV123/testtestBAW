<?php
require_once __DIR__ . '/../models/Messages.class.php';

class LoginCtrl {
    private $username;
    private $password;
    private $msgs;

    public function __construct() {
        $this->msgs = new Messages();
        $this->username = "";
        $this->password = "";
    }

    public function getParams() {
        $this->username = $_POST['username'] ?? "";
        $this->password = $_POST['password'] ?? "";
    }

    public function validate() {
        if ($this->username === "") $this->msgs->add("Wprowadź login.");
        if ($this->password === "") $this->msgs->add("Wprowadź hasło.");
        return $this->msgs->isEmpty();
    }

    public function process() {
        if ($this->validate()) {
            if (($this->username === 'admin' && $this->password === 'admin') ||
                ($this->username === 'user' && $this->password === 'user')) {
                $_SESSION['logged_in'] = true;
                header("Location: calc.php");
                exit;
            } else {
                $this->msgs->add("Nieprawidłowy login lub hasło.");
            }
        }
    }

    public function display() {
        require_once __DIR__ . '/../lib/smarty/smarty.class.php';

        $smarty = new Smarty();
        $smarty->template_dir = __DIR__ . '/../templates/';
        $smarty->compile_dir  = __DIR__ . '/../templates_c/';
        $smarty->cache_dir    = __DIR__ . '/../cache/';
        $smarty->config_dir   = __DIR__ . '/../configs/';

        $smarty->assign('msgs', $this->msgs->getMessages());
        $smarty->assign('username', $this->username);
        $smarty->display('login.tpl');
    }
}
