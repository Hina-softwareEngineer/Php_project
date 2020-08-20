<!--Laviza Falak Naz-->

<?php

$con = mysqli_connect("localhost", "root", "", "social_network") or die (
"connection was not established");

if (isset($_GET['post_id']))
{
	$post_id = $_GET['post_id'];
	$delete_post = "delete from posts where postid = '$post_id'";
	$run_delete = mysqli_query($con, $delete_post);

	if ($run_delete)
	{
		echo "<script>alert('A post have been deleted')</script>";
		echo "<script>windoe.open('../home.php','_self')</script>";
	}
}

?>

<!--Laviza Falak Naz-->