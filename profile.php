<?php
session_start();

// Check if the user is logged in. If not, redirect to login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT username, mobile, address, gender, image FROM users WHERE id = '$user_id'"; // Use prepared statement in real application
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    // Handle the case where the user is not found (e.g., deleted account)
    echo "User not found.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #f8f0e3, #e6dace);
        }

        .profile-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        h2 {
            color: #8a6c4b;
            margin-bottom: 20px;
        }

        .profile-info p {
            margin-bottom: 10px;
        }
        .logout-button{
            background-color: #b8860b;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
            text-decoration: none;
            display: block;
            margin-top: 20px;
        }
        .logout-button:hover {
            background-color: #a0522d;
        }
        @media (max-width: 480px) {
            .profile-container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Profile</h2>
        <?php if ($user['image']): ?>
            <img src="<?php echo $user['image'] ?>" alt="Profile Image" class="profile-image">
        <?php endif; ?>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($user['mobile']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
        </div>
        <a href="logout.php" class="logout-button">Logout</a>
        <a href="index.php" class="logout-button">Home Page</a>
        <a href="view-orders.php" class="logout-button">My Orders</a>
    </div>
</body>
</html>