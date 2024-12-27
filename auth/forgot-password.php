<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Database connection
    $conn = new mysqli('hostname', 'username', 'password', 'database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Email the password to the user
        $to = $email;
        $subject = "Your Password Recovery";
        $message = "Hello, your password is: " . $user['password'];
        $headers = "From: noreply@yourdomain.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Password has been sent to your email.";
        } else {
            echo "Failed to send the email.";
        }
    } else {
        echo "Email not registered.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form action="" method="post">
        <label for="email">Enter your registered email:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
