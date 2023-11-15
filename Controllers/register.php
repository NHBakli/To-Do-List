<?php

include_once('../Model/register.php');
include_once('../config/db.php');

function registerpage() {
	require('../View/register.php');
}

class RegisterController{
    
    private $db;


    public function __construct($db) {
        $this->db = $db;
    }

    public function register(){

        $register = new RegisterModel($this->db);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = isset($_POST['action']) ? $_POST['action'] : '';

            switch ($action) {
                case 'register':
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $register->createAccount($username, $email, $password);
                    break;
                // Ajoutez d'autres actions au besoin
                default:
                    // Action par défaut si aucune correspondance n'est trouvée
                    break;
            }
        }
    }
}
$controller = new RegisterController($db);

if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
    $action = $_GET['action'];
    $controller->$action();
}