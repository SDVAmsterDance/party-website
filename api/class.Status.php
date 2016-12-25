<?php

/**
 *  class.Status.php
 *
 *  The status class, e.g. how many registrations are still possible.
 *
 *  @author Michael van der Werve
 */

require_once 'autoload.php';

class Status implements JsonSerializable {
    /**
     *  Amount of regular registrations
     */
    private $regular = 0;

    /**
     *  Amount of VIP guests.
     */
    private $vip = 0;
    
    /**
     *  Constructor, does database query to get the status
     */
    function __construct() {
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        foreach ($dbh->query("SELECT SUM(guests) + COUNT(id) AS regular, SUM(vips) as vip FROM registrations", PDO::FETCH_ASSOC) as $row) {
            $this->regular += $row['regular'];
            $this->vip += $row['vip'];
        }
    }

    /**
     *  Amount of regular tickets left and vip
     */
    public function regular() { return 70 - $this->regular; }
    public function vip() { return min(10 - $this->vip, $this->regular()); }

    /**
     *  Function to convert to serializable datat type
     */
    public function jsonSerialize() {
        return array("regular" => $this->regular(), "vip" => $this->vip()); 
    }
}
