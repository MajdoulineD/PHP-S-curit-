<?php
    define("SERVEUR","Localhost");
    define("NOM","root");
    define("PASS","");
    define("DATABASE","resultatcourse");
    class gestion_BD {
        private $bd;
        public function __construct(){
            try{
                $this->bd = new PDO("mysql:host=".SERVEUR.";dbname=".DATABASE.";charset=utf8", NOM, PASS);
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
                //session_start();
            }catch(PDOException $e){
                exit("Probleme de la connexion à la base donnée ");
            }
        }
        public function getConnexion(){
            return $this->bd;
        }
        public function __destruct(){
            $this->bd =  null;
            //session_destroy();
        }
    }
    
?>
