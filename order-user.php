<?php

session_start();
try {

	if (!file_exists('backends/connection-pdo.php'))
		throw new Exception();
	else
		require_once('backends/connection-pdo.php');
} catch (Exception $e) {

	$_SESSION['msg'] = 'There were some problem in the Server! Try after some time!';

	header('location: index.php');

	exit();
}

if (!isset($_REQUEST['id'])) {

	$_SESSION['msg'] = 'Invalid ID!';

	header('location: index.php');

	exit();
}

$id = $_REQUEST['id'];


$sql = 'SELECT orders.order_id, orders.user_name, orders.timestamp, food.fname, food.price FROM orders LEFT JOIN food ON orders.food_id = food.id where orders.user_id = ?';

$query  = $pdoconn->prepare($sql);
$query->execute([$id]);
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<head>
	<meta charset="UTF-8">
	<title>CCFJResto - Orders!</title>

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
	<?php require('frontend/navbar.php'); ?>
	<div class="section white center">
		<?php echo '<h2>' . $_SESSION['firstname'] . '\'s Order List</h2>'; ?>
	</div>
	<div class="section center" style="padding: 20px;">
		<table class="centered responsive-table">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Food Name</th>
					<th>Price (RP)</th>
					<th>Timestamp</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$total = 0;
				foreach ($arr_all as $key) {
				?>
					<tr>
						<td><?php echo $key['order_id']; ?></td>
						<td><?php echo $key['fname']; ?></td>
						<td><?php echo $key['price']; ?></td>
						<td><?php echo $key['timestamp']; ?></td>
					</tr>
					<?php
					$total = $total + $key['price'];
					?>
				<?php } ?>
				<tr>
					<td colspan="3">Total Harga</td>
					<td><?php echo $total; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>