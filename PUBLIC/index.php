<?php 

require_once('../Controllers/home.php');
require_once('../Controllers/login.php');
require_once('../Controllers/register.php');


// Récupérez la valeur du paramètre "page" dans l'URL
$page = isset($_GET['page']) ? $_GET['page'] : '';

if ($page === '') {
    header("Location: index?page=home");
    exit();
}

switch ($page) {
    case 'login':
        loginpage();
        break;

    case 'home':
        homepage();
        break;

    case 'register':
        registerpage();
        break;

    default:
        header("Location: index?page=home");
        exit();
}
