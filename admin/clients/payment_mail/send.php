<?php
    use PhpMailer\PhpMailer\PhpMailer;
    use PhpMailer\PhpMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PhpMailer.php';
    require 'phpmailer/src/SMTP.php';

    if(isset($_POST["send"])){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'asianland.ph.it@gmail.com';
        $mail->Password = 'wpyxwmcvfwpudqcm';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('asianland.ph.it@gmail.com');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);

        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];

        $mail -> send();

        echo"
        <script>
        alert('Sent Successfully');
        document.location.href='index.php';
        </script>
        ";
    }
?>