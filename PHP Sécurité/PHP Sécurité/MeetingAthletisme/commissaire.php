<?php
    header('Content-type: text/html; charset=UTF-8');    
    include_once("../Model/Execrequette.php");
    session_start();
	$connexion = new Execrequette();
    if(!isset($_SESSION["user"]) || $_SESSION["PROFIL"] != "commissaire"){
        session_destroy();
        header('Location: /DS2_AnasBellaghzilia_2016_2017/MeetingAthletisme');
    }
    $PHP Sécurité = $connexion->ExtractCourseCommissaire($_SESSION["user"]["USER"]);
    if(count($PHP Sécurité) != 0){
	if(isset($_GET["l"])){
        $participants = $connexion->ExtractParticipantCourse($_GET["l"]);
    }else{
        $participants = $connexion->ExtractParticipantCourse($PHP Sécurité[0]['COURSE']);
    }
	}
    if(isset($_GET["action"])){
        session_destroy();
		header('Location: /DS2/DS_2013_2014/View');
    }
	if(isset($_POST["course"])){
		$_SESSION["course"] = $_POST["course"];
		header('Location: /DS2_AnasBellaghzilia_2016_2017/MeetingAthletisme/ResultatCommissaire.php');
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
        <p>Soyez le bienvenue Commissaire <?php echo $_SESSION["user"]["PRENOM"]." ".$_SESSION["user"]["NOM"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date('l F Y');  ;?></p>
        <form method="post" action="commissaire.php">
        <div class="label">
            <label>Compétences afféctées : </label><br>
        </div>
        <div class="input">
            <select name="course" class="in" id="ref">
                <?php
                    $sizePHP Sécurité = count($PHP Sécurité);
                    $i=0;
                    while($i<$sizePHP Sécurité){
                        echo "<option>".$PHP Sécurité[$i]['COURSE']."</option>";
                        $i++;
                    }
                ?>
            </select><br>
        </div>
        <table id="r">
                <tr><th>Dossard</th><th>Prénom</th><th>Nom</th><th>Date de naissance</th></tr>
                <?php
				if(isset($participants)){
                    $i = 0;
					$sizeParticipants = count($participants);
                    while($i<$sizeParticipants){
                        echo "<tr>
                            <td>".$participants[$i]["DOSSARD"]."</td>
                            <td>".$participants[$i]["PRENOM"]."</td>
                            <td>".$participants[$i]["NOM"]."</td>
                            <td>".$participants[$i]["DN"]."</td>
                            </tr>";
                        $i++;
                    }
				}
                ?>
        </table>
	    <div class="submit">
            <input type="submit" value="Resultat"/>
        </div>
		</form>
        <div>
            <p><a href="/DS2_AnasBellaghzilia_2016_2017/MeetingAthletisme/commissaire.php?action=Deco">Déconnecter</a></p>
        </div>
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
    <script src="../Public/JS/jquery.min.js"></script>
    <script>
		$(function() {
			$('#ref').click(function() {
				var param = 'l=' + $('#ref').val();
				$('#r').load('commissaire.php #r',param);
			});  
		});
    </script>
</div>
    </body>
</html>