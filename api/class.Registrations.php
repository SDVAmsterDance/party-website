<?php

/**
 *  class.Registrations.php
 *
 *  Find all the registrations
 *
 *  @author Michael van der Werve
 *  @copyright 2016 
 */

require_once 'autoload.php';

class Registrations {

    private $registrations = array();

    public function __construct() {
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD); 

        // find all hashes
        $hashes = $dbh->query("SELECT hash FROM registrations ORDER BY paid ASC", PDO::FETCH_ASSOC); 
    
        foreach ($hashes as $row) {
            array_push($this->registrations, Registration::get($row['hash']));
        }
    }

    public function arr() { return $this->registrations; }
}
