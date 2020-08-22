<!--Laviza Falak Naz-->

<!DOCTYPE html>
<?php
	session_start();
	include("includes/header.php");
	if(!isset($_SESSION['user_email']))
	{
		header("location: index.php");
	}
?>
	<head>
		<title>view your post</title>
		<meta charset="utf-8">
		<meta name="viewport" contents="width=device-width initial-scaled=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.mon.js"?></script>
		<link rel="stylesheet" type="text/css" href="style/home_style2.css">
	</head>
	<body>
		<div class="row">
			<div class="col-sm-12">
			<center><h2>comments</h2><br></center>
			<? php single_post(); ?>
			</div>
		</div>
	</body>
</html>

<!--Laviza Falak Naz-->
