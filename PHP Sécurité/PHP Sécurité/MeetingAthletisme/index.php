<?php
    header('Content-type: text/html; charset=UTF-8');    
    include_once("../Model/Execrequette.php");
    $connexion = new Execrequette();
    //$connexion->createTableElecteur();
    if(isset($_POST["user"])){
        session_start();
        $_SESSION = $connexion->Login($_POST);
    }
    //if(isset($_GET["messageLogin"])){
        //$messageLogin = $_GET["messageLogin"];
    //}    
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
        <p>Soyez le bienvenue</p>
        <h3>Formulaire de l'authentification</h3>
        <form method="post" action="index.php">
        <div class="label">
            <label>User : </label><br>
            <label>Mot de passe : </label><br>
        </div>
        <div class="input">
            <input type="text" name="user" required/>
            <input type="password" name="mdp" required/><br>
        </div>
        <div class="submit">
            <input type="submit" value="Se connecter"/>
        </div>
        <div class="submit">
            <?php
                //if(isset($_SESSION["user"]))echo "<p>$_SESSION['user']</p>";
            ?> 
        </div>
        </form>
        <div>
            <h4>Anas Bellaghzilia</h4>
        </div>
</div>
    </body>   
</html>