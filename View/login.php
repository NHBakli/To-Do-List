<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <title>Login</title>
</head>
<body>

    <?php include('layout/header.php'); ?>
    
    <main>
        <form action="../Controllers/login?action=login" method="post">
        <input type="hidden" name="action" value="login">
            <h1>Connexion</h1>


            <div class="container_input">
                <input type="email" name="email" placeholder="Votre email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="container_button">
                <input type="submit" value="Se connecter">
            </div>
        </form>

        <div class="container_line">
            <p>ou</p>
        </div>

        <div class="container_button">
            <button type="submit"><a href="index?page=register">Créer un compte</a></button>
        </div>
    </main>

</body>
</html>