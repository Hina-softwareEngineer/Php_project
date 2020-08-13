<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOG_IN PAGE </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src='https://kit.fontawesome.com/a076d05399.js'></script>

</head>

<body>
	<?php include('../includes/server.php') ?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>LOG IN</title>
		<link rel="stylesheet" type="text/css" href="../styles/login.css">
	</head>

	<body>
		<div class="login">
			<div class="header">
				<div>
					<i class="fa fa-user-alt"></i>
				</div>
				<h2>Login</h2>

			</div>

			<form method="post" action="login.php">
				<?php include('../includes/errors.php'); ?>
				<div class="input-group">

					<input type="text" name="email" placeholder="Email">
					<span class="icons"><i class="fas fa-envelope"></i></span>
				</div>
				<div class="input-group">

					<input type="password" name="password" placeholder="Password">
					<span class="icons"><i class="fas fa-key"></i></span>
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="login_user">Login</button>
				</div>
				<p class="member">
					Not yet a member? <a href="../functions/signup.php">Sign up</a>
				</p>
			</form>
		</div>
	</body>

	</html>
</body>

</html>


<!-- <Khizra /> -->