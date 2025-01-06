<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once('../config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

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

        // Email configuration
        $emailFrom = "francisdiaz@asianland.ph";
        $password = "Symtd8Qh6KXJzCGk"; // Replace with your SMTP password or API key
        $recipientEmail = $email; // Replace with the recipient's email
        $subject = "Reset Password";
        $htmlContent = "<pYour Password reset successfully.</p>";

        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = $emailFrom;
            $mail->Password = $password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email Settings
            $mail->setFrom($emailFrom, 'Asian Land'); // Sender
            $mail->addAddress($recipientEmail);      // Recipient
            $mail->Subject = $subject;
            $mail->isHTML(true);                     // Set email format to HTML
            $mail->Body = $htmlContent;

            // Send Email
            $mail->send();
            echo "Email sent successfully.";
        } catch (Exception $e) {
            echo "Failed to send email. Error: {$mail->ErrorInfo}";
        }
       
    } else {
        echo "Email not registered.";
    }

    $stmt->close();
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
