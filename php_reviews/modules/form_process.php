<?php

require('user_validator.php');

if (isset($_POST['submit'])) {
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    if (array_filter($errors)) {
        $form_error = 'Errors in the form';
        $name = $_POST['name'];
        $email = $_POST['email'];
        $review = $_POST['review'];
    } else {
        include('db_connect.php');

        $name = $db->escape_string($_POST['name']);
        $email = $db->escape_string($_POST['email']);
        $review = $db->escape_string($_POST['review']);

        $img_type = $_FILES['userImg']['type'];

        if (
            $img_type === 'image/png' ||
            $img_type === 'image/jpeg' ||
            $img_type === 'image/gif'
        ) {
            $img_name = $_FILES['userImg']['name'];
            $img_path = $_FILES['userImg']['tmp_name'];
            $img_size = getimagesize($img_path);
            
            $upload_path = 'images/' . $img_name;

            if ($img_size[0] > 320 || $img_size[1] > 240) {
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

        $sql = "INSERT INTO reviews (name, email, text, img_name, img_path) 
                VALUES (?, ?, ?, ?, ?)";

        if ($db->query($sql, $name, $email, $review, $img_name, $upload_path)) {
            $db->close();

            header('location: index.php');
        }
    }
}

?>
