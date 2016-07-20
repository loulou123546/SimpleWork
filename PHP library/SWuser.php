<?php
/**
* Class SWuser
* class contenant le nécessaire pour la gestions des utilisateurs
*/
class SWuser {

    /**
    * @param string $pseudo pseudo de l'utilisateur
    * @param string $mdp mot de passe de l'utilisateur
    */
    protected static $pseudo = "";
    protected static $mdp = "";

    /**
    * @var string $DB_pseudo contient le pseudo de l'utilisateur de la BDD
    * @var string $DB_mdp contient le mot de passe de l'utilisateur de la BDD
    * @var string $DB_host contient l'host de la BDD
    * @var string $DB_bddname contient le nom de la bdd qui contient les utilisateurs
    * @var string $DB_table contient le nom de la table de la BDD
    * @var string $DB_charset contient le charset de la BDD
    * @var string $DB_col_ID contient le nom de la colone qui contient les ID de la table
    * @var string $DB_col_PSEUDO contient le nom de la colone qui contient les PSEUDOS de la table
    * @var string $DB_col_MDP contient le nom de la colone qui contient les MOT DE PASSE de la table
    */
    protected static $DB_pseudo = "root";
    protected static $DB_mdp = "";
    protected static $DB_host = "localhost";
    protected static $DB_bddname = "USERS";
    protected static $DB_table = "user";
    protected static $DB_charset = "utf8";
    protected static $DB_col_ID = "ID";
    protected static $DB_col_PSEUDO = "PSEUDO";
    protected static $DB_col_MDP = "PASSWORD";

    /**
    * @param string $DB_pseudo contient le pseudo de l'utilisateur de la BDD
    * @param string $DB_mdp contient le mot de passe de l'utilisateur de la BDD
    * @param string $DB_host contient l'host de la BDD
    * @param string $DB_bddname contient le nom de la bdd qui contient les utilisateurs
    * @param string $DB_table contient le nom de la table de la BDD
    * @param string $DB_charset contient le charset de la BDD
    * @param string $DB_col_ID contient le nom de la colone qui contient les ID de la table
    * @param string $DB_col_PSEUDO contient le nom de la colone qui contient les PSEUDOS de la table
    * @param string $DB_col_MDP contient le nom de la colone qui contient les MOT DE PASSE de la table
    */
    public static function SETUP ($DB_host = "localhost", $DB_bddname, $DB_table, $DB_pseudo, $DB_mdp, $DB_col_ID, $DB_col_PSEUDO, $DB_col_MDP, $DB_charset = "utf8") {
        self::$DB_host = $DB_host;
        self::$DB_bddname = $DB_bddname;
        self::$DB_table = $DB_table;
        self::$DB_pseudo = $DB_pseudo;
        self::$DB_mdp = $DB_mdp;
        self::$DB_col_ID = $DB_col_ID;
        self::$DB_col_PSEUDO = $DB_col_PSEUDO;
        self::$DB_col_MDP = $DB_col_MDP;
        self::$DB_charset = $DB_charset;
    }
}




?>