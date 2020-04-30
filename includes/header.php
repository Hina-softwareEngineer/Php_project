<?php

include('includes/connection.php');

?>

<nav>
    <div>
        <div>
        <button></button>
        <span>Toggle Navigation</span>
        <span></span>
        <span></span>
        <span></span>

        <a href="home.php">Everyone FriendsBook</a>
        </div>
        <div>
        <ul>
            <?php
                $user = $_SESSION['user_email'];
                $get_user= "select * from users where user_email='$user'";
                $run_user = mysqli_query($con, $get_user);
                $row = mysqli_fetch_array($run_user);

                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $first_name = $row['f_name'];
                $last_name= $row['l_name'];
                $describe_user = $row['describe_user'];
                $Relationship_status = $row['Relationship'];
                $user_pass = $row['user_pass'];
                $user_email = $row['user_email'];
                $user_country = $row['user_country'];
                $user_gender= $row['user_gender'];
                $user_birthday = $row['user_birhtday'];
                $user_image = $row['user_image'];
                $user_cover = $row['user_cover'];
                $recovery_account = $row['recovery_account'];
                $register_date = $rown['user_reg_date'];


                $user_posts = "select * from posts where user_id = '$user_id'";
                $run_posts = mysqli_query($con, $user_posts);
                $posts = mysqli_num_rows(($run_posts));
            ?>
            <li><a href='profile.php?<?php echo "u_id=$user_id" ?>'>
        <?php echo"$first_name"; ?></a></li>
        <li><a href="home.php">Home</a></li>
        <li><a href="home.php">Find People</a></li>
        <li><a href="messages.php?u_id=new">Messages</a></li>
        <?php 
            echo "
            <li><a href='#'>
            <span>Down</span></a>
            <ul>
                <li>
                    <a href='my_post.php?u_id=$user_id'>My Posts
                    <span>$posts</span></a>
                </li>

                <li>
                    <a href='my_post.php?u_id=$user_id'>My Posts
                    <span>$posts</span></a>
                </li>

                <li>
                    <a href='edit_profile.php?u_id=$user_id'>Edit Account
                    </a>
                </li>

                <li>Separator</li>

                <li>
                    <a href='logout.php'>Logout
                    </a>
                </li>
            </ul>
            </li>
            ";
        ?>

        </ul>

        <ul>
            <li>
                <form action="results.php">
                    <div>
                        <input type="text" name="user_query" placeholder="Search">
                    </div>
                    <button type="submit" name="search">Search</button>
                </form>
            </li>
        </ul>
        </div>
    </div>
</nav>