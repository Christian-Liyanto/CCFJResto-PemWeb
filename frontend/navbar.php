<section class="fnavbar">
	<div class="navbar-fixed">
		<nav>
			<div class="nav-wrapper" style="background-color: #101820FF;">
				<a href="#" class="brand-logo" style="color: #F2AA4CFF;">CCFJResto<img src="./images/logo.png" width="60px" height="32px"></a>
				<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
				<ul class="right hide-on-med-and-down">
					<li><a href="/CCFJResto" class="hvr-grow" style="color: #F2AA4CFF;">Home</a></li>
					<li><a href="foods.php" class="hvr-grow" style="color: #F2AA4CFF;">Menu</a></li>

					<?php

					if (isset($_SESSION['email'])) {
						echo '
						<li><a href="order-user.php?id=' . $_SESSION['id'] . '" class="hvr-grow" style="color: #F2AA4CFF;">Order</a></li>
						<li><a href="#" class="hvr-grow" style="color: #F2AA4CFF;">Hi, ' . $_SESSION['firstname'] . '</a></li>
		        		<li><a href="logout.php" class="hvr-grow" style="color: #F2AA4CFF;">Logout</a></li>';
					} else {
						echo '<li><a href="#" class="hvr-grow modal-trigger" data-target="modal1" style="color: #F2AA4CFF;">Login</a></li>
		        		<li><a href="../CCFJResto/register-user.php" class="hvr-grow modal-trigger" style="color: #F2AA4CFF;">Register</a></li>';
					}

					?>

				</ul>
			</div>
		</nav>
	</div>

	<ul class="sidenav" id="mobile-demo">
		<li><a href="/CCFJResto" style="color: #F2AA4CFF;">Home</a></li>
		<li><a href="foods.php" style="color: #F2AA4CFF;">Menu</a></li>

		<?php

		if (isset($_SESSION['firstname'])) {
			echo '
					<li><a href="order-user.php?id=' . $_SESSION['id'] . '" class="hvr-grow">Order</a></li>
					<li><a href="#">Hi, ' . $_SESSION['firstname'] . '</a></li>
		        	<li><a href="logout.php">Logout</a></li>';
		} else {
			echo '<li><a href="#" class="modal-trigger" data-target="modal1" style="color: #F2AA4CFF;">Login</a></li>
		        		<li><a href="../CCFJResto/register-user.php" class="modal-trigger" style="color: #F2AA4CFF;">Register</a></li>';
		}

		?>
	</ul>
</section>