<?php
require '../config/db.php';

class CreateTable {
    private $db;

    public function __construct(Connexion $db) {
        $this->db = $db;
    }
    
    public function createUsersTable() {
        
        $connexion = $this->db->getConnection();

        try{
            $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                username VARCHAR(128) NOT NULL,
                email VARCHAR(256) NOT NULL,
                password VARCHAR(256) NOT NULL)";

            $stmt = $connexion->prepare($sql);

            if ($stmt->execute()){
                echo '<br> La table users a été créée avec succès ! </br>';
            }
        }
        catch(PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }

    }

    public function createlistTable() {
        
        $connexion = $this->db->getConnection();

        try{
            $sql = "CREATE TABLE IF NOT EXISTS list (
                id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                id_user INT(10) NOT NULL,
                title VARCHAR(255) NOT NULL)";

            $stmt = $connexion->prepare($sql);

            if ($stmt->execute()){
                echo '<br> La table users a été créée avec succès ! </br>';
            }
        }
        catch(PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
}

    public function createtasksTable() {
        
        $connexion = $this->db->getConnection();

        try{
            $sql = "CREATE TABLE IF NOT EXISTS task (
                id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                id_list INT(10) NOT NULL,
                description text NOT NULL,
                completed BOOLEAN NOT NULL DEFAULT 0)";

            $stmt = $connexion->prepare($sql);

            if ($stmt->execute()){
                echo '<br> La table users a été créée avec succès ! </br>';
            }
        } 
        catch(PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }

    }

    
}

// Usage
$tableCreator = new CreateTable($db);

$tableCreator->createtasksTable();

