<?php
/*
	For contact us : contact@simple-work.tk
	
	Official website : http://www.simple-work.tk
	GitHub project : https://github.com/Simple-Work/SimpleWork
	
	This is an open source project, license is here : https://www.mozilla.org/en-US/MPL/2.0/


	This code is part of "simplework"

	You can find exemple, documentation and tutorials in us website


	for use this code, add the following code           require "http://www.public.simple-work.tk/php/simplework.php";
    or if you have an php error, go on github, download the file and add       require "paths/to/go/on/your/simplework.php";
*/


/**
* Class SWapp
* class principale de SimpleWork permettant surtout l'intéraction avec le navigateur du client (IP, OS, browser, ...)
*/
class SWapp{

    /**
    * @var string $version version de SimpleWork
    */
    public $version = "0.0.2";
    /**
    * @var string $website Lien du site
    */
    public $website = "http://www.simple-work.tk"; // here you can find a lot of help an doc
    
    /**
    * @return array tableau contenant des info sur l'ordi du client et le serveur
    */
    public function getEnv () {
        $env = array(
            'IPclient' => getIP(),
            'IPserveur' => $_SERVER['SERVER_ADDR'],
            'OS' => getOS(false),
            'browser' => getBrowser(false),
            'arch' => getArch()
        );
        return $env;
    }

    /**
    * @return string retourne l'addresse IP du client
    */
    public function getIP() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    /**
    * @param boolean $generic true pour n'avoir que l'os, false pour avoir la distribution (si os = linux)
    * @return string retourne l'os du client
    */
    public function getOS ($generic = true) {
        $os = "unknown";
        $distrib = null;
        $info = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match("/linux/i", $info)){
            $os = "linux";
            if(preg_match("/ubuntu/i", info)){
                $distrib = "ubuntu";
            }
            else{
                $distrib = "unknown";
            }
        }
        elseif(preg_match("/windows|win32/i", $info)){
            $os = "windows";
        }
        elseif(preg_match("/macintosh|mac os x/i", $info)){
            $os = "mac";
        }
        else {
            $os = "unknown";
        }
        if($generic == true){
            return $os;
        }
        else{
            return $os . " " . $distrib;
        }
    }

    /**
    * @param boolean $fullename true pour le nom complet, false pour le raccourci
    * @return string retourne le navigateur du client
    */
    public function getBrowser ($fullname = false) {
        $browser = "unknown";
        $lite = "unknown";
        $info = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/MSIE/i',$info) && !preg_match('/Opera/i',$info)) { 
            $browser = 'Internet Explorer (or Microsoft Edge)'; 
            $lite = "IE"; 
        } 
        elseif(preg_match('/Firefox/i',$info)) { 
            $browser = 'Mozilla Firefox'; 
            $lite = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$info)) { 
            $browser = 'Google Chrome (or Chromium)'; 
            $lite = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$info))  { 
            $browser = 'Apple Safari'; 
            $lite = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$info)) { 
            $browser = 'Opera'; 
            $lite = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$info)) { 
            $browser = 'Netscape'; 
            $lite = "Netscape"; 
        }
        
        if($fullename == true){
            return $browser;
        }
        else {
            return $lite;
        }
    }

    /**
    * @return integer retourne 64 si l'os est un 64bits, 32 si c'est un 32bits
    */
    public function getArch () {
        $info = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match("/x86_64/i", $info)){
            return 64;
        }
        else {
            return 32;
        }
    }
}

/**
* Class SWerror
* class pour les erreurs SW
*/
class SWerror extends Exception{

