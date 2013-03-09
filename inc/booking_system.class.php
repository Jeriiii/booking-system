<?php
include("inc/config.inc.php");
include("models/BookingSystemDatabase.php");
$database = new BookingSystemDatabase();
$database->setParam(HOST, DBNAME, USER, PASSWORD);
?>
