<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../css/basis.css"/>
    <meta charset="ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="wrapper">
<div id="parchment">
<div id="content">
    <br><br>
    <div id="banner-title">
        <div id="title-presents"> SDV AmsterDance presents...</div>
        <div id="title">Arabian Nights Ballroom Gala</div>
        <div id="date">10th of February, 2017</div>
        <div id="time">Rhone Events: Humberweg 5, Amsterdam. 20:00 - 0:30</div>
    </div>
    
    <div class="stories clearfix">
    <div class="story"> 
        English follows Dutch
        
        <br><hr><br>

        <div class="story-internal">
            <b><div class="calligraphy love">G</div>eachte {$registration->buyer()->name}</b>,
        </div><br><br>
        
        <div class="story-internal">
            We zijn blij te horen dat je interesse hebt in ons evenement. Met deze mail bevestigen wij je reservering. 
        </div><br><br>   

        <div class="story-internal">
            <div class="calligraphy love">J</div>e reservering bevat een kaartje {if $registration->buyer()->member}met{else}zonder{/if} lidmaatschap{if $registration->buyer()->vip} en met behandeling als een Sultan{/if}.{if $registration->nguests() > 0} Daarnaast bevat de reservering kaartjes voor {$registration->sguests()}{if $registration->nvips() > 0} waarbij {$registration->svips()} behandeld {if $registration->nvips() == 1}zal{else}zullen{/if} worden als een Sultan{/if}{/if}.
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">O</div>m je reservering definitief te maken, maak <p class="love">&euro; {$registration->sprice()}</p> over naar <p class="love">NL72 ABNA 0455 2572 21</p> ter name van SDV AmsterDance, onder vermelding van "Gala 2017 - {$registration->buyer()->name|escape:'htmlall'}".
		</div><br><br>

        <div class="story-internal">
            Mocht je het geld niet hebben overgemaakt voor 9 februari 23:59, dan gaat je reservering verloren. Natuurlijk kan je dan nog wel een kaartje kopen aan de deur voor &euro; 17,50 (indien er nog kaarten beschikbaar zijn).
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">D</div>ansende groeten,<br>
            Andriy, Helena, Marjolein, Philine en Tom<br>
            GalaCie Commissie 2016 - 2017<br>
            SDV AmsterDance<br>
        </div>
        
        <br><hr><br>

        <div class="story-internal">
            <b><div class="calligraphy love">D</div>ear {$registration->buyer()->name|escape:'htmlall'}</b>,
        </div><br><br>
    
        <div class="story-internal">
            We are happy to see that you are interested in our event! With this email we confirm your reservation for the Arabian Nights Gala.
        </div><br><br>
        
        <div class="story-internal">
            <div class="calligraphy love">Y</div>our reservation contains a ticket {if $registration->buyer()->member}with{else}without{/if} membership{if $registration->buyer()->vip} and with Sultan treatment{/if}.{if $registration->nguests() > 0} Additionally, your reservation contains tickets for {$registration->sguests()}{if $registration->nvips() > 0} of which {$registration->svips()} shall be treated {if $registration->nvips() == 1}as a Sultan{else}as Sultans{/if}{/if}{/if}.
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">T</div>o complete your reservation, please transfer <p class="love">&euro; {$registration->sprice()}</p> to account number <p class="love">NL72 ABNA 0455 2572 21</p> in the name of SDV AmsterDance. Please state "Gala 2017 - {$registration->buyer()->name|escape:'htmlall'}" in the description. Thank you very much!
		</div><br><br>

        <div class="story-internal">
            Please be aware that if you do not transfer the amount before the 9th of february at 23:59, your reservation will be cancelled. After the cancellation, you can still buy a ticket at the door (unless the event is sold out). A ticket at the door will cost &euro; 17,50.
        </div><br><br>

        <div class="story-internal">
            <div class="calligraphy love">K</div>ind regards,<br<
            Andriy, Helena, Marjolein, Philine and Tom<br>
            GalaCie Commissie 2016 - 2017<br>
            SDV AmsterDance<br>
        </div>

        <br><hr><br>
        <center><a class="love" href="https://localhost/email.php?registration={$registration->hash()}">Webversion</a></center><br><br>
    </div>	
</div>
</div>
</div>

</body>
</html>