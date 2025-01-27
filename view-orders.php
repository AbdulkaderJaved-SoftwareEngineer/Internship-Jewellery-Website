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


if (isset($_GET['order_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['order_id']);

    $conn->begin_transaction();

    try {
        

        $sql_orders = "DELETE FROM orders WHERE id = '$delete_id'";
        $conn->query($sql_orders);

       

        $conn->commit();
        echo "<script>window.confirm('Are you sure you want to delete your order'); alert('Order deleted successfully'); window.location.href='view-product.php';</script>";
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error deleting product: " . $exception->getMessage();
    }
}







$user_id = $_SESSION['user_id'];

$sql = "SELECT o.id AS order_id, o.product_id, o.order_date, o.total_amount
        FROM orders o
        WHERE o.user_id = $user_id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Your Orders</title>
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

    <h1>Your Orders</h1>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Order Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["order_id"]. "</td>";
                echo "<td>" . $row["product_id"]. "</td>";
                echo "<td>" . $row["order_date"]. "</td>";
                echo "<td>$" . htmlspecialchars($row["total_amount"]). "</td>";
                echo "<td><a href='view-orders.php?order_id=" . $row['order_id'] . "'>Cancel This order</a></td>";
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