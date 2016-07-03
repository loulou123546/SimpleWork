<?php
class SWException extends Exception{

    public function __construct($message = "erreur non enregistré", $code = 0, Exception $previous = null) {
        
        $erreur = "Erreur SimpleWork : ".$message;
        
        parent::__construct($message, $code, $previous);
    }
}

class =
?>