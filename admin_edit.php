<?php

include('modules/db_connect.php');

session_start();

$sql = 'SELECT * FROM reviews WHERE id = ?';
$user_data = $db->query($sql, $_SESSION['user_id'])->fetchArray();

if (isset($_POST['edit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $review = $_POST['review'];

    include('modules/image.php');

    $img_data = new Image($_FILES['userImg']);
    $img_name = $img_data->getName();
    $img_path = $img_data->getPath();

    if ($img_data->validateImg()) {
        $img_data->addImg();
    }

    $sql = "UPDATE reviews SET name = ?, email = ?, text = ?, img_name = ?, 
            img_path = ?,admin_changed = ? WHERE id = ?";

    if ($db->query($sql, $name, $email, $review, $img_name, $upload_path, 1, 
                   $_SESSION['user_id'])) {
        $db->close();

        header('location: admin_edit.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/main.css" rel="stylesheet" type="text/css">
    <link href="styles/reviews.css" rel="stylesheet" type="text/css">
    <title>Admin_editing</title>
</head>

<body>
    <nav class="navigation">
        <a href="index.php">User form</a>
        <a href="admin.php">Admin page</a>
    </nav>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($user_data['name'] ?? ''); ?>">

            <label for="mail">E-mail:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user_data['email'] ?? ''); ?>">

            <label for="review">Review:</label>
            <textarea id="text" name="review"><?= htmlspecialchars($user_data['text'] ?? ''); ?></textarea>

            <p>
                <?php

                if ($user_data['img_path'] == null) {
                    echo '<img width="120" height="90" src="images/default.png" alt="user-img">';
                } else {
                    echo '<img width="120" height="90" src="' . $user_data['img_path'] . '">';
                }

                ?>
            </p>
            <label for="userImg"><b>Change User Avatar:</b></label>
            <input type="hidden" name="MAX_FILE_SIZE" value="16777215">
            <input type="file" name="userImg" value>

            <input style="width: 100%" type="submit" name="edit" value="Edit">
        </form>
    </div>
</body>

</html>