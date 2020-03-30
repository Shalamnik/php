<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link href="styles/style.css" rel="stylesheet" type="text/css">
</head>

<body>
  
  <div class="container">
    <form method="POST">
      <h1 style="text-align: center">Admin</h1>
      <!-- <p>Fill this form to create a review <span class="error"><?php echo $form_error ?></span></p> -->
      <hr>

      <label for="login">Login:</label>
      <input type="text" name="login" value="">

      <label for="password">Password:</label>
      <input type="password" name="password">

      <button id="login" type="submit" name="submit">Log in</button>
    </form>
  </div>

</body>

</html>
