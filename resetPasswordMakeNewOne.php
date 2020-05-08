<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style_sign_up.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title> Renew password </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form action="includes/resetPasswordMakeNewOne.inc.php" method="POST">
                        <?php
                        if (isset($_GET["error"])) {
                            echo '<div class="help-block text-center text-danger">' . $_GET["error"] . '</div>';
                        }
                        ?>
                        <label>Password</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="pwd" class="form-control input_pass" value="" placeholder="password">
                        </div>
                        <label>Confirm Password</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="pwd2" class="form-control input_pass" value="" placeholder="Confirm ur password">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">

                            <button type="submit" name="submit" class="btn btn-primary">Confirm</button>
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
</body>

</html>