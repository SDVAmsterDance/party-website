<?php

require_once '../api/autoload.php';

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

function yn($bool) {
    return $bool ? "Yes" : "No";
}

echo "<table>";
echo "<tr><td>Guest</td><td>Price</td><td>Vip</td><td>Paid</td></tr>";
foreach ($guests as $name => $arr) {
    $guest = $arr[0];
    $paid = $arr[1];
    echo sprintf("<tr><td>%s</td><td>%.2f</td><td>%s</td><td>%s</td></tr>", $guest->name, $guest->price()/100, yn($guest->vip), yn($paid));
}
echo "</table>";
?>
