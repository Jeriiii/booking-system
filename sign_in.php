<?php
session_start();
error_reporting(E_ALL);

include("PFBC/Form.php");

if(isset($_POST["form"])) {
	PFBC\Form::isValid($_POST["form"]);
	if (isset($_POST["mail"])) {
		include("inc/model_db.inc.php");
		
		$exist_user = Model_db::getInstance()
						->query("SELECT id FROM ". TABLE_USERS . " WHERE email = '" . $_POST["mail"] . "' AND password = '" . md5($_POST["password"]) . "'")
						->fetch();
		
		if ($exist_user) {
			session_regenerate_id(); // ochrana před Session Fixation
			$_SESSION["booking-system"]["logged"] = true;
			$_SESSION["booking-system"]["id_user"] = $exist_user->id;
			header("Location: " . $_SERVER["PHP_SELF"] . "/../index.php");
			exit();
		}else{
			$_SESSION["booking-system"]["message"] = "Uživatelské jméno nebo heslo je chybné.";
			$_SESSION["booking-system"]["message_type"] = "error";
		}
	}	
}
if (isset($_SESSION["booking-system"]["logged"])) {
	header("Location: index.php");
}

include("inc/message.inc.php");
include("inc/header.inc.php");

$active = "sign_in.php";
include('inc/navigation.inc.php');
echo $navigation;

$form = new PFBC\Form("login");
$form->addElement(new PFBC\Element\HTML('<legend>Přihlášení</legend></header><section>'));
$form->addElement(new PFBC\Element\Hidden("form", "login"));
$form->addElement(new PFBC\Element\Textbox("Emailová adresa:", "mail", array("required" => 1)));
$form->addElement(new PFBC\Element\Password("Heslo:", "password", array("required" => 1)));
$form->addElement(new PFBC\Element\Button("Přihlášení"));
$form->render();
?>

nejsteli zaregistrovaní, <a href="registration.php">registrujte se nyní</a><br />
testovací uživatel - jméno a heslo je: test


<?php include("inc/foot.inc.php");