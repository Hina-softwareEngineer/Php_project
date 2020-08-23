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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="../styles/header.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../styles/home.css" type="text/css" media="all" />

    <?php
    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con, $get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['username'];

    ?>

    <title><?php echo "$user_name"; ?></title>
</head>

<body>
    <div class="row">
        <div id="insert_post" class="col-sm-12">
            <center>
                <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
                    <textarea name="content" id="content" cols="100" rows="4" placeholder="What's in your Mind?....."></textarea>
                    <br>
                    <label for="" id="upload_image_button">
                        <input type="file" name="upload_image" id="upload_image" class="inputfile">
                        <label for="upload_image"><i class="fa fa-upload" aria-hidden="true"></i>&nbsp Choose a file</label>
                    </label>

                    <button id="btn-post" name="sub">Post</button>
                </form>

                <?php insertPost(); ?>
            </center>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-12">
            <center>
                <h2>
                    <strong class="feed" style="font-size:40px;">News Feed<br></strong>
                </h2><br>
            </center>
            <?php
            echo get_posts();
            ?>
        </div>
    </div>
</body>

</html>


<!-- <Hina /> -->