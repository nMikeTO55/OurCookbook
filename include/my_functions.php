<?php

function GetFormatedAmount($amt_in) {
  $front = "";
  

  $rtn = strpos($amt_in, "/");
  
  // if no fraction exist, return value.
  if($rtn == '')
   return $amt_in;

  // if no leading value, just a fraction, ignore front.
  if ($rtn == 1)  {
    $frac = substr($amt_in, $rtn-1, 3);
  }
  else {
    $front = substr($amt_in,0,$rtn-2);
    $frac = substr($amt_in, $rtn-1, 3);
  }

  if ($frac == '1/4'){
    return $front.'&frac14';
  }
  else if ($frac == '1/2'){
    return $front.'&frac12';
  }
  else if ($frac == '3/4'){
    return $front.'&frac34';
  }
  else if ($frac == '1/3'){
    return $front.'&#8531';
  }
  else if ($frac == '2/3'){
    return $front.'&#8532';
  }
  else if ($frac == '1/5'){
    return $front.'&#8533';
  }
  else if ($frac == '2/5'){
    return $front.'&#8534';
  }
  else if ($frac == '3/5'){
    return $front.'&#8535';
  }
  else if ($frac == '4/5'){
    return $front.'&#8536';
  }
  else if ($frac == '1/6'){
    return $front.'&#8537';
  }
  else if ($frac == '5/6'){
    return $front.'&#8538';
  }
  else if ($frac == '1/8'){
    return $front.'&#8539';
  }
  else if ($frac == '3/8'){
    return $front.'&#8540';
  }
  else if ($frac == '5/8'){
    return $front.'&#8541';
  }
  else if ($frac == '7/8'){
    return $front.'&#8542';
  }
}

function formatParagraph($line) {

  $findFractions  = '#(\d) (\d)/(\d)#';
  $findDF         = '#(\d)(\d)F#';
  $findDC         = '#(\d)(\d)C#';

  //Replace space between fractions ie(2 1/2 -> 21/2)
  $line =preg_replace($findFractions, "$1$2/$3", $line);

  //Insert a degree symbol before F
  $line =preg_replace($findDF, "$1$2&deg;F", $line);

  //Insert a degree symbol before C
  $line =preg_replace($findDC, "$1$2&deg;C", $line);

  $len = strlen($line);

  $loop = true;

  do {

    // match on fraction ie(1/3) to convert formatted fractions
    if (preg_match('#(\d)/(\d)#', $line, $match, PREG_OFFSET_CAPTURE)) {
      $front = substr($line,0,($match[0][1]));
      $back = substr($line, ($match[0][1]+4),$len-1);
      $line = $front. "" .GetFormatedAmount($match[0][0]). " " . $back;
    }
    else {
      $loop = false;
    }
    $len = strlen($line);

  } while ($loop);

  return $line;
}

function UpdatedList() {

  // initilize variables
  $file           = "xml/recipes.xml";
  $recipes        = simplexml_load_file($file);
  $initialArray   = array();
  $condensedArray = array();
  $updatedArray   = array();
  $arrayCnt       = 0;
  $idx            = 0;

  // load first array with each category
  foreach ($recipes as $recipe){
    $initialArray[$arrayCnt] = (string)$recipe['category'];
    $arrayCnt++;
  }

  //condense array elements into key and values
  $condensedArray = array_count_values($initialArray);

  // sort by number of categories
  arsort($condensedArray);

  // strip value from array and only load category name
  foreach ($condensedArray as $key=>$val) {
    $updatedArray[$idx] = $key;
    $idx++;
  }

  return $updatedArray;
}
?>