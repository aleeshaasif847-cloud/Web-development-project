<?php
$conn = new mysqli("localhost", "root", "", "user_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //HTML entities
    $name    = htmlspecialchars($_POST['full_name']);
    $email   = htmlspecialchars($_POST['business_email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $attend  = htmlspecialchars($_POST['attendees']);
    $details = htmlspecialchars($_POST['event_details']);

    // Statement 
    $stmt = $conn->prepare("INSERT INTO demo_bookings (full_name, business_email, phone, attendees, event_details) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $attend, $details);

    if ($stmt->execute()) {
        echo "<script>alert('Demo Booked Successfully! Our expert will call you.'); window.location.href='booking.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>