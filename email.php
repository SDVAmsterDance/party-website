<?php

// we need the registration
require_once "api/class.Registration.php";
require_once "api/class.NameList.php";
require_once "api/class.StoryBuilder.php";

if (!isset($_GET['registration'])) die('Registration not Found');

// make that actual registration
$registration = Registration::get($_GET['registration']);
	
?>
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
		<?php echo new StoryBuilder($registration); ?>at the <p class="love">Royal Disney Ball</p>. <?php echo count($registration->vips()); ?>  of your
		guests want/wants to be treated royally and <?php echo count($registration->members()); ?> of your guests are/is a member.  
		 We will expect you at the <p class="love">Grand Cafe Frankendael</p>, Amsterdam at approximately 20:00. The ball will end 
		at <p class="love">midnight</p>, so Cinderella can stay untill the very end. 
		</div>
		<div class="story-internal">
		<div class="calligraphy love">W</div>ould you like to store the <p class="love">€<?php echo sprintf("%.2f", $registration->price()/100.0); ?></p> you owe us to the bank account SDV Amsterdance <p class="love">NL72ABNA0455257221</p> and mention your name and the subject of the transfer (EindfeeCie)?
		Thank you very much!
		</div>
	</div>	
	
</div>
</div>
</div>

</body>
</html>
