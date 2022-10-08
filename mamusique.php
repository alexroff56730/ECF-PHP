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
        <form method="post" class="add" style="background-color: rgba(0,0,0,0.5); border-radius: 10px;" enctype="multipart/form-data">
            <label for="add">Fichier</label>
            <input type="file" name="add" class="btn btn-secondary">
            <input type="submit" name="sub" class="btn btn-success" value="Ajouter">
        </form>

        <div class="add" style="background-color: rgba(0,0,0,0.5); border-radius: 10px; margin-top: 10px;">
            <audio style="width: 100%; background-color: transparent;" controls id="music">
                <?php 
                    $sql = "SELECT * FROM musique WHERE PseudoUser = '{$_SESSION["utilisateur"]}' ORDER BY id DESC";

                    if($stmt = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($stmt) > 0) {
                            
                            while ($ligne = mysqli_fetch_array($stmt)) {?>
                                <source src=<?php
                                    echo $ligne['chemin'];
                                ?>
                                >
                                <?php
                            }
    
                            mysqli_free_result($stmt);
                        }
                    }
                ?>
            </audio>
        </div>

        
            <?php
                $sql = "SELECT * FROM musique WHERE PseudoUser = '{$_SESSION["utilisateur"]}' ORDER BY id DESC";

                if($stmt = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($stmt) > 0) {
                        
                        while ($ligne = mysqli_fetch_array($stmt)) {?>
                            <div class="add" style="background-color: rgba(0,0,0,0.5); border-radius: 10px; margin-top: 10px;">
                            <?php
                                echo $ligne['Nom'];
                                $path = $ligne['chemin'];
                            ?>
                                <input type="button" class="btn btn-dark" value="Lire" onclick="Play('<?= $path; ?>')">
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
            <script>
                function Play(musique) {
                    document.getElementById('music').src=musique;
                }
            </script>
    </div>

<?php
    include("footer.php");
?>