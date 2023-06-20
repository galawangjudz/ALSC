<?php
/* session_start();  */
include('payment_mail/functions.php');

// $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
// output any connection error
if ($conn->connect_error) {
	die('Error : ('.$conn->connect_errno .') '. $conn->connect_error);
}
// the query

?>
<?php
if(isset($_GET['id'])){
    $prop = $conn->query("SELECT * FROM property_clients where md5(property_id) = '{$_GET['id']}'");    
    while($row=$prop->fetch_assoc()){
    
        ///LOT
        $prop_id = $row['property_id'];
        $eadd = $row['email'];
        
        }
    // $pay_date = $_GET['pay_date_input'];
    }
    echo $prop_id;
?>
<?php

// Check if the textbox value was passed
if (isset($_GET['textboxValue'])) {
  // Retrieve the textbox value from the GET parameters
  $textboxValue = $_GET['textboxValue'];

  // Use the textbox value in your code
  echo "You passed: " . $textboxValue;
}
?>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>
<style>
    .nav-ra{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
	}
	.nav-ra:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>
<?php
    use PhpMailer\PhpMailer\PhpMailer;
    use PhpMailer\PhpMailer\Exception;

    require 'payment_mail/phpmailer/src/Exception.php';
    require 'payment_mail/phpmailer/src/PhpMailer.php';
    require 'payment_mail/phpmailer/src/SMTP.php';

    if(isset($_POST["send"])){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'asianland.ph.it@gmail.com';
        $mail->Password = 'lnecpyuqovopdbae';
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

<div class="card card-outline rounded-0 card-maroon">
    <div class="card-body">
        <div class="container-fluid">
            <h2>Compose Email</h2>
            <hr>
            <body>
                <form class="" method="post" enctype="multipart/form-data">
                    <div class="box_big1">
                        <div class="main_box">
                            <div class="row">
                                <div class="col-xs-12" style="width:86%;">		
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <textarea class="form-control required textarea" type="text" name="email"><?php echo $eadd; ?></textarea><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="width:86%;">		
                                    <div class="form-group">
                                    <label class="control-label">Subject: </label>
                                    <input type="text" name="subject" class="form-control required" value="PAYMENT RECEIVED - <?php echo $prop_id; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">		
                                    <div class="form-group">
                                        <label class="control-label">Message: </label>
                                        <textarea class="form-control required textarea" id='makeMeSummernote' name="message" rows="3">
                                        Thank you for your recent payment, which we have successfully received. We appreciate your promptness in settling your account with us.
                                        <br><br>
                                        Please note that your payment has been applied to your account and any outstanding balances have been adjusted accordingly. You can rest assured that your account is up-to-date and in good standing.
                                        <br><br>
                                        As a reminder, the payment amount was [Payment Amount], which was applied to your account on [Payment Date]. If you have any questions or concerns about your account, please don't hesitate to contact us at [Contact Information].
                                        If you have any questions or concerns about your account, please do not hesitate to contact us. We are always here to assist you and ensure your satisfaction.
                                        <br><br>
                                        Once again, thank you for your payment and we look forward to serving you in the future.<?php echo $textboxValue; ?>
                                        <br><br>
                                        <input type="text" id="inside_txtbox" disabled style="border:none" value="----------"><br>
                                        <input type="text" id="inside_txtbox" disabled style="border:none" value="<?php echo $_settings->userdata('lastname');?>, <?php echo $_settings->userdata('firstname');?> <?php echo $_settings->userdata('middlename');?>"><br>
                                        <input type="text" id="inside_txtbox" disabled style="border:none" value="<?php echo $_settings->userdata('user_type'); ?>">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">		
                                    <div class="form-group">
                                        <button type="submit" name="send" id="btnSend" class="btn btn-success">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </body>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#makeMeSummernote').summernote({
        height:200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    });
</script>

