<?php

include('modules/db_connect.php');

if (isset($_POST['delete'])) {

  $delete_id = mysqli_real_escape_string($connect, $_POST['delete_id']);

  $sql = "DELETE FROM reviews WHERE id = {$delete_id}";

  if (mysqli_query($connect, $sql)) {
    header('location: admin_reviews.php');
  } else {
    echo 'query error: ' . mysqli_error($connect);
  }

}

$sql = 'SELECT id, name, email, text, img_name, img_path, created_at FROM reviews ORDER BY created_at DESC';

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

      <!-- add admin editing -->
      
      <?php if ($_SERVER['SCRIPT_NAME'] == '/github/php/php_reviews/admin_reviews.php'): ?>
      <p>
        <form action="admin_reviews.php" method="POST">
          <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($review['id']) ?>">
          <input type="submit" name="delete" value="delete">
        </form>
      </p>
      <?php endif; ?>
    </div>

  <?php endforeach; ?>
</div>
