<?php

$con = mysqli_connect("localhost", "root", "", "social_network");

// function

function insertPost(){
    if(isset($_POST['sub'])){
        global $con;
        global $user_id;

        $content = htmlentities($_POST['content']);
        $upload_image = $_FILES['upload_image']['name'];
        $image_tmp = $_FILES['upload_image']['tmp_name'];
        $random_number = rand(1,100);

        if(strlen($content > 250)){
            echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
        }
        else{
            if(strlen($upload_image) >= 1 && strlen($content) >=1){
                move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                $insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', '$content', '$upload_image.$random_number', NOW())";

                $run = mysqli_query($con, $insert);

                if($run){
                    echo "<script>alert('Your Post update a moment ago!')</script>";
                    echo "<script>window.open('home.php', '_self')</script>";

                    $update = "update users set posts='yes' where user_id ='$user_id' ";
                    $run_update = mysqli_query($con, $update);
                }
                exit();
            }
            else{
                if($upload_image= '' && $content == ''){
                    echo "<script>alert('Error occured while uploading! ')</script>";
                    echo "<script>window.open('home.php', '_self')</script>";
                }
                else{
                    if($content==''){
                        move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                        $insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', 'No', '$upload_image.$random_number', NOW())";

                        $run = mysqli_query($con, $insert);

                        if($run){
                            echo "<script>alert('Your Post update a moment ago!')</script>";
                            echo "<script>window.open('home.php', '_self')</script>";

                            $update = "update users set posts='yes' where user_id ='$user_id' ";
                            $run_update = mysqli_query($con, $update);
                        }
                        exit();
                    }
                    else{
                        $insert = "insert into posts (user_id, post_content, post_date) values('$user_id', 'No',NOW())";

                        $run = mysqli_query($con, $insert);

                        if($run){
                            echo "<script>alert('Your Post update a moment ago!')</script>";
                            echo "<script>window.open('home.php', '_self')</script>";

                            $update = "update users set posts='yes' where user_id ='$user_id' ";
                            $run_update = mysqli_query($con, $update);
                    }
                }
            }
        }
    }
}

?>