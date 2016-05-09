<?php

/**
 *  class.Person.php
 *
 *  The person class, utility
 *
 *  @author Michael van der Werve
 */

class Person implements JsonSerializable {
    /**
     *  The name of the person
     */
    public $name = null; 
    
    /**
     *  Whether or not the person is a member
     */
    public $member = null;

    /**
     *  Whether or not person wants VIP treatment
     */
    public $vip = null;
    
    /**
     *  Construct the object from the initial data.
     */
    function __construct($arr) {
        $this->name = isset($arr['name']) ? substr((string)$arr["name"], 0, 32) : "";
        $this->member = $arr["member"] == true;
        $this->vip = $arr["vip"] == true;   
    
        // make sure the name is filled out, otherwise die
        if (strlen($this->name) < 3) die('empty field');
    }
    
    /**
     *  String casting operator
     */
    function __toString() {
        return sprintf("%s (member: %b, vip: %b)", $this->name, $this->member, $this->vip);
    }
    
    /**
     *  Serialize the json
     */
    public function jsonSerialize() {
        // serialize it to the correct form
        return array("name" => $this->name, "member" => $this->member, "vip" => $this->vip); 
    }
}
