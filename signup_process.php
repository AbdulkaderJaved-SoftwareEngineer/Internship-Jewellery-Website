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
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $address = $conn->real_escape_string($_POST['address']);
    $gender = $conn->real_escape_string($_POST['gender']);

    if (isset($_POST['email'])) {
        $email = $conn->real_escape_string($_POST['email']);

        $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            header("Location: signup.php?error=User with this email already exists.");
            exit();
        } else {
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = "profile-img/";
                $filename = basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $newFilename = date("YmdHis") . "_" . uniqid() . "." . $imageFileType;
                $targetFile = $targetDir . $newFilename;

                $uploadOk = 1;
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                    header("Location: signup.php?error=File is not an image.");
                    exit();
                }

                if ($uploadOk == 0) {
                    header("Location: signup.php?error=Sorry, there was an error uploading your file. UploadOk is 0");
                    exit();
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        $imagePath = $targetFile;
                    } else {
                        $error = error_get_last();
                        header("Location: signup.php?error=Sorry, there was an error uploading your file: " . $error['message'] . " Target File: " . $targetFile);
                        exit();
                    }
                }
            }

            $insert_stmt = $conn->prepare("INSERT INTO users (username, password, email, mobile, address, gender, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssssss", $username, $password, $email, $mobile, $address, $gender, $imagePath);

            if ($insert_stmt->execute()) {
                header("Location: login.php?success=Registration successful");
                exit();
            } else {
                header("Location: signup.php?error=Error registering user: " . $insert_stmt->error);
                exit();
            }
            $insert_stmt->close();
        }
    } else {
        header("Location: signup.php?error=Email not provided.");
        exit();
    }
}

$conn->close();
?>