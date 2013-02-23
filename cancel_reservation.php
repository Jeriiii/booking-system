<?php
include("inc/model_db.inc.php");

Model_db::getInstance()
	->query("DELETE FROM " . TABLE_RESERVED_ELEMENTS . " WHERE id = '" . gpc_addslashes($_GET["id_element"]) . "'");

header('Location: preview.php');
?>
