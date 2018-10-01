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
    $course = $connexion->ExtractCourse();
    $titlesCourses = $connexion->ExtractTitleCourse();
    $tailleCourseH = count($course["courseH"]);
    $tailleCourseF = count($course["courseF"]);
    if(isset($_POST["dossard"])){
        $_SESSION["message"] = $connexion->addParticipant($_POST);
        header('Location: /PHP Sécurité/MeetingAthletisme/afficherCourse.php');
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
        <h3>La liste des courses </h3>
        <table>
                <tr><th colspan="3" >Hommme</th><th colspan="3">Femme</th></tr>
                <tr><th>Categorie</th><th>Jour</th><th>Heure</th><th>Categorie</th><th>Jour</th><th>Heure</th></tr>
                <?php
                    $i = 0;
                    $j = 0;
                    $k = 0;
                    while($k<2){
                        echo "<tr>";
                        if($i<$tailleCourseH){
                            echo "<td>".$course["courseH"][$i]["CATEGORIE"]."</td><td>".$course["courseH"][$i]["JOUR"]."</td><td>".$course["courseH"][$i]["HEURE"]."</td>";
                            $i++;
                        }else{
                            if($j<$tailleCourseF){
                                echo"<td class='vide'></td><td class='vide'></td><td class='vide'></td>";
                            }else{
                                $k++;
                            }
                        }
                        if($j<$tailleCourseF){
                            echo "<td>".$course["courseF"][$j]["CATEGORIE"]."</td><td>".$course["courseF"][$j]["JOUR"]."</td><td>".$course["courseF"][$j]["HEURE"]."</td>";
                            $j++;
                        }else{
                            if($i<$tailleCourseH){
                                echo"<td class='vide'></td><td class='vide'></td><td class='vide'></td>";
                            }else{
                                $k++;
                            }
                        }
                        echo "</tr>";
                    }
                ?>
        </table>
        <h3>Formulaire de l'ajout d'un participant</h3>
        <form method="post" action="afficherCourse.php">
        <div>
        <div class="label">
            <label>DOSSARD : </label><br>
        </div>
        <div class="input">
            <input type="number" min="0" class="in" name="dossard" required/><br>
        </div>
        </div>
        <div>
        <div class="label">
            <label>Courses : </label><br>
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
        <div>
        <div class="label">
            <label>Prenom : </label><br>
        </div>
        <div class="input">
            <input type="text" class="in" name="prenom" required/><br> 
        </div>
        </div>
        <div>
        <div class="label">
            <label>Nom : </label><br>
        </div>
        <div class="input">
            <input type="text" class="in" name="nom" required/><br> 
        </div>
        </div>
        <div>
        <div class="label">
            <label>Date de naissance : </label><br>
        </div>
        <div class="input">
            <input type="date" class="in" name="dn" required/><br> 
        </div>
        </div>        
        <div class="submit">
            <input type="submit" value="Ajouter"/>
        </div>
        </form>
        <div>
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