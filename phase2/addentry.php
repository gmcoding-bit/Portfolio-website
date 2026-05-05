<?php
    session_start();
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "portfolio_website";
        
        $conn = new mysqli($servername, $username, $password, $dbname);  

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $title = $_POST['title'];
        $text = $_POST['text'];

        $timezone = date_default_timezone_set("GMT");
        $date = date("jS F Y, G:i e");

        $sql = "INSERT INTO blogs (`title`,`content`,`datemade`) VALUES('$title','$text','$date')";

        $conn -> query($sql);
        $conn -> close();

        header("Location: addentry.php"); 
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="css/addentry.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="addentryButton.js" type="text/javascript" defer></script>
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
            <section class="inner_section">
                <div class="form_container">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset>
                            <h1 class="input_title">Add Entry</h1>
                            <div class="input_container">
                                <input class="input_box" id="title_box" name="title" placeholder="Title" required>
                                <textarea class="input_box" id="text_box" name ="text" placeholder="Add your text here" required></textarea>
                            </div>
                                <div class="button_container">
                                <button id="post" type="submit">Post</button>
                                <button id="clear" type="submit">Clear</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
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