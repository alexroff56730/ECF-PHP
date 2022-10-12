<?php 
    require_once("config/Conf.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body class="bg-dark text-white">
    <header class="entete">
        <div class="menu-resp">
            <div style="width: 20%;">
                <img style="width: 100%;" src="https://ar-web-ouest.fr/wp-content/uploads/2022/02/cropped-Logo-Alex.png" alt="">
            </div>
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <?php 
                    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                        echo $_SESSION['utilisateur'];
                    }            
                ?>
                <ul>
                    <li><a href="index.php">Acceuil</a></li>
                
                    <?php if (!isset($_SESSION["loggedin"])) :?>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="connexion.php">Connection</a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) :?>
                        <li><a href="mamusique.php">Playlist</a></li>
                        <li><a href="deconnexion.php">Deconnection</a></li>
                    <?php endif; ?>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>

            <a href="#" id="openBtn" class="btn btn-light text-dark">
                <span class="burger-icon">
                    ☰
                </span>
            </a>
        </div>
        <div class="logo-desk" style="width: 10%;">
            <img style="width: 100%;" src="https://ar-web-ouest.fr/wp-content/uploads/2022/02/cropped-Logo-Alex.png" alt="">
        </div>

        <ul class="menu-desk">
            <li><a href="index.php">Accueil</a></li>
            <?php if (!isset($_SESSION["loggedin"])) :?>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connection</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) :?>
                <li><a href="mamusique.php">Playlist</a></li>
                <li><a href="deconnexion.php">Deconnection</a></li>
            <?php endif; ?>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <script src="script/script.js"></script>
    </header>