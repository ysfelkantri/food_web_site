<?php
require "header.php";
?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style_sign_up.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<body>



    <?php
    $firstName = "";
    $lastName = "";
    $uid = "";
    $email = "";

    if (isset($_GET["firstName"])) {
        $firstName = $_GET["firstName"];
    }

    if (isset($_GET["lastName"])) {
        $lastName = $_GET["lastName"];
    }


    if (isset($_GET["uid"])) {
        $uid = $_GET["uid"];
    }

    if (isset($_GET["email"])) {
        $email = $_GET["email"];
    }


    echo ' <div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img src="logo.png" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form action="includes/signup.inc.php" method="POST">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="firstName" class="form-control input_user" value="' . $firstName . '" placeholder="FirstName">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="lastName" class="form-control input_user" value="' . $lastName . '" placeholder="LastName">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control input_pass" value="' . $email . '" placeholder="Email">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="uid" class="form-control input_user" value="' . $uid . '" placeholder="Username">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="pwd" class="form-control input_pass" value="" placeholder="Password">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="pwd2" class="form-control input_pass" value="" placeholder="Confirm your password">
                    </div>';
    if (isset($_GET["error"])) {
        echo '<div class="help-block text-center text-danger">' . $_GET["error"] . '</div>';
    }

    echo '<div class="d-flex justify-content-center mt-3 login_container">
                        <!--<a href="login.html"><button type="button" name="button" class="btn btn-primary">Register</button></a>-->
                        <input type="submit" name="signUp-submit" value="Sign up">
                    </div>
                    <div class="d-flex justify-content-center links">
                        Already have an account? <a href="index.php" class="ml-2">Sign in</a>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>';




    /*

echo '<main>
    <form action="includes/signup.inc.php" method="POST">

        <input name="firstName" type="text" placeholder="firstname" value=' . $firstName . '>
        <br>
        <input name="lastName" type="text" placeholder="lastname" value=' . $lastName . '>
        <br>
        <input name="email" type="email" placeholder="email" value=' . $email . '>
        <br>
        <input name="uid" type="text" placeholder="uid" value=' . $uid . '>
        <br>
        <input name="pwd" type="password" placeholder="password">
        <br>
        <input name="pwd2" type="password" placeholder="Repeat Password">
        <br>
        <button type="submit" name="signUp-submit">sign up</button>
    </form>

</main>'; */

    if (isset($_GET["error"])) {
        echo "<br><br>error : " . $_GET["error"];
    }

    require "footer.php";
