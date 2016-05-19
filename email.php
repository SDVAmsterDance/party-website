<?php

// we need the registration
require_once "api/class.Registration.php";
require_once "api/class.NameList.php";
require_once "api/class.StoryBuilder.php";

if (!isset($_GET['registration'])) die('Registration not Found');

// make that actual registration
$registration = Registration::get($_GET['registration']);

// confirm it
$registration->confirm();

// make the email
$email = new EmailBuilder($registration, false);

// simply echo the email
echo (string) $email;

?>
