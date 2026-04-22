<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="css/Blog.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <header>Rahul Rai</header>
        <div class ="nav_container">
            <nav>
                <ul class="nav_bar">
                    <li class="nav_item"><a class="pagelink" href="index.php">Home</a></li>
                    <li class="nav_item"><a class="pagelink" href="About_me.html">About me</a></li>
                    <li class="nav_item"><a class="pagelink" href="Education.html">Education</a></li>
                    <li class="nav_item"><a class="pagelink" href="Skills.html">Skills</a></li>
                    <li class="nav_item"><a class="pagelink" href="Experience.html">Experience</a></li>
                    <li class="nav_item"><a class="pagelink" href="portfolio.html">Portfolio</a></li>
                    <li class="nav_item"><a class="pagelink" href="viewBlog.php">Blog</a></li>
                    <li class="nav_item"><a class="pagelink" href="addentry.html">Add entry</a></li>
                </ul>
            </nav>
        </div>
        <article>
            <section class ="inner_section">
                <h1>Blog</h1>
                <?php
                    session_start();
                    $servername = "127.0.0.1";
                    $username = "root";
                    $password = "";
                    $dbname = "portfolio_website";
                    
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM BLOG ORDER BY date_made DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='blog_entry'>";
                            echo "<h2 class='blog_title'>" . htmlspecialchars($row['title']) . "</h2>";
                            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
                            echo "<p class='timestamp'>" . date("F j, Y, g:i a", strtotime($row['date_made'])) . "</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No blog entries found.</p>";
                    }
                ?>
                <h2>Portfolio website</h2>
                <p>
                    I have created a portfolio website to allow people to see information about me and the skills and experience I have developed.
                    <br>
                    @15.03.2026
                </p>
                <p></p>
            </section>
        </article>
        <footer>
            <div class ="contact_container">
                <nav>
                    <ul class="contact_bar">
                        <li class="contact_link"><a href="https://github.com/gmcoding-bit"><img class="contact_img" src="images/GitHub_logo.png" alt="GitHub account"></a></li>
                        <li class="contact_link"><a href="mailto:rahulraix100@gmail.com"><img class="contact_img" src="images/gmail_logo.png" alt="Email"></a></li>
                        <li class="contact_link"></li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
</body>
</html>