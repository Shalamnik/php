<?php 

if (isset($_POST['delete'])) {
    $sql = "SELECT img_path FROM reviews WHERE id = ?";
    $img_path = $db->query($sql, $_POST['edit_id'])->fetchArray()['img_path'];
    
    if ($img_path) {
        unlink($img_path);    
    }

    if ($db->query("DELETE FROM reviews WHERE id = ?", $_POST['edit_id'])) {
        $db->close();
        
        header('location: admin_reviews.php');
    }
}

if (isset($_POST['checked'])) {
    $query = 'SELECT admin_checked FROM reviews WHERE id = ?';
    $response = $db->query($query, $_POST['edit_id'])->fetchArray();
    $checked = $response['admin_checked'];

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

?>