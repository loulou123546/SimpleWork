<?php

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
?>