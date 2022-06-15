<?php


session_start();
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

	if (isset($_POST["submit"]) && isset($_FILES['file'])) {
		$name = $_POST['name'];
		$desc = $_POST['desc'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$id = $_GET['id'];

		if (!empty($_FILES["file"]["name"])) {
			$filename = basename($_FILES["file"]["name"]);
			$targetFilePath = $targetDir . $filename;
			//Upload file to server
			$select = mysqli_query($db, "SELECT * FROM food WHERE id = '$id'");
			$fetch = mysqli_fetch_assoc($select);
			$gambarold = $fetch['filename'];
			unlink($targetDir . $gambarold);
			if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
				$sql = "UPDATE food SET filename = '$filename', fname = '$name', category = '$category', description = '$desc', price = '$price' WHERE id = $id";
				$query = $pdoconn->prepare($sql);
				if ($query->execute([$filename, $name, $category, $desc, $price])) {
					$_SESSION['msg'] = 'Food Added!';
					header('location: ../../admin/food-list.php');
				} else {
					$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';
					header('location: ../../admin/food-list.php');
				}
			}
		} else {
			$statusmsg = 'Please select a file to upload.';
		}
	}
}
