<?php 
    include("header.php");

// On vérifie si l'utilisateur est déjà connecté, si oui, on le redigie vers la page d'accueil.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit();
}

$utilisateur = $motdepasse = "";
$utilisateur_err = $motdepasse_err = $login_err = "";

// On vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // On vérifie si utilisateur est vide
    if (empty(trim($_POST["pseudo"]))) {
        $utilisateur_err = "Veuillez rentrer votre pseudo.";
    } else {
        $utilisateur = trim($_POST["pseudo"]);
    }

    // On vérifie le mot de passe est vide
    if (empty(trim($_POST["pass"]))) {
        $motdepasse_err = "Veuillez rentrer votre mot de passe.";
    } else {
        $motdepasse = trim($_POST["pass"]);
    }

    // Validation des credentials
    if (empty($utilisateur_err && empty($motdepasse_err))) {
        // Préparation de la requête de sélection
        $sql = "SELECT id, Pseudo, Mdp FROM user WHERE Pseudo = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Liaison des variables de la requête preparée au paramètre.
            mysqli_stmt_bind_param($stmt, "s", $param_utilisateur);
            $param_utilisateur = $utilisateur;

            // Exécution de la requête
            if (mysqli_stmt_execute($stmt)) {
                // Stockage des résultats
                mysqli_stmt_store_result($stmt);

                // On vérifie si l'utilisateur selectionné existe
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // On recupère les données renvoyés par la requête
                    mysqli_stmt_bind_result($stmt, $id, $utilisateur, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        // On vérifie si le mot de passe saisi et celle recupère dans la base correspondent
                        if (password_verify($motdepasse, $hashed_password)) {
                            // Le mot de passe est correct, on commence une nouvelle session.
                            session_start();

                            // On stocker les données dans la variable session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["utilisateur"] = $utilisateur;
                            // Redirection vers la page bienvenue.php
                            header("location: index.php");
                        } else {
                            // Les mots de passe ne correspondent pas, on affiche un message.
                            $login_err = "Le pseudo ou le mot de passe est incorrect. <br/>";
                        }
                    }
                } else {
                    // L'utilisateur n'existe pas, on affiche un message générale
                    $login_err = "Le pseudo ou le mot de passe est incorrect. <br/>";
                }
            } else {
                echo "Oops! Quelque chose ne va pas. Merci de réessayer.";
            }
            // Fermeture du statement
            mysqli_stmt_close($stmt);
        }
    }
    // Fermeture de la connexion
    mysqli_close($link);
}
?>

    <form method="post" style="width: 50%; margin: 0 auto; margin-top: 10%; padding: 20px;">
        <h1>Connection</h1>
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="pass">
        </div>
        <input type="submit" class="btn btn-success" name="sub" value="Envoyer">
    </form>

<?php 
    include("footer.php")
?>