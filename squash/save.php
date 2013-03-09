<?php
include("inc/protection.inc.php");
unset($_POST["Zarezervovat"]);
$string = "";
$id_user = gpc_addslashes($_POST["id_user"]);
$id_place = 1; //nebo pozmenit v databazi ze muze bzt null
unset($_POST["id_user"]);

include("inc/booking_system.class.php");	

$database->connect();
foreach ($_POST as $value)
{
	$serie_and_seat = explode("_", $value );
	$serie = gpc_addslashes($serie_and_seat[1]);
	$seat = gpc_addslashes($serie_and_seat[0]);
	
	$database->bookSeats($id_place, $id_user, $serie, $seat);//->query($query);
	
}
$database->disconnect();

header('Location: preview.php');

?>