<?php

// we need the registration
require_once "api/autoload.php";

// make sure the registration is set
if (!isset($_GET['registration'])) die('Registration not Found');
$text = isset($_GET['text']);

// get the actual registration
$registration = Registration::get($_GET['registration']);

// get the emplate engine
$tpl = new TemplateRenderer;

// make sure the registration exists
if ($registration != null && !$text) {
	// assign the registration
	$tpl->assign('registration', $registration);
    
	// get the email needed
	if ($registration->paid()) $tpl->render('confirm-payment-html');
	else $tpl->render('confirm-registration-html');
} else {
	// registration was not found...
	$tpl->render('registration-not-found');
} 