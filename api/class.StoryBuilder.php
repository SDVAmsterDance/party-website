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

    public function english($registration, $web, $payment) {
        $this->str = "<div class='story-internal'>";
        $this->str .= "<b><div class=\"calligraphy love\">D</div>ear ";
        $this->str .= htmlentities($registration->buyer()->name, ENT_QUOTES);
        $this->str .= "</b>,<br>";

        $this->str .= "<div class=\"story-internal\">We are happy to see that you are interested in our event! With this email we confirm your ticket reservation for the \"Arabian Nights Gala\" for you";

        $price = sprintf('&euro; %.2f', $registration->price() / 100.0);
        $guestamount = count($registration->guests());
        $this->str .= $guestamount > 0 ? ($guestamount == 1 ? " and your guest." : " and your guests. ") : ".";
    
        if ($guestamount > 0) {
            $this->str .= ($guestamount == 1) ?  " Your guest, " : " Your guests, ";
            $this->str .= (string) new NameList($registration->guests());
            $this->str .= " shall accompany you.";
        }
        
        if ($registration->buyer()->vip) $this->str .= " You shall receive VIP treatment.";
        $this->str .= '</div>';  

        $payment = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">T</div>o complete your reservation, please transfer <p class="love">&euro; $price</p> to account number <p class="love">NL72 ABNA 0455257221</p> in the name of SDV AmsterDance. Please state your name and "Gala 2017" in the description.
		Thank you very much!
		</div>
HTML;
        $paid = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">Y</div>our payment of <p class="love">&euro; $price</p> has been received in good order. We look forward to seeing you at the gala! 
		</div>
HTML;

        $this->str .= ($registration->paid() ? $paid : $payment);

        $this->str .= <<<HTML
        <div class="story-internal">
	    Please be aware that if you do not transfer the amount before the 9th of february at 23:59, your reservation will be cancelled. After the cancellation, you can still buy a ticket at the door (unless the event is sold out). A ticket at the door will cost &euro; 17,50.  
		</div>
        <div class="story-internal">
        We wish you a magical evening at the Arabian Nights Gala!
        </div>
        <div class="story-internal">
        Kind regards,
        </div>
        <div class="story-internal">
        Andriy, Helena, Marjolein, Philine and Tom<br>
        GalaCie Commissie 2016 - 2017
        </div>
HTML;

        $hash = $registration->hash();

        $html = <<<HTML
        <div class="story-internal">
		<a href='https://gala-amsterdance.tk/email.php?registration=$hash'><div class="calligraphy love">C</div>lick here for a webversion!</div></a>
HTML;

        // if this is the mail version, we want to link to the webversion 
        if (!$web) {
            $this->str .= $html;
        }
        } else {
            $hash = $registration->hash();
            $this->str .= "your payment has been received in full. Thank you! We look forward to your attendance, your registration is available <a href='https://gala-amsterdance.tk/email.php?registration=$hash' class='love'>here</a>.";
        }
    }

    public function __construct($registration, $web, $payment) {
        
    }

    public function __toString() {
        return $this->str;
    }
}


