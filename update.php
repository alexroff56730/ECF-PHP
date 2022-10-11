<?php 
    include("header.php");

    if (!isset($_SESSION["loggedin"])) {
        header("Location: connexion.php");
    }

    if(isset($_POST['up'])) {
        $nameofmusic = htmlspecialchars($_POST['name']);
        if(!empty($nameofmusic)) {
            $sql = "UPDATE musique SET Nom = ? WHERE PseudoUser = ?";

            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $NomChange, $pseudoChange);

                $NomChange = $nameofmusic;
                $pseudoChange = $_SESSION['utilisateur'];

                mysqli_stmt_execute($stmt);

                header("Location: mamusique.php");
            }
        }
    }
?>

<div class="header-add-new">

<form method="post" class="add" style="background-color: rgba(0,0,0,0.5); border-radius: 10px;">
<?php
    $sql = "SELECT * FROM musique WHERE PseudoUser = '{$_SESSION["utilisateur"]}' ORDER BY id DESC";

    if($stmt = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($stmt) > 0) {
                        
            while ($ligne = mysqli_fetch_array($stmt)) {
                $Nom = $ligne['Nom'];
            }

            mysqli_free_result($stmt);
        }
    }
?>

<label for="name">changer le nom</label>
<input type="text" name="name" value=<?= $Nom; ?> id="">
<input type="submit" class="btn btn-success" name="up" value="changer">
</form>
</div>

<?php 
    include("footer.php");
?>