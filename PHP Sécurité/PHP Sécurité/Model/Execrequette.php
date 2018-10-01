<?php
    include_once("gestion_BD.php");
    class Execrequette{
        private $connexion;
        public function __construct(){
            $this->connexion = new gestion_BD();
        }
        public function addCourse($tab){
            $cat = split(" ",htmlspecialchars($tab["categorie"]));
            $titre = $cat[0]."(".htmlspecialchars($tab["type"]).")";
            if(is_numeric($cat[0])){
                $categorie = htmlspecialchars($tab["categorie"])." metres";
            }else{
                $categorie = htmlspecialchars($tab["categorie"]);
            }
            $request = $this->connexion->getConnexion()->prepare("INSERT INTO course VALUES ('',:titre,:heure,:categorie,:jour,:type)");
            $request->execute(array(":titre"=>$titre,":heure"=>htmlspecialchars($tab["heure"]),":categorie"=>$categorie,":jour"=>htmlspecialchars($tab["jour"]),":type"=>htmlspecialchars($tab["type"])));
            $request->closeCursor();
            return "Course ajoutée";
        }
        public function addParticipant($tab){
            $request = $this->connexion->getConnexion()->prepare("INSERT INTO participant VALUES ('',:dossard,:course,:nom,:prenom,:dn)");
            $request->execute(array(":dossard"=>htmlspecialchars($tab["dossard"]),":course"=>htmlspecialchars($tab["course"]),":nom"=>htmlspecialchars($tab["nom"]),":prenom"=>htmlspecialchars($tab["prenom"]),":dn"=>htmlspecialchars($tab["dn"])));
            $request->closeCursor();
            return "Participant ". $tab['prenom']." ". $tab["nom"]. " ajouté";
        }
        public function addCommissaire($tab){
            $mdp = sha1(htmlspecialchars($tab["mdp"]));
            $request = $this->connexion->getConnexion()->prepare("INSERT INTO commissaire VALUES ('',:nom,:prenom,:user,:mdp,:mdps)");
            $request->execute(array(":nom"=>htmlspecialchars($tab["nom"]),":prenom"=>htmlspecialchars($tab["prenom"]),":user"=>htmlspecialchars($tab["user"]),":mdp"=>htmlspecialchars($tab["mdp"]),":mdps"=>$mdp));
            $request->closeCursor();
            return "Commissaire ajouté";
        }
        public function Login($tab){
            $mdps = sha1(htmlspecialchars($tab["mdp"]));
            $searchAdmin = $this->connexion->getConnexion()->prepare("SELECT * FROM admin WHERE (USER = :user AND MDPS = :mdps)");
            $searchAdmin->execute(array(":user"=>htmlspecialchars($tab["user"]),":mdps"=>$mdps));
            $searchCommissaire = $this->connexion->getConnexion()->prepare("SELECT * FROM commissaire WHERE (USER = :user AND MDPS = :mdps)");
            $searchCommissaire->execute(array(":user"=>htmlspecialchars($tab["user"]),":mdps"=>$mdps));
            $user = array();
            if($donnee = $searchAdmin->fetch(PDO::FETCH_ASSOC)){
                header('Location: /PHP Sécurité/MeetingAthletisme/admin.php');
                $user["user"] = $donnee;
                $user["PROFIL"] = "admin";
                return $user;
            }else if($donnee = $searchCommissaire->fetch(PDO::FETCH_ASSOC)){
                header('Location: /PHP Sécurité/MeetingAthletisme/commissaire.php');
                $user["user"] = $donnee;
                $user["PROFIL"] = "commissaire";
                return $user;
            }else{
                return "Veuillez s'inscrire";
                header('Location: /PHP Sécurité/MeetingAthletisme/index.php');
            }
        }
        public function ExtractCourse(){
            $requestTypeH = $this->connexion->getConnexion()->query("SELECT * FROM course WHERE TYPE = 'H'");
            $courseH = array();
            $id = 0;
            while($donnee = $requestTypeH->fetch(PDO::FETCH_ASSOC)){
                $courseH[$id] = $donnee;
                $id++;
            }
            $courseF = array();
            $requestTypeF = $this->connexion->getConnexion()->query("SELECT * FROM course WHERE TYPE = 'F'");
            $id = 0;
            while($donnee = $requestTypeF->fetch(PDO::FETCH_ASSOC)){
                $courseF[$id] = $donnee;
                $id++;
            }
            $course = array(
                "courseH" => $courseH,
                "courseF" => $courseF,
            );
            return $course;
        }
        public function ExtractTitleCourse(){
            $request = $this->connexion->getConnexion()->query("SELECT TITRE FROM course");
            $titlesCourses = array();
            $id = 0;
            while($donnee = $request->fetch(PDO::FETCH_ASSOC)){
                $titlesCourses[$id] = $donnee;
                $id++;
            }
            return $titlesCourses;
        }
        public function ExtractUserCommissaire(){
            $request = $this->connexion->getConnexion()->query("SELECT USER FROM commissaire");
            $commissaires = array();
            $id = 0;
            while($donnee = $request->fetch(PDO::FETCH_ASSOC)){
                $commissaires[$id] = $donnee;
                $id++;
            }
            return $commissaires;
        }
        public function affecterCourseCommissaire($tab){
            $request = $this->connexion->getConnexion()->prepare("INSERT INTO commissairecourse VALUES ('',:user,:course)");
            $request->execute(array(":user"=>htmlspecialchars($tab["user"]),":course"=>htmlspecialchars($tab["course"])));
            $request->closeCursor();
            return "Course ". $tab["course"] ." affectée à ". $tab["user"];
        }
        public function ExtractCourseCommissaire($user){
            $request = $this->connexion->getConnexion()->prepare("SELECT COURSE FROM commissairecourse WHERE (COMMISSAIRE = :user)");
            $request->execute(array(":user"=>htmlspecialchars($user)));
            $coursesCommissaire = array();
            $id = 0;
            while($donnee = $request->fetch(PDO::FETCH_ASSOC)){
                $coursesCommissaire[$id] = $donnee;
                $id++;
            }
            return $coursesCommissaire;
        }
        public function ExtractParticipantCourse($course){
            $request = $this->connexion->getConnexion()->prepare("SELECT DOSSARD, NOM, PRENOM, DN FROM participant WHERE (COURSE = :course)");
            $request->execute(array(":course"=>htmlspecialchars($course)));
            $participants = array();
            $id = 0;
            while($donnee = $request->fetch(PDO::FETCH_ASSOC)){
                $participants[$id] = $donnee;
                $id++;
            }
            return $participants;
        }
        public function addResultat($tab){
            $request = $this->connexion->getConnexion()->prepare("INSERT INTO resultat VALUES ('',:course,:dossard,:temps,:place)");
            $request->execute(array(":course"=>htmlspecialchars($tab["course"]),":dossard"=>htmlspecialchars($tab["dossard"]),":temps"=>htmlspecialchars($tab["temps"]),":place"=>htmlspecialchars($tab["place"])));
            $request->closeCursor();
        }
        public function ExtractResultat($course){
            $request = $this->connexion->getConnexion()->prepare("SELECT NOM, PRENOM, TEMPS, PLACE FROM resultat r, participant p WHERE ( p.DOSSARD = r.DOSSARD AND r.TITRE = :course ) ORDER BY r.TEMPS ASC");
            $request->execute(array(":course"=>$course));
            $resultat = array();
            $i = 0;
            while($donnee = $request->fetch(PDO::FETCH_ASSOC)){
                $resultat[$i] = $donnee;
                $i++;
            };
            $request->closeCursor();
            return $resultat;
        }
        public function ExtractCourseParJour($jour){
            $request = $this->connexion->getConnexion()->prepare("SELECT TITRE, HEURE FROM course WHERE (JOUR = :jour)");
            $request->execute(array(":jour"=>htmlspecialchars($jour)));
            $resultats = array();
            $id = 0;
            while($donnee = $request->fetch(PDO::FETCH_ASSOC)){
                $resultats[$id] = $donnee;
                $id++;
            }
            return $resultats;
        }
        Public function ExtractRecourdCourse($course){
            $request = $this->connexion->getConnexion()->prepare("SELECT RM,RO,RE,RF FROM RecordCourse WHERE (COURSE = :course)");
            $request->execute(array(":course"=>htmlspecialchars($course)));
            $donnee = $request->fetch(PDO::FETCH_ASSOC);
            return $donnee;
        }
    }
?>