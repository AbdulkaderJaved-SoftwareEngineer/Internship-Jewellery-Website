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


$sql = "SELECT * FROM orders";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>ALL Orders</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>

    <h1>All  Orders</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["user_id"]. "</td>";
                echo "<td>" . $row["product_id"]. "</td>";
                echo "<td>" . $row["order_date"]. "</td>";
                echo "<td>$" . htmlspecialchars($row["total_amount"]). "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    </body>
    </html>
    <?php
} else {
    echo "No orders found.";
}
$conn->close();
?>