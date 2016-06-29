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
 
 // en cours de création
function SW_display_connect ($displaymode) {
	 
	if($displaymode == "inline"){
		
	}
	elseif($displaymode == "panel"){
		 
	}
	elseif($displaymode == "modal"){
		 
	}
	else { echo("<h1 style='background-color:red;color:white'>ERREUR : LE displaymode RENSEIGNER DANS display_connect EST INCORRECT !"); }
}

// fonction permettant d'utiliser un systeme de pseudo et/ou mot de passe por acceder à une page sécuriser (ex: panel d'administration)
function SW_display_websecurity ($mdprequire = true, $pseudorequire = false, $methodused = "post"){
	if($mdprequire == true AND $pseudorequire == false){
		return "<div><h1>Cette page est sécurisé</h1><h3>Merci de bien vouloir entrer un mot de passe ci-dessous</h3><form action='' method='".$methodused."'>Mot de passe : <input type='password' name='mdp' required /><br/></br><input type='submit' name='submit' value='connexion'></form></div>";
	}
	elseif($mdprequire == true AND $pseudorequire == true) {
		return "<div><h1>Cette page est sécurisé</h1><h3>Merci de bien vouloir entrer un mot de passe ci-dessous</h3><form action='' method='".$methodused."'>Pseudo : <input type='text' name='pseudo' required /><br/><br/>Mot de passe : <input type='password' name='mdp' required /><br/></br><input type='submit' name='submit' value='connexion'></form></div>";
	}
	elseif($mdprequire == false AND $pseudorequire == true){
		return "<div><h1>Cette page est sécurisé</h1><h3>Merci de bien vouloir entrer un mot de passe ci-dessous</h3><form action='' method='".$methodused."'>Pseudo : <input type='text' name='pseudo' required /><br/><br/><input type='submit' name='submit' value='connexion'></form></div>";
	}
}
 ?>