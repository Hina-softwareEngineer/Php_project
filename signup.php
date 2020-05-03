<!DOCTYPE html>
<html>
<head>
	<title>LANDING PAGE</title>
</head>
<body>

<div class="header">

  	<h2>SIGN UP</h2>
  </div>
	
  <form method="post" action="signup.php">
  <?php include('server.php');
  include('errors.php');
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
  	  <select name="gender" value="<?php echo $gender; ?>" >
		<option value="female" name="female" selected="none"> Female</option>
		<option value="male" name="male" >Male </option>
		<option value="other" name="other" >Other </option>
		</select>
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Sign Up</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>

</html>