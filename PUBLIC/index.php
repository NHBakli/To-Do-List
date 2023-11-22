<?php 

session_start();

require_once('../Controllers/home.php');
require_once('../Controllers/login.php');
require_once('../Controllers/register.php');
require_once('../Controllers/list.php');
require_once('../Controllers/lagout.php');
require_once('../Controllers/layout/header.php');

include_once("../View/layout/header.php");


// Récupérez la valeur du paramètre "page" dans l'URL
$page = isset($_GET['page']) ? $_GET['page'] : '';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($page === '') {
    header("Location: index?page=home");
    exit();
}

switch ($page) {
    case 'login':
        loginpage();
        break;

    case 'lagout':
        lagoutpage();
        break;

    case 'home':
        homepage();
        break;

    case 'register':
        registerpage();
        break;

    case 'list':
        include_once("../Model/list.php");
        $listModel = new ListModel($db);

        if ($action === 'create') {
            $listModel->CreateDefaultList();
        }
        if(!empty($id)) {
            $listModel->listPageWithId();
        }
        if(!empty($id) && ($action === 'changetitle')){
            $listModel->changeTitleList();
        }
        break;

    default: 
        header("Location: index?page=home");
        exit();
}
