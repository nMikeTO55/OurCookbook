<?php

  $displayPage = "Recipe";
  include ('include/my_functions.php');

  if ((isset($_GET['banner']))){

    $banner = $_GET['banner'];
    $have_photo = false;

    // If picture supplied for recipe, use it

  if (file_exists("images/$banner"))
      $have_photo = true;
  }
 
  include ('include/header.html');
  echo '    <nav>
              <a id="backHome" href="categoryList.php">Home</a>
            </nav>';
  $done = false;
  $name = $_GET["recipe"];
  $file = "xml/recipes.xml";

  $recipes = simplexml_load_file($file);

  foreach ($recipes as $recipe) {

    if ((string)$recipe->title  == $name){
      $done = true;

      $nameSearch = (string)$recipe->title;

      if ($have_photo === false){
        $category_type = (string)$recipe['category'];

        if (str_contains($nameSearch, 'Cookies'))
          $banner = 'Cookie dough.png';
        if (str_contains($nameSearch, 'Spaghetti'))
            $banner = 'PH_pasta.png';
        else {
            $banner = match ($category_type){
              'baked'            => 'dough.png',
              'breakfast brunch' => 'PH_breakfast.png',
              'chili stews'      => 'PH_chili.png',
              'canning'          => 'Red Hot Pepper Jelly.png',
              'dessert'          => 'Pastry Recipe.png',
              'drinks'           => 'PH_drinks.png',
              'entree'           => 'Korean Style Flank Steak.png',
              'horsdoeuvres'     => 'PH_horsdoeuvres.png',
              'salad'            => 'Cobb Salad.png',
              'sides'            => 'PH_sides.png',
              'slow cook'        => 'PH_slowcooker.png',
              'soup sauces'      => 'Cream of Tomato and Roasted Red Pepper Soup.png',
              default            => 'Holder.png',
          };
        }
      }
      echo '<aside id="recipePicture">
              <p><button class="siteButtons" onclick="printRecipe(\'printArea\')">Print Recipe</button></p>
              <p> <img id="aside-img" src="images/'.$banner.'" height="328" width="500" /></p>
            </aside> <!-- recipePicture ends-->';

  echo '
      <section id="printArea">
      <section id="enclosedIngredientList">

        <section id="ingredientList">

          <div id="title">
            <h2>'.$recipe->title.'</h2>
          </div>';

      // List ingredients required for recipes
      $ingredientCnt = $recipe->ingredients->count();
      
      for ($ingredientIdx = 0; $ingredientIdx < $ingredientCnt; $ingredientIdx++){

        echo '<p class="ingredientTitle">'.$recipe->ingredients[$ingredientIdx]['name']. '</p>';

        $itemCnt = $recipe->ingredients[$ingredientIdx]->item->count();
        $col     = ceil($itemCnt/2);

        for ($i=0; $i < $itemCnt; $i++){
          if ($i == 0){
            echo '<section id="leftIngredients"><ul>';
          } elseif ($i == $col) {
             echo '</lu></section><section id="rightIngredients"><ul>';
          }


          if ($recipe->ingredients[$ingredientIdx]->item[$i] != ''){
            $amt_in = $recipe->ingredients[$ingredientIdx]->item[$i]['amount'];
            // Get the ingedient
            $item_in = $recipe->ingredients[$ingredientIdx]->item[$i];

            echo '    <li><span class="item">'
                        .GetFormatedAmount($amt_in).' '
                        .$recipe->ingredients[$ingredientIdx]->item[$i]['unit'].' '
                        .formatParagraph($item_in).
                      '</span></li>';
          }
        }
        echo '    </ul>';
        echo  ' </section> <!-- left/rightIngredients ends -->';
  
      }
      echo '<p class="clear"></p>';
      echo '</section> <!-- ingredientList ends -->
            </section> <!-- enclosedIngedientList ends -->';

  echo '<p class="clear"></p>

        <section id="steps">
          <ol>';

      // List steps required for recipe

      foreach ($recipe->prep->step as $step) {
         echo '  <li>' .formatParagraph($step). '</li>';
      }

      echo '  </ol>
      </section> <!-- steps ends -->

      <p class="clear"></p>';

      $notesCnt = $recipe->notes->count();

      // If any notes- list for ($notesIdx = 0; $notesIdx < $notesCnt; $notesIdx++){

      for ($notesIdx = 0; $notesIdx < $notesCnt; $notesIdx++){

        echo '<p class="clear"></p>';
        echo '<section id="notes">';
        echo '<h4>' .$recipe->notes[$notesIdx]->title. '</h4>';

        $contentCnt = $recipe->notes[$notesIdx]->content->count();

        echo '  <ul>';
        for ($contentIdx = 0; $contentIdx < $contentCnt; $contentIdx++) {

          $notesLine = $recipe->notes[$notesIdx]->content[$contentIdx];
          echo '<li>'.formatParagraph($notesLine).'</li>';

        }
      echo '  </ul>';
      echo '</section> <!-- notes ends -->
              </section> <!-- printArea ends-->';

      }
    }
    if ($done) {break;}; // found the recipe no need to continue foreach loop.
  }
  include ('include/footer.html');
