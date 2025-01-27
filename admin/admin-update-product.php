<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$update_product_id = "";

if (isset($_GET["update_id"])) {
    $update_product_id = $_GET["update_id"];
}

$product_data = [];

if ($update_product_id) {
    $sql = "SELECT * FROM products WHERE id = " . $update_product_id;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product_data = $result->fetch_assoc();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $mrp = mysqli_real_escape_string($conn, $_POST["mrp"]);
    $discount = mysqli_real_escape_string($conn, $_POST["discount"]);
    $weight = mysqli_real_escape_string($conn, $_POST["weight"]);
    $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
    $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
    $jewelry_type = mysqli_real_escape_string($conn, $_POST["jewelry_type"]);

    if (empty($name) || empty($price) || empty($mrp) || empty($category_id) || empty($jewelry_type)) {
        $error_message = "Name, Price, MRP, Category ID and Jewelry Type are required.";
    } else if (!is_numeric($price) || !is_numeric($mrp) || !is_numeric($discount) || !is_numeric($weight) || !is_numeric($category_id)) {
        $error_message = "Price, MRP, Discount, Weight and Category ID must be numeric.";
    } else {
        $upload_dir = "uploads/" . $jewelry_type . "/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $image_url = $product_data["image_url"];

        if (!empty($_FILES["image"]["name"])) {
            $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $unique_filename = uniqid() . "." . $imageFileType;
                $target_file = $upload_dir . $unique_filename;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $target_file;
                    if (!empty($product_data["image_url"])) {
                        unlink($product_data["image_url"]);
                    }
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error_message = "File is not an image.";
            }
        }

        $sql = "UPDATE products SET name = '$name', price = '$price', mrp = '$mrp', discount = '$discount', weight = '$weight', image_url = '$image_url', brand = '$brand', category_id = '$category_id' WHERE id = '$update_product_id'";

        if ($conn->query($sql)) {
            $success_message = "Product updated successfully.";
            $product_data = []; // Clear product data
        } else {
            $error_message = "Error updating product: " . $conn->error;
        }
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            
        }

        .container {
            
            max-width: 500px; /* Adjust as needed */
            padding: 20px;
        }
        a{
            text-decoration:none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Update Product</h1>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . (isset($_GET['update_id']) ? '?update_id=' . $_GET['update_id'] : ''); ?>" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?php echo isset($product_data['id']) ? $product_data['id'] : ''; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($product_data['name']) ? $product_data['name'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" id="price" step="0.01" value="<?php echo isset($product_data['price']) ? $product_data['price'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="mrp">MRP:</label>
                <input type="number" class="form-control" name="mrp" id="mrp" step="0.01" value="<?php echo isset($product_data['mrp']) ? $product_data['mrp'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount:</label>
                <input type="number" class="form-control" name="discount" id="discount" step="0.01" value="<?php echo isset($product_data['discount']) ? $product_data['discount'] : '0'; ?>">
            </div>
            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="number" class="form-control" name="weight" id="weight" step="0.01" value="<?php echo isset($product_data['weight']) ? $product_data['weight'] : '0'; ?>">
            </div>
            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" class="form-control-file" name="image" id="image">
                <?php if (isset($product_data['image_url']) && !empty($product_data['image_url'])): ?>
                    <img src="<?php echo $product_data['image_url']; ?>" alt="Product Image" style="max-width: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" name="brand" id="brand" value="<?php echo isset($product_data['brand']) ? $product_data['brand'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="category_id">Category ID:</label>
                <input type="number" class="form-control" name="category_id" id="category_id" value="<?php echo isset($product_data['category_id']) ? $product_data['category_id'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="jewelry-type">Select Jewelry Type:</label>
                <select class="form-control" id="jewelry-type" name="jewelry_type" required>
                    <option value="rings" <?php echo (isset($product_data['image_url']) && strpos($product_data['image_url'], '/rings/') !== false) ? 'selected' : ''; ?>>Rings</option>
                    <option value="necklaces" <?php echo (isset($product_data['image_url']) && strpos($product_data['image_url'], '/necklaces/') !== false) ? 'selected' : ''; ?>>Necklaces</option>
                    <option value="earrings" <?php echo (isset($product_data['image_url']) && strpos($product_data['image_url'], '/earrings/') !== false) ? 'selected' : ''; ?>>Earrings</option>
                    <option value="bracelets" <?php echo (isset($product_data['image_url']) && strpos($product_data['image_url'], '/bracelets/') !== false) ? 'selected' : ''; ?>>Bracelets</option>
                    <option value="pendants" <?php echo (isset($product_data['image_url']) && strpos($product_data['image_url'], '/pendants/') !== false) ? 'selected' : ''; ?>>Pendants</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <button type="button" class="btn btn-danger"><a href="admin_dashboard.php">Cancel</a></button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>