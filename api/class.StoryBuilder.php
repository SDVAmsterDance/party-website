<?php

/**
 * class.Namelist.php
 * 
 * @author Michael van der Werve
 * @author Brechje Boeklagen
 */

require_once 'autoload.php';

class StoryBuilder {
    private $str;

    public function __construct($registration, $nomail) {
        $this->str = "<div class='story-internal'>";
        $this->str .= "<b><div class=\"calligraphy love\">D</div>ear ";
        $this->str .= $registration->buyer()->name;
        $this->str .= "</b>, it will be an honour to receive you";

        $price = sprintf('&euro; %.2f', $registration->price() / 100.0);
        $guestamount = count($registration->guests());
        $this->str .= $guestamount > 0 ? ($guestamount == 1 ? " and your guest." : " and your guests. ") : ".";
    
        if ($registration->buyer()->vip) $this->str .= "You shall be treated royally.";

        if ($guestamount > 0) {
            $this->str .= ($guestamount == 1) ?  " Your guest, " : " Your guests, ";
            $this->str .= (string) new NameList($registration->guests());
            $this->str .= " shall accompany you.";
        }

        $story = <<<HTML
		We will expect you at the <p class="love">Grand Cafe Frankendael</p>, Amsterdam at approximately 20:00. The ball will end 
		at <p class="love">midnight</p>, so Cinderella can stay untill the very end. 
		</div>
		<div class="story-internal">
		<div class="calligraphy love">W</div>ould you like to transfer the <p class="love">$price</p> you owe us to the bank account SDV Amsterdance <p class="love">NL72ABNA0455257221</p> and mention your name and the subject of the transfer (EindfeeCie)?
		Thank you very much!
		</div>
HTML;

        $this->str .= $story;
    }

    public function __toString() {
        return $this->str;
    }
}


