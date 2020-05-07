<?php include('modules/form_process.php') ?>

<!DOCTYPE html>
<html>

<head>
    <title>Reviews</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="styles/main.css" rel="stylesheet" type="text/css">
    <link href="styles/reviews.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <p>Fill this form to create a review <span class="error"><?= $form_error ?? ''; ?></span></p>
            <hr>

            <label for="name">Name:</label>
            <span class="error"><?= $errors['name'] ?? ''; ?></span>
            <input type="text" name="name" value="<?= htmlspecialchars($name ?? ''); ?>">

            <label for="mail">E-mail:</label>
            <span class="error"><?= $errors['email'] ?? ''; ?></span>
            <input type="email" name="email" value="<?= htmlspecialchars($email ?? ''); ?>">

            <label for="review">Review:</label>
            <span class="error"><?= $errors['review'] ?? ''; ?></span>
            <textarea id="text" name="review"><?= htmlspecialchars($review ?? ''); ?></textarea>

            <label for="userImg"><b>Choose your Avatar:</b></label>
            <input type="hidden" name="MAX_FILE_SIZE" value="16777215">
            <input type="file" name="userImg">

            <input type="submit" name="submit" value="Submit">
            <button id="btn-preview" type="button" value="Preview">Preview</button>
            <a id="admin" href="admin.php">For Admin</a>
        </form>
    </div>

    <script src="scripts/preview.js"></script>

    <?php include('reviews.php') ?>

</body>

</html>