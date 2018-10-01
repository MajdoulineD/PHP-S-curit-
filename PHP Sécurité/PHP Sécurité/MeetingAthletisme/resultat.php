<?php
    header('Content-type: text/html; charset=UTF-8');
    date_default_timezone_set('UTC');
    include("../Model/Execrequette.php");
    $connexion = new Execrequette();
    session_start();
	if(!isset($_SESSION["user"]) || $_SESSION["PROFIL"] != "admin"){
        session_destroy();
        header('Location: /PHP Sécurité/MeetingAthletisme/');
    }
    if(isset($_POST["dossard"])){
        $connexion->addResultat($_POST);
    }
    if(isset($_GET["l"])){
        $resultats = $connexion->ExtractCourseParJour($_GET["l"]);
    }else{
        $resultats = $connexion->ExtractCourseParJour("Samedi 25 Janvier");
    }
?>
<html>
    <head>
        <title>Systeme d'athletisme</title>
        <meta charset="utf-8"/>
        <link href="../Public/CSS/StyleCSS.css" rel="stylesheet"/>
        <style>
            .input{
                text-align: left;
            }
        </style>
    </head>
    <body>
<div class="container">    
        <h1>Systeme de l'athlétisme</h1>
		<p>Soyez le bienvenue Admin <?php echo $_SESSION["user"]["PRENOM"]." ".$_SESSION["user"]["NOM"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date('l F Y');  ;?></p>
        <div class="label">
            <label>Jour : </label><br>
        </div>
        <div class="input">
            <select class="in" id="ref">
                <option>Samedi 25 Janvier</option>
                <option>Dimanche 26 Janvier</option>
            </select><br>
        </div>
        <table id="r">
            <tr><th>ID</th><th>Titre Course</th><th>Heure</th><th>Resultat</th></tr>
                <?php
                    $i = 0;
                    $j = 1;
                    $sizeResultats = count($resultats);
                    while($i<$sizeResultats){
                        echo "
                            <tr>
                                <td>".$j."</td>
                                <td>".$resultats[$i]["TITRE"]."</td>
                                <td>".$resultats[$i]["HEURE"]."</td>
                                <td>
								<a style=\"color: black\" href=\"/PHP Sécurité/MeetingAthletisme/ResultatCompetition.php?course=".$resultats[$i]["TITRE"]."\"> >> Resultat </td>
                            </tr>";
                        $i++; $j++;
                    }
                ?>
        </table>
        <div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/admin.php">Retour au menu</a></p>
        </div>
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
		<script src="../Public/JS/jquery.min.js"></script>
		<script>
            $(function() {
            	$('#ref').click(function() {
                    var param = 'l=' + $('#ref').val();
            		$('#r').load('resultat.php #r',param);
            	});  
            });
        </script>
</div>
    </body>
</html>