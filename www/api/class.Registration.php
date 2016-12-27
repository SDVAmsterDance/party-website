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
    private $_guests = array();

    /**
     *  Email
     */
    private $_email = null;

    /**
     * Buyer (also a person)
     */
    private $_buyer = null;

    /**
     *  Whether or not payment has been made
     */
    private $_paid = false;

    /**
     *  The unique db identifier
     */
    private $_hash = null;

    /**
     *  Whether or not this was confirmed.
     */
    private $_confirmed = false;
    private $_payconfirmed = false;
    
    /**
     *  Construct the object
     */
    function __construct($arr, $fromdb = false) {
        // this array doubles as the stuff
        $this->_buyer = new Person($arr);

        // validate the guests by constructing the above classes
        foreach ($arr["guests"] as $guest) {
            array_push($this->_guests, new Person($guest));
        }

        // get the email
        $this->_email = isset($arr["email"]) ? substr((string) $arr["email"], 0, 128) : "";

        // make sure email is filled out 
        if (strlen($this->_email) < 3) die('email must contain at least 3 characters');

        // if we're from the database, get extra fields
        if ($fromdb) {
            // whether or not payment has been made
            $this->_paid = $arr["paid"];

            // the info is also in the json
            $this->_confirmed = $arr["confirmed"];

            // payment confirmation
            $this->_paymentconfirmed = $arr["payconfirmed"];
            
            // we are now done, no status checks
            return;
        } else {
            // check the email 
            $this->check($this->_email);
        }

        // everything is in order so far, get the status (to see if registration is still possible)
        $status = new Status();

        // make sure there are enough tickets
        if (count($this->_guests) + 1 > $status->regular()) die('too many regular tickets');
        else if (count($this->vips()) > $status->vip()) die('too many vip tickets');
    }

    /**
     *  Check the email
     */
    function check($email) {
        // check validity
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) die('invalid email format');
    
        // we don't want to check any more for now, same email can have multiple tickets
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
        foreach ($this->_guests as $guest) $guests .= (string) $guest;
        return sprintf("%s (member: %b, vip: %b, email: %s) brings along (%s)", $this->_buyer->name, $this->_buyer->member, $this->_buyer->vip, $this->_email, $guests);
    }

    /**
     *  Store
     */
    public function store() {
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        $stmt = $dbh->prepare("INSERT INTO registrations (hash, json, email, guests, vips) VALUES (:hash, :json, :email, :guests, :vips) ON DUPLICATE KEY UPDATE json=:json");

        // create the json
        $json = json_encode($this);

        // create the hash
        $this->_hash = md5($json . time());

        // the amount of guests
        $n_guests = count($this->_guests);
        $n_vips = count($this->vips());

        // bind the parameters 
        $stmt->bindParam(':hash', $this->_hash);
        $stmt->bindParam(':json', $json);
        $stmt->bindParam(':email', $this->_email);
        $stmt->bindParam(':guests', $n_guests);
        $stmt->bindParam(':vips', $n_vips);

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
        if ($this->_buyer->vip) array_push($vips, $this->_buyer);

        // find the vips
        foreach ($this->_guests as $guest)
            if ($guest->vip) array_push($vips, $guest);


        // return the array
        return $vips; 
    }

    public function members() {
        // get the very important people
        $members = array();

        // we may also be a vip
        if ($this->_buyer->member) array_push($members, $this->_buyer);

        // find the vips
        foreach ($this->_guests as $guest)
            if ($guest->member) array_push($members, $guest);

        // return the array
        return $members; 
    }

    /**
     *  Retrieve the guest arrays
     */
    public function guests() { return $this->_guests; }

    /**
     *  Amount of guests/vips
     */
    public function nguests() { return count($this->_guests); }
    public function nvips() { return count($this->vips()); }
    public function sguests() { return (string) new NameList($this->_guests); }
    public function svips() { return (string) new NameList($this->vips()); }
    public function sprice() { return number_format($this->price() / 100.0, 2, ",", "."); }

    /**
     *  Retrieve the buyers email
     */
    public function email() { return $this->_email; }

    /**
     *  Retrieve whether or not payment had been made
     */
    public function paid() { return $this->_paid; }
    
    /**
     *  Retrieve the hash.
     */
    public function hash() { return $this->_hash; }

    /**
     *  Retrieve the buyer info
     */
    public function buyer() { return $this->_buyer; }

    /**
     *  Retrieve the confirmation info
     */
    public function confirmed() { return $this->_confirmed; }

    /**
     *  Retrieve the confirmation info
     */
    public function payconfirmed() { return $this->_payconfirmed; }

    /**
     *  Send the confirmation email.
     */
    public function confirm() {
        // create the template renderer
        $tpl = new TemplateRenderer;

        // assgign the registration value
        $tpl->assign('registration', $this);

        // simply message, might fail
        if (!$this->message("Gala Ticket", $tpl->str('confirm-registration-html'), $tpl->str('confirm-registration-txt'))) return;

        // now confirmed
        $this->_confirmed = true;

        // we should store
        $this->store();
    }

    /**
     *  Confirm that the payment has been received.
     */
    public function confirm_payment() {
        // create the template renderer
        $tpl = new TemplateRenderer;

        // assgign the registration value
        $tpl->assign('registration', $this);

        // simply message, might fail
        if (!$this->message("Payment Confirmation", $tpl->str('confirm-payment-html'), $tpl->str('confirm-payment-txt'))) return;

        // now confirmed
        $this->_payconfirmed = true;

        // we should store
        $this->store();
    }
    
    /**
     *  Payment has been made.
     */
    public function hasPaid() {
        // do nothing if already paid
        if ($this->_paid) return;

        // the payment has been made
        $this->_paid = true;
        
        // get a database connection
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

        // make the statement
        $stmt = $dbh->prepare("UPDATE registrations SET paid = true WHERE hash = :hash");

        // run the statement
        $stmt->bindParam(":hash", $this->_hash);
        $stmt->execute();
    }

    /**
     *  Generic mail function from eindfeecie
     */
    public function message($subject, $body, $alt) { 
        // make the mailer
        $mail = new PHPMailer;  

        $mail->IsSMTP();                                      // Set mailer to use SMTP
        $mail->IsHTML();
        $mail->Host = RELAY_EMAIL_SMTP;                       // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = RELAY_EMAIL_USER;                   // SMTP username
        $mail->Password = RELAY_EMAIL_PASSWORD;               // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = RELAY_EMAIL_PORT;                       // TCP port to connect to
        $mail->Priority = 1;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = '8bit';
        
        $mail->setFrom(EMAIL_FROM, EMAIL_FROM_NAME);
        $mail->addAddress($this->_email, $this->_buyer->name);     // Add a recipient
        $mail->addReplyTo(RELAY_EMAIL_USER, EMAIL_FROM_NAME);
        $mail->isHTML(true);                                  // Set email format to HTML

        // set the subject and body
        $mail->Subject = $subject;
        $mail->Body    = (string) new HtmlEmailBuilder($body);
        $mail->AltBody = $alt;

        // send the mail
        $mail->Send();
        $mail->SmtpClose();
        
        // send the mail
        return $mail->IsError();
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
    
        // reconstruct from the json
        $reg = new Registration(json_decode($res["json"], true), true);
    
        // correct the payment info from the result
        $reg->_paid = $res['paid'];

        // set the hash
        $reg->_hash = $id;

        // get the registration
        return $reg;
    } 

    /**
     *  Give json_encode correct output
     */
    public function jsonSerialize() {
        // serialize it to the correct form 
        return array_merge(json_decode(json_encode($this->buyer()), true), array("guests" => $this->_guests, "email" => $this->_email, "paid" => $this->_paid, "confirmed" => $this->_confirmed, "payconfirmed" => $this->_payconfirmed));
    }

    public function price() {
        $p = 0;
        foreach ($this->_guests as $guest) {
            $p += $guest->price();
        }
        return $p + $this->_buyer->price();
    }
}



