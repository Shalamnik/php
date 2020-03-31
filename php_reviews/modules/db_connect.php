<?php 

  $connect = mysqli_connect('localhost', 'shalamnik', '131619121518nM$', 'phpformdb');

  if (!$connect) {
    echo 'Connection error: ' . mysqli_connect_error();
  }

?>