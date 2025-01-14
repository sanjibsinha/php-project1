<?php
// Sample data for posts
$posts = [
    [
        'title' => 'First Blog Post',
        'content' => 'This is the content of the first blog post.'
    ],
    [
        'title' => 'Second Blog Post',
        'content' => 'This is the content of the second blog post.'
    ],
    // Add more posts as needed
];

foreach ($posts as $post) {
    echo '<div class="post">';
    echo '<h3>' . htmlspecialchars($post['title']) . '</h3>';
    echo '<p>' . htmlspecialchars($post['content']) . '</p>';
    echo '</div>';
}
?>