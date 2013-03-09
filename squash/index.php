<?php 
	session_start();
	include("inc/message.inc.php");
	include("inc/authorization.inc.php");
	$input = 1;
	
	include("inc/header.inc.php");
	
	include("inc/booking_system.class.php");
	$database->connect();
	$input_file = $database->loadInputFromFile($input);
	$database->disconnect();
	$active = "index.php";
	include('inc/navigation.inc.php');
	echo $navigation;
	echo "<legend>Výběr místa</legend></header><section>";
?>
	<div id="json">
		<?php 
			$database->connect();
			$json = $database->loadAllSeatsFromDatabaseJSON($input);
			$database->disconnect();
			echo $json;
		?>
	</div>
	<div id="xls">
		<?php 
			$filename = "data/" . $input_file;
			if(file_exists ($filename))
				echo file_get_contents($filename);
			else
				die("Vstupní soubor nebyl nalezen");
		?>
	</div>
		<div id="reserved_system">
			<div id="left"></div>
			<div id="middle">
				<div id="head"></div>
				<div id="cinema"></div>
				<div id="foot"></div>
			</div>
			<div id="right"></div>
			<div style="clear: both"></div>
		</div>
		<div id="reserved"><ul>
			<?php
				$place = 1;

				$database->connect();
				$elements = $database->loadReservedSeatsFromDatabase($place);
				$database->disconnect();
				while ($reserved = $elements->fetch())
				{
					echo "<li>" . $reserved->element_number . "_" . $reserved->serie_number . "</li>";
				}
			?>
		</ul></div>
		<div id="selected">
			<form action="save.php" method="post">
				<input type="hidden" name="id_user" value="<?php echo $_SESSION["booking-system"]["id_user"] ?>" />
				<div class="span3 offset12"><input type='submit' value='Zarezervovat' class="bnt btn-large btn-success" /></div>
			</form>
		</div>

		<script type="text/JavaScript" src="js/jquery.js"></script>
		<script type="text/JavaScript" src="js/jquery.cinemaPlugin.js"></script>	
		<script type="text/JavaScript" src="js/test.js"></script>
		
<?php include("inc/foot.inc.php");