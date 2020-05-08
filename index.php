<?php
require "header.php"
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->

<body>

    <?php


    // hadi bach t3amer dakchi yla 5ta2e l user fchi 7aja
    if (isset($_GET["emailOrUid"])) {
        $emailOrUid = $_GET["emailOrUid"];
    } else {
        $emailOrUid = "";
    }


    if (isset($_SESSION["uid"])) {
        echo "
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <form action='./includes/logOut.inc.php' method='post'>
        <button type='submit' name='logout-submit'>logout</button>
    </form>";
    } else {
        /*echo " <form action='includes/login.inc.php' method='POST'>
        <input name='emailOrUid' type='text' placeholder='email or uid' value='$email'>
        <br>
        <input name='pwd' type='password' placeholder='password'>
        <br>
        <button type='submit' name='login-submit'>sign in</button>
    </form>
    <a href='./signUp.php'>SignUp</a>
    <br>";
    }
    echo '<br><a href="reset-password.php">Reset Password</a>'; */

        echo '
        <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="includes/login.inc.php" method="POST">
                        <label>Email</label>
                        <div class="input-group mb-2">

                            <div class="input-group-append">

                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>

                            <input type="text" name=" emailOrUid" class="form-control input_pass " value="' . $emailOrUid . '" placeholder="Email or Uid ">
                        </div>

                        <label>Password</label>
                        <div class="input-group mb-2 ">
                            <div class="input-group-append ">
                                <span class="input-group-text "><i class="fas fa-key "></i></span>
                            </div>
                            <input type="password" name="pwd" class="form-control input_pass " value="" placeholder="password "></div>';

        if (isset($_GET["error"])) {
            echo '<div class="help-block text-center text-danger">' . $_GET["error"] . '</div>';
        }

        echo '


                        <div class="d-flex justify-content-center mt-3 login_container ">

                            <input type="submit" name="login-submit" value="Login">
                        </div>
                    </form>
                </div>

                <div class="mt-4 ">
                    <div class="d-flex justify-content-center links ">
                        Don\'t have an account? <a href="./signUp.php" class="ml-2 ">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center links ">
                        <a href="send-email.php">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
    /*';
        //  if (isset($_GET["error"])) {
        //     echo '<div class="help-block">' . $_GET["error"].'</div>';
        // }

        echo '*/
    ?>


</body>

</html>