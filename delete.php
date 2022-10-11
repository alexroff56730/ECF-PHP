<?php 
    include("header.php");

    if (!isset($_SESSION["loggedin"])) {
        header("Location: connexion.php");
    }

    if(isset($_POST['Suppr'])) {

        $chemin = htmlspecialchars($_POST['DEL']);
        if(!empty($chemin)) {
            $sql = "DELETE FROM musique WHERE chemin = ?";

            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $cheminDel);

                $cheminDel = $chemin;

                mysqli_stmt_execute($stmt);

                if (file_exists($cheminDel)) {
                    unlink($cheminDel);
                }

                header("Location: mamusique.php");
            } else {
                echo "ERREUR Impossible d'executer la requete $sql . " . mysqli_error($link);
            }
        }
    }
?>

<div class="header-add-new">

    <form class="add" style="background-color: rgba(0,0,0,0.5); border-radius: 10px;" method="post">

        <label for="DEL">fichier</label>
        <select name="DEL" id="">
            <?php 
                $sql = "SELECT * FROM musique WHERE PseudoUser = '{$_SESSION["utilisateur"]}' ORDER BY id DESC";

                if($stmt = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($stmt) > 0) {
                        
                        while ($ligne = mysqli_fetch_array($stmt)) {?>
                            <option value=<?= $ligne['chemin']; ?>><?= $ligne['Nom']; ?></option>
                            <?php
                        }

                        mysqli_free_result($stmt);
                    }
                }
            ?>
        </select>

        <input class="btn btn-danger" name="Suppr" type="submit" value="Supprimer">

    </form>

</div>

<?php
    include("footer.php");
?>