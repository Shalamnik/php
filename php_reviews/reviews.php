<?php

include('modules/db_connect.php');

if (isset($_POST['delete'])) {
    if ($db->query("DELETE FROM reviews WHERE id = ?", $_POST['edit_id'])) {
        $db->close();
        header('location: admin_reviews.php');
    }
}

if (isset($_POST['checked'])) {
    $query = 'SELECT admin_checked FROM reviews WHERE id = ?';
    $response = $db->query($query, $_POST['edit_id'])->fetchAll();
    $checked = $response[0]['admin_checked'];

    if ($checked) {
        $db->query("UPDATE reviews SET admin_checked = 0 WHERE id = ?", $_POST['edit_id']);
        $db->close();
        header('location: admin_reviews.php');
    } else {
        $db->query("UPDATE reviews SET admin_checked = 1 WHERE id = ?", $_POST['edit_id']);
        $db->close();
        header('location: admin_reviews.php');
    }
}

if (isset($_POST['edit'])) {
    session_start();
    $_SESSION['user_id'] = $_POST['edit_id'];

    header('location: admin_edit.php');
}

$sql = 'SELECT id, name, email, text, img_name, img_path, created_at, admin_checked 
        FROM reviews ORDER BY created_at DESC';

$reviews = $db->query($sql)->fetchAll();

?>

<div class="reviews">
    <?php foreach ($reviews as $review) : ?>
        <?php 
            if (
                $_SERVER['SCRIPT_NAME'] == '/github/php/php_reviews/index.php' &&
                !$review['admin_checked']
            ) continue; 
        ?>

        <div class="review">
            <?php

            if ($review['img_path'] == null) {
                echo '<img src="images/default.png" alt="user-img">';
            } else {
                echo '<img src="' . $review['img_path'] . '">';
            }

            ?>
            <p>
                <span>
                    Name: <?= htmlspecialchars($review['name']); ?>
                </span>
                <span>
                    Email: <?= htmlspecialchars($review['email']); ?>
                </span>
                <span id="date">
                    Date: <?= htmlspecialchars($review['created_at']); ?>
                </span>
            </p>
            <p id="text">
                <b>Review:</b> <br><br> <?= nl2br(htmlspecialchars($review['text'])); ?>
            </p>

            <!-- add admin editing -->

            <?php if ($_SERVER['SCRIPT_NAME'] == '/github/php/php_reviews/admin_reviews.php'): ?>

                <?php if ($review['admin_checked'] == true) : ?>

                    <h4 style="text-align: right">Checked</h4>
                    <?php $input_value = 'UNCHECKED'; ?>

                <?php else : ?>

                    <h4>Unchecked</h4>
                    <?php $input_value = 'CHECKED'; ?>

                <?php endif; ?>
                <p>
                    <form class="admin" action="admin_reviews.php" method="POST">
                        <input type="hidden" name="edit_id" value="<?= htmlspecialchars($review['id']); ?>">
                        <input style="width: 33%" type="submit" name="edit" value="EDIT">
                        <input style="width: 33%" type="submit" name="delete" value="DELETE">
                        <input style="width: 33%" type="submit" name="checked" value="<?= $input_value; ?>">
                    </form>
                </p>
            <?php endif; ?>
        </div>

    <?php endforeach; ?>
</div>