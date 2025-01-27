<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);

    $conn->begin_transaction();

    try {
        $sql_cart = "DELETE FROM cart WHERE product_id = '$delete_id'";
        $conn->query($sql_cart);

        $sql_orders = "DELETE FROM orders WHERE product_id = '$delete_id'";
        $conn->query($sql_orders);

        $sql_product = "DELETE FROM products WHERE id = '$delete_id'";
        $conn->query($sql_product);

        $conn->commit();
        echo "<script>alert('Product deleted successfully.'); window.location.href='view-product.php';</script>";
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        echo "Error deleting product: " . $exception->getMessage();
    }
}






$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Your Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="admin_dashboard.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view-product.php">Products</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Product List</h1>
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
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
                        <th>Category ID</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["mrp"]; ?></td>
                            <td><?php echo $row["discount"]; ?></td>
                            <td><?php echo $row["weight"]; ?></td>
                            <td><img src="<?php echo $row["image_url"]; ?>" alt="Product Image" width="100"></td>
                            <td><?php echo $row["brand"]; ?></td>
                            <td><?php echo $row["category_id"]; ?></td>
                            <td>
                                <a href="admin-update-product.php?update_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="view-product.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$conn->close();
?>