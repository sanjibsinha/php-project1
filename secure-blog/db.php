<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$sql = "SELECT posts.title, posts.content, posts.created_at, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='blog-post'>";
        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
        echo "<p><small>By " . htmlspecialchars($row['username']) . " on " . $row['created_at'] . "</small></p>";
        echo "<p>" . htmlspecialchars($row['content']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No blog posts available.</p>";
}
?>