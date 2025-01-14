<?php
session_start();  // Start session
require('db.php');  // Database connection

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$post_id = $_GET['id'];

// Fetch post details to ensure the user is the owner
$sql = "SELECT user_id FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($user_id);
$stmt->fetch();

if ($_SESSION['user_id'] != $user_id) {
    // Only the post owner can delete the post
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete post from database
    $sql_delete = "DELETE FROM posts WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $post_id);

    if ($stmt_delete->execute()) {
        $success = "Post deleted successfully!";
        header("Location: index.php");
        exit();
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Are you sure you want to delete this post?</h2>

        <form method="POST">
            <button type="submit" class="btn btn-danger">Yes, Delete Post</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>

        <?php
        if (isset($error)) {
            echo "<div class='alert alert-danger mt-3'>$error</div>";
        }
        if (isset($success)) {
            echo "<div class='alert alert-success mt-3'>$success</div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>