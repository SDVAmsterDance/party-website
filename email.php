<!DOCTYPE html>
<html>
<head>
    <title>Disney Ball</title>
    <link rel="stylesheet" type="text/css" href="reset.css"/>
    <link rel="stylesheet" type="text/css" href="basis.css"/>
	<link rel="shortcut icon" type="image/png" href="slipper.jpg"/>
    <meta charset="ISO-8859-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="wrapper">
<div id="parchment">
<div id="content">
	
	<div id="banner-title">
		<div id="title-presents"> AmsterDance presents... </div>
		<div id="title">Your Very Own Royal Ticket</div>
	</div>
	
	<div class="stories clearfix">
	<div id="story-initial" class="story"> 
		<div class="story-internal">
		<b><div class="calligraphy love">D</div>ear <?php echo $registration->buyer(); ?>, </b> thank you for your registration. It will be an honour to receive you 
		and your guests at the <p class="love">Royal Disney Ball</p>. We will expect you at the <p class="love">Grand Cafe Frankendael</p>, Amsterdam at approximately 20:00. The ball will end 
		at <p class="love">midnight</p>, so Cinderella can stay untill the very end. 
		</div>
	</div>
	
	<div class="stories clearfix">
	<div id="story-initial" class="story"> 
		<div class="story-internal">
		<b><div class="calligraphy love">W</div>e hereby confirm your registration.<?php echo $registration->buyer(); ?>, </b> thank you for your registration. It will be an honour to receive you 
		and your guests at the <p class="love">Royal Disney Ball</p>. We will expect you at the <p class="love">Grand Cafe Frankendael</p>, Amsterdam at approximately 20:00. The ball will end 
		at <p class="love">midnight</p>, so Cinderella can stay untill the very end. 
		</div>
	</div>
	
	
</div>
</div>
</div>

</body>
</html>
