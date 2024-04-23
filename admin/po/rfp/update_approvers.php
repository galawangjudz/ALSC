<?php
require_once('../../../config.php');

if (isset($_POST['removedSelect']) && isset($_POST['rfp_no'])) {
    $rfp_no = $_POST['rfp_no'];

    if (is_numeric($rfp_no)) {
        echo "RFP Number: $rfp_no<br>";
        echo "Removed Select: {$_POST['removedSelect']}<br>";

        $previousValues = [];
        for ($i = 1; $i <= 7; $i++) {
            if (isset($_POST['status' . $i])) {
                $previousValues['status' . $i] = $_POST['status' . $i];
            }
        }


        $update_query_null = $conn->prepare("UPDATE tbl_rfp SET status1=NULL, status2=NULL, status3=NULL, status4=NULL, status5=NULL, status6=NULL, status7=NULL WHERE rfp_no=?");
        $update_query_null->bind_param("i", $rfp_no);

        if ($update_query_null->execute()) {
            echo "All columns set to NULL successfully.<br>";


            $update_query_values = "UPDATE tbl_rfp SET ";
            $set_values = false;
            for ($i = 1; $i <= 7; $i++) {
                if (isset($_POST['status' . $i])) {
                    $value = $_POST['status' . $i];
                    $update_query_values .= "status$i=?, ";
                    $set_values = true;
                }
            }

    
            $update_query_values = rtrim($update_query_values, ", ");
            $update_query_values .= " WHERE rfp_no=?";

          
            $update_stmt = $conn->prepare($update_query_values);
            if ($update_stmt) {
         
                $types = "";
                $params = [];
                for ($i = 1; $i <= 7; $i++) {
                    if (isset($_POST['status' . $i])) {
                        $types .= "s";
                        $params[] = $_POST['status' . $i];
                    }
                }
                $types .= "i";
                $params[] = $rfp_no;

               
                $update_stmt->bind_param($types, ...$params);
                if ($update_stmt->execute()) {
                    echo "Values updated successfully.<br>";
                } else {
               
                    foreach ($previousValues as $key => $value) {
                        $_POST[$key] = $value;
                    }
                    echo "Error updating values: " . $update_stmt->error . "<br>";
                }
            } else {
                echo "Error preparing update query: " . $conn->error . "<br>";
            }
        } else {
            echo "Error setting fields to NULL: " . $update_query_null->error . "<br>";
        }
    } else {
        echo "Invalid RFP number: $rfp_no<br>";
    }
} else {
    echo "Select name or RFP number not provided.<br>";
}
?>
