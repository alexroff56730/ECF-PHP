<?php 
    include("header.php");

    if (!isset($_SESSION["loggedin"])) {
        header("Location: connexion.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Le formulaire a été soumis <br />";
        // Affichage des informations

        echo "<br/>";

        $nom_fichier = $_FILES["myFile"]["name"];
        $type_fichier = $_FILES["myFile"]["type"];
        $taille_fichier = $_FILES["myFile"]["size"];
        $tmp_fichier = $_FILES["myFile"]["tmp_name"];
        $error_fichier = $_FILES["myFile"]["error"];

        // Vérification de l'extension du fichier
        $extension_autorises = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

        // La fonction "pathinfo" retourne des informations sur un chemin système
        // On cherche a recupérer que l'extension de l'image en question
        $extension_fichier = pathinfo($nom_fichier, PATHINFO_EXTENSION);

        // On vérifie si l'extension (le key precisément) recupéré du fichier n'existe pas dans le tableau 
        // des extensions autorisés
        if (!array_key_exists($extension_fichier, $extension_autorises)) {
            echo "Error : Merci de selectionner le bon format de fichier <br/>";
        }

        // On vérifie si le name attribut "photo" existe et qu'il n'y a pas d'erreur lors de l'uploading
        if (isset($_FILES["myFile"]) && $_FILES["myFile"]["error"] == 0) {
            // Je vérifie si l'extension du fichier fait partie des extensions autorisés
            if (in_array($type_fichier, $extension_autorises)) {
                // Je verifie aussi si le fichier existe dans le serveur, sinon je le crée un dossier 
                // Pour enregistrer le fichier que je vais upload
                if (file_exists("upload/" . $nom_fichier)) {
                    echo "Le fichier existes.<br/>";
                } else {
                    move_uploaded_file($tmp_fichier, "upload/" . $nom_fichier);
                    echo "Votre fichier a été uploadé correctement.<br/>";
                }
            }
        }
    }

    
    
?>

    <div class="header-add-new">
        <form method="post" class="bg-danger add">
            <label for="add">Fichier</label>
            <input type="file" name="myFile" class="btn btn-dark">
            <input type="submit" name="sub" class="btn btn-success" value="Ajouter">
        </form>

        <div class="bg-danger add" style="margin-top: 10px;">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
        </div>
    </div>

<?php 
    include("footer.php");
?>