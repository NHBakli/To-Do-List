<?php

include_once('../Model/lagout.php');

function lagoutpage() {
    require('../View/lagout.php');
}

class LogoutController {
    
    public function lagout() {
        $lagoutModel = new LagoutModel;
        $lagoutModel->lagout();
    }
}

$lagoutController = new LogoutController;

if (isset($_GET['action']) && method_exists($lagoutController, $_GET['action'])) {
    $action = $_GET['action'];
    $lagoutController->$action();
}
