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

    public function dutch($registration, $web, $payment) {
        $this->str .= "<b><div class=\"calligraphy love\">G</div>eachte ";
        $this->str .= htmlentities($registration->buyer()->name, ENT_QUOTES);
        $this->str .= "</b>,<br><br>";

        $this->str .= "<div class=\"story-internal\">We zijn blij te horen dat je interesse hebt in ons evenement. Met deze mail bevestigen wij de reservering voor ";

        $price = sprintf('&euro; %.2f', $registration->price() / 100.0);
        $guestamount = count($registration->guests());
        $this->str .= $guestamount > 0 ? ($guestamount == 1 ? " jij en je gast." : " jij en je gaster. ") : " jou.";
        $this->str .= "<br><br>";

        if ($guestamount > 0) {
            $this->str .= ($guestamount == 1) ?  " Your guest, " : " Your guests, ";
            $this->str .= (string) new NameList($registration->guests());
            $this->str .= " shall accompany you.";
        }
        
        if ($registration->buyer()->vip) $this->str .= " Je zult VIP behandeling ontvangen.";
        $this->str .= '</div>';  

        $payment = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">O</div>m je reservering definitief te maken, maak <p class="love">$price</p> over naar <p class="love">NL72 ABNA 0455257221</p> ter name van SDV AmsterDance, onder vermelding van je naam en "Gala 2017".
		</div>
        <br>
        <div class="story-internal">
        Mocht je het geld niet hebben overgemaakt voor 9 februari 23:59, dan gaat je reservering verloren. Natuurlijk kan je dan nog wel een kaartje kopen aan de deur voor &euro; 17,50 (indien er nog kaarten beschikbaar zijn).
        </div>
HTML;

        $paid = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">J</div>e betaling van <p class="love">$price</p> is ontvangen.  
		</div>
HTML;

        $this->str .= ($registration->paid() ? $paid : $payment);

        $this->str .= <<<HTML
        <br>
        <div class="story-internal">
        <div class="calligraphy love">W</div>e wensen je veel plezier tijdens het Arabian Nights gala!
        </div>
        <br>
        <div class="story-internal">
        <div class="calligraphy love">D</div>ansende groeten,
        </div>
        <div class="story-internal">
        Andriy, Helena, Marjolein, Philine en Tom<br>
        GalaCie Commissie 2016 - 2017<br>
        SDV AmsterDance<br>
        </div>
HTML;
    }

    public function english($registration, $web, $payment) {
        $this->str .= "<b><div class=\"calligraphy love\">D</div>ear ";
        $this->str .= htmlentities($registration->buyer()->name, ENT_QUOTES);
        $this->str .= "</b>,<br><br>";

        $this->str .= "<div class=\"story-internal\">We are happy to see that you are interested in our event! With this email we confirm your ticket reservation for the Arabian Nights Gala for you";

        $price = sprintf('&euro; %.2f', $registration->price() / 100.0);
        $guestamount = count($registration->guests());
        $this->str .= $guestamount > 0 ? ($guestamount == 1 ? " and your guest." : " and your guests. ") : ".";
        $this->str .= "<br><br>";

        if ($guestamount > 0) {
            $this->str .= ($guestamount == 1) ?  " Your guest, " : " Your guests, ";
            $this->str .= (string) new NameList($registration->guests());
            $this->str .= " shall accompany you.";
        }
        
        if ($registration->buyer()->vip) $this->str .= " You shall receive VIP treatment.";
        $this->str .= '</div>';  

        $payment = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">T</div>o complete your reservation, please transfer <p class="love">$price</p> to account number <p class="love">NL72 ABNA 0455257221</p> in the name of SDV AmsterDance. Please state your name and "Gala 2017" in the description.
		Thank you very much!
		</div>
        <br>
        <div class="story-internal">
        Please be aware that if you do not transfer the amount before the 9th of february at 23:59, your reservation will be cancelled. After the cancellation, you can still buy a ticket at the door (unless the event is sold out). A ticket at the door will cost &euro; 17,50.
        </div>
HTML;
        $paid = <<<HTML
        <div class="story-internal">
		<div class="calligraphy love">Y</div>our payment of <p class="love">&euro; $price</p> has been received in good order. We look forward to seeing you at the gala! 
		</div>
HTML;

        $this->str .= ($registration->paid() ? $paid : $payment);

        $this->str .= <<<HTML
        <br>
        <div class="story-internal">
        <div class="calligraphy love">W</div>e wish you a magical evening at the Arabian Nights Gala!
        </div>
        <br>
        <div class="story-internal">
        <div class="calligraphy love">K</div>ind regards,
        </div>
        <div class="story-internal">
        Andriy, Helena, Marjolein, Philine and Tom<br>
        GalaCie Commissie 2016 - 2017<br>
        SDV AmsterDance<br>
        </div>
HTML;
    }

    public function __construct($registration, $web, $payment) {
        $this->str .= "English follows Dutch";
        $this->str .= "<hr>";
        $this->dutch($registration, $web, $payment);
        $this->str .= "<hr>";
        $this->english($registration, $web, $payment);
        $this->str .= "<hr>";
        
        $hash = $registration->hash();
        $html = <<<HTML
        <br>
        <div class="story-internal">
        <center>
		<a href='https://gala-amsterdance.tk/email.php?registration=$hash'><div class="calligraphy love"><u>Webversion</u></div></a></center></div><br><br>
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


