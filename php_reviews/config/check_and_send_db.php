<?php

$form_error = '';
$rev_add = '';
$name = $email = $review = '';
$errors = array('name' => '', 'email' => '', 'review' => '');


//check submit
if (isset($_POST['submit'])) {

  if (empty($_POST['name'])) {
    $errors['name'] = 'A name is required';
  } else {
    $name = $_POST['name'];
    if (!preg_match('/^[a-zA-Z0-9\s]+$/', $name)) {
      $errors['name'] = 'Name must have letters, digits and spaces only';
    }
  }

  //check email
  if (empty($_POST['email'])) {
    $errors['email'] = 'An email is required';
  } else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = 'Email must be a valid email address';
    }
  }

  //check text review
  if (empty($_POST['review'])) {
    $errors['review'] = 'Review must have some characters';
  } else {
    $review = $_POST['review'];
    if (!preg_match('/^[a-zA-Z0-9\s.,:!\'\"]+/', $review)) {
      $errors['review'] = 'Review must have letter, digits and spaces only';
    }
  }

  //check errors in form and send data to db
  if (array_filter($errors)) {
    $form_error = 'Errors in the form';
  } else {

    include('config/db_connect.php');

    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $review = mysqli_real_escape_string($connect, $_POST['review']);

    //check img type and size
    $img_type = $_FILES['userImg']['type'];

    if (
      $img_type === 'image/png' ||
      $img_type === 'image/jpeg' ||
      $img_type === 'image/gif'
    ) {

      $size_img = getimagesize($_FILES['userImg']['tmp_name']);
      print_r($size_img);

      if ($size_img[0] > 320 || $size_img[1] > 240) {

        include('config/compress_img.php');

        $source_img = $_FILES['userImg']['tmp_name'];

        $img = compress($source_img, $source_img, 75);
        $img = addslashes(file_get_contents($img));
      } else {

        $img = addslashes(file_get_contents($_FILES['userImg']['tmp_name']));
      }
    } else {
      $img = null;
    }

    $sql = "INSERT INTO reviews (name, email, text, img) VALUES ('{$name}', '{$email}', '{$review}', '{$img}')";

    //save to db and check
    if (mysqli_query($connect, $sql)) {
      // $rev_add = 'Review added';

      // $name = '';
      // $email = '';
      // $review = '';

      // mysqli_close($connect);
      
      header('location: index.php');
      exit();

    } else {
      echo 'query error: ' . mysqli_error($connect);
    }
  }
}

?>