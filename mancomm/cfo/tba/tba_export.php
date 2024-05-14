<?php require_once('../../../config.php');

$query = "SELECT * FROM tbl_tba";
$result = $conn->query($query);


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="TBA_list.csv"');


$output = fopen('php://output', 'w');


fputcsv($output, array('#', 'TBA No.', 'Preparer', 'Req. Dept.', 'Tran. Date', 'Date Needed', 'Amount', 'Approver 1', 'Approver 2', 'Approver 3', 'Approver 4', 'Approver 5', 'Approver 6', 'Action'));


while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}


fclose($output);
?>
