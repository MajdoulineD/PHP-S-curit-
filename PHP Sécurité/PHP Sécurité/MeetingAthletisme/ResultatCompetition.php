<?php
    header('Content-type: text/html; charset=UTF-8');
    date_default_timezone_set('UTC');
    include("../Model/Execrequette.php");
    $connexion = new Execrequette();
    session_start();
    if(isset($_POST["dossard"])){
        $connexion->addResultat($_POST);
		header('Location: /PHP Sécurité/MeetingAthletisme/ResultatCommissaire.php');
    }
	if(isset($_GET["course"])){
		$_SESSION["course"]=$_GET["course"];
	}
	if(isset($_GET["action"])){
        session_destroy();
		header('Location: /PHP Sécurité/MeetingAthletisme');
    }
	$titlesCourses = $connexion->ExtractTitleCourse();
	if(isset($_GET["l"])){
		$_SESSION["course"]=$_GET["l"];
    }
	$record = $connexion->ExtractRecourdCourse($_SESSION["course"]);
    $resultats = $connexion->ExtractResultat($_SESSION["course"]);
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
        <div>
		<div class="label">
            <label>Competition : </label><br>
        </div>
        <div class="input">
            <select name="course" class="in" id="ref">
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
<div id="r">
		<h3>Resultat de la Course : <?php echo $_SESSION["course"]?></h3>
        <div>	
		<?php
			echo " RM : ". $record["RM"]." | RO : ". $record["RO"]." | RE : ". $record["RE"]." | RF : ". $record["RF"]."";
		?>
		</div>
		<table>
                <tr><th>Rang</th><th>Nom</th><th>Prenom</th><th>Place</th><th>Time</th></tr>
                <?php
                    $i = 0;
					$j = 0;
                    $sizeResultats = count($resultats);
                    while($i<$sizeResultats){
                        echo "
                            <tr>
								<td>".++$j."</td>
                                <td>".$resultats[$i]["NOM"]."</td>
                                <td>".$resultats[$i]["PRENOM"]."</td>
                                <td>".$resultats[$i]["PLACE"]."</td>
                                <td>".$resultats[$i]["TEMPS"]."</td>
                            </tr>";
                        $i++;
                    }
                ?>
        </table>
</div>
		<div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/resultat.php">Return au page</a></p>
        </div>
        <div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/ResultatCompetition.php?action=Deco">Déconnecter</a></p>
        </div>		
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
		<script src="../Public/JS/jquery.min.js"></script>
        <script>
            $(function() {
            	$('#ref').click(function() {
					var param = 'l=' + $('#ref').val();
            		$('#r').load('ResultatCompetition.php #r',param);
            	});  
            });
        </script>
</div>
    </body>
</html>
