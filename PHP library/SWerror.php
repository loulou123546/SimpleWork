<?php

/**
* Class SWerror
* class pour les erreurs SW
*/
class SWerror extends Exception{

    /**
    * @param string $message le message de l'erreur
    * @param int $code code de l'erreur
    * @param Exception $previous Laisser vide, ne pas spécifier
    */
    public function __construct($message = "erreur non enregistré", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

// use :    throw new SWerror("message",code);
// for debug an SW error, go here : http://www.simple-work.tk/doc/php/error and enter your code error

?>