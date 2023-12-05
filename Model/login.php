<?php 

session_reset();
class LoginModel{

    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

    public function validLogin($email, $password) {
        
        $conn = $this->db->getConnection();
    
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $user['password'])) {
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
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }
    
}