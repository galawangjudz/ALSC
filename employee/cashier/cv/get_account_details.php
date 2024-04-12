<?php
require_once('../../../config.php');

error_log("Script started", 0);

if (isset($_POST['v_num'])) {
    $selectedVNum = $_POST['v_num'];


    error_log("Received v_num: $selectedVNum", 0);
    $vsItemsQuery = $conn->prepare("SELECT vi.*, ac.*, g.type FROM vs_items vi JOIN account_list ac ON vi.account_id=ac.id JOIN group_list g ON ac.group_id = g.id WHERE journal_id = ? AND ac.name = 'Accounts Payable Trade'");
    $vsItemsQuery->bind_param("i", $selectedVNum);
    $vsItemsQuery->execute();
    $result = $vsItemsQuery->get_result();
    
    $vsItems = array();
    
    while ($row = $result->fetch_assoc()) {
        $vsItems[] = array(
            'account_id' => $row['code'],
            'account_name' => $row['name'],
            'phase' => $row['phase'],
            'block' => $row['block'],
            'lot' => $row['lot'],
            'amount' => $row['amount'],
            'group_id' => $row['group_id'],
            'type' => 1,
        );
    }
    

    $vsItemsQuery->close();
    //$conn->close();

    error_log("vsItems: " . json_encode($vsItems), 0);

   
    echo json_encode($vsItems);
} else {
    error_log("Invalid request", 0);

    echo "Invalid request";
}
?>
