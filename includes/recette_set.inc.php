<?php
session_start();
?>

<!DOCTYPE HTML>
<HTML>

<head>
</head>

<body>
    <!-- Bootstrap core CSS -->
    <link href="../home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_register_success.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="../home/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../home/css/grayscale.min.css" rel="stylesheet">
    <?php
    foreach ($_SESSION['stockIndex'] as $i) { //--------------------> nbr de resultats affichees
        if (isset($_POST['add' . $i])) {  //--------------------> test sur tous les boutons  &&($_SESSION['idOfUser']!=0))
            include_once 'db.inc.php'; //ou on a la db pour utiliser $conn
            $usr = $_SESSION['id'];
            //$_SESSION['idOfRecipe']=$_SESSION['stockID'][$i] ;
            $sql = "insert into recipes (user_id,recipe_id) select * from (select " . $usr . ", ? ) as t where not exists ( select user_id from recipes where user_id = " . $usr . " and recipe_id = ? ) ";
            //$sql = "insert into recipes (user_id,recipe_id) select * from (select  ? , ? ) as t where not exists ( select user_id from recipes where user_id = ".$usr." ) ";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "operation failed ";
            } else {
                //-------------------->$_SESSION['idOfUser'] le id de notre user ;
                mysqli_stmt_bind_param($stmt, "ss", $_SESSION['stockID'][$i], $_SESSION['stockID'][$i]); //$_SESSION['idOfUser'],$d,$_SESSION['idOfUser'],
                mysqli_stmt_execute($stmt);
                echo '<section id="about" class="about-section text-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-8 mx-auto">
                <h2 class="text-info mb-4">Adding to your favories list ...</h2>
                    </div>
                </div>

            </div>
            </div>
            </section>
            <br><br><br>
            <div class="text-center">
            <div class="spinner-border text-success" width = "30rem" height = "30rem" role="status">
            <span class="sr-only" >Loading...</span>
            </div>
            ';

                //header("Location: ../result.php?register=success") ;
                echo "<script language='javascript'>
                window.history.go(-1) ;
                </script>
                ";
            }
        }
        //------------------------> $_SESSION['arr'] contient nbr de boutons ;

    }
    ?>
</body>
</head>