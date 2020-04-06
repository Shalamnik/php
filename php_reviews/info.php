<?php 

  if (isset($_POST['submit'])) {

    session_start();

    $_SESSION['name'] = $_POST['name'];

    setcookie('gender', $_POST['gender'], time() + 86400);

    header('location: show.php');
  }

?>

<html>
  <head>
    <title>Test</title>
    <meta charset="utf-8">
  </head>
  <body>
    <form action="#" method="POST">
      <input type="text" name="name">
      <select name="gender" id="select">
        <option value="male">male</option>
        <option value="female">female</option>
      </select>
      <input type="submit" name="submit" value="submit">
    </form>
  </body>
</html>