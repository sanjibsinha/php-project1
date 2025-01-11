<?php

include 'db.php'; // Include the database connection

// Fetch About Me Data
$sql_about = "SELECT * FROM about_me LIMIT 1";
$result_about = $conn->query($sql_about);
$about = $result_about->fetch_assoc();

// Fetch Skills Data
$sql_skills = "SELECT * FROM skills";
$result_skills = $conn->query($sql_skills);

// Fetch Projects Data
$sql_projects = "SELECT * FROM projects";
$result_projects = $conn->query($sql_projects);
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
        <p><strong>Name:</strong> <?php echo $about['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $about['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $about['phone']; ?></p>
        <p><strong>Bio:</strong> <?php echo nl2br($about['bio']); ?></p>
    </section>

    <!-- Skills Section -->
    <section id="skills">
        <h1>Skills</h1>
        <ul>
            <?php while ($skill = $result_skills->fetch_assoc()) { ?>
                <li><strong><?php echo $skill['skill_name']; ?>:</strong> <?php echo $skill['proficiency']; ?></li>
            <?php } ?>
        </ul>
    </section>

    <!-- Projects Section -->
    <section id="projects">
        <h1>Projects</h1>
        <?php while ($project = $result_projects->fetch_assoc()) { ?>
            <div class="project">
                <h2><?php echo $project['title']; ?></h2>
                <p><?php echo nl2br($project['description']); ?></p>
                <p><strong>Completed:</strong> <?php echo $project['date_completed']; ?></p>
                <?php if ($project['url']) { ?>
                    <p><a href="<?php echo $project['url']; ?>" target="_blank">View Project</a></p>
                <?php } ?>
            </div>
        <?php } ?>
    </section>
<?php   include 'contact.php'; // Include the contact form ?>
</body>
</html>

<?php $conn->close(); ?>