<?php

/**
 *  mail.php
 *
 *  Email all users that have not yet received their email.
 *
 *  @author Michael van der Werve
 *  @copyright 2016
 */

require_once dirname(dirname(__FILE__)) . '/api/autoload.php';

// get the registrations
$registrations = new Registrations;

// loop over all registrations
foreach ($registrations->arr() as $reg) {
    // if the registration is already confirmed, we can skip it! (or paid & not confirmed)
    if ($reg->confirmed() && (!$reg->paid() || $reg->payconfirmed())) continue;

    // we did a registration
    echo (string) $reg;

    // otherwise, we confirm it
    if (!$reg->confirmed()) $reg->confirm();
    
    // otherwise confirm the paymenf if it was made
    if ($reg->paid() && !$reg->payconfirmed()) $reg->confirm_payment();
}