<?php 
    include("header.php");

    if (!isset($_SESSION["loggedin"])) {
        header("Location: connexion.php");
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