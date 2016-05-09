<?php

/**
 *  register.php
 *
 *  Register an user.
 *
 *  @author Michael van der Werve
 *  @copyright 2016
 */

require_once "class.Registration.php";

// if the data is not set, we should stop immediately
if (!isset($_POST['data'])) die('no data');

// get the users from the data, it should be a json array
$users = json_decode($_POST['data'], true);

// create the registration, this will validate
$registration = new Registration($users);
$registration->store();

echo (string) $registration;
