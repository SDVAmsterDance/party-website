<?php

require_once 'api/autoload.php';

if (isset($_GET['paid'])) {
    $reg = Registration::get($_GET['paid']);
    $reg->hasPaid();
}

// get the registrations
$regs = new Registrations;

$guests = array();

foreach ($regs->arr() as $reg) {
    $guests[$reg->buyer()->name] = array($reg->buyer(), $reg->paid());
    foreach ($reg->guests() as $guest) {
        $guests[$guest->name] = array($guest, $reg->paid());
    }
}

ksort($guests);

echo "<table>";
echo "<tr><td>Guest</td><td>Price</td><td>Paid</td><td>Vip</td></tr>";
foreach ($guests as $name => $arr) {
    $guest = $arr[0];
    $paid = $arr[1];
    echo sprintf("<tr><td>%s</td><td>%.2f</td><td>%s</td><td>%s</td></tr>", $guest->name, $guest->price()/100, $guest->vip, $paid);
}
echo "</table>";
?>
