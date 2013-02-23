<?php
include("inc/model_db.inc.php");

Model_db::getInstance()->cancelReservation($_GET["id_element"]);

header('Location: preview.php');
?>
