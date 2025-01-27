<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$products = []; // Store products in an array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();

include "navbar.php";

?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="products.css">
</head>




<body>
<section id="new_product">
        <div class="new-product-heading">
            <h2>Our Products</h2>
        </div>
        <div class="new-product-grid">
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
                       <a href="cart.php?id=<?php echo $product['id'];?>"> <button class="cart-btn" data-product-id="<?php echo $product['id']; ?>"> <i class="fa-solid fa-cart-shopping"></i>Add to Cart</button></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>



</body>
</html>