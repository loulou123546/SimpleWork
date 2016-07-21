<?php
/**
* Class SWmysql
* class permettant l'utlisation de mysql plus simple
*/
class SWmysql{

    /**
    * @var object $conn contient la connexion a la base de donnees
    */
    protected $conn = null;

    /**
    * @var string|null $req contient la requete
    */
    protected $req = null;

    /**
    * @var string|null $res contient le resultat de la requete
    */
    protected $res = null;
    
    /**
    * @param string $host nom de l'hote mysql
    * @param string $bdd nom de la base de donnees
    * @param string $pseudo contient le nom d'utilisateur de la bdd
    * @param string $mdp mot de passe pour la bdd
    * @param string $charset contient le charset (utf8 par default)
    */
    public function __construct ($host = "localhost", $bdd = "", $pseudo = "root", $mdp = "", $charset = "utf8") {
        $this->conn = new PDO ('mysql:host='.$host.';dbname='.$bdd.';charset='.$charset.';', $pseudo, $mdp);
    }

    /**
    * @param string $requete requete mysql a executer
    * @return string|array|null|boolean resultat de la requete mysql
    */
    public function requete ($requete) {
        $this->req = $this->conn->query($requete);
        $this->res = $this->req->fetch();
        return $this->res;
    }

}

?>

<!--
/**
    * @param string $table nom de la/les tables
    * @param string|array|null $colone contient les colones, "*" pour tous
    * @param string|null $condition contient la / les conditions
    * @param string|null $orderby ASC ou DESC ou null
    * @return array|string|null retourne le resultat de la requete
    */
    public function SELECT ($table, $colone = "*", $condition = "", $orderby = "") {
        if(is_array($colone)) {
            $colone = implode(",", $colone);
        }
        $req = "SELECT " . $colone . " from " . $table;
        if($condition != ""){
            $req = $req . " WHERE " . $condition;
        }
        if($orderby != "") {
            $req = $req . " ORDER BY " . $orderby;
        }
        $this->req = $req . ";";

        // req defini, maintenant on l'envoi a mysql et on retourne

        $req2 = $conn->query($this->req);
        $res = $req2->fetch();
        return $res;
    }
-->