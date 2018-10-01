<?php
    header('Content-type: text/html; charset=UTF-8');
    date_default_timezone_set('UTC');
    include_once("../Model/Execrequette.php");
    session_start();
    $_SESSION["message"] = null;
    if(!isset($_SESSION["user"]) || $_SESSION["PROFIL"] != "admin"){
        session_destroy();
        header('Location: /PHP Sécurité/MeetingAthletisme/');
    }
    if(isset($_POST["heure"])){
        $connexion = new Execrequette();
        $_SESSION["message"] = $connexion->addCourse($_POST);
        header('Location: /PHP Sécurité/MeetingAthletisme/ajouterCourse.php');
    }
?>
<html>
    <head>
        <title>Systeme d'athletisme</title>
        <meta charset="utf-8"/>
        <link href="../Public/CSS/StyleCSS.css" rel="stylesheet"/>
    </head>
    
    <body>
    <div>
        <h1>Systeme de l'athlétisme</h1>
        <p>Soyez le bienvenue Admin <?php echo $_SESSION["user"]["PRENOM"]." ".$_SESSION["user"]["NOM"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date('l F Y');  ;?></p>
        <h3>Formulaire de l'ajout d'une course</h3>
        <form method="post" action="ajouterCourse.php">
        <div>
        <div class="label">
            <label>Heure : </label><br>
        </div>
        <div class="input">
            <input type="time" class="in" name="heure" required/><br>
        </div>
        </div>
        <div>
        <div class="label">
            <label>Categorie : </label><br>
        </div>
        <div class="input">
            <input type="text" class="in" name="categorie" required/><br> 
        </div>
        </div>
        <div>
        <div class="label">
            <label>Jour : </label><br>
        </div>
        <div class="input">
            <select name="jour" class="in" >
                <option>Samedi 25 Janvier</option>
                <option>Dimanche 26 Janvier</option>
            </select><br>
        </div>
        </div>
        <div>
        <div class="label">
            <label>Type : </label><br>
        </div>
        <div class="input">
            <input type="radio" name="type" value="H"/> Homme   <input type="radio" name="type" value="F"/> Femme <br> 
        </div>
        </div>
        
        <div class="submit">
            <input type="submit" value="Ajouter"/>
        </div>
        <div class="submit">
            <?php
                if(isset($_SESSION["message"]))echo "<p>".$_SESSION["message"]."</p>";
            ?> 
        </div>
        </form>
        <div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/admin.php">Retour au menu</a></p>
        </div>
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
    </body>
    
</html>