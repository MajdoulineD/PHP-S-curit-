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
    $connexion = new Execrequette();
    $titlesCourses = $connexion->ExtractTitleCourse();
    if(isset($_POST["user"])){
        $_SESSION["message"] = $connexion->addCommissaire($_POST);
        header('Location: /PHP Sécurité/MeetingAthletisme/ajouterCommissaire.php');
    }
?>
<html>
    <head>
        <title>Systeme d'athletisme</title>
        <meta charset="utf-8"/>
        <link href="../Public/CSS/StyleCSS.css" rel="stylesheet"/>
    </head>
    <body>
<div class="container">
        <h1>Systeme de l'athlétisme</h1>
        <p>Soyez le bienvenue Admin <?php echo $_SESSION["user"]["PRENOM"]." ".$_SESSION["user"]["NOM"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date('l F Y');  ;?></p>
        <h3>Formulaire de l'ajout d'un commissaire</h3>
        <form method="post" action="ajouterCommissaire.php">
        <div><div class="label">
            <label>User : </label><br>
        </div>
        <div class="input">
            <input type="text" class="in" name="user" required/><br>
        </div>
        </div>
        <div>
        <div class="label">
            <label>Mot de passe : </label><br>
        </div>
        <div class="input">
            <input type="password" class="in" name="mdp" required/><br> 
        </div>
        </div>        
           <div><div class="label">
            <label>Nom : </label><br>
        </div>
        <div class="input">
            <input type="text" class="in" name="nom" required/><br>
        </div>
        </div>
        <div>
        <div class="label">
            <label>Prenom : </label><br>
        </div>
        <div class="input">
            <input type="text" class="in" name="prenom" required/><br> 
        </div>
        </div>        
        <div class="submit">
            <input type="submit" value="Ajouter"/>
        </div>
        </form>
        <div class="submit">
            <?php
                if(isset($_SESSION["message"]))echo "<p>".$_SESSION["message"]."</p>";
            ?> 
        </div>
        <div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/admin.php">Retour au menu</a></p>
        </div>
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
</div>
    </body>
</html>