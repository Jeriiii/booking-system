<?php 
	session_start();
	include("inc/message.inc.php");
	include("inc/authorization.inc.php");
	$input = 1;
	
	include("inc/header.inc.php");
	
	include("inc/model_db.inc.php");
	$input_file = Model_db::getInstance()
			->query("SELECT file FROM " . $TABLE_PLACES . " WHERE id=" . $input)
			->fetch()
			->file;
	$active = "index.php";
	include('inc/navigation.inc.php');
	echo $navigation;
	echo "<legend>Výběr místa</legend></header><section>";
?>
	<div id="json">
		<?php 
			$json = Model_db::getInstance()
				->query("SELECT serie, type FROM " . $TABLE_INPUT_ELEMENTS_FOR_JSON)
				->getJSON();
			echo $json;
		?>
	</div>
	<div id="xls">
		<?php echo file_get_contents("data/" . $input_file);?>
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

				$elements = Model_db::getInstance()->query("SELECT * FROM " . $TABLE_RESERVED_ELEMENTS . " WHERE id_place=" . $place );
				while ($reserved = $elements->fetch())
				{
					echo "<li>" . $reserved->element_number . "_" . $reserved->serie_number . "</li>";
				}
			?>
		</ul></div>
		<div id="selected">
			<form action="save.php" method="post">
				<input type="hidden" name="id_user" value="<?php echo $_SESSION["id_user"] ?>" />
				<div class="span3 offset12"><input type='submit' value='Zarezervovat' class="bnt btn-large btn-success" /></div>
			</form>
		</div>

		<script type="text/JavaScript" src="js/jquery.js"></script>
		<script type="text/JavaScript" src="js/jquery.cinemaPlugin.js"></script>	
		<script type="text/JavaScript" src="js/test.js"></script>
		
<?php include("inc/foot.inc.php");