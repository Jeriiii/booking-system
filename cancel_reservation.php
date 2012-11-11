<?php
include("inc/model_db.inc.php");

Model_db::getInstance()
	->query("DELETE FROM elements WHERE id = '" . $_GET["id_element"] . "'");

header('Location: preview.php');
?>
