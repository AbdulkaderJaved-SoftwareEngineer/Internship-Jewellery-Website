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

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['banner_message']) && !empty($_POST['banner_message'])) {
        $banner_message = $_POST['banner_message'];

        $stmt = $conn->prepare("INSERT INTO flash_message (message) VALUES (?)");
        $stmt->bind_param("s", $banner_message);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Flash message inserted successfully!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error inserting flash message: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        $message = "<div class='alert alert-warning'>Please enter a flash message.</div>";
    }
}

// Retrieve messages from the flash_message table
$messages_query = "SELECT * FROM flash_message";
$messages_result = $conn->query($messages_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert/View Flash Messages</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
        .container{
          max-width: 700px;
        }
        .message-display {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Insert Flash Message</h1>

    <?php echo $message; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="banner_message">Flash Message:</label>
            <textarea class="form-control" id="banner_message" name="banner_message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="message-display">
      <h2>Existing Flash Messages</h2>
      <?php
      if ($messages_result->num_rows > 0) {
        echo "<ul class='list-group'>";
          while ($row = $messages_result->fetch_assoc()) {
            
            echo "<li class='list-group-item'>" . $row["id"].".    ". htmlspecialchars($row["message"]) . "</li>";
            
        }
          echo "</ul>";
      } else {
          echo "<div class='alert alert-info'>No flash messages found.</div>";
      }
      ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>