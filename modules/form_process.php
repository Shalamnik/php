<?php

require('user_validator.php');

if (isset($_POST['submit'])) {
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $review = $_POST['review'];

    if (array_filter($errors)) {
        $form_error = 'Errors in the form';
    } else {
        include('db_connect.php');
        include('image.php');

        $img_data = new Image($_FILES['userImg']);
        $img_name = $img_data->getName();
        $img_path = $img_data->getPath();

        if ($img_data->validateImg()) {
            $img_data->addImg();
        }

        $sql = "INSERT INTO reviews (name, email, text, img_name, img_path) 
                VALUES (?, ?, ?, ?, ?)";

        if ($db->query($sql, $name, $email, $review, $img_name, $img_path)) {
            $db->close();

            header('location: index.php');
        }
    }
}

?>