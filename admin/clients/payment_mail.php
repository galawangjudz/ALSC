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

        $mail->setFrom("asianland.ph.it@gmail.com", 'IT ASIANLAND');
        // $mail->addAddress($_POST["email"]);

        $addresses = explode(',',$_POST["email"]);
        foreach ( $addresses as $address ){
            $mail->AddAddress($address);
        }

        for ($i=0; $i < count($_FILES['file']['tmp_name']); $i++){
            $mail->addAttachment($_FILES['file']['tmp_name'][$i],$_FILES['file']['name'][$i]);
        }
        
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];


        if($mail->send()){?>
            <script>
                alert("Email Sent!");
                location.href="?page=ra";
            </script>
        <?php
        }else{
        ?>
            <script>
                alert("Error! Email not sent!");
                location.href="?page=ra";
            </script>
        <?php
        }
        $mail->smtpClose();
        // $mail -> send();

        // echo"
        // <script>
        // alert('Sent Successfully');
        // document.location.href='index.php';
        // </script>
        // ";
    }
?>