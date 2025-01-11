<?php
include 'db.php'; // Include the database connection

// Fetch About Me Data with Prepared Statement
$sql_about = "SELECT * FROM about_me LIMIT 1";
$stmt_about = $conn->prepare($sql_about);
if ($stmt_about === false) {
    die("Error preparing the SQL query for 'about_me': " . $conn->error);
}
$stmt_about->execute();
$result_about = $stmt_about->get_result();
if ($result_about === false) {
    die("Error executing query for 'about_me': " . $conn->error);
}
$about = $result_about->fetch_assoc();

// Fetch Skills Data with Prepared Statement
$sql_skills = "SELECT * FROM skills";
$stmt_skills = $conn->prepare($sql_skills);
if ($stmt_skills === false) {
    die("Error preparing the SQL query for 'skills': " . $conn->error);
}
$stmt_skills->execute();
$result_skills = $stmt_skills->get_result();
if ($result_skills === false) {
    die("Error executing query for 'skills': " . $conn->error);
}

// Fetch Projects Data with Prepared Statement
$sql_projects = "SELECT * FROM projects";
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

    <!-- About Me Section -->
    <section id="about-me">
        <h1>About Me</h1>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($about['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($about['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($about['phone']); ?></p>
        <p><strong>Bio:</strong> <?php echo nl2br(htmlspecialchars($about['bio'])); ?></p>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <h1>Skills</h1>
        <ul>
            <?php while ($skill = $result_skills->fetch_assoc()) { ?>
                <li><strong><?php echo htmlspecialchars($skill['skill_name']); ?>:</strong> <?php echo htmlspecialchars($skill['proficiency']); ?></li>
            <?php } ?>
        </ul>
    </section>

    <!-- Projects Section -->
    <section id="projects">
        <h1>Projects</h1>
        <?php while ($project = $result_projects->fetch_assoc()) { ?>
            <div class="project">
                <h2><?php echo htmlspecialchars($project['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
                <p><strong>Completed:</strong> <?php echo htmlspecialchars($project['date_completed']); ?></p>
                <?php if ($project['url']) { ?>
                    <p><a href="<?php echo htmlspecialchars($project['url']); ?>" target="_blank">View Project</a></p>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
    <!-- Contact Form Section -->
<section id="contact">
    <h1>Contact Me</h1>
    <form action="contact-submit.php" method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
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