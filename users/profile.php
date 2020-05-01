<!DOCTYPE html>
<?php
    session_start();
    include('../includes/header.php');

    if(isset($_SESSION['user_email'])){
        header('location:index.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        $user = $_SESSION['user_email'];
        $get_user= "select * from users where user_email='$user'";
        $run_user = mysqli_query($con, $get_user);
        $row = mysqli_fetch_array($run_user);

        $user_name = $row['user_name'];
        
    ?>

    <title><?php echo "$user_name"; ?></title>
</head>
<body>
    <div>
        <div>

        </div>
        <div>
            <?php
                echo"
                    <div>
                        <div><img id='cover-img' src='cover/$user_cover' alt='cover></div>
                        <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data' >
                            <ul style='position : absolute; top:10px; left:40px;'>
                                <li>
                                    <button>
                                    Change Cover
                                    </button>
                                    <div>
                                        <center>
                                            <p>Click <strong>Select Cover</strong> and then click the 
                                            <br> <strong>Update Cover</strong></p>
                                            <label>Select Cover Image
                                            <input type='file' name='u_cover' size='60' />

                                            </label><br><br>
                                            <button name='submit'>Update Cover</button>
                                        </center>
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>

                    <div>
                        <img src='users/$user_image' alt='Profile' width='180px' height='185px' >
                        <form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data' >

                            <label>Select Profile
                            <input type='file' name='u_image' size='60 />
                            </label><br><br>

                            <button name='update' >Update Profile</button>

                        </form>
                    </div><br>

                ";
            ?>

            <?php
                if(isset($_POST['submit'])){
                    $u_cover= $_FILES['u_cover']['name'];
                    $image_tmp = $_FILES['u_cover']['tmp_name'];
                    $random_number = rand(1,100);

                    if($u_cover==''){
                        echo "<script>alert('Please select Cover Image')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";

                        exit();
                    }
                    else{
                        move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
                        $update = "update users set user_cover = '$u_cover.$random_number' where user_id='$user_id'";

                        $run = mysqli_query($con, $update);

                        if($run){
                            echo "<script>alert('Your Cover Updated')</script>";
                            echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                        }
                    }
                }
            ?>
        </div>

        <?php
            if(isset($_POST['update'])){
                $u_image= $_FILES['u_image']['name'];
                $image_tmp = $_FILES['u_image']['tmp_name'];
                $random_number = rand(1,100);

                if($u_image==''){
                    echo "<script>alert('Please select Profile Image on clicking on your Profile Image')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";

                    exit();
                }
                else{
                    move_uploaded_file($image_tmp, "users/$u_image.$random_number");
                    $update = "update users set user_image = '$u_image.$random_number' where user_id='$user_id'";

                    $run = mysqli_query($con, $update);

                    if($run){
                        echo "<script>alert('Your Profile Updated')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                    }
                }
            }
        ?>

        <div>
            
        </div>

    </div>
</body>
</html>