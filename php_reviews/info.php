<?php 

  $word = 'hello';
  $reverse_word = str_split($word);
  $reverse_word = array_reverse($reverse_word);
  $reverse_word = implode($reverse_word);
  
  echo $reverse_word;
?>