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



if (!isset($_SESSION['user_id'])) {
    echo "<h1>Please log in to view your cart.</h1>";
    exit();
}

$user_id = $_SESSION['user_id'];

function selectFromCarts($conn, $user_id) {
    $user_id = $conn->real_escape_string($user_id);

    $sql = "SELECT p.* FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = '$user_id'";

    $result = $conn->query($sql);
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;
    } else {
       return [];
    }
}

$products = selectFromCarts($conn, $user_id);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="products.css">
    <title>Your Cart</title>
</head>
<body>
<section id="new_product">
    <div class="new-product-heading">
        <h2>Your Cart</h2>
    </div>
    <div class="new-product-grid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="new-product-box" data-product-id="<?php echo $product['id']; ?>">
                    <a href="view-product.php?id=<?= $product['id'] ?>" class="new-product-img">
                        <img src="admin/<?php echo $product['image_url']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                        <span>New</span>
                    </a>
                    <div class="new-product-details">
                        <a href="#" class="new-product-title"><?php echo htmlspecialchars($product['name']); ?></a>
                        <p class="product-brand">Brand: <?php echo htmlspecialchars($product['brand']); ?></p>
                        <div class="price-info">
                            <span class="discounted-price">$<?php echo htmlspecialchars($product['price']); ?></span>
                            <span class="mrp">$<?php echo htmlspecialchars($product['mrp']); ?></span>
                            <?php
                            $discount = (($product['mrp'] - $product['price']) / $product['mrp']) * 100;
                            if($discount > 0){
                                echo '<span class="discount-percent">('.number_format($discount,0).'% Off)</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h1>You do not have items in the cart.</h1>
        <?php endif; ?>
    </div>
</section>
</body>
</html>