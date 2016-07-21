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
?>