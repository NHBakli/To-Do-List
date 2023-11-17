<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/register.css">
    <title>Register</title>
</head>
<body>

    <?php include('layout/header.php'); ?>  
    
    <main>
    <form action="../Controllers/register?action=register" method="post">
    <input type="hidden" name="action" value="register">
        <h1>Register</h1>

            <div class="container_input">
                <input type="text" name="username" placeholder="Pseudo" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="container_button">
                <button type="submit"><a href="index?page=home">Annuler</a></button>
                <input type="submit" value="Valider">
            </div>
        </form>

    </main>
</body>
</html>