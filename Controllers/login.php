<?php

include_once('../Model/login.php');

class LoginController {
    private $model;

    public function __construct() {
        // Initialisez le modèle
        $this->model = new LoginModel();
    }

    public function processLogin($email, $password) {
        // Validez les informations d'identification à l'aide du modèle
        $isValid = $this->model->validateCredentials($email, $password);

        if ($isValid) {
            // Redirigez l'utilisateur vers la page de succès ou effectuez d'autres actions nécessaires
            header("Location: success.php");
            exit();
        } else {
            // Affichez un message d'erreur ou redirigez vers la page d'échec
            header("Location: error.php");
            exit();
        }
    }
}

?>
