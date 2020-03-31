<?php 


  if (isset($_POST['submit'])) {

    if (($_POST['login'] == 'admin') && ($_POST['password'] == 12345)) {
      header('location: admin_reviews.php');
    }
  }


?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="styles/main.css" rel="stylesheet" type="text/css">
</head>

<body>
  
  <div class="container">
    <form method="POST">
      <h1 style="text-align: center">Admin</h1>
      <hr>

      <label for="login">Login:</label>
      <input type="text" name="login" value="">

      <label for="password">Password:</label>
      <input type="password" name="password">

      <button id="login" type="submit" name="submit" value="submit">Log in</button>
    </form>
  </div>

</body>

</html>

