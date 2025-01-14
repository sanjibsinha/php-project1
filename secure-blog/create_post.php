<?php
session_start();  // Start session
require('db.php');  // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $user_id = $_SESSION['user_id'];  // Get logged-in user's ID

    // Input validation
    if (empty($title) || empty($content)) {
        $error = "Title and content are required.";
    } else {
        // Insert new post into database
        $sql = "INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $user_id, $title, $content);

        if ($stmt->execute()) {
            $success = "Post created successfully!";
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
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Create New Post</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Post</button>
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