<?php

/**
 *  class.Registration.php
 *
 *  The registration.
 *
 *  @author Michael van der Werve
 */

require_once 'autoload.php';

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
     *  The unique db identifier
     */
    private $hash = null;
    
    /**
     *  Construct the object
     */
    function __construct($arr, $fromdb = false) {
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

        // we're done if from registration
        if ($fromdb) return;

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
    
        // we don't want to check any more for now
        return;

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

        // create the hash
        $this->hash = md5($json . time());

        // bind the parameters 
        $stmt->bindParam(':hash', $this->hash);
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

    public function members() {
        // get the very important people
        $members = array();

        // we may also be a vip
        if ($this->buyer->member) array_push($members, $this->buyer);

        // find the vips
        foreach ($this->guests as $guest)
            if ($guest->member) array_push($members, $guest);


        // return the array
        return $members; 
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
     *  Retrieve the hash.
     */
    public function hash() { return $this->hash; }

    /**
     *  Retrieve the buyer info
     */
    public function buyer() { return $this->buyer; }

    /**
     *  Send the confirmation email.
     */
    public function confirm() {
        // create the email
        $email = (string)new EmailBuilder($this, false);   

        // simply message 
        $this->message("Royal Ticket", $email);
    }
    
    /**
     *  Payment has been made.
     */
    public function hasPaid() {
        // do nothing if already paid
        if ($this->paid) return;

        // TODO: mail + store
        $this->paid = true;
        
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        $stmt = $dbh->prepare("UPDATE registrations SET paid = true WHERE hash = :hash");

        // run the statement
        $stmt->bindParam(":hash", $this->hash);
        $stmt->execute();
        
        // create the email
        $email = (string)new EmailBuilder($this, false, true);   

        // simply message 
        $this->message("Payment Confirmation", $email);
    }

    /**
     *  Generic mail function from eindfeecie
     */
    public function message($subject, $body) { 
        // make the mailer
        $mail = new PHPMailer;  

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = RELAY_EMAIL_SMTP;                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = RELAY_EMAIL_USER;     // SMTP username
        $mail->Password = RELAY_EMAIL_PASSWORD;                    // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = RELAY_EMAIL_PORT;                                    // TCP port to connect to
        
        $mail->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
        $mail->addAddress($this->email, $this->buyer->name);     // Add a recipient
        $mail->addReplyTo(RELAY_EMAIL_USER, EMAIL_FROM_NAME);
        $mail->isHTML(true);                                  // Set email format to HTML
        
        // set the subject and body
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // send the mail
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } 
    }

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

        // execute the statementds
        $stmt->execute();

        // fetch the result
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        // if no result, do nothing
        if (!$res) return null;
    
        // the result is now the json
        $json = json_decode($res["json"]);

        // reconstruct from the json
        $reg = new Registration(json_decode($res["json"], true), true);
    
        // whether or not payment has been made
        $reg->paid = $res["paid"];
        
        // set the hash
        $reg->hash = $id;

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

    public function price() {
        $p = 0;
        foreach ($this->guests as $guest) {
            $p += $guest->price();
        }
        return $p + $this->buyer->price();
    }
}



