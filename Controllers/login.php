<?php
include_once('../Model/login.php');
include_once('../config/db.php');

function loginpage() {
	require('../View/login.php');
}

class LoginController{
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login(){

        $login = new LoginModel($this->db);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = isset($_POST['action']) ? $_POST['action'] : '';

            switch ($action) {
                case 'login':
                    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                    $password = $_POST['password'];
                    $login->validLogin($email, $password);
                    break;

                default:
                    break;
            }
        }
    }
}

$controller = new LoginController($db);

if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
    $action = $_GET['action'];
    $controller->$action();
}
?>
