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


if($_SESSION['user_id'])
{
echo "You are logged in";
}

else{
header("location: login.php");
exit();
}

if (isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']) && is_numeric($_GET['id']) && isset($_GET['quantity']) && is_numeric($_GET['quantity']) && $_GET['quantity'] > 0) {
    $product_id = (int)$_GET['id'];
    $quantity = (int)$_GET['quantity'];
    $name = $_GET['name'];
    $user_id = $_SESSION['user_id'];
    $price = (int)$_GET['price'];

    $total_amount = $quantity * $price;
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, order_date, total_amount) VALUES (?, ?, NOW(), ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("iid", $user_id, $product_id, $total_amount);


    if ($stmt->execute()) {
        echo "Order placed successfully! Order ID: " . $conn->insert_id;
    } else {
        echo "Error placing order: " . $stmt->error;
    }

    $stmt->close();

    
} 
else {
    echo "Invalid request.";
}

$conn->close();

?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Order Details Card</title>
                    <style>
                        .order-card {
                            width: 600px;
                            border: 1px solid #ccc;
                            padding: 10px;
                            box-sizing: border-box;
                            margin: 10px auto;
                            overflow-y: auto;
                            max-height: 500px;
                            font-family: sans-serif;
                            box-shadow: 6px 10px 5px 0px rgba(0,0,0,0.75);
                        }

                        .order-card h2, .order-card h3{
                            margin-bottom: 5px;
                        }

                        .order-card p {
                            margin: 5px 0;
                            font-size: 14px;
                            word-wrap: break-word;
                        }
                        .order-card strong{
                            font-weight: 600;
                        }
                        .buy-now{
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

                        @media (max-width: 300px) {
                            .order-card {
                                width: 95%;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="order-card">
                        <u><h2>Order Summary</h2></u>
                        <p><strong>Product Name:</strong> <?php echo $name?></p>
                        <p><strong>Quantity:</strong> <?php echo $quantity ?></p>
                        <p><strong>Price per unit:</strong> $<?php echo $price  ?></p>
                        <p><strong>Total Price:</strong> Rs. <?php echo $total_amount?></p>
                        <p><strong>Status:</strong> Processing</p>
                       
                    </div>
                    
                </body>
                </html>
            

