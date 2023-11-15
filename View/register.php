<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/register.css">
    <title>Register</title>
</head>
<body>
    
    <main>
        <h1>Register</h1>

        <form action="../Controllers/register?action=register" method="post">
        <input type="hidden" name="action" value="register">

            <div class="container_input">
                <input type="text" name="username" placeholder="Pseudo">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Mot de passe">
            </div>

            <div class="container_button">
                <button type="submit"><a href="index?page=home">Annuler</a></button>
                <input type="submit" value="Valider">
            </div>
        </form>

    </main>
</body>
</html>