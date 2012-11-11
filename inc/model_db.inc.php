<?php
include("inc/config.inc.php");
include("models/Model_db.php");
Model_db::getInstance()
		->setParam($host, $dbname, $user, $password);
?>
