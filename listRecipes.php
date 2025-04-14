<?php

  ini_set ('display_errors', 1);
  error_reporting (E_ALL);

  session_start();

  $title       = $_SESSION['titles'];
  $passedValue = $_SESSION['passed'];
  
  include ('include/header.html');
  echo '    <nav>
              <a id="backHome" href="categoryList.php">Home</a>
            </nav>';
  echo '<section id="columns">';

  if (count($title) > 0){
    usort($title, function($t1, $t2) {
      return strcmp($t1, $t2);
    });

    $col    = ceil(count($title)/3);
    $arrNum = count($title);

    echo '  <h3>' .ucwords($passedValue). ': ' .count($title). '</h3>';

    for ($idx= 0; $idx < $arrNum; $idx++) {
      if ($idx == 0) {
        echo '    <div id="column1"><ul>';
      } elseif ($idx == $col) {
        echo '    </ul></div><div id="column2"><ul>';
      } elseif ($idx - $col == $col) {
        echo '    </ul></div><div id="column3"><ul>';
      }

      echo '<li><a href="recipe.php?recipe=' .$title[$idx]. '&banner='.$title[$idx].'.png">' .$title[$idx]. '</a></li>';

      }
    echo '</ul>';
    echo '</div> <!-- column ends -->';
  }

  echo '</section> <!-- columns ends -->';

  include ('include/footer.html');