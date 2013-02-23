<?php
include("inc/protection.inc.php");
unset($_POST["Zarezervovat"]);
$string = "";
$id_user = gpc_addslashes($_POST["id_user"]);
$id_place = gpc_addslashes($_POST["id_place"]);
unset($_POST["id_user"]);
unset($_POST["id_place"]);

include("inc/model_db.inc.php");	

foreach ($_POST as $value)
{
	$serie_and_seat = explode("_", $value );
	$serie = gpc_addslashes($serie_and_seat[1]);
	$seat = gpc_addslashes($serie_and_seat[0]);
	
	$query = "
		INSERT INTO " . TABLE_RESERVED_ELEMENTS . " (id_place, id_user, serie_number, element_number)
		VALUES (" . $id_place . "," . $id_user . "," . $serie . ",". $seat ." );
	";
	
	Model_db::getInstance()->query($query);
	
}

header('Location: preview.php');

?>