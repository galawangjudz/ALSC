<?php
require_once('../../../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents("php://input");
    $request = json_decode($data);

    if (isset($request->phase) && isset($request->block) && isset($request->lot)) {
        $enteredPhase = $request->phase;
        $enteredBlock = $request->block;
        $enteredLot = $request->lot;

        error_log("Entered Phase: " . $enteredPhase);
        error_log("Entered Block: " . $enteredBlock);
        error_log("Entered Lot: " . $enteredLot);

        $checkQuery = $conn->query("SELECT * FROM t_lots WHERE c_site = '$enteredPhase' AND c_block = '$enteredBlock' AND c_lot = '$enteredLot'");

        // if ($checkQuery->num_rows > 0) {
        //     echo '<span style="color: green;">Entered location exists.</span>';
        // } else {
        //     echo '<span style="color: red;">Entered location does not exist.</span>';
        // }
    } else {
        echo "Invalid JSON data.";
    }
} else {
    echo "Invalid request method.";
}
?>
