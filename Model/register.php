<?php
class RegisterModel {

    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

    public function createAccount($username, $email, $password) {

        $conn = $this->db->getConnection();

        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("Tous les champs doivent être remplis.");
        }

        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            header("Location: ../PUBLIC/index");
            exit();
        } else {
            // Échec, gérer l'erreur (lancer une exception, retourner un message d'erreur, etc.)
            throw new Exception("Erreur lors de la création du compte.");
        }
    }
}

