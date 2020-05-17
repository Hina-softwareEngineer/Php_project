<?php
session_start();

if (!isset($_SESSION['user_email'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../users/login.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user_email']);
	header("location: ../users/login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="header">
		<h2>Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success">
				<h3>
					<?php
					echo $_SESSION['success'];
					unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php if (isset($_SESSION['user_email'])) : ?>
			<p>Welcome <strong><?php
								echo $_SESSION['username'];
								echo "hello";
								echo $_SESSION['user_email'];
								?></strong></p>
			<p> <a href="../users/home.php" style="color: red;">HOME</a> </p>
		<?php endif ?>
	</div>
	<?php include('../includes/errors.php'); ?>
</body>

</html>