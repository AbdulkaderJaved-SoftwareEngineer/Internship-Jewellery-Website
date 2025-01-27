<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT id FROM users WHERE username = '$email' AND password = '$password'"; 
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // $_SESSION['user_id'] = $row['id'];
        session_start();
    $_SESSION['user_id'] = $row['id']; 
    $_SESSION['user_email'] = $email; 
    header("Location: index.php");
    
        header("Location: index.php");

        exit();
    } else {
        
       header("Location: login.php");
        exit();
    }
}

$conn->close();
?>