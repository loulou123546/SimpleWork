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

$SW_userSystem_utilisateur = "default";
$SW_userSystem_dbname = "users";
$SW_userSystem_tablename = "users";
$SW_userSystem_column_pseudo = "PSEUDO";
$SW_userSystem_colum_mdp = "MDP";
$SW_userSystem_colum_id = "ID";


function SW_user_setup ($utilisateur, $dbname, $tablename, $colpseudo, $colmdp, $colid){
	$SW_userSystem_utilisateur = $utilisateur;
	$SW_userSystem_dbname = $dbname;
	$SW_userSystem_tablename = $tablename;
	$SW_userSystem_column_pseudo = $colpseudo;
	$SW_userSystem_colum_mdp = $colmdp;
	$SW_userSystem_colum_id = $colid;
}

function SW_user_doexist ($pseudo, $mdp){
	$res = SW_mysql_SELECT(SW_mysql_addconnexion($SW_userSystem_dbname, $SW_userSystem_utilisateur), "SELECT * FROM `".$SW_tablename."` WHERE `".$SW_column_pseudo."` = '".$pseudo."' AND `".$SW_column_mdp."` = '".$mdp."'");
	if(!empty($res[$SW_colum_pseudo])){
		return true;
	} else {
		return false;
	}
	$res = null;
}

function SW_user_setSESSION ($pseudo, $mdp, $pseudoname = "userPSEUDO", $mdpname = "userMDP", $idname = "userID"){
	if(SW_user_doexist($pseudo, $mdp)){
		$res = SW_mysql_SELECT(SW_mysql_addconnexion($SW_userSystem_dbname, $SW_userSystem_utilisateur), "SELECT * FROM `".$SW_tablename."` WHERE `".$SW_column_pseudo."` = '".$pseudo."' AND `".$SW_column_mdp."` = '".$mdp."'");
		$_SESSION[$pseudoname] = $res[$SW_colum_pseudo];
		$_SESSION[$mdpname] = $res[$SW_colum_mdp];
		$_SESSION[$idname] = $res[$SW_colum_id];
		$res = null;
		return true;
	}
	else { return false; }
}

function SW_user_get ($pseudo, $mdp) {
	if(SW_user_doexist($pseudo, $mdp)){
		$res = SW_mysql_SELECT(SW_mysql_addconnexion($SW_userSystem_dbname, $SW_userSystem_utilisateur), "SELECT * FROM `".$SW_tablename."` WHERE `".$SW_column_pseudo."` = '".$pseudo."' AND `".$SW_column_mdp."` = '".$mdp."'");
		return $res;
		$res = null;
	}
	else { return false; }
}

?>