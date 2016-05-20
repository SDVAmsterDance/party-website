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

    public function __construct($registration, $web) {
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
		We will expect you at the <p class="love">Grand Cafe Frankendael</p>, Amsterdam at on the 24th of June at approximately 20:00. The ball will end 
		at <p class="love">midnight</p>, so Cinderella can stay until the very end too! 
		</div>
HTML;

        $payment = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">W</div>ould you like to transfer the <p class="love">$price</p> you owe us to the bank account SDV Amsterdance <p class="love">NL72ABNA0455257221</p> and mention your name and the subject of the transfer (EindfeeCie)?
		Thank you very much!
		</div>
HTML;
        $paid = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">Y</div>our payment of <p class="love">$price</p> has been received in good order. We look forward to seeing you at the ball! 
		</div>
HTML;

        $this->str .= $story;
        $this->str .= ($registration->paid() ? $paid : $payment);
        
        $hash = $registration->hash();

        $html = <<<HTML
        <div class="story-internal">
		<a href='https://eindfeecie.tk/email.php?registration=$hash'><div class="calligraphy love">C</div>lick here for a webversion!</div></a>
HTML;

        // if this is the mail version, we want to link to the webversion 
        if (!$web) {
            $this->str .= $html;
        }
    }

    public function __toString() {
        return $this->str;
    }
}


