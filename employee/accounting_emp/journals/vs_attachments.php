<?php
require_once('../../../config.php');

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
        $newDocNo = $_POST["newDocNo"];
        $v_num = $_POST["v_num"];

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
            $newImageName = $fileName;
            //$newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, '../../attachments/' . $newImageName);

           $query = "INSERT INTO tbl_vs_attachments VALUES('','$newImageName', '0', 'AP', '$v_num',NOW())";
           mysqli_query($conn,$query);
           echo
           "Attached na, ssob. Hihe."
           ;
        }
    }
}
?>
