<?php

/**
 *  register.php
 *
 *  Register an user.
 *
 *  @author Michael van der Werve
 *  @copyright 2016
 */

require_once 'autoload.php';

// if the data is not set, we should stop immediately
if (!isset($_POST['data'])) die('no data');

// get the users from the data, it should be a json array
$users = json_decode((string)$_POST['data'], true);

// create the registration, this will validate
$registration = new Registration($users);
$registration->store();

// for some reason, this works better?
$reg = Registration::get($registration->hash());
$reg->confirm();

// for now, stringify the registration
echo (string) $registration;
