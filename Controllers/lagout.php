<?php

include_once('../Model/lagout.php');

function lagoutpage() {
    require('../View/lagout.php');
}

class LogoutController {
    
    public function lagout(){
        session_unset();
        header("Location: ../PUBLIC/index"); 
        exit();
    }

}

$lagoutController = new LogoutController;

if (isset($_GET['action']) && method_exists($lagoutController, $_GET['action'])) {
    $action = $_GET['action'];
    $lagoutController->$action();
}
