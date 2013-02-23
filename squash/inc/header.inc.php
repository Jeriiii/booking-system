<?php
$directory = dirname(__FILE__);

$bootstrapPath = "PFBC/Resources/bootstrap/";
if(strpos(getcwd(), "/examples") !== false) {
	$bootstrapPath = "../" . $bootstrapPath;
	$examplePath = "";
	$indexPath = "../index.php";
}
else {
	$examplePath = "examples/";
	$indexPath = "";
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Kapitola 6</title>
<!--		<link href="<?php echo $bootstrapPath; ?>css/bootstrap.min.css" rel="stylesheet" />
		<link href="<?php echo $bootstrapPath; ?>css/bootstrap-responsive.min.css" rel="stylesheet" />-->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<!-- styly pro token-input -->
		<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
		<!-- slideshow -->
		<link rel="stylesheet" href="css/slideshow/default/default.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/slideshow/light/light.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/slideshow/dark/dark.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/slideshow/bar/bar.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/slideshow/nivo-slider.css" type="text/css" media="screen" />
	</head>
	<body>
		<div class="container-fluid">
		<?php if(isset($message)) echo $message?>