    /**
    * @param string $message le message de l'erreur
    * @param int $code code de l'erreur
    * @param Exception $previous Laisser vide, ne pas spécifier
    */
    public function __construct($message = "erreur non enregistré", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

// use :    throw new SWerror("message",code);
// for debug an SW error, go here : http://www.simple-work.tk/doc/php/error and enter your code error


/**
* Class SWtext
* class contenant des fonctions statiques pour les variables de type texte
*/
class SWtext {

    /**
    * @param string $string1 string dans lequelle la recherche sera faite
    * @param string $search string a chercher dans $string1
    * @param boolean $case_sensitif true pour une recherche qui respecte la casse, false sinon
    * @return boolean true si $string1 contient $search, false sinon
    */
    public static function if_contain ($string1, $search, $case_sensitif = true){
        if($case_sensitif == true){
            return strpos($string1, $search) !== false;
        }
        else{
            return stripos($string1, $search) !== false;
        }
    }

    /**
    * @param string $string1 string initial
    * @param string $string2 string a rajouter
    * @param int $where endroit ou $string2 doit etre rajouter
    * @return string assemblage des deux string
    */
    public static function merge ($string1, $string2, $where){
        $temp = str_split($string1, $where);
        $temp2 = "";
        for($i = 1; $i < count($temp); $i++){
            $temp2 = $temp2 . $temp[i];
        }
        return $temp[0] . $string2 . $temp2;
    }

}

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

/**
* Class SWuser
* class contenant le nécessaire pour la gestions des utilisateurs
*/
class SWuser {

    /**
    * @param string $pseudo pseudo de l'utilisateur
    * @param string $mdp mot de passe de l'utilisateur
    */
    protected static $pseudo = "";
    protected static $mdp = "";

    /**
    * @var string $DB_pseudo contient le pseudo de l'utilisateur de la BDD
    * @var string $DB_mdp contient le mot de passe de l'utilisateur de la BDD
    * @var string $DB_host contient l'host de la BDD
    * @var string $DB_bddname contient le nom de la bdd qui contient les utilisateurs
    * @var string $DB_table contient le nom de la table de la BDD
    * @var string $DB_charset contient le charset de la BDD
    * @var string $DB_col_ID contient le nom de la colone qui contient les ID de la table
    * @var string $DB_col_PSEUDO contient le nom de la colone qui contient les PSEUDOS de la table
    * @var string $DB_col_MDP contient le nom de la colone qui contient les MOT DE PASSE de la table
    */
    protected static $DB_pseudo = "root";
    protected static $DB_mdp = "";
    protected static $DB_host = "localhost";
    protected static $DB_bddname = "USERS";
    protected static $DB_table = "user";
    protected static $DB_charset = "utf8";
    protected static $DB_col_ID = "ID";
    protected static $DB_col_PSEUDO = "PSEUDO";
    protected static $DB_col_MDP = "PASSWORD";

    /**
    * @param string $DB_pseudo contient le pseudo de l'utilisateur de la BDD
    * @param string $DB_mdp contient le mot de passe de l'utilisateur de la BDD
    * @param string $DB_host contient l'host de la BDD
    * @param string $DB_bddname contient le nom de la bdd qui contient les utilisateurs
    * @param string $DB_table contient le nom de la table de la BDD
    * @param string $DB_charset contient le charset de la BDD
    * @param string $DB_col_ID contient le nom de la colone qui contient les ID de la table
    * @param string $DB_col_PSEUDO contient le nom de la colone qui contient les PSEUDOS de la table
    * @param string $DB_col_MDP contient le nom de la colone qui contient les MOT DE PASSE de la table
    */
    public static function SETUP ($DB_host = "localhost", $DB_bddname, $DB_table, $DB_pseudo, $DB_mdp, $DB_col_ID, $DB_col_PSEUDO, $DB_col_MDP, $DB_charset = "utf8") {
        self::$DB_host = $DB_host;
        self::$DB_bddname = $DB_bddname;
        self::$DB_table = $DB_table;
        self::$DB_pseudo = $DB_pseudo;
        self::$DB_mdp = $DB_mdp;
        self::$DB_col_ID = $DB_col_ID;
        self::$DB_col_PSEUDO = $DB_col_PSEUDO;
        self::$DB_col_MDP = $DB_col_MDP;
        self::$DB_charset = $DB_charset;
    }

    /**
    * @param string $pseudo pseudo de l'utilisateur
    * @param string $mdp mot de passe de l'utilisateur
    * @return boolean true s'il existe, false sinon
    */
    public static function do_exist ($pseudo, $mdp) {
        // on se connect
        $conn = new PDO ('mysql:host='.self::$DB_host.';dbname='.self::$DB_bddname.';charset='.self::$DB_charset.';', self::$DB_pseudo, self::$DB_mdp);
        //requete mysql
        $req = $conn->query("SELECT ".self::$DB_col_ID." FROM `".self::$DB_table."` WHERE ".self::$DB_col_PSEUDO." = '".$pseudo."' AND ".self::$DB_col_MDP." = '".$mdp."';");
        $res = $req->fetch(); // on recupere le resultat
        return !empty($res); // on renvoie true ou false
    }

    /**
    * @param string $pseudo pseudo de l'utilisateur
    * @param string $mdp mot de passe de l'utilisateur
    * @return boolean true si la connexion a reussi, false sinon
    */
    public static function connect ($pseudo, $mdp) {
        // on se connect
        $conn = new PDO ('mysql:host='.self::$DB_host.';dbname='.self::$DB_bddname.';charset='.self::$DB_charset.';', self::$DB_pseudo, self::$DB_mdp);
        //requete mysql
        $req = $conn->query("SELECT ".self::$DB_col_ID." FROM `".self::$DB_table."` WHERE ".self::$DB_col_PSEUDO." = '".$pseudo."' AND ".self::$DB_col_MDP." = '".$mdp."';");
        $res = $req->fetch(); // on recupere le resultat
        if(!empty($res)){
            $_SESSION['userPSEUDO'] = $pseudo;
            $_SESSION['userMDP'] = $mdp;
            $_SESSION['userID'] = $res[self::$DB_col_ID];
            return true;
        }
        else {
            return false;
        }
    }

    /**
    * @return boolean true si la deconnexion a reussi, false sinon
    */
    public static function deconnect () {
        $_SESSION['userPSEUDO'] = null;
        $_SESSION['userMDP'] = null;
        $_SESSION['userID'] = null;
        return true;
    }

    /**
    * @return boolean true si l'utilisateur est deja connecter, false sinon
    */
    public static function is_connected () {
        if(isset($_SESSION['userPSEUDO']) && isset($_SESSION['userMDP']) && isset($_SESSION['userID'])){
            if(!empty($_SESSION['userPSEUDO']) && !empty($_SESSION['userMDP']) && !empty($_SESSION['userID'])){
                return true;
            } else { return false; }
        } else { return false; }
    }

}

/**
* Class SWsecurity
* class concernant la sécurite
*/
class SWsecurity {

    /**
    * @param boolean $mdprequire true pour demander un mdp, false sinon
    * @param boolean $pseudorequire true pour demander un pseudo, false sinon
    * @param string $methodused "post" pour utiliser un formaulaire en $_POST[], "get" pour un $_GET[]
    */
    public static function display_websecurity ($mdprequire = true, $pseudorequire = false, $methodused = "post"){
        if($mdprequire == true AND $pseudorequire == false){
            echo "<div><h1>Cette page est sécurisé</h1><h3>Merci de bien vouloir entrer un mot de passe ci-dessous</h3><form action='' method='".$methodused."'>Mot de passe : <input type='password' name='mdp' required /><br/></br><input type='submit' name='submit' value='connexion'></form></div>";
        }
        elseif($mdprequire == true AND $pseudorequire == true) {
            echo "<div><h1>Cette page est sécurisé</h1><h3>Merci de bien vouloir entrer un mot de passe ci-dessous</h3><form action='' method='".$methodused."'>Pseudo : <input type='text' name='pseudo' required /><br/><br/>Mot de passe : <input type='password' name='mdp' required /><br/></br><input type='submit' name='submit' value='connexion'></form></div>";
        }
        elseif($mdprequire == false AND $pseudorequire == true){
            echo "<div><h1>Cette page est sécurisé</h1><h3>Merci de bien vouloir entrer un mot de passe ci-dessous</h3><form action='' method='".$methodused."'>Pseudo : <input type='text' name='pseudo' required /><br/><br/><input type='submit' name='submit' value='connexion'></form></div>";
        }
        else {
            throw new SWException("Les arguments de la fonction ".__FUNCTION__." ne coincident pas, merci de lire la documentation", 1);
        }
    }


    /*   $type est le type de variable à retourner parmi :  (more info in documentation : http://www.simple-work.tk/documentation)
	
	text,      (text for display directly on screen)
	int,       (return an int value, delete all others caracter)
	html,      (delete "<script>","</script>","include","require"  , very not securised)
	bbcode,     (ex: <b> -> [b] and </b> -> [/b] )
	crypted,   (like password, use md5() )
	mail,      (plain text for mail, !)
	mysql,     (mysql don't display error but it juste use \          need the $bdd in $param3 for $bdd->quote())
	mysql2,    (can display error, but your DataBase is safe          need the $bdd in $param3 for $bdd->quote())
    */

    /**
    * @param string $string valeur a securiser
    * @param string $type type de securisation
    * @param string|array|object|null $param3 parametre pour certaine fonction (bbcode, mysql, mysql2)
    * @return string|integer|null valeur securiser
    */
    public static function add_security($string, $type = "text", $param3 = null) {
        if($type == "text"){
            $string = htmlentities($string);
            $string = htmlspecialchars($string);
            return $string;
        }
        elseif($type == "int"){
            $y = str_split($string);
            $z = "";
            foreach($y as $value){
                switch($value){
                    case "1": $z.= "1";break;
                    case "2": $z.= "2";break;
                    case "3": $z.= "3";break;
                    case "4": $z.= "4";break;
                    case "5": $z.= "5";break;
                    case "6": $z.= "6";break;
                    case "7": $z.= "7";break;
                    case "8": $z.= "8";break;
                    case "9": $z.= "9";break;
                    case "0": $z.= "0";break;
                } }
                return $z;
        }
        elseif($type == "html"){
            $search = array("<script>", "</script>", "<?php", "?>", "include", "require", "<!--", "-->");
            $string = str_replace($search, "", $string);
            return $string;
        }
        elseif($type == "bbcode"){
            // use $param3 (array) for don't change unique balise like "b","i","h4",...   WARNING : for <p id="id01">, in $param3 write "p id='id01'"
            //                                                                                    
            $string = str_replace("<", "[", $string);
            $string = str_replace(">", "]", $string);
            foreach($param3 as $x){
                $string = str_replace("[".$x."]", "<".$x.">", $string);
            }
            return $string;
        }
        elseif($type == "crypted"){
            return md5($string); // md5() ne posséde pas de fonction inverse, donc utiliser     if(md5(...) == $le_md5_encrypté) { ... }
        }
        elseif($type == "mail"){
            $string = quoted_printable_encode($string);
            $string = htmlentities($string);
            return $string;
        }
        elseif($type == "mysql"){
            // use $param3 for $bdd
            $string = $param3->quote($string);
            $string = addcslashes($string, "%_;");
            return $string;
        }
        elseif($type == "mysql2"){
            // use $param3 for $bdd
            $string = $param3->quote($string);
            $string = addcslashes($string, "%_");
            $search = array("WHERE", "SELECT", "UPDATE", "DELETE", "DROP", "INSERT", "INTO", "=", "OR", "AND");
            $string = str_ireplace($search, "", $string);
            return $string;
        }
        else{ echo("<h1 style='background-color:red;color:white'>ERREUR : LE TYPE RENSEIGNER DANS ADDsecurity EST INCORRECT !"); }
        
    }

}
?>