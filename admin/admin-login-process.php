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
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT id FROM admin WHERE username = '$username' AND password = '$password'"; 
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // $_SESSION['user_id'] = $row['id'];
        session_start();
    $_SESSION['admin_user_id'] = $row['id']; 
    $_SESSION['admin_username'] = $username; 
    header("Location: admin_dashboard.php");
    
        
        exit();
    } else {

        
        echo "Wrong password";
        
        exit();
    }
}

$conn->close();
?>