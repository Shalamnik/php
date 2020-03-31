<?php

$form_error = '';
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

    include('db_connect.php');

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

      $img_name = $_FILES['userImg']['name'];
      $img_path = $_FILES['userImg']['tmp_name'];
      $upload_path = 'images/' . $img_name;

      $size_img = getimagesize($img_path);

      if ($size_img[0] > 320 || $size_img[1] > 240) {

        include('img_compress.php');

        $img = compress($img_path, $img_path, 75);

        move_uploaded_file($img, $upload_path);

      } else {

        move_uploaded_file($img_path, $upload_path);
      }


    } else {
      
      $img_name = null;
      $upload_path = null;
    }

    $sql = "INSERT INTO reviews (name, email, text, img_name, img_path) VALUES ('{$name}', '{$email}', '{$review}', '{$img_name}', '{$upload_path}')";

    //save to db and check
    if (mysqli_query($connect, $sql)) {
      mysqli_close($connect);

      header('location: index.php');

    } else {
      echo 'query error: ' . mysqli_error($connect);
    }
  }
}

?>
