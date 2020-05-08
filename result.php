<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Food</title>

    <!-- Bootstrap core CSS -->
    <link href="home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style_more.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="home/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="home/css/grayscale.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Hello <?php
                                                                                echo $_SESSION["uid"]; ?> </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <nav>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="favoris.php">Favories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="home.php">Deconnection</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="#signup">Contact</a>
                        </li>

                    </ul>

                </div>
            </nav>

        </div>
    </nav>

    <section id="about" class="about-section text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-info mb-4">After analyzing your order we recommanded this for your</h2>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_GET['submit'])) //------------------->si le bouton est cliquee
    {

        //------------------->test sur les separateur de notre ingredients
        $moukawinate = array();
        for ($i = 1; $i <= 4; $i++) {
            array_push($moukawinate, $_GET["text" . $i]);
        }
        $str = implode(",+", $moukawinate);

        //------------------->pswd de notre api
        $_SESSION['apiKey'] = "871c1b806d07427bbe2d79749900c182";
        //------------------->variables
        $_SESSION['stockIndex'] = array(); //------------------->tableaux des index de notre plat filtrees
        $_SESSION['stockID'] = array(); // ---------------------->tableaux des Id des recipes preferer
        $number = $_GET['number']; //nombre max des recettes a afficher
        if (empty($_GET['diet'])) {
            $filterOfUser = "none";
        } else {
            $filterOfUser = "" . $_GET['diet'];
        } //-------------------> string de notre choix de la list select soit vegan,vegetarian...
        $maxTime =  $_GET["time"]; //-------------------> le temps en minutes
        $stockRecipe = array();
        ////////////////////////////////////
        //------------------->un objet de notre plat a partir des ingredients
        $url1 = "https://api.spoonacular.com/recipes/findByIngredients?apiKey=" . $_SESSION['apiKey'] . "&ingredients=" . $str . "&number=" . $number;
        $data1 = file_get_contents($url1);
        $characters1 = json_decode($data1, false);
        //------------------->attribution des id des recettes qui satisfait notre choix dans le tableau $_SESSION['stockID']

        for ($j = 0; $j < $number; $j++) {
            //-------------------> un objet qui contient notre plat en bouclant sur character1->id
            $url2 = "https://api.spoonacular.com/recipes/" . $characters1[$j]->id . "/information?apiKey=" . $_SESSION['apiKey'] . "&includeNutrition=false";
            $data2 = file_get_contents($url2);
            $characters2 = json_decode($data2, false);
            //-------------------> test sur list et nbr de minutes
            array_push($_SESSION['stockID'], $characters2->id);
            array_push($stockRecipe, $characters2->instructions);
            if ((($filterOfUser == 'none') || ($characters2->$filterOfUser)) && (($characters2->readyInMinutes <= $maxTime) || (empty($maxTime)))) {
                array_push($_SESSION['stockIndex'], $j);
            }
        }
        //------------------->pour chaque id on affiche
        echo '<form action = "includes/recette_set.inc.php" method = "POST">';
        echo '<section id="about" class="about-section text-center">
                <div class="container">';

        foreach ($_SESSION['stockIndex'] as $i) {
            //------------------->titre et image de notre plat
            echo '                    </br>
                    </br>
                    </br>
                    </br>
                    <h3 class="text-success mb-4">' . $characters1[$i]->title . '</h3>';
            echo '<img src=' . $characters1[$i]->image . ' class="img-fluid" width ="50%" alt="' . $characters1[$i]->title . '">';
            //-------------------> les ingredient utiliser de votre choix
            echo '<br>';
            echo '<br>';
            echo '<br>';
            echo '<section>';
            echo '<div class="container">';
            echo '<div class="row"> ';
            echo '<div class="col-sm-4 mx-auto ">';
            echo '<h2 class="text-success mb-4" >Ingredients</h2>  ';
            $url3 = "https://api.spoonacular.com/recipes/" . $_SESSION['stockID'][$i] . "/ingredientWidget.json?apiKey=" . $_SESSION['apiKey'];
            $data3 = file_get_contents($url3);
            $ObjetIngredient = json_decode($data3, false);
            // 9lab 3la les ingredients
            foreach ($ObjetIngredient->ingredients as $ingredient) {
                echo '<div class="row"> ';
                echo '<div class="col-sm-9 mx-auto ">';
                echo '<img src="https://spoonacular.com/cdn/ingredients_100x100/' . $ingredient->image . '" width="30" />';
                echo '<h6 class="text-white mb-4">' . $ingredient->name . '</h6>';
                echo '</div>';
                echo '<div class="col-sm-3 mx-auto ">';
                echo '<h6 class="text-white mb-4">' . $ingredient->amount->metric->value . ' ' . $ingredient->amount->metric->unit . '</h6>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
            }
            echo '</div>';
            echo '<div class="col-sm-2 mx-auto "></div>';
            echo '<div class="col-sm-4 mx-auto ">';
            echo '<h2 class="text-success mb-8" > Recipe </h2>';
            echo '<h4 class="text-white mb-4">' . $stockRecipe[$i] . '</h4>';

            echo '</div>';
            echo '</div>';
            echo "<div> ";
            echo '<button type="submit" class="btn btn-success" name="add' . $i . '" value="submit">add to favories</button>';
            echo "</div>";
        }
        echo '</div>';
        echo '</div>';
        echo "</section>";
        echo "</section>";
        echo '</form>';
    }
    ?>

    <section id="signup" class="signup-section">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto text-center">

                    <i id="msg2" class="far fa-paper-plane fa-2x mb-2 text-white"></i>
                    <h2 id="msg1" class="text-white mb-5">Subscribe to receive updates!</h2>

                    <form class="form-inline d-flex" method="POST">
                        <input name="emailin" type="email" class="form-control flex-fill mr-0 mr-sm-2 mb-3 mb-sm-0" id="inputEmail" placeholder="Enter email address...">
                        <button type="submit" id="subscribe" class="btn btn-primary mx-auto" name="email">Subscribe</button>
                    </form>
                    <?php
                    if (isset($_POST['email']) && (!empty($_POST['emailin']))) {
                        echo '<i class="far fa-2x mb-2 text-white">Thanks for subscribe !</i> ';
                        echo '<script language="javascript">
                        document.getElementById("subscribe").style.display = "none" ;
                        document.getElementById("inputEmail").style.display = "none" ;
                        document.getElementById("msg1").style.display = "none" ;
                        document.getElementById("msg2").style.display = "none" ;
                        </script>
                        ';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section bg-black">
        <div class="container">

            <div class="row">

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Address</h4>
                            <hr class="my-4">
                            <div class="small text-black-50">ENSA FEZ</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4">
                            <div class="small text-black-50">
                                <a href="#">Ardouz@Elkantri.Mansouri</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Phone</h4>
                            <hr class="my-4">
                            <div class="small text-black-50">+(212)667764287</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="social d-flex justify-content-center">
                <a href="https://twitter.com/yurri_djorkaeff " target="_blank" class="mx-2">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://www.facebook.com/rachid.ardouz?ref=bookmarks" target="_blank" class="mx-2">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://github.com/Ardouz" target="_blank" class="mx-2">
                    <i class="fab fa-github"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
        <div class="container">
            Copyright &copy; Your Website 2019
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="home/vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="home/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="home/js/grayscale.min.js"></script>

</body>

</html>