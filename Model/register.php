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
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        try {
            $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :hashedPassword)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                header("Location: ../PUBLIC/index");
                exit();
            } else {
                throw new Exception("Erreur lors de la création du compte.");
            }
        } catch (PDOException $e) {
            throw new Exception("PDOException: " . $e->getMessage());
        }
    }
    
}



