<?php

/**
 *  status.php
 *
 *  This will serve as a simple counter - how many possible normal and VIP tickets are left.
 *
 *  @author Michael van der Werve
 */

require_once 'config.php';

// get a database connection
$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_DATABASE, DB_USER, DB_PASSWORD);  

$regular = 0;
$vips = 0;

// make the statement
foreach ($dbh->query("SELECT SUM(guests) + COUNT(id) AS regular, SUM(vips) as vip FROM registrations", PDO::FETCH_ASSOC) as $row) {
    $regular += $row['regular'];
    $vips += $row['vip'];
}

// return the amount of tickets left
echo json_encode(array("regular" => (70 - $regular), "vip" => min(10 - $vips, 70 - $regular)));
