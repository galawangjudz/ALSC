<?php
require_once('../../../config.php');

$data = array();
$tba_for = isset($_GET['tba_for']) ? $_GET['tba_for'] : '';
$tbaNo = isset($_GET['tba_no']) ? $_GET['tba_no'] : '';
$mainId = isset($_GET['mainId']) ? $_GET['mainId'] : '';

if (isset($_GET['tba_for'])) {
    if ($_GET['tba_for'] == '2' && $mainId == '') {
        $supplier_qry = $conn->query("SELECT * FROM `users` ORDER BY `firstname` ASC");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'user_code' => $row['user_code'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname']
            );
        }
    }else if ($_GET['tba_for'] == '2' && $mainId != '') {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_tba` WHERE tba_no=$tbaNo");
        while ($row = $supplier_qry->fetch_assoc()) {
            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    } else {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_tba` WHERE tba_no=$tbaNo");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    }
}
$response = array(
    'alert' => "tba_for value: $tba_for",
    'data' => $data
);

echo json_encode($response);
?>
