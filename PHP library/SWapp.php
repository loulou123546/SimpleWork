<?php
class SWapp{

    public $version = "0.0.1";
    
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