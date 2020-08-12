<!DOCTYPE html>
<html>

<head>
	<title>LANDING PAGE</title>
</head>
<link rel="stylesheet" href="./styles/signup.css">


<body>


	<div class="signup">

		<h2 class="header">Sign up for free</h2>


		<form method="post" action="signup.php">
			<?php include('../includes/server.php');
			include('../includes/errors.php');
			echo "<link rel='stylesheet' type='text/css' href='./styles/signup.css'>";
			?>

			<div class="input-group">
				<label>Firstname: </label>
				<input type="text" name="Firstname" value="<?php echo $firstname; ?>">
			</div>
			<div class="input-group">
				<label>Lastname: </label>
				<input type="text" name="Lastname" value="<?php echo $lastname; ?>">
			</div>
			<div class="input-group">
				<label>Email: </label>
				<input type="email" name="email" value="<?php echo $email; ?>">
			</div>
			<div class="input-group">
				<label>Password: </label>
				<input type="password" name="password_1">
			</div>
			<div class="input-group">
				<label>Confirm password: </label>
				<input type="password" name="password_2">
			</div>
			<div class="input-group">
				<label>Gender: </label>
				<select name="gender" value="<?php echo $gender; ?>">
					<option value="female" name="female" selected="none"> Female</option>
					<option value="male" name="male">Male </option>
					<option value="other" name="other">Other </option>
				</select>
			</div>

			<div class="input-group">
				<button type="submit" class="btn" name="reg_user">Sign Up</button>
			</div>
			<p class="member">
				Already a member? <a href="../users/login.php">Log in</a>
			</p>
		</form>
	</div>
</body>

</html>