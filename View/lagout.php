<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/lagout.css">
    <title>Déconnexion</title>
</head>
<body>

    <main>
        <form action="index?page=lagout&action=lagout" method="post">
            <h1>Déconnexion</h1>

            <p>Etes vous sur de vouloir vous déconnectez ?</p>

            <div class="container_button">

                <button type="submit"><a href="../PUBLIC/index">Annuler</a></button>

                <input type="hidden" name="action" value="lagout">
                <input type="submit" value="Valider">
            </form>
        </div>
    </main>


</body>
</html>