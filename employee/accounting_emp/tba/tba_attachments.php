<?php require_once('../../../config.php');

if(isset($_FILES["image"])){
    $name = $_POST["imageName"];
    if($_FILES["image"]["error"] === 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>"
        ;
    }
    else{
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
<<<<<<< HEAD
        $doc_no = $_POST["rfp_no"];
=======
        $doc_no = $_POST["tba_no"];
>>>>>>> 2e894c5abd9aaca7fd605e981ee1bb306314718d
        $num = $_POST["num"];

        $validImageExtension = ['jpg', 'jpeg', 'png', 'pdf', 'gif','xlsx','csv','xls','txt','docx'];
        $imageExtension = explode('.',$fileName);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validImageExtension)){
            echo
            "Invalid Image Extension.";
            return;
            ;
        }
        else if($fileSize > 5000000){
            echo 
            "Image Size Is Too Large.";
                return;
            ;
        }else{
            $currentDateTime = date('Ymd_His');
            $newImageName = $currentDateTime . '_' . $fileName;
            move_uploaded_file($tmpName, './../../attachments/' . $newImageName);

<<<<<<< HEAD
           $query = "INSERT INTO tbl_vs_attachments VALUES('','$newImageName', '0', 'RFP', '$num',NOW())";
=======
           $query = "INSERT INTO tbl_vs_attachments VALUES('','$newImageName', '0', 'TBA', '$num',NOW())";
>>>>>>> 2e894c5abd9aaca7fd605e981ee1bb306314718d
           mysqli_query($conn,$query);
           echo
           "Attached na, ssob. Hihe."
           ;
        }
    }
}
?>
