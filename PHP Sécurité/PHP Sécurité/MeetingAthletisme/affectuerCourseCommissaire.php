<?php
    header('Content-type: text/html; charset=UTF-8');
    date_default_timezone_set('UTC');
    include_once("../Model/Execrequette.php");
    session_start();
    $_SESSION["message"] = null;
    if(!isset($_SESSION["user"]) || $_SESSION["PROFIL"] != "admin"){
        session_destroy();
        header('Location: /PHP Sécurité/MeetingAthletisme/View/');
    }
    $connexion = new Execrequette();
    $titlesCourses = $connexion->ExtractTitleCourse();
    $commissaires = $connexion->ExtractUserCommissaire();
    if(isset($_POST["user"])){
        $_SESSION["message"] = $connexion->affecterCourseCommissaire($_POST);
        header('Location: /PHP Sécurité/MeetingAthletisme/affectuerCourseCommissaire.php');
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
        <h3>Formulaire de l'affectation d'une course à un commissaire</h3>
        <form method="post" action="affectuerCourseCommissaire.php">
        <div>
        <div class="label">
            <label>User : </label><br>
        </div>
        <div class="input">
            <select name="user" class="in" >
                <?php
                    $sizeCommissaires = count($commissaires);
                    $i=0;
                    while($i<$sizeCommissaires){
                        echo "<option>".$commissaires[$i]['USER']."</option>";
                        $i++;
                    }
                ?>
            </select><br>
        </div>
        </div>
        <div>
        <div class="label">
            <label>Course : </label><br>
        </div>
        <div class="input">
            <select name="course" class="in" >
                <?php
                    $sizeTitlesCourses = count($titlesCourses);
                    $i=0;
                    while($i<$sizeTitlesCourses){
                        echo "<option>".$titlesCourses[$i]['TITRE']."</option>";
                        $i++;
                    }
                ?>
            </select><br>
        </div>
        </div>        
        <div class="submit">
            <input type="submit" value="Affecter"/>
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
</div>
    </body>
</html>