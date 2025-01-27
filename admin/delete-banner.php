<?php
include "navbar.php";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['banner_message']) && !empty($_POST['banner_message'])) {
        $banner_message = $_POST['banner_message'];

        $stmt = $conn->prepare("INSERT INTO flash_message (message) VALUES (?)");
        $stmt->bind_param("s", $banner_message);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Flash message inserted successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error inserting flash message: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        $message = "<div class='alert alert-warning'>Please enter a flash message.</div>";
    }
}

// Retrieve messages from the flash_message table
$messages_query = "SELECT * FROM flash_message";
$messages_result = $conn->query($messages_query);

$conn->close();
?>