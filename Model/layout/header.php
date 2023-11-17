<?php 

class HeaderModel{
    

    public function content(){

        if (empty($_SESSION)) {
            echo '
                <div class="container_link">
                    <li><a href="index?page=home">Home</a></li>
                    <li><a href="index?page=login">Connexion</a></li>
                    <li><a href="index?page=register">Inscription</a></li>
                </div>
            ';
        } else {
            $username = isset($_SESSION["username"]) ? $_SESSION["username"] : '';
        
            echo '
                <div class="container_link">
                    <li><a href="index?page=home">Home</a></li>
                    <li><a href="index?page=lagout">Déconnexion</a></li>
                    <li><a class="name">' . $username . '</a></li>
                </div>
            ';
        }
    }
}