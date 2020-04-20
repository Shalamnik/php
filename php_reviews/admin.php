<?php

session_start();

if (isset($_SESSION['admin'])) {
    if ($_SESSION['admin'] == $_SERVER['HTTP_USER_AGENT']) {
        header('location: admin_reviews.php');
    } else {
        $incorrect = 'Invalid Session';
    }
}

if (isset($_POST['submit'])) {

    if ($_POST['login'] == 'admin' && $_POST['password'] == 12345) {
        $_SESSION['admin'] = $_SERVER['HTTP_USER_AGENT'];
        header('location: admin_reviews.php');
    } else {
        $incorrect = 'incorrect password or login';
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="styles/main.css" rel="stylesheet" type="text/css">
    <link href="styles/reviews.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navigation">
        <a href="index.php">User form</a>
    </nav>

    <div class="container">
        <form method="POST">
            <h1 style="text-align: center">Admin</h1>
            <hr>

            <label for="login">Login:</label>
            <input type="text" name="login" value="">

            <label for="password">Password:</label>
            <input type="password" name="password">
            <p class="error"><?= $incorrect ?? ''; ?></p>

            <button id="login" type="submit" name="submit" value="submit">Log in</button>
        </form>
    </div>

</body>

</html>