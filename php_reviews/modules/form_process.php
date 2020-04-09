<?php

require('user_validator.php');

if (isset($_POST['submit'])) {
    $validation = new UserValidator($_POST);
    $errors = $validation->validateForm();

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

            $img_size = getimagesize($img_path);

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
                VALUES ('{$name}', '{$email}', '{$review}', '{$img_name}', '{$upload_path}')";

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
