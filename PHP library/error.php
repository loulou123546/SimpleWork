<?php

class SWException extends Exception{

    public function __construct($message = "erreur non enregistré", $code = 0, Exception $previous = null) {
        
        $erreur = "Erreur SimpleWork : ".$message." (code : ".$code.")";
        
        parent::__construct($message, $code, $previous);
    }
}

// use :    throw new SWException("message",code);

// for debug an SW error, go here : http://www.simple-work.tk/doc/php/error and enter your code error
?>