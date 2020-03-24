<?php

include('config/db_connect.php');

$sql = 'SELECT name, email, text, img, created_at FROM reviews ORDER BY created_at';

$result = mysqli_query($connect, $sql);

$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($connect);

?>

<div class="reviews">
  <?php foreach ($reviews as $review) : ?>

    <div class="review">
      <?php

      if ($review['img'] == null) {
        echo '<img src="data:image/jpeg;base64,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"/>';
      } else {
        echo '<img src="data:image/jpeg;base64,' . base64_encode($review['img']) . '"/>';
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