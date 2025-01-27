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

function insertIntoCarts($conn, $user_id, $product_id) {
    $user_id = $conn->real_escape_string($user_id);
    $product_id = $conn->real_escape_string($product_id);

    $sql = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";

    if ($conn->query($sql) === TRUE) {
        return "Product added to cart successfully";
    } else {
        return "Error adding product to cart: " . $sql . "<br>" . $conn->error;
    }
}







if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        $insertion_result = insertIntoCarts($conn, $user_id, $product_id);
        echo $insertion_result;
    } 
    
    
    else {

    }
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>