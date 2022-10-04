<?php 
    include("header.php");

    if (!isset($_SESSION["loggedin"])) {
        header("Location: connexion.php");
    }

    if(isset($_POST['sub'])) {
        echo 'submit' . "<br>";
    
        $maxSizeFile = 50000000;
        $validExt = array('.jpg', '.png', '.jpeg', '.gif', '.mp3');
    
        if($_FILES["add"]["error"] > 0) {
            echo "error file";
            die;
        }
    
        $fileSize = $_FILES['add']['size'];
        echo $fileSize . "<br>";
    
        if($fileSize > $maxSizeFile) {
            echo "fichier trop volumineux !!!";
            die;
        }
    
        $fileName = $_FILES['add']['name'];
        $fileExt = "." . strtolower(substr(strrchr($fileName, '.'), 1));
    
        if(!in_array($fileExt, $validExt)) {
            echo "le fichier n'est pas une image ! <br>";
            die;
        }
    
        $tmpName = $_FILES['add']['tmp_name'];
        
        if(!file_exists($_SESSION['utilisateur'])){
            mkdir($_SESSION['utilisateur']);    
        }
        
        $fileName = $_SESSION['utilisateur'] . "/" . htmlspecialchars($_FILES['add']['name']);
        $result = move_uploaded_file($tmpName, $fileName);
    
        $nom = trim(stripslashes(htmlspecialchars($_FILES['add']['name'])));
        $pseudo = $_SESSION['utilisateur'];
        $path = $fileName;
    
            if(!empty($nom) && !empty($pseudo) && !empty($path)) {
                $sql = "INSERT INTO musique (Nom, PseudoUser, chemin) VALUES (?, ?, ?)";
    
                if($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $nomInsert, $pseudoInsert, $pathInsert);
                    
                    $nomInsert = $nom;
                    $pseudoInsert = $pseudo;
                    $pathInsert = $path;
    
                    mysqli_stmt_execute($stmt);
    
                    echo 'donnée inserer avec succes.' . "<br>";
                } else {
                    echo "ERREUR Impossible d'executer la requete $sql . " . mysqli_error($link);
                }
            } 
            
            header('Location: mamusique.php');
    }
?>

    <div class="header-add-new">
        <form method="post" class="bg-danger add" enctype="multipart/form-data">
            <label for="add">Fichier</label>
            <input type="file" name="add" class="btn btn-dark">
            <input type="submit" name="sub" class="btn btn-success" value="Ajouter">
        </form>

        
            <?php
                $sql = "SELECT * FROM musique ORDER BY id DESC";

                if($stmt = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($stmt) > 0) {
                        while ($ligne = mysqli_fetch_array($stmt)) {?>
                            <div class="bg-danger add" style="margin-top: 10px;"><?php
                            echo $ligne['Nom'] . " ";
                            ?>
                            <audio controls src=<?= $ligne['chemin']; ?>></audio>
                            <?php
                            echo $ligne['PseudoUser'];
                            ?>
                            </div>
                            <?php
                        }

                        mysqli_free_result($stmt);
                    }
                }
            ?>
    </div>

<?php
    include("footer.php");
?>