<?php
include "include/db_connection.php";
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location:signin.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>Chat</title>
</head>

<body style="overflow-x: hidden;">
    <!-- As a link -->
    <nav class="navbar body-class navbar-dark">
        <a class="navbar-brand" href="#">Chat</a>
    </nav>

    <div id="left-chat">
        <div class="row">

            <!-- Left side -->
            <div class="col-md-3">

                <div class="card rounded-0">
                    <div class="card-body">

                        <?php
                        // Getting the data of user who is logged in
                        $current_user = $_SESSION['user_email'];
                        $get_curr_user = "SELECT * FROM `users` WHERE `user_email`='$current_user'";
                        $run_curr_user = mysqli_query($conn, $get_curr_user);
                        $row = mysqli_fetch_assoc($run_curr_user);
                        $current_username = $row['user_name'];
                        ?>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <img src="images/default-user.png" alt="" style="width: 40px; height:40px">
                                <h4 class="my-2 ml-2"><?php echo $current_username ?> (You)</h4>
                            </div>

                            <div>
                                <a href="include/find_friends.php">
                                    <button class="btn btn-outline-secondary border-0 round-border" data-toggle="tooltip" data-placement="bottom" title="Find new friends" type="button" id="find_friends">
                                        <i class="fas fa-user-friends"></i>
                                    </button>
                                </a>
                            </div>

                        </div>


                    </div>
                </div>

                <div class="card rounded-0 left-chat">
                    <div class="card-body" style="overflow:scroll; height: 650px;">


                        <ul class="list-group">
                            <li class="list-group-item border-0">
                                <h6 class="text-muted">FRIENDS</h6>
                            </li>

                            <?php
                            // Getting friends to chat
                            $get_users = "SELECT * FROM `users` WHERE `user_email` != '$current_user'";
                            $run_users = mysqli_query($conn, $get_users);

                            while ($row = mysqli_fetch_assoc($run_users)) {
                                $users_name = $row['user_name'];
                                $users_status = $row['login'];

                            ?>
                                
                                <!-- List of friends using while loop -->
                                <a href="home.php?fuser_name=<?php echo $users_name ?>" class="list-group-item list-group-item-action border-0 round-border p-0 pl-3">
                                    <div class="d-flex my-2">
                                        <img src="images/default-user.png" alt="" class="my-2" style="width: 50px; height:50px">
                                       
                                        <div class="my-4 d-flex">
                                            <h6><?php echo $users_name ?></h6>

                                            <?php
                                                // Login status
                                                if ($users_status == 'Online') {
                                                    echo '<small class="text-success ml-2">' . $users_status . '</small>';
                                                } else {
                                                    echo '<small class="text-black-50 ml-2">' . $users_status . '</small>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </a>

                                <!-- Remaining bracket of while -->
                            <?php
                            }
                            ?>


                            <!-- <?php //include "include/get_user_data.php"
                                    ?> -->
                        </ul>

                    </div>


                </div>
            </div>
            <!-- Left side ends -->

            <!-- Right start here -->
            <div class="col-md-9">

                <?php
                // Getting userdetails in header
                if (isset($_GET['fuser_name'])) {
                    $fuser_name = $_GET['fuser_name'];
                }
                ?>

                <div class="right-chat">
                    <div class="d-flex justify-content-between" id="right header">
                        <div class="d-flex my-2">
                            <img src="images/default-user.png" alt="" style="width: 50px; height:50px">
                            <h5 class="my-3 ml-2"><?php echo $fuser_name; ?></h5>
                        </div>
                        <a href="logout.php" class="btn btn-danger round-border my-3 mr-3" name="logout" style="height: 40px;">Logout</a>
                    </div>

                    <hr>
                    <div id="right_chat" style="overflow:scroll; height: 600px;">
                        Chat Area
                    </div>


                </div>
            </div>
        </div>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>