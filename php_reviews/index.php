<?php include('config/check_and_send_db.php') ?>

<!DOCTYPE html>
<html>

<head>
  <title>PHP test</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="styles/style.css" rel="stylesheet" type="text/css">
  <link href="styles/review-style.css" rel="stylesheet" type="text/css">
</head>

<body>
  
  <div class="container">
    <form method="POST" enctype="multipart/form-data">
      <h1 style="text-align: center">Reviews</h1>
      <p>Fill this form to create a review <span class="error"><?php echo $form_error ?></span></p>
      <hr>

      <label for="name">Name:</label>
      <span class="error"><?php echo $errors['name']; ?></span>
      <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">

      <label for="mail">E-mail:</label>
      <span class="error"><?php echo $errors['email']; ?></span>
      <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">

      <label for="review">Review:</label>
      <span class="error"><?php echo $errors['review'];  ?></span>
      <textarea id="text" name="review"><?php echo htmlspecialchars($review); ?></textarea>

      <label for="userImg"><b>Choose your Avatar:</b></label>
      <input type="hidden" name="MAX_FILE_SIZE" value="16777215">
      <input type="file" name="userImg">

      <input type="submit" name="submit" value="Submit">
    </form>
  </div>

  <?php include('list_reviews.php') ?>

</body>

</html>
