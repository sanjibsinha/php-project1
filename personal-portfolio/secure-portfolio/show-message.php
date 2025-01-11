<?php
include 'db.php'; // Include the database connection

// Fetch Messages Data with Prepared Statement
$sql_projects = "SELECT * FROM contact";
$stmt_projects = $conn->prepare($sql_projects);
if ($stmt_projects === false) {
    die("Error preparing the SQL query for 'projects': " . $conn->error);
}
$stmt_projects->execute();
$result_projects = $stmt_projects->get_result();
if ($result_projects === false) {
    die("Error executing query for 'projects': " . $conn->error);
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Projects Section -->
    <section id="projects">
        <h1>Messages</h1>
        <?php while ($project = $result_projects->fetch_assoc()) { ?>
            <div class="project">
                <h2><?php echo htmlspecialchars($project['name']); ?></h2>
                <h2><?php echo htmlspecialchars($project['email']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($project['message'])); ?></p>
                
            </div>
        <?php } ?>
    </section>

   
</body>
</html>

<?php
// Close prepared statements
$stmt_about->close();
$stmt_skills->close();
$stmt_projects->close();

// Close the database connection
$conn->close();
?>