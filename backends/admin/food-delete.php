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

if (!isset($_REQUEST['id'])) {

	$_SESSION['msg'] = 'Invalid ID!';

	header('location: ../../admin/food-list.php');

	exit();
}

$id = $_REQUEST['id'];

$targetDir = "../../images/";

$select = mysqli_query($db, "SELECT * FROM food WHERE id = '$id'");
$fetch = mysqli_fetch_assoc($select);
$gambarold = $fetch['filename'];
unlink($targetDir . $gambarold);

$sql = "DELETE FROM food WHERE id = ?";
$lanjut = mysqli_query($db, "ALTER TABLE food AUTO_INCREMENT = 0");
$query  = $pdoconn->prepare($sql);
if ($query->execute([$id])) {

	$_SESSION['msg'] = 'Category Deleted!';

	header('location: ../../admin/food-list.php');
} else {

	$_SESSION['msg'] = 'There were some problem in the server! Please try again after some time!';

	header('location: ../../admin/food-list.php');
}
