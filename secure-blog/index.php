<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Admin Panel (Left Side) -->
            <div class="col-md-3 bg-light p-3">
                <h4>Admin Panel</h4>
                <a href="login.php" class="btn btn-primary mb-2">Login</a>
                <a href="register.php" class="btn btn-success mb-2">Register</a>
                <a href="create_post.php" class="btn btn-warning mb-2">Create Post</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>

            <!-- Blog Content (Right Side) -->
            <div class="col-md-9">
                <h2>Latest Blog Posts</h2>
                <!-- Display Posts here -->
                <?php include('display_posts.php'); ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>