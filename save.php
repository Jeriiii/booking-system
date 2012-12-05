<?php
unset($_POST["Zarezervovat"]);
$string = "";
$id_user = $_POST["id_user"];
unset($_POST["id_user"]);

include("inc/model_db.inc.php");	

foreach ($_POST as $value)
{
	$serie_and_seat = explode("_", $value );
	$serie = $serie_and_seat[1];
	$seat = $serie_and_seat[0];
	
	$query = "
		INSERT INTO " . $TABLE_RESERVED_ELEMENTS . " (id_place, id_user, serie_number, element_number)
		VALUES (1," . $id_user . "," . $serie . ",". $seat ." );
	";
	
	Model_db::getInstance()->query($query);
	
}

header('Location: preview.php');

?>