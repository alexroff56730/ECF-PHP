<?php 
    include("header.php");
?>
    <div class="header-add-new">
        <h1>Tout les titres</h1>
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) :?>
            <div class="add2" style="flex-direction: column; background-color: rgba(0,0,0,0.5); border-radius: 10px; margin-top: 10px;">
                <p>Votre Profile</p>
                <?php
                    echo "Connecté en tant que : " . $_SESSION['utilisateur'];
                ?>
            </div>
        <?php endif; ?>
        <div class="add" style="background-color: rgba(0,0,0,0.5); border-radius: 10px; margin-top: 10px;">
            <audio style="width: 100%; background-color: transparent;" controls id="music">
                <source src="">
            </audio>
        </div>

        <?php 
        $sql = "SELECT * FROM musique";

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
    <script src="script/musique.js"></script>
    </div>

<?php 
    include("footer.php");
?>