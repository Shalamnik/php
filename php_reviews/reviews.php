<?php

include('modules/db_connect.php');

$sql = 'SELECT name, email, text, img_name, img_path, created_at FROM reviews ORDER BY created_at DESC';

$result = mysqli_query($connect, $sql);

$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($connect);

?>

<div class="reviews">
  <?php foreach ($reviews as $review) : ?>

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
          Name: <?php echo htmlspecialchars($review['name']); ?>
        </span>
        <span>
          Email: <?php echo htmlspecialchars($review['email']); ?>
        </span>
        <span id="date">
          Date: <?php echo htmlspecialchars($review['created_at']); ?>
        </span>
      </p>
      <p id="text">
        <b>Review:</b> <br><br> <?php echo htmlspecialchars($review['text']); ?>
      </p>
    </div>

  <?php endforeach; ?>
</div>