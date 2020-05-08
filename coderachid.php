<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Reset password</title>
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
                    <form action="includes/verify-reset-password.inc.php" method="POST">
                        <label id="label">Code</label>
                        <div class="input-group mb-2">

                            <div class="input-group-append">
                                <span id="envelop" class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>

                            <input type="text" name="code" id="msg2" class="form-control input_pass" value="" placeholder="Enter Code">
                        </div>


                        <div class="d-flex justify-content-center mt-3 login_container">
                            <!-- <a href="order.php"><button type="button" name="button" class="btn btn-primary">Login</button></a>-->
                            <input type="submit" name="submit" id="msg1" value="submit">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php
    /*if (isset($_POST['email'])&& (!empty($_POST['emailin']))) {


                        echo '<script language="javascript">

                        document.getElementById("msg1").style.display = "none" ;
                        document.getElementById("msg2").style.display = "none" ;
            document.getElementById("envelop").style.display = "none" ;
            document.getElementById("label").innerHTML = "<h3>Check your email !</h3>" ;
                        </script>
                        ';
                    }*/
    ?>
</body>

</html>