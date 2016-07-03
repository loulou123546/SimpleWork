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



 /* $string est la variable à sécuriser
	
	$type est le type de variable à retourner parmi :
	
	text,      (text for display directly on screen)
	int,       (return an int value, delete all others caracter)
	bool,      (if is "NULL","",0 is false, else is true)
	html,      (delete "<script>","</script>","include","require"  , very not securised)
	html2,     (ex: <b> -> [b] and </b> -> [.b] + html)
	crypted,   (like password)
	replace,   (need $sign, like addcslashes($string,$sign))
	mail,      (plain text !)
	mysql,     (mysql don't display error but it juste use \          need the $bdd in $sign for $bdd->quote())
	mysql2,    (can display error, but your DataBase is safe          need the $bdd in $sign for $bdd->quote())
 
 */
function SW_security_add($string, $type = "text", $sign = null, $replaceby = "") {

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
	elseif($type == "bool"){
		if($string == "" || $string == null || $string == 0){
			return false;
		}
		else{
			return true;
		}
	}
	elseif($type == "html"){
		$search = array("<script>", "</script>", "<?php", "?>", "include", "require", "<!--", "-->");
		$string = str_replace($search, "", $string);
		return $string;
	}
	elseif($type == "html2"){
		// use $sign (array) for don't change unique balise like "b","i","h4",...   WARNING : for <p id="id01">, in $sign write "p id='id01'"
		//                                                                                    
		$string = str_replace("<", "[", $string);
		$string = str_replace(">", "]", $string);
		$string = str_replace("/", ".", $string);
		foreach($sign as $x){
			$string = str_replace("[".$x."]", "<".$x.">", $string);
			$string = str_replace("[.".$x."]", "</".$x.">", $string);
			$string = str_replace("[".$x.".]", "<".$x."/>", $string);
			$string = str_replace("[".$x." .]", "<".$x." />", $string);
		}
		return $string;
	}
	elseif($type == "crypted"){
		$string2 = convert_uuencode($string);
		return $string2;
	}
	elseif($type == "replace"){
		// use $sign AND $relaceby
		$x = str_split($sign);
		$string = str_ireplace($x,$replaceby, $string);
		return $string;
	}
	elseif($type == "mail"){
		$string = quoted_printable_encode($string);
		$string = htmlentities($string);
		return $string;
	}
	elseif($type == "mysql"){
		// use $sign for $bdd
		$string = $sign->quote($string);
		$string = addcslashes($string, "%_;");
		return $string;
	}
	elseif($type == "mysql2"){
		// use $sign for $bdd
		$string = $sign->quote($string);
		$string = addcslashes($string, "%_");
		$search = array("WHERE", "SELECT", "UPDATE", "DELETE", "DROP", "INSERT", "INTO", "=", "OR", "AND");
		$string = str_ireplace($search, "", $string);
		return $string;
	}
	else{ echo("<h1 style='background-color:red;color:white'>ERREUR : LE TYPE RENSEIGNER DANS ADDsecurity EST INCORRECT !"); }
	
}

function SW_security_sub($string, $type){
	
	if($type == "text"){
		$string = html_entity_decode($string);
		$string = htmlspecialchars_decode($string);
		return $string;
	}
	elseif($type == "html2"){
		// use $sign (array) for don't change unique balise like "b","i","h4",...   WARNING : for <p id="id01">, in $sign write "p id='id01'"
		//                                                                                    for balise like <br />, use "<br>" or <br/>
		$string = str_replace("[", "<", $string);
		$string = str_replace("]", ">", $string);
		$string = str_replace(".", "/", $string);
		return $string;
	}
	elseif($type == "crypted"){
		$string = convert_uudecode($string);
		return $string;
	}
	elseif($type == "mail"){
		$string = html_entity_decode($string);
		$string = quoted_printable_decode($string);
		return $string;
	}
	else{ echo("<h1 style='background-color:red;color:white'>ERREUR : LE TYPE RENSEIGNER DANS SW_subsecurity EST INCORRECT !"); }
	
}

?>