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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .product-container {
            display: flex;
            gap: 20px; /* Space between image and details */
            max-width: 900px;
            margin: 0 auto; /* Center the container */
        }

        .product-image-container {
            flex: 1; /* Takes up available space */
            border-radius: 4px;
            overflow: hidden; /* Ensures image stays within rounded corners */
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product-image-container img {
            width: 100%;
            height: auto;
            display: block; /* Prevents extra space below image */
        }

        .product-details {
            flex: 2; /* Takes up more space for details */
        }

        .product-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-description {
            margin-bottom: 20px;
        }

        .add-to-cart-button {
            background-color: purple;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .add-to-cart-button a{
            color:white;
        }

        .add-to-cart-button:hover {
            background-color: #0056b3;
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
        .buy-now:hover{
                background-color:"#0056b3";
        }

        #qtn{

            display:"flex";
            padding:5px 15px;
            outline:none;
            width: 100px;
        }




        @media (max-width: 600px) {
            .product-container {
                flex-direction: column; 
            }
            .product-image-container{
                width: 100%;
            }
            .product-details{
                width: 100%;
            }
        }
    </style>
</head>
<body>
<?php


if(isset($_GET['cartid']))
{
    $cart_id = $_GET['cartid'];

    $conn->begin_transaction();
    try {
        $sql_cart = "DELETE FROM cart WHERE product_id = '$cart_id'";
        $conn->query($sql_cart);

        $conn->commit();
        echo "<script>alert('Item Removed from cart successfully.'); window.location.href='my-cart-view.php';</script>";
    }catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error deleting product: " . $exception->getMessage();
    }

}







if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

 
    if ($product) {
        

?>



    <div class="product-container">
        <div class="product-image-container">
            <img src="admin/<?= $product['image_url'] ?>" alt="Product Image">
        </div>
        <div class="product-details">

            <p>Product Name: </p><h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
            <p>Price : </p><p class="product-price">&#8377;  <?= htmlspecialchars($product['price'])?></p>
            <p>MRP  : </p><strike><p class="product-price">&#8377;  <?= htmlspecialchars($product['mrp'])?></p></strike>

            <p>Discount  : </p><p class="product-price"><?= htmlspecialchars($product['discount'])?>%</p>

            <p>About :</p><p class="product-description">
                This elegant ring features a stunning blue topaz gemstone set in a delicate silver band. It's the perfect accessory for any occasion. Add a touch of sophistication to your look with this timeless piece.
            </p>
            <p class="product-brand">Brand: <?= htmlspecialchars($product['brand'])?></p>
            <p class="product-brand">Weight: <?= htmlspecialchars($product['weight'])?></p>
           <label for="quantity">quantity</label>
            <input type="number" name="quantity" id="quantity"/>
        
            
            <button class="add-to-cart-button" ><a href="view-product.php?cartid=<?php echo $product['id']?>">Remove item from  Cart</a></button>

            <a href="buy.php"><button type="submit" class="buy-now" id="buyLink">Buy Now</button></a>
           
        </div>
    </div>
    <script>
                    const buyLink = document.getElementById('buyLink');
                    const quantityval = document.getElementById('quantity');
                    

                    buyLink.addEventListener('click', (event) => {
                        event.preventDefault(); 
                        const quantity = quantityval.value;
                        if (isNaN(quantity) || quantity <= 0) {
                            alert("Please enter a valid quantity");
                            return;
                        }
                        window.location.href = "buy.php?id=<?= $product['id'] ?>&price=<?= $product['price']?>&name=<?= $product['name']?>&quantity=" + quantity;
                    });
                </script>
</body>
</html>

<?php
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}
$conn->close();
?>