<?php
include("inc/config.inc.php");
include("models/Model_db.php");
Model_db::getInstance()
		->setParam(HOST, DBNAME, USER, PASSWORD);
?>
