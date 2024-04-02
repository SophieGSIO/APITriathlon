<?php
class TriathlonDAO {
    private $login="root";
    private $mdp="";
    private $bdd="triathlon";
    private $server="localhost";
    private $port="3306";	
    private $connexion = null;

    //constructeur : connexion à la base de données triathlon
    public function __construct(){
        try{
			$hote = "mysql:host=".$this->server.";dbname=".$this->bdd.";port=".$this->port;
            $this->connexion = new PDO($hote, $this->login, $this->mdp);
			$this->connexion->query('SET CHARACTER SET utf8');
        }catch(PDOException $e){
            throw new Exception('Connexion impossible');
        }
    }
	
	// fonction qui retourne tous les concurrents
	public function getAllConcurrents() {
        try {
            $requete = 'SELECT dossardC, nomC, genreC, categorieC from concurrent';
            $lignes = $this->connexion->query($requete)->fetchAll(PDO::FETCH_ASSOC);
            return $lignes;
        } catch (Exception $e) {
            throw new Exception("getAllConcurrents() " . $e->getMessage());
        }
    }
	
	// fonction qui permet de modifier un concurrent
	public function updateConcurrent($dossard, $natation, $cyclisme, $course) {
        try {
            $requete = 'UPDATE concurrent set natationC=:perfNatation, cyclismeC=:perfCyclisme, courseC=:perfCourse where dossardC=:numDossard';
            $prep = $this->connexion->prepare($requete);
            $prep->bindValue(':numDossard', $dossard, PDO::PARAM_STR);
            $prep->bindValue(':perfNatation', $natation, PDO::PARAM_STR);
            $prep->bindValue(':perfCyclisme', $cyclisme, PDO::PARAM_STR);
            $prep->bindValue(':perfCourse', $course, PDO::PARAM_STR);
            $ok = $prep->execute();
            return $prep->rowCount();
        } catch (Exception $e) {
            throw new Exception("updateConcurrent() " .$e->getMessage());
        }
    }
}
?>
