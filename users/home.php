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
    <div>
        <div id="insert_post">
            <center>
                <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
                    <textarea name="content" id="content" cols="30" rows="4" placeholder="What's in your mind">

                </textarea><br>
                    <label for="" id="upload_image_button">Select Image
                        <input type="file" name="upload_image" size="30" id="">
                    </label>

                    <button id="btn-post" name="sub">Post</button>
                </form>

                <?php insertPost(); ?>
            </center>
        </div>
    </div>



    <div>
        <center>
            <h2>
                <strong>New Feed</strong>
            </h2><br>
        </center>
        <?php
        echo get_posts();
        ?>
    </div>
</body>

</html>


<!-- <Hina /> -->