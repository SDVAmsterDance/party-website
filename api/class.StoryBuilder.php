<?php

/**
 * class.Namelist.php
 * 
 * @author Michael van der Werve
 * @author Brechje Boeklagen
 */
 
 
 class StoryBuilder {
     
     private $str;
     
     public function __construct($registration) {
        $this->str = "<b><div class=\"calligraphy love\">D</div>ear ";
        $this->str .= $registration->buyer()->name;
        $this->str .= "</b>, it will be an honour to receive you and your guests. ";
        if ($registration->buyer()->vip) $this->str .= "You shall be treated royally.";
        
        $this->str .= sprintf("Your guests, %s, shall accompany you.", new NameList($registration->guests()));
        
     }
     
     public function __toString() {
         return $this->str;
     }
 }
 
 
