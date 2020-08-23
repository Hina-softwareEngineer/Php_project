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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="../styles/header.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../styles/profile.css" type="text/css" media="all" />

    <?php
    $con = mysqli_connect("friendscorner-mysqldbserver.mysql.database.azure.com", "hina@friendscorner-mysqldbserver", "Nedhas1webapp", "social_network");
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
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <?php
            echo "
                    <div>
                        <div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'></div>
                        
                        <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data' >
                            <div class='nav pull-left' style='position : absolute; top:10px; left:100px;'>
                                
                                    <label style='color: black; font-weight: bold;'>Select Cover Image
                                        <input type='file' name='u_cover' id='cover' class='inputfile' size='60' />
                                       
                                    </label><br><br>
                                    <button style='color: black; font-weight: bold;' for='cover' name='submit'>Set Cover Pic</button>
                                    <div>
                                    </div>
                                
                            </div>
                        </form>
                    </div>

                    <div id='profile_img'>
                        <img src='images/$user_image' alt='Profile' width='180px' min-height='185px' >
                        <form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data' >

                            <label style='color: black; font-weight: bold;' id='update_profile'> Select Profile
                                <input type='file' name='u_image' id='profile' class='inputfile' size='60' />
                               
                            </label><br><br>
                            <button style='color: black; font-weight: bold;' for='profile' id='button_profile' name='update'>Set Profile Pic</button>

                        </form>
                    </div><br>

                ";
            ?>

            <?php
            if (isset($_POST['submit'])) {
                $u_cover = $_FILES['u_cover']['name'];
                $image_tmp = $_FILES['u_cover']['tmp_name'];

                $random_number = rand(1, 100);

                if ($u_cover == '') {
                    echo "<script>alert('Please select Cover Image')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";

                    exit();
                } else {
                    $file_destination =  'cover/' . $u_cover . $random_number;
                    if (move_uploaded_file($image_tmp, $file_destination)) {

                        $update = "update users set user_cover = '$u_cover$random_number' where user_id='$user_id'";
                        $run = mysqli_query($con, $update);

                        if ($run) {
                            echo "<script>alert('Your Cover Updated')</script>";
                            echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                        }
                    } else {
                        echo "<script>alert('Error while updating cover photo'); </script>";
                    }
                }
            }
            ?>
        </div>

        <?php
        if (isset($_POST['update'])) {
            $u_image = $_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];
            $random_number = rand(1, 100);

            if ($u_image == '') {
                echo "<script>alert('Please select Profile Image on clicking on your Profile Image')</script>";
                echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";

                exit();
            } else {
                $file_destination =  'images/' . $u_image . $random_number;
                if (move_uploaded_file($image_tmp, $file_destination)) {
                    $update = "update users set user_image = '$u_image$random_number' where user_id='$user_id'";

                    $run = mysqli_query($con, $update);

                    if ($run) {
                        echo "<script>alert('Your Profile Updated')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                    }
                } else {
                    echo "<script>alert('Error while updating Profile photo'); </script>";
                }
            }
        }
        ?>

        <div class="col-sm-2">

        </div>

    </div>

    <div class="row">
        <div class="col-sm-2">
        </div>

        <div class="col-sm-2" id="sidebar" style="background-color: #f6b2ff; color:#190030; text-align: center; left:0.8%; border-radius: 5px;">
            <?php
            echo "
                <center><h2><strong>About</strong></h2></center><br>
                <center><h3><strong>$first_name $last_name</strong></h3></center><br>
                <p><strong><i style='color:grey;'>$describe_user</i></strong></p><br>
                <p><strong>Relationship Status: </strong> $Relationship_status</p><br>
                <p><strong>Lives In : </strong> $user_country</p><br>
                <p><strong>Member Since: </strong> $register_date</p><br>
                <p><strong>Gender: </strong> $user_gender</p><br>
                <p><strong>Date Of Birth: </strong> $user_birthday</p><br>
                ";
            ?>
        </div>
        <!-- <Vazeema> -->
        <div class="col-sm-6">
            <!-- display user posts -->
            <?php
            global $con;

            if (isset($_GET['u_id'])) {
                $u_id = $_GET['u_id'];
            }

            $get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";

            $run_posts = mysqli_query($con, $get_posts);

            while ($row_posts = mysqli_fetch_array($run_posts)) {
                $post_id = $row_posts['post_id'];
                $user_id = $row_posts['user_id'];
                $content = $row_posts['post_content'];
                $upload_image = $row_posts['upload_image'];
                $post_date = $row_posts['post_date'];

                $user = "select * from users where user_id='$user_id' AND posts='yes'";

                $run_user = mysqli_query($con, $user);
                $row_user = mysqli_fetch_array($run_user);

                $user_name = $row_user['username'];
                $user_image = $row_user['user_image'];

                // now diplaying the posts

                if ($content == "No" && strlen($upload_image) >= 1) {
                    echo "
                    <div id='own_posts'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='images/$user_image' class='img-circle' width='100px' min-height='100px'></p>
                            </div>
                            <div class='col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color:rgb(44, 20, 66);' href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                <h4><small style='color:white; font-size:16px;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <img id='posts-img' src='../imagepost/$upload_image' style='height:350px;'>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                        <a href='functions/delete_post.php?post_id=$post_id' style='float:right'><button class='btn btn-danger'>Delete</button></a>
                    </div><br><br>
                ";
                } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                    echo "
                    <div id='own_posts'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='images/$user_image' class='img-circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color:rgb(44, 20, 66);' href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                <h4><small style='color:white; font-size:16px;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <p>$content</p>
                                <img id='posts-img' src='../imagepost/$upload_image' style='height:350px;'>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                        <a href='functions/delete_post.php?post_id=$post_id' style='float:right'><button class='btn btn-danger'>Delete</button></a>
                    </div><br><br>
                ";
                } else {
                    echo "
                    <div id='own_posts'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='images/$user_image' class='img-circle' width='100px' min-height='100px'></p>
                            </div>
                            <div class='col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color:rgb(44, 20, 66);' href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                <h4><small style='color:white; font-size:16px;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-2'>
                            </div>
                            <div class='col-sm-6'>
                                <h3><p>$content</p></h3>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                ";

                    global $con;

                    if (isset($_GET['u_id'])) {
                        $u_id = $_GET['u_id'];
                    }

                    $get_posts = "select user_email from users where user_id='$u_id'";
                    $run_user = mysqli_query($con, $get_posts);
                    $row = mysqli_fetch_array($run_user);

                    $user_email = $row['user_email'];

                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $u_email = $row['user_email'];

                    if ($u_email != $user_email) {
                        echo "
                        <script>window.open('profile.php?u_id=$user_id', '_self')</script>
                    ";
                    } else {
                        echo "
                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                    <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
                    <a href='functions/delete_post.php?post_id=$post_id' style='float:right'><button class='btn btn-danger'>Delete</button></a>
                    </div><br><br>
                    ";
                    }
                }

                include("../functions/delete_post.php");
            }
            ?>
        </div>
        <div class='col-sm-2'>

        </div>
        <!-- </Vazeema> -->
    </div>

    <!-- Laviza Falak Naz -->
    <div class="row">
    </div>
    <div class="col-sm-2" style="background-color:#e6e6e6; text-align: center; left=0.8%; border-radius:5px;">
        <?php
        echo "
            <center><h2><strong>About</Strong></h2></center>
            <center><h4><strong>$first_name $last_name>/strong></h4></center>
            <p><strong><i style='color:grey;'>$describe_user</i><strong></p><br>
            <p><strong>Relationshio Status: </strong> $Relationshio_status</p><br>
            <p><strong>Lives in: </strong><$user_country</p><br>
            <p><strong>Member Since: </strong><$register_date</p><br>
            <p><strong>Gender: </strong><$user_gender</p><br>
            <p><strong>Date of Birth: </strong><$user_birthday</p><br>
        ";
        ?>
    </div>
    <div class="col-sm-6">

        <!-- DIAPLAY USER POSTS-->

        <?php
        global $con;
        if (isset($_GET['u_id'])) {
            $u_id = $_GET['u_id'];
        }
        $get_posts = "select * from posts where user_ids='$u_id' ORDER by 1 DESC LIMIT 5";

        $run_posts = mysqli_query($con, $get_posts);
        while ($row_posts = mysqli_fetch_array($run_posts)) {

            $post_id = $row_posts['post_id'];
            $user_id = $row_posts['user_id'];
            $content = $row_posts['post_content'];
            $upload_image = $row_posts['upload_image'];
            $post_date = $row_posts['post_date'];


            $user = "select * from users where user_id='$user_id' AND posts='yes'";
            $run_user = mysqli_query($con, $user);
            $row_user = mysqli_fetch_array($run_user);

            $user_name = $row_user['user_name'];
            $user_image = $row_user['user_image'];

            //NOW WE WILL DISPLAY THE POSTS

            if ($content == "No" && strlen($upload_image) >= 1) {
                echo "
                    <div id='own_posts'>
                        <div class='row>
                            <div class='col-sm-2>
                                <p><img src='images/$user_image' class='img-circle' width='100px' height='100px'></p>
                            </div>
                            <div class'col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                            <img id='posts-img' src='../imagepost/$upload_image' style='height:350px;'>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                        <a href='functions/delete_post.php?post_id=$post_id' styles='float:right;'> <button class='btn btn-danger'>Delete</button></a>
                    </div><br><br>
                ";
            } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                echo "
                    <div id='own_posts'>
                        <div class='row>
                            <div class='col-sm-2>
                                <p><img src='images/$user_image' class='img-circle' width='100px' height='100px'></p>
                            </div>
                            <div class'col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                            <p>$content</p>
                            <img id='posts-img' src='../imagepost/$upload_image' style='height:350px;'>
                            </div>
                        </div><br>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                        <a href='functions/delete_post.php?post_id=$post_id' styles='float:right;'> <button class='btn btn-danger'>Delete</button></a>
                    </div><br><br>
                ";
            } else {
                echo "
                    <div id='own_posts'>
                        <div class='row>
                            <div class='col-sm-2>
                                <p><img src='images/$user_image' class='img-circle' width='100px' height='100px'></p>
                            </div>
                            <div class'col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color:#3897f0;' href='user_profile.php?u_id=$user_id'>$user_name</h3>
                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-2'>
                            </div>
                            <div class='col-sm-6'>
                            <h3><p>$content</p></h3>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                ";

                global $con;

                if (isset($_GET['u_id'])) {
                    $u_id = $_GET['u_id'];
                }

                $get_posts = "select user_email from users where user_id='$u_id'";
                $run_user = mysqli_query($con, $get_posts);
                $row  = mysqli_fetch_array($run_user);

                $user_email = $row['user_email'];

                $user = $_SESSION['user_email'];
                $get_user = "select # from users where user_email = '$user'";
                $run_user = mysqli_query($con, $get_user);
                $row  = mysqli_fetch_array($run_user);

                $user_id = $row['user_id'];
                $u_email = $row['user_email'];

                if ($u_email != $user_email) {
                    echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                } else {
                    echo "
                      <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                      <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
                      <a href='functions/delete_post.php?post_id=$post_id' styles='float:right;'> <button class='btn btn-danger'>Delete</button></a> 
                      </div><br><br><br>
                    ";
                }
            }

            include("functions/delete_post.php");
        }
        ?>
    </div>
    <div class='col-sm-2'>
    </div>
    </div>
    <!--Laviza Falak Naz-->
</body>

</html>


<!-- <Hina /> -->