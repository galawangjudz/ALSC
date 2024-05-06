<?php
require_once('../../../config.php');

$data = array();
$rfp_for = isset($_GET['rfp_for']) ? $_GET['rfp_for'] : '';
$rfpNo = isset($_GET['rfp_no']) ? $_GET['rfp_no'] : '';
$mainId = isset($_GET['mainId']) ? $_GET['mainId'] : '';

if (isset($_GET['rfp_for'])) {
    if ($_GET['rfp_for'] == '1' && $mainId == '') {
        $supplier_qry = $conn->query("SELECT * FROM `t_agents` ORDER BY `c_first_name` ASC");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'c_code' => $row['c_code'],
                'c_first_name' => $row['c_first_name'],
                'c_last_name' => $row['c_last_name']
            );
        }
    } else if ($_GET['rfp_for'] == '1' && $mainId != '') {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE rfp_no=$rfpNo");
        while ($row = $supplier_qry->fetch_assoc()) {
            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    } else if ($_GET['rfp_for'] == '2' && $mainId == '') {
        $supplier_qry = $conn->query("SELECT * FROM `users` ORDER BY `firstname` ASC");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'user_code' => $row['user_code'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname']
            );
        }
    }else if ($_GET['rfp_for'] == '2' && $mainId != '') {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE rfp_no=$rfpNo");
        while ($row = $supplier_qry->fetch_assoc()) {
            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    }else if ($_GET['rfp_for'] == '3' && $mainId == '') {
        $supplier_qry = $conn->query("SELECT * FROM property_clients ORDER BY `first_name` ASC");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'property_id' => $row['property_id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name']
            );
        }
    } else if ($_GET['rfp_for'] == '3' && $mainId != '') {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE rfp_no=$rfpNo");
        while ($row = $supplier_qry->fetch_assoc()) {
            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    } else if ($_GET['rfp_for'] == '4' && $mainId == '') {
        $supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    }else if ($_GET['rfp_for'] == '4' && $mainId != '') {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE rfp_no=$rfpNo");
        while ($row = $supplier_qry->fetch_assoc()) {
            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    } else {
        $supplier_qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE rfp_no=$rfpNo");
        while ($row = $supplier_qry->fetch_assoc()) {

            $data[] = array(
                'id' => $row['id'],
                'name' => $row['name'],
            );
        }
    }
}
$response = array(
    'alert' => "rfp_for value: $rfp_for",
    'data' => $data
);

echo json_encode($response);
?>
