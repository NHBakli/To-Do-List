<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <title>Login</title>
</head>
<body>
    
    <main>
        <h1>Connexion</h1>

        <form action="" method="post">

            <div class="container_input">
                <input type="email" name="email" placeholder="Votre email">
                <input type="password" name="password" placeholder="Mot de passe">
            </div>

            <div class="container_button">
                <input type="submit" value="Se connecter">
            </div>
        </form>

        <div class="container_line">
            <p>ou</p>
        </div>

        <div class="container_button">
            <button type="submit"><a href="./create_account">Créer un compte</a></button>
        </div>
    </main>

</body>
</html>