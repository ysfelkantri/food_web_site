<?php
session_start();
?>
<?php
if (isset($_POST['favories'])) {
    include_once 'db.inc.php'; //ou on a la db pour utiliser $conn

    $_SESSION['arrstockIdFromBD'] = array(); //--------------------> this array stock recipes id added in the favories
    $sql = "select recipe_id from recipes where user_id = " . $_SESSION['id'] . ";"; //-------------------->$_SESSION['id'] le id de notre user ;
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($_SESSION['arrstockIdFromBD'], $row['recipe_id']);
        }
    }
    /*echo "<p>" ;
    foreach ($_SESSION['arrstockIdFromBD'] as $idd) echo $idd . "<br>" ;
    echo "</p>" ;*/
    $apiKey = "b2e613b2e4134c6f9ac19ed395709b60";
    ////////////////////////////////////////////////////////////

    //----------------------------------------form of button delete-------------------------------------------------
    echo '<form action = "recette_delete.inc.php" method = "POST">';

    //----------------------------------------affichage de favories---meme que spoon ----------------------------------------------
    foreach ($_SESSION['arrstockIdFromBD'] as $i) {
        $url2 = "https://api.spoonacular.com/recipes/" . $i . "/information?apiKey=" . $apiKey . "&includeNutrition=false";
        $data2 = file_get_contents($url2);
        $characters2 = json_decode($data2, false);
        //------------------->titre et image de notre plat
        echo "<h1>" . $characters2->title . "</h1><br><img src=" . $characters2->image . " width='400' /><br>";
        //-------------------> les ingredient utiliser de votre choix
        echo '<h4>ingredients :</h4>  ';
        $url3 = "https://api.spoonacular.com/recipes/" . $i . "/ingredientWidget.json?apiKey=" . $apiKey;
        $data3 = file_get_contents($url3);
        $ObjetIngredient = json_decode($data3, false);
        // 9lab 3la les ingredients
        foreach ($ObjetIngredient->ingredients as $ingredient) {
            echo ' <br><img src="https://spoonacular.com/cdn/ingredients_100x100/' . $ingredient->image . '" width="30" /><br>' . $ingredient->name . '<br>quantity : ' . $ingredient->amount->metric->value . ' ' . $ingredient->amount->metric->unit;
        }
        echo '<h4>recipe : </h4>';
        echo '<section style="background-color:pink ; border:3px solid red ; padding:15px ; margin:5px">';
        echo $characters2->instructions;
        echo '</section>';

        //----------------------------------------button delete---------------------------------------------------------
        echo '<button type="submit" name="del' . $i . '" value="submit"> delete from favories </button>';
    }
    echo '</form>';
    //////////////////////////////////////////////////////////////////////
}
//------------------------> $_SESSION['arrstockIdFromBD'] :::: tableau des id de recettes aimee par notre user
?>