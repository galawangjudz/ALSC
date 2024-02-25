<?php
require_once('../../../../config.php');

    for ($a = 0; $a < count($_FILES["images"]["name"]); $a++)
    {
        $path = "attachments/" . $_FILES["images"]["name"][$a];
        mysqli_query($conn, "INSERT INTO tbl_vs_attachments(image) VALUES('$path')");
        move_uploaded_file($_FILES["images"]["tmp_name"][$a], $path);
    }

    echo "Done";
