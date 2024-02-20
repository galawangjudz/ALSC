<?php
require_once('../../../config.php');

if(isset($_FILES["image"])){
    $name = $_POST["name"];
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

        $validImageExtension = ['jpg', 'jpeg', 'png', 'pdf', 'gif'];
        $imageExtension = explode('.',$fileName);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validImageExtension)){
            echo
            "Invalid Image Extension.";
            return;
            ;
        }
        else if($fileSize > 1000000){
            echo 
            "Image Size Is Too Large.";
                return;
            ;
        }else{
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'attachments/' . $newImageName);

            $query = "INSERT INTO tbl_vs_attachments VALUES('','$name', '$newImageName', '0', 'AP', '$v_num',NOW())";
            mysqli_query($conn,$query);
            echo
            "'$name' successfully uploaded."
            ;
        }
    }
}
?>
