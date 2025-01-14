<?php
// Connect to the database
$host = 'localhost'; // Database host
$dbname = 'your_database_name'; // Database name
$username = 'your_username'; // Database username
$password = 'your_password'; // Database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the latest blog posts
    $stmt = $pdo->query("SELECT title, content, created_at FROM posts ORDER BY created_at DESC LIMIT 5");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the posts
    foreach ($posts as $post) {
        echo "<div class='post'>";
        echo "<h3>" . htmlspecialchars($post['title']) . "</h3>";
        echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>";
        echo "<small>Posted on " . htmlspecialchars($post['created_at']) . "</small>";
        echo "</div><hr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>