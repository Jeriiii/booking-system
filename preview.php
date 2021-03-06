<?php
session_start();
include("inc/message.inc.php");
include("inc/authorization.inc.php");

include("inc/header.inc.php");

$active = "preview.php";
include('inc/navigation.inc.php');
echo $navigation;

echo "<h2>Zarezervovaná sedadla:</h2></header><section>";
echo "<table class='table'>";
echo "<thead><th>sál</th><th>řada</th><th>sedadlo</th></thead>";

include("inc/booking_system.class.php");
$database->connect();
$elements = $database->userReservedSeats($_SESSION["booking-system"]["id_user"]);
$database->disconnect();

while($element = $elements->fetch())
{
	echo "<tr>";
	echo	"<td>" . $element->id_place . "</td>
		<td>" . $element->serie_number . "</td>
		<td>" . $element->element_number . "</td><td>
		<a class='btn btn-danger' href='cancel_reservation.php?id_element=" . $element->id . "'>zrušit rezervaci</a></td>";
	echo "</tr>";
}

echo "</table>";
?>
