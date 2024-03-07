<?php
include '../../config.php';
echo 'Script is executed';

if ($_settings->chk_flashdata('success')) {
    echo json_encode(['status' => 'error', 'message' => $_settings->flashdata('success')]);
    exit;
}

$filename = $_FILES['file']['name'];
$location = 'journals/attachments/' . $filename;
$file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
$image_ext = array("jpg", "png", "jpeg", "gif", "pdf","gif","xlsx","csv","xls","txt","docx");
$resp = ['status' => 'error', 'message' => 'File upload failed'];

if (in_array($file_extension, $image_ext)) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
        $attachmentsFolder = 'attachments/';
        $newLocation = $attachmentsFolder . $filename;

        if (rename($location, $newLocation)) {
            $resp = ['status' => 'success', 'message' => 'File uploaded and moved successfully', 'file_location' => $newLocation];
        } else {
            $resp['message'] = 'Error moving the file to the attachments folder';
        }
    } else {
        $resp['message'] = 'Error moving the file';
    }
} else {
    $resp['message'] = 'Invalid file extension';
}

echo json_encode($resp);
?>
