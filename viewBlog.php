<?php
    session_start();
?>

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
    <script src="monthChoice.js" type="text/javascript" defer></script>
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
                    <li class="nav_item"><a class="pagelink" href="addentry.php">Add entry</a></li>
                </ul>
            </nav>
        </div>
        <article>
            <section class ="inner_section">
                <h1>Blog</h1>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <select name="month" id="month_selector">
                        <option value="choice" disabled selected><--Choose a month--></option>
                        <option value="All">All blogs</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select> 
                </form>  
                    <?php
                    if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "";
                        $dbname = "portfolio_website";
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM blogs";
                        $result = $conn->query($sql);
                        $multiple = false;
                        
                        if ($result->num_rows > 0) {
                            if($result->num_rows > 1) {
                                $multiple = true;
                            }

                            // Collect rows using the original fetch_assoc loop
                            $rows = [];
                            while($row = $result->fetch_assoc()) {
                                $rows[] = $row;
                            }

                            // --- Bubble Sort (descending by date) ---
                            // Parse each datemade string into a Unix timestamp so dates
                            // can be compared numerically. The format string is the exact
                            // inverse of  date("S F Y, G:i e"),  e.g. "3rd May 2026, 20:24 GMT"
                            $n = count($rows);
                            for ($i = 0; $i < $n - 1; $i++) {
                                // After each full pass the smallest timestamp has bubbled
                                // to the end, so we can shorten the inner loop each time.
                                for ($j = 0; $j < $n - 1 - $i; $j++) {
                                    $dateA = DateTime::createFromFormat('jS F Y, G:i e', $rows[$j]['datemade']);
                                    $dateB = DateTime::createFromFormat('jS F Y, G:i e', $rows[$j + 1]['datemade']);

                                    // Fall back to 0 timestamp if a date string cannot be parsed,
                                    // so malformed data pushes to the bottom rather than crashing.
                                    $tsA = $dateA ? $dateA->getTimestamp() : 0;
                                    $tsB = $dateB ? $dateB->getTimestamp() : 0;

                                    // If the left entry is OLDER than the right, swap them
                                    // so that newer entries rise to the top (descending order).
                                    if ($tsA < $tsB) {
                                        $temp         = $rows[$j];
                                        $rows[$j]     = $rows[$j + 1];
                                        $rows[$j + 1] = $temp;
                                    }
                                }
                            }
                            
                            // --- End Bubble Sort ---
                            if(isset($_POST['month'])){
                                $month = $_POST['month'];
                                if($month == "All"){
                                    foreach ($rows as $row) {
                                        echo "<div class='blog_entry'>";
                                        echo "<p>" . $row['datemade'] . "</p>";
                                        echo "<h2 class='blog_title'>" . $row['title'] . "</h2>";
                                        echo "<p>" . $row['content'] . "</p>";
                                        echo "</div>";
                                        if($multiple) {
                                            echo "<hr>";
                                        }
                                    }
                                }else{
                                    $monthDateTimeFormat = date("m",strtotime("1st" . $month));
                                    $hasBlogs = false;
                                    foreach ($rows as $row) {
                                        $date = DateTime::createFromFormat('jS F Y, G:i e', $row['datemade']);
                                        if($monthDateTimeFormat == $date->format('m')){
                                            $hasBlogs = true;
                                            echo "<div class='blog_entry'>";
                                            echo "<p>" . $row['datemade'] . "</p>";
                                            echo "<h2 class='blog_title'>" . $row['title'] . "</h2>";
                                            echo "<p>" . $row['content'] . "</p>";
                                            echo "</div>";
                                            if($multiple) {
                                                echo "<hr>";
                                            }
                                        }
                                    }
                                    if(!$hasBlogs){
                                        echo "<p>There are no blogs for the month selected</p>";
                                    }
                                }
                            }
                        } else {
                            echo "<p>No blog entries found.</p>";
                        }
                    }
                    else{
                        echo "<p>Please log in to view your blogs.</p>";
                    }
                ?>
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