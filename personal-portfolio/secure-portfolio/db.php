<?php
$servername = "localhost";
$username = "root"; // Default username for local MySQL
$password = "your password"; // Default password is empty for local MySQL
$dbname = "portfolio"; // Database name

// Create connection using mysqli with error handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error and display a general message to the user
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set for the connection to avoid issues with special characters
$conn->set_charset("utf8");
?>