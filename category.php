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

$sql_categories = "SELECT * FROM category";
$result_categories = $conn->query($sql_categories);

if (isset($_GET['category_id'])) {
    $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
    $sql_products = "SELECT * FROM products WHERE category_id = '$category_id'";
    $result_products = $conn->query($sql_products);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jewelry Categories</title>
    <style>
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
            padding: 20px;
        }

        .category-card {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            border-radius: 8px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 10px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            border-radius:4px;
        }
        th {
            background-color: red;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>

    <h1>Jewelry Categories</h1>

    <div class="category-grid">
        <?php
        if ($result_categories->num_rows > 0) {
            while ($row = $result_categories->fetch_assoc()) {
                $category_id = $row["id"];
                $category_name = $row["name"];
                $category_image = $row["image"];
                echo "<div class='category-card' onclick=\"window.location.href='category.php?category_id=$category_id'\">";
                echo "<img class='category-image' src='$category_image' alt='$category_name'>";
                echo "<h3>$category_name</h3>";
                echo "</div>";
            }
        } else {
            echo "No categories found.";
        }
        ?>
    </div>

    <?php if (isset($result_products) && $result_products->num_rows > 0) : ?>
        <h2>Products in Category</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>MRP</th>
                    <th>Discount</th>
                    <th>Weight</th>
                    <th>Image</th>
                    <th>Brand</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result_products->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["name"] ?></td>
                        <td><?= $row["price"] ?></td>
                        <td><?= $row["mrp"] ?></td>
                        <td><?= $row["discount"] ?></td>
                        <td><?= $row["weight"] ?></td>
                        <td><img src="admin/<?= $row["image_url"] ?>" alt="Product Image"></td>
                        <td><?= $row["brand"] ?></td>
                        <td><a href="products.php">Shop Now</a> </td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php elseif (isset($_GET['category_id'])): ?>
        <p>No products found in this category.</p>
    <?php endif; ?>

</body>
</html>