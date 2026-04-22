<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css" type="text/css">
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    ?>
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
                <h1>My Portfolio Website</h1>
                <p>
                    Welcome to the home page of my portfolio website! Within this website you will find sections containing information on my eDUCATION, Experience, Projects and a bit about me personally.  
                </p>
            </section>
        </article>
        <aside>
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo "<p>Welcome, you are logged in!</p>";
                echo "<a href='logout.php'>Logout</a>";
            }else{
                print("<div class='form_container'>
                            <form action=" . $_SERVER['PHP_SELF'] . " method='post'>
                                <fieldset>
                                    <h1 class='login_title'>Login</h1>
                                    <div class='input_container'>
                                        <input class='input_box' type='email' name ='femail' placeholder='Email' required>
                                        <input class='input_box' type='password' name='fpassword' placeholder='Password' required>
                                        <button type='submit'>Login</button>
                                    </div>
                                </fieldset>
                            </form>
                    </div>");
            }
            ?>
        </aside>
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

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "portfolio_website";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $email = $_POST['femail'];
            $password = $_POST['fpassword'];

            $sql = "SELECT * FROM USERS WHERE email='$email' AND password='$password'";
            $result = $conn->query($sql);

            if($result === false) {
                die("Error: " . $conn->error);
            }
            if ($result-> num_rows === 1) {
                $row = $result->fetch_assoc();
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            }
        }
    ?>
</body>
</html>