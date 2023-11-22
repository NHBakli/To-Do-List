<?php 

session_reset();
class LoginModel{

    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

    public function validLogin($email, $password){

        $conn = $this->db->getConnection();

        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $email;
                $_SESSION['id'] = $user['id'];
                header("Location: ../PUBLIC/index");
                exit();
            } else {
                $erreur = "Adresse Mail ou Mot de passe incorrect !";
            }
        } else {
            $erreur = "Adresse Mail ou Mot de passe incorrect !";
        }
    }
}