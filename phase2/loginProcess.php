<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "portfolio_website";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $email = $_POST["femail"];
        $password = $_POST["fpassword"];

        $sql = "SELECT * FROM USERS WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if($result === false) {
            die("Error: " . $conn->error);
        }
        if ($result-> num_rows === 1) {
            $row = $result->fetch_assoc();
            $_SESSION["logged_in"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["email"] = $email;
            header("Location: index.php");
        }
        $conn->close();
    }
?>