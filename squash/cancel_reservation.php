<?php
include("inc/booking_system.class.php");

$database->connect();
$database->cancelReservation($_GET["id_element"]);
$database->disconnect();

header('Location: preview.php');
?>
