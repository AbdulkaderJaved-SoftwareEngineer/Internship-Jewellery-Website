<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body>

<header id="header">
        

    <div class="header-top-bar">

    
    <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hertzsoft_jewellery";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, message FROM flash_message ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $message = $row['message'];
    

} else {
    echo "Welcome to Hertzsoft Jewellery Store"; 
}

$conn->close();

?>
      
      
    <span id="flash-message"><?php echo $message ?></span>

    
    </div>

    <nav class="navigation">
    <a href="#" class="logo">
        <img src="assests/logo1.jpg" alt="logo">
    </a>
    <div class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
  


    <ul class="menu" id="menu">
    <div class="menu-toggle-times" id="menu-toggle-times" style="display:none;">
        <i class="fas fa-times"></i>
    </div>
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php">Category</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="#footer">Contact Us</a></li>
    </ul>
    <div class="right-nav">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="profile.php" class="nav-user"><i class="fa-solid fa-user"></i></a>
            <a href="my-cart-view.php" class="nav-cart"><i class="fa-solid fa-cart-shopping"></i></a>
        <?php else: ?>
            <a href="login.php" class="nav-user">Login</a> &nbsp;&nbsp; <a href="signup.php">Signup</a>
        <?php endif; ?>
    </div>
</nav>



    </div>

</header>



<script>
    document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menu-toggle");
    const menuToggleTimes = document.getElementById("menu-toggle-times");
    const menu = document.getElementById("menu");




    menuToggle.addEventListener("click", function () {
        menu.classList.add("show"); 
        menuToggle.style.display = "none"; 
        menuToggleTimes.style.display = "block"; 
    });


    menuToggleTimes.addEventListener("click", function () {
        menu.classList.remove("show");
        menuToggle.style.display = "block"; 
        menuToggleTimes.style.display = "none"; 
    });


});
</script>
</body>
</html>