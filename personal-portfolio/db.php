<?php
$servername = "localhost";
$username = "root"; // Default username for local MySQL
$password = "your-password-for-mysql-database"; // Default password might be empty for local MySQL
$dbname = "portfolio"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}