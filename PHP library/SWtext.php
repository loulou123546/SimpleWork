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