<?php
require '../config/db.php';

class CreateTable {
    private $db;

    public function __construct(Connexion $db) {
        $this->db = $db;
    }
    
    public function createUsersTable() {
        
        $connexion = $this->db->getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            username VARCHAR(128) NOT NULL,
            email VARCHAR(256) NOT NULL,
            password VARCHAR(256) NOT NULL)";

        if (mysqli_query($connexion, $sql)) {
            echo '<br> La table users a été créée avec succès ! </br>';
        } else {
            mysqli_error($connexion, $sql);
        }

    }

    
}

// Usage
$tableCreator = new CreateTable($db);

$tableCreator->createUsersTable();

?>
