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
            <b><div class="calligraphy love">G</div>eachte {$registration->buyer()->name|escape:'htmlall'}</b>,
        </div><br><br>

        <div class="story-internal">
            Je betaling van <div class="love">&euro; {$registration->sprice()}</div> is in goede orde ontvangen en je reservering staat hierbij vast. 
        </div><br><br>

        <div class="story-internal">
            We wensen je veel plezier tijdens het Arabian Nights Gala!
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
            Your payment of <div class="love">&euro; {$registration->sprice()}</div> has been fully received and your reservation has been fully confirmed.
        </div><br><br>
        
        <div class="story-internal">
            We wish you a magical evening at the Arabian Nights Gala!
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