<?php 
    include("header.php");
    require_once("speed-mail/Info.php");

    if(isset($_POST['sub'])) {
        if(!empty($_POST['name']) && !empty($_POST['Fname']) && !empty($_POST['Subject']) && !empty($_POST['email']) && !empty($_POST['MSG'])) {
            SpeedMail("name", "Fname", "Subject", "email", "MSG");
        }
    }

    
?>
<div class="header-add-new">

    <form method="post" class="new-form" style="background-color: rgba(0,0,0,0.5); border-radius: 10px; margin-top: 10px;">
        <div class="flexBox">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="flexBox">
            <div class="mb-3">
                <label for="Fname" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="Fname" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Sujet</label>
                <input type="text" class="form-control" name="Subject">
            </div>
        </div>
        <div style="margin: 10px;" class="flexBox">
            <div class="flexBox2">
                <label for="MSG">Message</label>
                <textarea name="MSG" class="form-control" placeholder="Message" style="height: 100px"></textarea>
            </div>
        </div>
        <div class="flexBox" style="align-items: flex-end;">
            <input type="submit" class="btn btn-success" name="sub" value="Envoyer">
        </div>
        
    </form>

</div>
<?php 
    include("footer.php");
?>