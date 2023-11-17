<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/header.css">
    <title></title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <?php 
                    include_once("../Model/layout/header.php");
                    $header = new HeaderModel;
                    $header->content();
                ?>
            </ul>
        </nav>
    </header>
</body>
</html>