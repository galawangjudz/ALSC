<?php
/* session_start();  */
include('functions.php');
$getID = $_GET['id'];
// $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
// output any connection error
if ($conn->connect_error) {
	die('Error : ('.$conn->connect_errno .') '. $conn->connect_error);
}
// the query
$query = "SELECT * FROM t_csr inner join t_csr_buyers on t_csr.c_csr_no = t_csr_buyers.c_csr_no WHERE t_csr_buyers.c_buyer_count = 1 and t_csr.c_csr_no = '" . $conn->real_escape_string($getID) . "'";
$result = mysqli_query($conn, $query);
// mysqli select query
if($result) {
	while ($row = mysqli_fetch_assoc($result)) {
		$csr_no = $row['c_csr_no'];
        $email = $row['email'];
      /*   $employment_status= $row['c_employment_status']; */
    }
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
    .box_big1{
        width:100%;
        height:auto;
        margin-left:auto;
        margin-right:auto;
        background-color:#ffffff;
        border:none;
        float:left;
        padding:25px;
        border-radius:5px;
        border: 1px solid black;
        padding-left:5%;
    }
</style>
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
    <div class="card-header">
        <h3 class="card-title"><b><i>Compose Email</i></b></h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <body>
            <div class="main_box">
                <form class="" method="post" enctype="multipart/form-data">
                    <div class="box_big1">
                        <div class="main_box">
                            <div class="row">
                                <div class="col-xs-12" style="width:100%;">		
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <textarea class="form-control required textarea" type="text" name="email">donitarosetantoco2028@gmail.com</textarea><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="width:100%;">		
                                    <div class="form-group">
                                    <label class="control-label">Subject: </label>
                                    <input type="text" name="subject" class="form-control required" value="APPROVAL FOR CSR #<?php echo $getID; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">		
                                    <div class="form-group">
                                        <label class="control-label">Message: </label>
                                        <textarea class="form-control required textarea" id='makeMeSummernote' name="message" rows="3">
                                        <br><br><br><br><br><br>
                                        <input type="text" id="inside_txtbox" disabled style="border:none" value="----------"><br>
                                        <input type="text" id="inside_txtbox" disabled style="border:none" value="<?php echo $_settings->userdata('lastname');?>, <?php echo $_settings->userdata('firstname');?> <?php echo $_settings->userdata('middlename');?>"><br>
                                        <input type="text" id="inside_txtbox" disabled style="border:none" value="<?php echo $_settings->userdata('user_type'); ?>">

                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12" style="width:100%;">		
                                    <div class="form-group">
                                        <label class="control-label">Attachment/s: </label>
                                        <input name="file[]" multiple="multiple" class="form-control" type="file" id="file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">		
                                    <div class="form-group">
                                        <button type="submit" name="send" id="btnSend" class="btn btn-flat btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;&nbsp;Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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

