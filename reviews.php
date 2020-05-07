<?php

include('modules/db_connect.php');
include('modules/submit_process.php');

$sql = 'SELECT * FROM reviews ORDER BY created_at DESC';
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
            <?php if ($review['admin_changed']): ?>
                <h4 style="text-align: right">Changed by Admin</h4>
            <?php endif; ?>
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