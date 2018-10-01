<?php
    header('Content-type: text/html; charset=UTF-8');
    date_default_timezone_set('UTC');
    include("../Model/Execrequette.php");
    $connexion = new Execrequette();
    session_start();
	if(!isset($_SESSION["user"]) || $_SESSION["PROFIL"] != "commissaire"){
        session_destroy();
        header('Location: /PHP Sécurité/MeetingAthletisme');
    }
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
		<p>Soyez le bienvenue Commissaire <?php echo $_SESSION["user"]["PRENOM"]." ".$_SESSION["user"]["NOM"]." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ". date('l F Y');  ;?></p>
        <h3>Resultat de la Course : <?php echo $_SESSION["course"]?></h3>
        <div>
		<table id="r">
                <tr><th>Nom</th><th>Prenom</th><th>Place</th><th>Time</th></tr>
                <?php
                    $i = 0;
                    $sizeResultats = count($resultats);
                    while($i<$sizeResultats){
                        echo "
                            <tr>
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
		<?php if($_SESSION["PROFIL"]=="commissaire"){
			?>
		<h3>Formulaire de l'insertion d'un resultat dans la course <?php echo $_SESSION["course"]?></h3>
		<form method="post" action="ResultatCommissaire.php">
        <div>
		<div class="label">
            <label>Dossard : </label><br>
        </div>
        <div class="input">
            <input type="text" name="dossard" required/><br>
        </div
		</div>
		<div>
		<div class="label">
            <label>Place : </label><br>
        </div>
        <div class="input">
            <input type="text" name="place" required/><br>
        </div>
		</div>
		<div>
		<div class="label">
            <label>Temps : </label><br>
        </div>
        <div class="input">
            <input type="text" name="temps" required/><br>
        </div>
		</div>
		<input type="hidden" name="course" value="<?php echo $_SESSION["course"]?>" required/><br>
        <div class="submit" id="ref">
            <input type="submit" value="Valider"/>
        </div>
        </form>
		<?php
		}
		?>
		<div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/commissaire.php">Return au page Commissaire</a></p>
        </div>
        <div>
            <p><a href="/PHP Sécurité/MeetingAthletisme/ResultatCommissaire.php?action=Deco">Déconnecter</a></p>
        </div>		
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
		<script src="../Public/JS/jquery.min.js"></script>
        <script>
            $(function() {
            	$('#ref').click(function() {
					var param = 'l=' + $('#ref').val();
            		$('#r').load('ResultatCommissaire.php #r',param);
            	});  
            });
        </script>
</div>
    </body>
</html>
