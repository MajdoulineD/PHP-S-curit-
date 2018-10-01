<?php
    header('Content-type: text/html; charset=UTF-8');
    date_default_timezone_set('UTC');
    include_once("../Model/Execrequette.php");
    session_start();
    if(!isset($_SESSION["user"]) || $_SESSION["PROFIL"] != "admin"){
        session_destroy();
        header('Location: /PHP Sécurité/MeetingAthletisme');
    }
    if(isset($_GET["action"])){
        session_destroy(); header('Location: /PHP Sécurité/MeetingAthletisme');
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
<div class="container">
        <h1>Systeme de l'athlétisme</h1>
        <p>Soyez le bienvenue Admin <?php echo $_SESSION["user"]["PRENOM"]." ".$_SESSION["user"]["NOM"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date('l F Y');  ;?></p>
        <br>
        <div>
            <a href="/PHP Sécurité/MeetingAthletisme/ajouterCommissaire.php" class="button">Ajouter Commissaire</a>
            <a href="/PHP Sécurité/MeetingAthletisme/ajouterCourse.php" class="button">Ajouter Course</a>
        </div>
        <br>
        <br>
        <div>
            <a href="/PHP Sécurité/MeetingAthletisme/affectuerCourseCommissaire.php" class="button">Affecter une course à un commissaire</a>
        </div>
        <br>
        <br>
        <div>
            <a href="/PHP Sécurité/MeetingAthletisme/afficherCourse.php" class="button">Afficher Course</a>
            <a href="/PHP Sécurité/MeetingAthletisme/resultat.php" class="button">Resultat</a>
        </div>
        <div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/admin.php?action=Deco">Déconnecter</a></p>
        </div>
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
</div>
    </body>
</html>