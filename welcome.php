<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signup.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 50px; background-color: #f4f4f4; }
        .box { background: white; padding: 30px; display: inline-block; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0,0,0,0.1); }
        h1 { color: #2ecc71; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Welcome to your Dashboard! 🎉</h1>
        <p>Login Successful.</p>
        <a href="signup.html" style="color: red; text-decoration: none;">Logout</a>
    </div>
</body>
</html>