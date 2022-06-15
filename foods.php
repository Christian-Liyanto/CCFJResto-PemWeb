<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>CCFJResto - Foods!</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- <meta http-equiv="refresh" content="1"> -->

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Bree+Serif&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<link rel="stylesheet" href="css/style.css">

	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


</head>

<body>

	<?php require('frontend/login-modal.php'); ?>


	<?php require('frontend/register-modal.php'); ?>


	<?php require('frontend/info-modal.php'); ?>


	<?php require('frontend/navbar.php'); ?>


	<?php require('frontend/banner-slider.php'); ?>


	<?php require('frontend/foods.php'); ?>


	<?php require('frontend/drinks.php'); ?>


	<?php require('frontend/footer.php'); ?>


	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

	<script src="js/loaders.js"></script>
	<script src="js/ajax.js"></script>
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>
		AOS.init();
	</script>
</body>

</html>