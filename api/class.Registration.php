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
require_once 'class.Status.php';

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
        if (strlen($this->email) < 3) die('empty field');
    
        // everything is in order so far, get the status (to see if registration is still possible)
        $status = new Status();

        // make sure there are enough tickets
        if (count($this->guests) + 1 > $status->regular()) die('too many regular tickets');
        else if (count($this->vips()) > $status->vip()) die('too many vip tickets');
    }

    /**
     *  Check the email
     */
    function check($email) {
        // check validity
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die('invalid email format');

        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  
        
        // make the statement
        $stmt = $dbh->prepare("SELECT * FROM registrations WHERE email = :email");

        // bind the params
        $stmt->bindParam(':email', $email);
        
        // execute
        $stmt->execute();

        // get the rowcount
        if ($stmt->rowCount() > 0) die('email exists');
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
        // check the email 
        $this->check($this->email);

        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        $stmt = $dbh->prepare("INSERT INTO registrations (hash, json, email, guests, vips) VALUES (:hash, :json, :email, :guests, :vips)");

        // create the json
        $json = json_encode($this);
    
        // bind the parameters 
        $stmt->bindParam(':hash', md5($json . time()));
        $stmt->bindParam(':json', $json);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':guests', count($this->guests));
        $stmt->bindParam(':vips', count($this->vips()));

        // execute the statement
        $stmt->execute();
    }
    
    /**
     *  Retrieve the vips
     */
    public function vips() {
        // get the very important people
        $vips = array();
        
        // we may also be a vip
        if ($this->buyer->vip) array_push($vips, $this->buyer);
            
        // find the vips
        foreach ($this->guests as $guest)
            if ($guest->vip) array_push($vips, $guest);


        // return the array
        return $vips; 
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
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        $stmt = $dbh->prepare("SELECT json, paid FROM registrations WHERE hash = :hash LIMIT 1");

        // bind the statements
        $stmt->bindParam(':hash', $id);
        
        // execute the statement
        $stmt->execute();
        
        // fetch the result
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        // if no result, do nothing
        if (!$res) return null;
         
        // reconstruct from the json
        $reg = new Registration(json_decode($res["json"], true));

        // get the registration
        return $reg;
    } 

    /**
     *  Give json_encode correct output
     */
    public function jsonSerialize() {
        // serialize it to the correct form 
        return array_merge(json_decode(json_encode($this->buyer()), true), array("guests" => $this->guests, "email" => $this->email, "paid" => $this->paid));
    }
}

