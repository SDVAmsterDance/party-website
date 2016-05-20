<?php

require_once 'api/autoload.php';

if (isset($_GET['paid'])) {
    $reg = Registration::get($_GET['paid']);
    $reg->hasPaid();
}

// get the registrations
$regs = new Registrations;

function paymentlink($reg) {
    $hash = $reg->hash();
    return $reg->paid() ? "Yes" : "<a href='admin.php?paid=$hash'>Check</a>"; 
}

echo "<table>";
echo "<tr><td>Buyer</td><td>Mail</td><td>Guests</td><td>Price</td><td>Paid</td></tr>";
foreach ($regs->arr() as $reg) {
    echo sprintf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%.2f</td><td>%s</td></tr>", $reg->buyer()->repr(), $reg->email(), (string) new NameList($reg->guests()), $reg->price()/100, paymentlink($reg));
}
echo "</table>";
?>
