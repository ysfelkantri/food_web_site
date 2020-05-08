
<?php
   session_start(); ///////////////////////////////////////////////
?>
<!DOCTYPE HTML>
<HTML>

<head>
    <title>ingredients</title>
</head>

<body>

    <!-----------------------------------inputs--------------------------------->
    <form name="myform" method='post'>
        <input name="search" type="text" placeholder="what in your fridge ? "><br>
        <input name="time" type="number" placeholder="maximum number of minutes">
        <!-----------------------------------list des choix--------------------------------->
        <p>enter option :
        <select name='option'>
            <option value="none">none</option>
            <option value="vegetarian">vegetarian</option>
            <option value="vegan">vegan</option>
            <option value="cheap">cheap</option>
            <option value="veryHealthy">very healthy</option>
            <option value="dairyFree">dairy free</option>
            <option value="whole30">whole 30</option>
        </select>
        </p>
        <form method = "GET">
        <button type="submit" name="button" value="submit">Search</button>
        </form>
        <!-----------------------------------favories button--------------------------------->
        <form action = "includes/recette_get.inc.php" method = "POST">
            <button type="submit" name="favories" value="submit"> favories </button>
        </form>
</form>
    </form>
        <p>

            <!-----------------------------------php--------------------------------->
            <?php
            $_SESSION['idOfUser'] = 2 ;
            ?>
            <?php
            if (isset($_POST['button'])) //------------------->si le bouton est cliquee
            {

                //------------------->test sur les separateur de notre ingredients
                $moukawinate = array();
                for ($i = 0; $i < 4; $i++) {
                    array_push($moukawinate, $_POST["text" . $i]);
                }
                $str = implode(",+", $moukawinate);
                
                //------------------->pswd de notre api
                $apiKey = "db254b5cd61744d39a2deebd9c361444";
                //------------------->variables
                $_SESSION['stockIndex'] = array(); //------------------->tableaux des index de notre plat filtrees
                $_SESSION['stockID'] = array(); // ---------------------->tableaux des Id des recipes preferer
                $number = 2; //nombre max des recettes a afficher
                $filterOfUser = "" . $_GET["option"]; //-------------------> string de notre choix de la list select soit vegan,vegetarian...
                $maxTime = (int) $_GET["time"]; //-------------------> le temps en minutes
                $stockRecipe = array();
                ////////////////////////////////////
                //------------------->un objet de notre plat a partir des ingredients
                $url1 = "https://api.spoonacular.com/recipes/findByIngredients?apiKey=" . $apiKey . "&ingredients=" . $str . "&number=" . $number;
                $data1 = file_get_contents($url1);
                $characters1 = json_decode($data1, false);
                //------------------->attribution des id des recettes qui satisfait notre choix dans le tableau $_SESSION['stockID']

                for ($j = 0; $j < 2; $j++) {
                    //-------------------> un objet qui contient notre plat en bouclant sur character1->id
                    $url2 = "https://api.spoonacular.com/recipes/" . $characters1[$j]->id . "/information?apiKey=" . $apiKey . "&includeNutrition=false";
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
                echo '<form action = "includes/recette_set.inc.php" method = "POST">' ;
                foreach ($_SESSION['stockIndex'] as $i) {
                    //------------------->titre et image de notre plat
                    echo "<h1>" . $characters1[$i]->title . "</h1><br><img src=" . $characters1[$i]->image . " width='400' /><br>";
                    //-------------------> les ingredient utiliser de votre choix
                    echo '<h4>ingredients :</h4>  ';
                    $url3 = "https://api.spoonacular.com/recipes/" . $_SESSION['stockID'][$i] . "/ingredientWidget.json?apiKey=" . $apiKey;
                    $data3 = file_get_contents($url3);
                    $ObjetIngredient = json_decode($data3, false);
                    // 9lab 3la les ingredients
                    foreach ($ObjetIngredient->ingredients as $ingredient) {
                        echo ' <br><img src="https://spoonacular.com/cdn/ingredients_100x100/' . $ingredient->image . '" width="30" /><br>' . $ingredient->name . '<br>quantity : ' . $ingredient->amount->metric->value . ' ' . $ingredient->amount->metric->unit;
                    }
                    echo '<h4>recipe : </h4>';
                    echo '<section style="background-color:pink ; border:3px solid red ; padding:15px ; margin:5px">';
                    echo $stockRecipe[$i];
                    echo '</section>';
                    echo '<button type="submit" name="add'.$i.'" value="submit"> add to favories </button>';
                }
                echo '</form>' ;
            }
            ?>
        </p>
</body>

</html>