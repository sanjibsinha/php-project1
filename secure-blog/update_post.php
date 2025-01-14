<?php
session_start();  // Start session
require('db.php');  // Database connection

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$post_id = $_GET['id'];

// Fetch post details to populate the form
$sql = "SELECT title, content, user_id FROM posts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $content, $user_id);
$stmt->fetch();

if ($_SESSION['user_id'] != $user_id) {
    // Only the post owner can update the post
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = htmlspecialchars(trim($_POST['title']));
    $new_content = htmlspecialchars(trim($_POST['content']));

    if (empty($new_title) || empty($new_content)) {
        $error = "Title and content are required.";
    } else {
        // Update post in database
        $sql_update = "UPDATE posts SET title = ?, content = ?, updated_at = NOW() WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $new_title, $new_content, $post_id);

        if ($stmt_update->execute()) {
            $success = "Post updated successfully!";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Update Post</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="form-control" rows="5" required><?php echo htmlspecialchars($content); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Post</button>
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>