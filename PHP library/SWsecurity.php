<?php
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