<?php
// Database connection
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input 
    $name    = htmlspecialchars($_POST['u_name']);
    $email   = htmlspecialchars($_POST['u_email']);
    $subject = htmlspecialchars($_POST['u_subject']);
    $msg     = htmlspecialchars($_POST['u_message']);

    // Statements 
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $msg);

    if ($stmt->execute()) {
        echo "<script>alert('Thank you! Your message has been sent.'); window.location.href='contact.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>