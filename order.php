<?php
session_start();
if (isset($_POST['email'])) {
    $_SESSION["name"] = $_POST["email"];
} ?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style_order.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>

    <!-- Bootstrap core CSS -->
    <link href="home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="home/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="home/css/grayscale.min.css" rel="stylesheet">
    <title>Order Page</title>
    <link rel="stylesheet" href="home/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Hello
                <?php
                echo $_SESSION["uid"]; ?>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <nav>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="./includes/logOut.inc.php">Deconnection</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </nav>
    <div class="container h-100">

        <div class="d-flex justify-content-center h-100">

            <div class="user_card">

                <div class="d-flex justify-content-start">

                    <!-- <div class="brand_logo_container">
                        <img src="logo.png" class="brand_logo" alt="Logo">
                    </div>-->
                </div>
                <div class="d-flex justify-content-center form_container">

                    <form action="result.php" name="myform" method='GET'>
                        <label>Ingredients</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-dice-one"></i></span>
                            </div>
                            <input id="input1" type="text" name="text1" class="form-control input_pass" value="" placeholder="First">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-dice-two"></i></span>
                            </div>
                            <input id="input2" type="text" name="text2" class="form-control input_pass" value="" placeholder="Second">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-dice-three"></i></span>
                            </div>
                            <input id="input3" type="text" name="text3" class="form-control input_pass" value="" placeholder="Third">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-dice-four"></i></span>
                            </div>
                            <input id="input4" type="text" name="text4" class="form-control input_pass" value="" placeholder="Fourth">
                        </div>

                        <label>Diet</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-utensil-spoon"></i></span>
                            </div>
                            <input id="diet" type="text" name="diet" class="form-control input_pass" value="" placeholder="Votre diet">
                        </div>
                        <label>Le Maximum du temps</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="number" name="time" class="form-control input_pass" value="" placeholder="Le maximum du temps">
                        </div>
                        <label>Number of suggestions</label>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-lightbulb"></i></span>
                            </div>
                            <input type="number" name="number" class="form-control input_pass" value="" placeholder="number of suggestions">
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <!-- <a href="result.php"><button type="submit" name="button" class="btn btn-secondary">Send</button></a>-->
                            <input type="submit" name="submit" value="Send">
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

</body>
<script src="autocomplete-master/demo/jquery.js" type="text/javascript"></script>
<script src="autocomplete-master/demo/prettify.js" type="text/javascript"></script>
<script type="text/javascript">
    window.prettyPrint && prettyPrint()
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="autocomplete-master/jquery.autocomplete.css">
<script src="autocomplete-master/jquery.autocomplete.js" type="text/javascript"></script>
<script>
    /********************************** local start ************************************************/
    var states = [
        'raspberries', 'powder', 'oats', 'eggs',
        'salami', 'cheese', 'meat', 'sugar', 'butter', 'milk',
        'tomato', 'potato', 'baguette', 'olives', 'basil',
        'chicken', 'flour', 'soup', 'nodle', 'pizza', 'onion', 'orange', 'salt',
        'pepper', 'oil', 'flour', 'garlic', 'sugar', 'water', 'onion', 'chicken', 'juice', 'milk',
        'lemon', 'butter', 'egg', 'cheese', 'wheat', 'vegetable', 'vanilla', 'vinegar', 'parsley', 'honey', 'soy', 'wine', 'seeds', 'celery', 'rice', 'cinnamon', 'tomato', 'bread', 'eggs', 'onions', 'yeast', 'leaves', 'broth', 'tomatoes', 'cream', 'cloves', 'thyme', 'peeled', 'ginger', 'beans', 'soda', 'basil', 'mushrooms', 'apple', 'parmesan', 'yogurt', 'stock', 'bell', 'oats', 'sodium', 'beef', 'flakes', 'carrot', 'oregano', 'chocolate', 'cumin', 'paprika', 'sesame', 'mustard', 'spinach', 'corn', 'potatoes', 'coconut', 'carrots', 'nutmeg', 'cilantro', 'raisins', 'chili', 'syrup', 'peas', 'peanut', 'almond', 'walnuts', 'canned', 'lime', 'leaf', 'pineapple', 'margarine', 'cabbage', 'cucumber', 'broccoli', 'cornstarch', 'zucchini', 'coriander', 'paste', 'turkey', 'banana', 'almonds', 'nuts', 'maple', 'cheddar', 'cider', 'scallions', 'lettuce', 'dill'
    ];

    var diet = ['none', 'vegetarian', 'gluten free', 'dairy free', 'veryHealthy', 'whole30', 'cheap', 'vegan'];

    $('#input1').autocomplete({
        source: [states]
    });
    $('#input2').autocomplete({
        source: [states]
    });
    $('#input3').autocomplete({
        source: [states]
    });
    $('#input4').autocomplete({
        source: [states]
    });

    $('#diet').autocomplete({
        source: [diet]
    });
</script>

</html>