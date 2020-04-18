<?php 

session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin view</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="styles/main.css" rel="stylesheet" type="text/css">
    <link href="styles/reviews.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navigation">
        <a href="index.php">User form</a>
        <a href="logout.php">Log out</a>
    </nav>
    <?php include('reviews.php') ?>
</body>

</html>