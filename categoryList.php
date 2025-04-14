<?php

  include ('include/header.html');
?>  

  <div class=line-one>
    <div class=menu-picture>
      <a href="search.php?category=baked"><img src="./images/categories/baked goods.png"width="250" height="150">
        <div class="image-text">
          <h4>Baked Goods</h4>
        </div>
      </a>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=breakfast brunch"><img src="./images/categories/breakfast and brunch.png" width="250" height="150">
        <div class="image-text">
          <h4>Breakfest and Brunch</h4>
        </div>
      </a>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=canning"><img src="./images/categories/canning.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Canning</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=chili stews"><img src="./images//categories/chili and stew.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Chilis and Stews</h4>
        </div>
    </div>
  </div>

  <div class=line-two>
    <div class=menu-picture>
      <a href="search.php?category=dessert"><img src="./images/categories/dessert and sweets.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Desserts</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=drinks"><img src="./images/categories/drinks.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Drinks</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=entree"><img src="./images/categories/entree.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Entrees</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=horsdoeuvres"><img src="./images/categories/hors doeuvres.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Hordoeuvres</h4>
        </div>
    </div>

  </div>

  <div class=line-three>
    <div class=menu-picture>
      <a href="search.php?category=salad"><img src="./images/categories/salad.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Salads</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=sides"><img src="./images/categories/sides.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Sides</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=slow cook"><img src="./images/categories/slow cooker.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Slow Cooking</h4>
        </div>
    </div>
    <div class=menu-picture>
      <a href="search.php?category=soup sauces"><img src="./images/categories/soup and sauces.png" width="250" height="150"></a>
        <div class="image-text">
          <h4>Soups and Sauces</h4>
        </div>
    </div>

  </div>

    <div id="search">
      <form action="search.php" method="GET">
        <table>
          <tr>
            <td class="labelTbl">Search by Title:</td>
            <td><span class="input"><input type="text" name="recipename"/></span></td>
            <td><span class="selectionBtn"><input class="siteButtons" type="submit" value="Select"/></span></td>
          </tr>
        </table>
      </form>
      <form action="search.php" method="GET">
        <table>
          <tr>
            <td class="labelTbl">Search by Ingredient:</td>
            <td><span class="input"><input type="text" name="ingredient"/></span></td>
            <td><span class="selectionBtn"><input class="siteButtons" type="submit" value="Select"/></span></td>
          </tr>
        </table>
      </form>
    </div> <!-- search ends -->
    <input type="button" class="siteButtons" id="toggleButton" value="Search for Recipes" />

<?php
  
  include ('include/footer.html');

?>