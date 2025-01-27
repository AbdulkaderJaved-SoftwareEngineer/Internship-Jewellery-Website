
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $price = $_POST["price"];
    $mrp = $_POST["mrp"];
    $discount = $_POST["discount"];
    $weight = $_POST["weight"];
    $brand = $_POST["brand"];
    $category_id = $_POST["category_id"];
    $jewelry_type = $_POST["jewelry_type"];

    if (empty($name) || empty($price) || empty($mrp) || empty($category_id) || empty($jewelry_type)) {
        $error_message = "Name, Price, MRP, Category ID and Jewelry Type are required.";
    } else if (!is_numeric($price) || !is_numeric($mrp) || !is_numeric($discount) || !is_numeric($weight) || !is_numeric($category_id)) {
        $error_message = "Price, MRP, Discount, Weight and Category ID must be numeric.";
    } else {
        $upload_dir = "uploads/" . $jewelry_type . "/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $image_url = "";

        if (!empty($_FILES["image"]["name"])) {
            $imageFileType = strtolower(pathinfo(basename($_FILES["image"]["name"]), PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $unique_filename = uniqid() . "." . $imageFileType;
                $target_file = $upload_dir . $unique_filename;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $image_url = $target_file;
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            } else {
                $error_message = "File is not an image.";
            }
        }

        $stmt = $conn->prepare("INSERT INTO products (name, price, mrp, discount, weight, image_url, brand, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sddddssd", $name, $price, $mrp, $discount, $weight, $image_url, $brand, $category_id);

        if ($stmt->execute()) {
            $success_message = "Product added successfully.";
        } else {
            $error_message = "Error adding product: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        <h1>Add New Product</h1>

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

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" id="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="mrp">MRP:</label>
                <input type="number" class="form-control" name="mrp" id="mrp" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount:</label>
                <input type="number" class="form-control" name="discount" id="discount" step="0.01" value="0">
            </div>
            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="number" class="form-control" name="weight" id="weight" step="0.01" value="0">
            </div>
            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" name="brand" id="brand">
            </div>
            <div class="form-group">
                <label for="category_id">Category ID:</label>
                <input type="number" class="form-control" name="category_id" id="category_id" required>
            </div>
            <div class="form-group">
                <label for="jewelry-type">Select Jewelry Type:</label>
                <select class="form-control" id="jewelry-type" name="jewelry_type" required>
                    <option value="rings">Rings</option>
                    <option value="necklaces">Necklaces</option>
                    <option value="earrings">Earrings</option>
                    <option value="bracelets">Bracelets</option>
                    <option value="pendants">Pendants</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            <button type="button" class="btn btn-danger"><a href="admin_dashboard.php" >Cancel</a></button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>