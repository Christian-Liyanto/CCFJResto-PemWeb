<?php

session_start();

include '../config.php';

try {

	if (!file_exists('../connection-pdo.php'))
		throw new Exception();
	else
		require_once('../connection-pdo.php');
} catch (Exception $e) {

	$_SESSION['msg'] = 'There were some problem in the Server! Try after some time!';

	header('location: ../../admin/food-list.php');

	exit();
}

if (!isset($_POST['name']) || !isset($_POST['desc'])) {

	$_SESSION['msg'] = 'Invalid POST variable keys! Refresh the page!';

	header('location: ../../admin/food-list.php');

	exit();
}

$regex = '/^[(A-Z)?(a-z)?(0-9)?\-?\_?\.?\s*]+$/';


if (!preg_match($regex, $_POST['name'])) {

	$_SESSION['msg'] = 'Whoa! Invalid Inputs!';

	header('location: ../../admin/food-list.php');

	exit();
} else {
	$statusmsg = '';

	$targetDir = "../../images/";

	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$price = $_POST['price'];
	$category = $_POST['category'];

	if (isset($_POST["submit"]) && isset($_FILES['file'])) {
		if (!empty($_FILES["file"]["name"])) {
			$filename = basename($_FILES["file"]["name"]);
			$targetFilePath = $targetDir . $filename;
			$find = mysqli_query($db, "SELECT filename FROM food WHERE filename = $filename");
			$rowcount = mysqli_num_rows($find);
			echo $rowcount;
			return $rowcount;
			if ($rowcount == 1) {
				//Upload file to server
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
					$sql = "INSERT INTO food(filename, fname, description, price, category) VALUES ('" . $filename . "', ?, ?, ?, ?)";
					$query = $pdoconn->prepare($sql);
					if ($query->execute([$name, $desc, $price, $category])) {
						$_SESSION['msg'] = 'Food Added!';
						header('location: ../../admin/food-list.php');
					} else {
						$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
						header('location: ../../admin/food-list.php');
					}
				}
			} else {
				echo '<script type="text/javascript">
						alert("Nama File Sudah Ada!");
						window.location = "../../admin/food-add.php";
					  </script>';
			}
		} else {
			$statusmsg = 'Please select a file to upload.';
		}
	}
}
