<!--Laviza Falak NAz-->

<!DOCTYPE html>
<?php
session_start();
include('../includes/header.php');


if (!isset($_SESSION['user_email'])) {
    header('location:../includes/index.php');
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.37/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_stle2.css">

    <?php
    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['username'];

    ?>

    <title>Find People</title>
</head>

<body>
    <div class="row">
    	<div class="col-sm-12">
    		<center><h2>Find new people</h2><center><br><br>
    		<div class="row">
    			<div class="col-sm-4">
    			</div>
    			<div class="col-sm-4">
    				<form class="search" placeholder="Search Friends" name="search_user">
    				<button class="btn btn-info" type="submit" name="search_user_btn">
    				Search</btn>
    				</form>
    			</div>
    			<div class-"col-sm-4">
    			</div>
    		</div><br><br>
    		<?php

    		search_user();

    		?>
    	</div>
    </div>
</body>

</html>


<!-- Laviza Falak Naz -->
