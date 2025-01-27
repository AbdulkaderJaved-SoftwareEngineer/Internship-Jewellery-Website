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


$sql = "SELECT (SELECT COUNT(*) FROM products) AS product_count, (SELECT COUNT(*) FROM users) AS user_count, (SELECT COUNT(*) FROM orders) AS order_count";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $product_count = $row["product_count"];
    $user_count = $row["user_count"];
    $order_count = $row["order_count"];

} else {
    echo "Error fetching counts.";
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Admin | Dasboard</title>
</head>
<body>
  <div class="container mt-3 d-flex flex-row justify-content-between">
  <div class="card text-bg-primary mb-3" style="width: 300px;">
  <div class="card-header">No of Orders</div>
  <div class="card-body">
    <h2 class="card-title ml-5"><?php echo $order_count?></h2>
  </div>
</div>




<div class="card text-bg-success mb-3" style="width: 300px;">
  <div class="card-header">No of Products</div>
  <div class="card-body">
    <h2 class="card-title ml-5"><?php echo $product_count?></h2>
  </div>
</div>


<div class="card text-bg-danger mb-3" style="width: 300px;">
  <div class="card-header">No of users</div>
  <div class="card-body">
    <h2 class="card-title ml-5"><?php echo $user_count?></h2>
  </div>
</div>



</div>
</body>
</html>