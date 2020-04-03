<?php

function longestConsec($strarr, $k)
{

  $n = count($strarr);

  if ($n == 0 || $k > $n || $k <= 0) return "";
  $arr = array_unique($strarr);

  $sort_arr = [];
  foreach ($arr as $elem) {
    $sort_arr[strlen($elem)] = $elem;
  }

  krsort($sort_arr);
  
  $max_str = implode(array_slice($sort_arr, 0, 2));

  print_r($max_str); 
}

longestConsec(["zone", "abigail", "theta", "form", "libe", "zas", "theta", "abigail"], 2);

?>
