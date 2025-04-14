<?php

   ini_set ('display_errors', 1);
   error_reporting(E_ALL);
  
  $getIngredient = false;
  $getCategory   = false;
  $getRecipe     = false;
  
  // Minimal form validation:
  if (isset($_GET['ingredient']) && ($_GET['ingredient'] != '')) {
    $passedValue = strtolower($_GET['ingredient']);
    $getIngredient = true;
  }
  
  if (isset($_GET['category']) && ($_GET['category'] != '')) {
    $passedValue = strtolower($_GET['category']);
    $getCategory  = true;
  }
  
  if (isset($_GET['recipename']) && ($_GET['recipename'] != '')) {
    $passedValue = strtolower($_GET['recipename']);
    $getRecipe  = true;
  }
  
  $file     = "xml/recipes.xml";
  
  
  $recipes  = simplexml_load_file($file);

  $title    = array();
  $idxArray = 0;
  
  foreach ($recipes as $recipe) {
  
    if ($getIngredient) {
  
      // Get count of ingredients in specific recipe
      $numIngredients = $recipe->ingredients->count();
  
      for ($ingredientIdx=0; $ingredientIdx < $numIngredients; $ingredientIdx++) {
  
        // Get count of items in ingredients list
        $numItems = $recipe->ingredients[$ingredientIdx]->item->count();
  
        for ($itemIdx = 0; $itemIdx < $numItems; $itemIdx++) {
  
          $foundValue = strtolower($recipe->ingredients[$ingredientIdx]->item[$itemIdx]);
  
           /* retrieved title must be casted as a string variable otherwise it is
              considered an XML element and will throw an error */
          if (preg_match('/'.$passedValue.'/', $foundValue)){
            $title[$idxArray++] = (string)$recipe->title;
            $ingredientIdx      = $numIngredients;
            break;
          }
        }
      }
    }
  
    elseif ($getCategory) {
  
      $foundValue = strtolower($recipe['category']);
  
      if ($foundValue == $passedValue) {
        $title[$idxArray++] = (string)$recipe->title;
      }
    }
  
    elseif ($getRecipe) {
  
      $foundValue = strtolower($recipe->title);
  
      if (preg_match('/'.$passedValue.'/', $foundValue)){
        $title[$idxArray++] = (string)$recipe->title;
      }
    }
  }
  
    session_start();
  
    $_SESSION['passed'] = $passedValue;
    $_SESSION['titles'] = $title;
  
    header ('Location: listRecipes.php');
    exit();
    
?>