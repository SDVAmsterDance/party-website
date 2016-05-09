<?php

/**
 *  class.Registration.php
 *
 *  The registration.
 *
 *  @author Michael van der Werve
 */

require_once 'config.php';
require_once 'class.Person.php';

class Registration implements JsonSerializable {
    /**
     *  The guests.
     */
    private $guests = array();
    
    /**
     *  Email
     */
    private $email = null;

    /**
     * Buyer (also a person)
     */
    private $buyer = null;

    /**
     *  Whether or not payment has been made
     */
    private $paid = false;

    /**
     *  Construct the object
     */
    function __construct($arr) {
        // this array doubles as the stuff
        $this->buyer = new Person($arr);

        // validate the guests by constructing the above classes
        foreach ($arr["guests"] as $guest) {
            array_push($this->guests, new Person($guest));
        }

        // get the email
        $this->email = isset($arr["email"]) ? substr((string) $arr["email"], 0, 32) : "";
        
        // make sure email is filled out 
        if ($this->email < 3) die('empty field');
    }

    /**
     *  String casting operator
     */
    function __toString() {
        $guests = "";
        foreach ($this->guests as $guest) $guests .= (string) $guest;
        return sprintf("%s (member: %b, vip: %b, email: %s) brings along (%s)", $this->buyer->name, $this->buyer->member, $this->buyer->vip, $this->email, $guests);
    }

    /**
     *  Store
     */
    public function store() {
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        $stmt = $dbh->prepare("INSERT INTO registrations (hash, json) VALUES (:hash, :json)");

        // create the json
        $json = json_encode($this);

        // bind the parameters 
        $stmt->bindParam(':hash', md5($json . time()));
        $stmt->bindParam(':json', $json);

        // execute the statement
        $stmt->execute();
    }
    
    /**
     *  Retrieve the guest arrays
     */
    public function guests() { return $this->guests; }
    
    /**
     *  Retrieve the buyers email
     */
    public function email() { return $this->email; }

    /**
     *  Retrieve whether or not payment had been made
     */
    public function paid() { return $this->paid; }
    
    /**
     *  Retrieve the buyer info
     */
    public function buyer() { return $this->buyer; }
    
    /**
     *  Get a registration by an identifier, this is externally to load it from the database
     */
    public static function get($id) {
        // TODO get it from the database
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);  

        // make the statement
        $stmt = $dbh->prepare("SELECT json, paid FROM registrations WHERE hash == :hash LIMIT 1");

        // bind the statements
        $stmt->bindParam(':hash', $id);
        
        // execute the statement
        $stmt->execute();
    } 

    public function jsonSerialize() {
        // serialize it to the correct form 
        array();
    }
}

