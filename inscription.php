<?php 
    include("header.php");

    if(isset($_POST['sub'])) {
        $nom = trim(stripslashes(htmlspecialchars($_POST['name'])));
        $prenom = trim(stripslashes(htmlspecialchars($_POST['Fname'])));
        $email = trim(stripslashes(htmlspecialchars($_POST['mail'])));
        $pseudo = trim(stripslashes(htmlspecialchars($_POST['pseudo'])));
        $pass = trim(stripcslashes(htmlspecialchars(password_hash($_POST['pass'], PASSWORD_DEFAULT))));

        if(!empty($nom) && !empty($prenom) && !empty(filter_var($email, FILTER_VALIDATE_EMAIL)) && !empty($pseudo) && !empty($pass)) {
            $sql = "INSERT INTO user (Nom, Prenom, Mail, Pseudo, Mdp) VALUES (?, ?, ?, ?, ?)";

            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssss", $nomInsert, $prenomInsert, $emailInsert, $pseudoInsert, $passInsert);
                
                $nomInsert = $nom;
                $prenomInsert = $prenom;
                $emailInsert = $email;
                $pseudoInsert = $pseudo;
                $passInsert = $pass;

                mysqli_stmt_execute($stmt);

                echo 'donnée inserer avec succes.' . "<br>";
            } else {
                echo "ERREUR Impossible d'executer la requete $sql . " . mysqli_error($link);
            }
        } 
        
        header('Location: index.php');
    }
?>

    <form method="post" style="width: 50%; margin: 0 auto; margin-top: 10%; padding: 20px;">
        <h1>Inscription</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" name="name" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="Fname" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="Fname">
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Mail</label>
            <input type="email" class="form-control" name="mail">
        </div>
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" name="pseudo">
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="pass">
        </div>

        <input type="submit" class="btn btn-success" name="sub" value="Envoyer">
    </form>

<?php 
    include("footer.php");
?>