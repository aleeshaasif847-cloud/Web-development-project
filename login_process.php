<?php
session_start(); // User login 
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Password 
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            echo "<script>alert('Login Successful! Welcome.'); window.location.href='welcome.php';</script>";
        } else {
            echo "<script>alert('Wrong Password!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Email not found!'); window.location.href='login.html';</script>";
    }
}
?>