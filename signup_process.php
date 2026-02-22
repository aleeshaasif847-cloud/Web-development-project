<?php
// Error reporting 
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    // Password 
    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if($stmt) {
        $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);
        if ($stmt->execute()) {
            echo "<script>alert('Account Created Successfully!'); window.location.href='signup.html';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }
    $conn->close();
}
?>