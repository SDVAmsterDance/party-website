<?php

// we need the registration
require_once "api/class.Registration.php";
require_once "api/class.NameList.php";
require_once "api/class.StoryBuilder.php";

if (!isset($_GET['registration'])) die('Registration not Found');

// make that actual registration
$registration = Registration::get($_GET['registration']);

if ($registration != null) {
    // make the email
    $webversion = new EmailBuilder($registration, true);

    // simply echo the email
    echo (string) $webversion;
} else {
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
		<div id="title">OOPS!</div>
	</div>
	<div class="stories clearfix">
	<div id="story-initial" class="story"> 
		<div class="story-internal">
		<b><div class="love">Your</div> registration was not found!</b> If you think this is a mistake, please <a href="mailto:eindfeestamsterdance@gmail.com"><p class="love">contact us</p></a>!
		</div>
	</div>
</div>
</div>

</body>
</html>

<?php
}
?>
