<?php 
require_once('../../config.php');
$userid = $_settings->userdata('user_code');
$totalCredit = 0;
$totalDebit = 0;
$due_date = date('Y-m-d', strtotime('+1 week'));
$publicId = '';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `vs_entries` WHERE v_num = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        $publicId = $_GET['id'];

        if ($publicId > 0) {
            $docNoQuery = $conn->query("SELECT doc_no FROM tbl_gl_trans WHERE vs_num = '$publicId' and doc_type='AP'");
            if ($docNoQuery) {
                $docNoRow = $docNoQuery->fetch_assoc();
                $docNo = $docNoRow['doc_no'];
                $doc_no = $docNo;
            } else {
                echo "Error executing doc_no query: " . $conn->error;
            }
        }
    }
}

$is_new_vn = true;
$query = $conn->query("SELECT COUNT(DISTINCT vs_num) AS max_doc_no FROM `tbl_gl_trans` WHERE doc_type = 'AP'");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    if ($maxDocNo === null) {
        $maxDocNo = 0;
    }
    if ($publicId > 0) {
        $newDocNo = $doc_no;
    } else {
        $newDocNo = '2' . sprintf('%05d', $maxDocNo + 1);
    }
} else {
    echo "Error executing query: " . $conn->error;
}


if (isset($_GET['id']) && $_GET['id'] > 0) {
    $existing_v_id = $_GET['id'];

    $qry = $conn->query("SELECT v_num FROM `vs_entries` WHERE v_num = $existing_v_id");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $v_number = $row['v_num'];
        $is_new_vn = false;
    } else {
        $v_number = 'Selected voucher not found';
    }
} else {
    $qry = $conn->query("SELECT MAX(v_num) AS max_id FROM `vs_entries`");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $next_v_number = $row['max_id'] + 1;
    } else {
        $next_v_number = 1;
    }
    $v_number = str_pad($next_v_number, STR_PAD_LEFT);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table{
            font-size:14px;
        }
        .paid_to_main{
            border:solid 1px gainsboro;
            padding:10px;
            border-radius:5px;
        }
        .paid_to{
            padding:10px;
        }
        .rdo-btn {
            display: flex;
            width: 100%;
        }

        .rdo-btn label {
            flex: 1;
            text-align: center; 
            margin: 0; 
            padding: 10px; 
            box-sizing: border-box; 
        }

        .rdo-btn input[type="radio"] {
            margin: 0;
            vertical-align: middle; 
        }
        .hidden {
            display: none;
        }
        .phase{
            width:30%;
        }
        .block, .lot{
            width:10%;
        }
        .loc-cont{
            style:inline-block;
            width:100%;
        }
        .custom-modal-width {
            max-width: 60%; 
        }
        .custom-modal-width .modal-header .close {
            display: none;
        }
        #uni_modal .modal-footer{
            display: none;
        }
        .nav-client{
            background-color:#007bff;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        }
        .nav-client:hover{
            background-color:#007bff!important;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
        }
    </style>
    <script>
        $(document).ready(function() {
            updateTotals();
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="../../libs/js/lightbox.min.js"></script>
        <link rel="stylesheet" href="../../libs/js/jquery.fancybox.min.css"/>
    <script src="libs/js/jquery.fancybox.min.js"></script>
</head>
<body>
<div class="card card-outline card-primary">
    <div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($_GET['id']) ? "Update Voucher Setup Entry (Supplier)": "Add New Voucher Setup Entry (Supplier)" ?></b></i></h5>
	</div>
    <div class="card-body">
    <label class="control-label">Add Attachment:</label>
        <div id="picform-container">
            <form action="" method="post" enctype="multipart/form-data" id="picform">
                <table class="table table-bordered">
                    <input type="hidden" class="control-label" name="newDocNo" id="newDocNo" value="<?php echo $newDocNo; ?>" readonly>
                    <input type="hidden" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
                    <tr>
                        <td>
                        <!-- <label for="image" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i> Custom Upload
                        </label>
                        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" style="display:none;"> -->
                        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" value="">
                        </td>
                        <td style="display:none;">
                            <input type="hidden" name="imageName" id="imageName" class="form-control form-control-sm form-control-border rounded-0" readonly>
                        </td>
                        <td style="display:none;">
                            <button type="submit" name="submit" id="picform_submit_button"  class="btn btn-flat btn-sm btn-secondary">
                            <i class="fa fa-paperclip" aria-hidden="true"></i> Confirm Attachment </button>
                        </td>
                    </tr>
                </table> 
                <hr>
            </form>
        </div>
        <div id="attachments-container">
        <table class="table table-striped table-bordered" id="data-table" style="text-align:center;width:100%;">
            <colgroup>
                <col width="50%">
                <col width="50%">
            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th class="px-1 py-1 text-center">Attachment/s</th>
                    <th class="px-1 py-1 text-center">Date/Time Attached</th>
                </tr>
            </thead>
            <?php 
            $i = 1;
            $rows = mysqli_query($conn, "SELECT * FROM tbl_vs_attachments WHERE doc_no = $newDocNo ORDER BY date_attached DESC");
            ?>
            <?php if (mysqli_num_rows($rows) > 0): ?>
                <?php foreach($rows as $row):?>
                    <tr>
                        <td>
                            <?php
                                $fileExtension = pathinfo($row['image'], PATHINFO_EXTENSION);
                                $filePath = base_url . "employee/attachments/" . $row['image']; 

                                if (strtolower($fileExtension) == 'pdf'): ?>
                                    <a data-fancybox data-src="<?php echo $filePath; ?>" data-type="iframe" href="javascript:;">
                                        <img src="<?php echo base_url . 'employee/icons/pdf-icon.png'; ?>" alt="PDF Icon" width="25" height="25">
                                    </a>
                                <?php elseif (in_array(strtolower($fileExtension), ['xlsx'])): ?>
                                    <a href="<?php echo $filePath; ?>" download>
                                        <img src="<?php echo base_url . 'employee/icons/excel.png'; ?>" alt="XLSX Icon" width="25" height="25">
                                    </a>
                                <?php elseif (in_array(strtolower($fileExtension), ['docx'])): ?>
                                    <a href="<?php echo $filePath; ?>" download>
                                        <img src="<?php echo base_url . 'employee/icons/docx.jpg'; ?>" alt="DOCX Icon" width="25" height="25">
                                    </a>
                                <?php elseif (in_array(strtolower($fileExtension), ['csv'])): ?>
                                    <a href="<?php echo $filePath; ?>" download>
                                        <img src="<?php echo base_url . 'employee/icons/csv.png'; ?>" alt="CSV Icon" width="25" height="25">
                                    </a>
                                <?php else: ?>
                                    <a data-fancybox="images" href="<?php echo $filePath; ?>" data-caption="<?php echo $row['image']; ?>">
                                        <img src="<?php echo $filePath; ?>" alt="" width="25" height="25">
                                    </a>
                                <?php endif; ?>
                        </td>
                        <td>
                            <?php
                                $timestamp = strtotime($row["date_attached"]);
                                $formattedDate = date('F j, Y g:i:sA', $timestamp);
                                echo $formattedDate;
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No rows found</td>
                </tr>
            <?php endif; ?>
        </table>
        </div>
    </div>
</div>
<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <form action="" id="journal-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <input type="hidden" id="publicId" value="<?php echo $publicId; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="v_num" class="control-label">Voucher Setup #:</label>
                                    <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Document #:</label>
                                    <input type="text" id="newDocNo" name="newDocNo" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $newDocNo; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label class="control-label">Reference #:</label>
                                    <input type="text" id="ref_no" name="ref_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($ref_no) ? $ref_no : "" ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="journal_date" class="control-label">Transaction Date:</label>
                                    <input type="date" id="journal_date" name="journal_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($journal_date) ? $journal_date : date("Y-m-d") ?>" required readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="due_date" class="control-label">Due Date:</label>
                                    <input type="date" id="due_date" name="due_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($due_date) ? $due_date : date("Y-m-d") ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="col-md-12 form-group">
                            <label for="rfp_no">Approved RFPs:</label>
                            <table class="table table-bordered" id="table2" style="text-align:center;width:100%;">
                                <colgroup>
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="30%">
                                    <col width="50%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-navy disabled">
                                        <th>#</th>
                                        <th>RFP #</th>
                                        <th>Req. Dept.</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $qry = $conn->query("SELECT 
                                    tbl_rfp.id AS mainId,
                                    tbl_rfp.*,  
                                    tbl_rfp_approvals.* 
                                FROM 
                                    tbl_rfp 
                                JOIN 
                                    tbl_rfp_approvals ON tbl_rfp.rfp_no = tbl_rfp_approvals.rfp_no
                                WHERE 
                                    (tbl_rfp.rfp_for = 4 OR tbl_rfp.rfp_for = 5) 
                                GROUP BY 
                                    tbl_rfp.rfp_no
                                HAVING 
                                    (CASE WHEN tbl_rfp.status1 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp.status2 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp.status3 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp.status4 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp.status5 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp.status6 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp.status7 <> '' THEN 1 ELSE 0 END) 
                                    = 
                                    (CASE WHEN tbl_rfp_approvals.status1 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp_approvals.status2 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp_approvals.status3 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp_approvals.status4 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp_approvals.status5 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp_approvals.status6 <> '' THEN 1 ELSE 0 END +
                                    CASE WHEN tbl_rfp_approvals.status7 <> '' THEN 1 ELSE 0 END)
                                ORDER BY 
                                    tbl_rfp.transaction_date ASC;");
                                    while ($row = $qry->fetch_assoc()) {
                                    ?>
                                        <tr class="clickable-row" data-rfp="<?php echo $row['rfp_no']; ?>" data-toggle="modal" data-target="#rfpModal<?php echo $row['mainId']; ?>" style="cursor:pointer;">
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo ($row['rfp_no']); ?></td>
                                        <td><?php echo ($row['req_dept']) ?></td>
                                        <td><?php echo ($row['name']) ?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <hr>
                            <label for="rfp_no">Selected RFP #:</label>
                            <input type="text" id="rfp_no" name="rfp_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($rfp_no) ? $rfp_no : "" ?>" readonly> 
                            <?php
                            $qry = $conn->query("SELECT * FROM tbl_rfp ORDER BY transaction_date DESC;");
                            while ($row = $qry->fetch_assoc()) {
                                ?>
                                <div class="modal fade" id="rfpModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">RFP Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered" style="width:100%;font-size:14px;">
                                                    <tr>
                                                    <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>RFP #: </b></td>
                                                    <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['rfp_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                    <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Particulars: </b></td>
                                                    <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['description']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Amount: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo number_format($row['amount'],2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Requesting Department: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['req_dept']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Name: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Address: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['address']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Payment Form: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;">
                                                        <?php 
                                                            if ($row['payment_form'] == 0) {
                                                                echo 'Cash';
                                                            } elseif ($row['payment_form'] == 1) {
                                                                echo 'Check';
                                                            } 
                                                        ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Release Date: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['release_date']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Check Date: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['check_date']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Transaction Date: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo date('Y-m-d', strtotime($row['transaction_date'])); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>PR #: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['pr_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Bank Name: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['bank_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>PO #: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['po_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>CDV #: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['cdv_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>OFV #: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['ofv_no']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Remarks: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php echo $row['remarks']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $query = "SELECT firstname, lastname FROM users WHERE user_code = '{$row['preparer']}'";
                                                            $result = $conn->query($query);
                                                        
                                                            if ($result->num_rows > 0) {
                                                                while ($preparer_row = $result->fetch_assoc()) {
                                                                    echo '<tr>';
                                                                    echo '<td style="padding-top:5px!important;padding-bottom:5px!important;"><b>Preparer: </b></td>';
                                                                    echo '<td style="padding-top:5px!important;padding-bottom:5px!important;">';
                                                                    echo $preparer_row['firstname'] . ' ' . $preparer_row['lastname'];
                                                                    echo '</td>';
                                                                    echo '</tr>';
                                                                }
                                                            } 
                                                            ?>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><b>RFP for: </b></td>
                                                        <td style="padding-top:5px!important;padding-bottom:5px!important;"><?php 
                                                            if ($row['rfp_for'] == 1) {
                                                                echo 'Agent';
                                                            } elseif ($row['rfp_for'] == 2) {
                                                                echo 'Employee';
                                                            } elseif ($row['rfp_for'] == 3) {
                                                                echo 'Client';
                                                            }elseif ($row['rfp_for'] == 4) {
                                                                    echo 'Supplier';
                                                            }elseif ($row['rfp_for'] == 5) {
                                                                echo 'Others';
                                                            }
                                                        ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class="paid_to_main">
                        <div class="paid_to">
                            <label class="control-label">Paid To:</label>
                            <hr>          
                            <div class="row" id="sup-div">
                            <table style="width:100%;">
                                <tr>
                                    <td style="width:50%; padding-right: 10px;">
                                        <label for="supplier_id">Supplier:</label>
                                        <select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;" required>
                                            <option value="" <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                            <?php
                                            $supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
                                            while ($row = $supplier_qry->fetch_assoc()): 
                                            ?>
                                                <option
                                                    value="<?php echo $row['id'] ?>"
                                                    data-supplier-code="<?php echo $row['id'] ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?>
                                                    <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                                                ><?php echo $row['name'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </td>
                                    <td style="width:50%; padding-left: 10px;"> 
                                        <label for="sup_code" class="control-label">Supplier Code:</label>
                                        <input type="text" name="sup_code" id="sup_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                    </td>
                                </tr>
                            </table>
                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered" id="acc_list">
					    <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="25%">
                            <col width="40%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
						<thead>
							<tr class="bg-navy disabled">
								<th class="px-1 py-1 text-center"></th>
								<th class="px-1 py-1 text-center">Item #</th>
								<th class="px-1 py-1 text-center">Account Code</th>
								<th class="px-1 py-1 text-center">Account Name</th>
								<th class="px-1 py-1 text-center">Debit</th>
								<th class="px-1 py-1 text-center">Credit</th>
							</tr>
						</thead>
						<tbody>
                            <?php 
                            if (!isset($id) || $id === null) :
                                $journalId = isset($_GET['id']) ? $_GET['id'] : null;
                                $jitems = $conn->query("SELECT gl.account,gl.amount, gl.doc_no, gl.gtype, a.name 
                                FROM tbl_gl_trans gl LEFT JOIN account_list a ON
                                gl.account = a.code
                                WHERE gl.vs_num = '{$journalId}' and gl.doc_type = 'AP'
                                ORDER BY (gl.gtype = 1) DESC, gl.gtype;
                                ");
                                $counter = 1;
                                while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr class="po-item" data-id="accname">
                                <td class="align-middle p-1 text-center">
                                    <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                </td>
                                <td class="align-middle p-0 text-center">
                                    <input type="number" class="text-center w-100 border-0" step="any" name="ctr" value="<?= $counter ?>" readonly required/>
                                </td>
                                <td class="align-middle p-1">
                                    <input type="text" class="text-center w-100 border-0" name="account_id[]" value="<?= $row['account'] ?>" readonly>
                                    <input type="hidden" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
                                    <input type="hidden" name="doc_no[]" value="<?= $row['doc_no'] ?>" readonly>
                                    <input type="hidden" name="amount[]" value="<?= $row['amount'] ?>">
                                </td>
                                <td class="align-middle p-1">
                                <select id="account_id" class="form-control form-control-sm form-control-border select2" required>
                                    <option value="" disabled selected></option>
                                    <?php 
                                    $selectedAccountIds = array();
                                    $accountsResult = $conn->query("SELECT * FROM `account_list` WHERE delete_flag = 0 AND status = 1 ORDER BY name;");
                                    while ($accountRow = $accountsResult->fetch_assoc()):
                                        $selected = ($accountRow['code'] == $row['account']) ? 'selected' : '';
                                        echo '<option value="' . $accountRow['id'] . '" data-code="' . $accountRow['code'] . '" ' . $selected . '>' . $accountRow['name'] . '</option>';
                                    endwhile;
                                    ?>
                                </select>
                                </td>
                                <td class="debit_amount text-right" name="debit"><input type="text" class="text-right w-100 border-0 debit" name="debit[]" value="<?= $row['gtype'] == 1 ? $row['amount'] : '' ?>"></td>
                                <td class="credit_amount text-right" name="credit"><input type="text" class="text-right w-100 border-0 credit" name="credit[]" value="<?= $row['gtype'] == 2 ? abs($row['amount']) : '' ?>"></td>
                            </tr>

                            <?php 
                            $counter++;
                            endwhile; ?>
                        <?php endif; ?>
						</tbody>
						<tfoot>
                            <tr class="bg-gradient-secondary">
                                <tr>
									<th class="p-1 text-right" colspan="3"><span>
                                    <th colspan="1" class="text-right"><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>TOTAL</th>
                                    <th class="text-right total_debit"></th>
                                    <th class="text-right total_credit"></th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-center"></th>
                                    <th colspan="2" class="text-center total-balance"></th>
                                </tr>
                            </tr>
                        </tfoot>
					</table>
                    <div class="card-footer">
                        <table style="width:100%;">
                            <tr>
                                <td>
                                    <button class="btn btn-flat btn-default bg-maroon" style="width:100%;margin-right:5px;font-size:14px;" id="save_journal"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
                                </td>
                                <td>
                                    <a href="?page=journals/"  class="btn btn-flat btn-default" id="cancel" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<table class="d-none" id="item-clone">
	<tr class="po-item" data-id="accname">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="ctr" required/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="account_id[]" readonly>
			<input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo ?>" readonly>
            <input type="hidden" name="amount[]" value="">
		</td>
		<td class="align-middle p-1">
		<select id="account_id" class="form-control form-control-sm form-control-border select2" required>
            <option value="" disabled selected></option>
            <?php 
            $selectedAccountIds = array();
            $accountsResult = $conn->query("SELECT * FROM `account_list` WHERE delete_flag = 0 AND status = 1 ORDER BY name;");
            while ($accountRow = $accountsResult->fetch_assoc()):
                $selected = ($accountRow['code'] == $row['account']) ? 'selected' : '';
                echo '<option value="' . $accountRow['id'] . '" data-code="' . $accountRow['code'] . '" ' . $selected . '>' . $accountRow['name'] . '</option>';
            endwhile;
            ?>
        </select>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-right w-100 border-0 debit" name="debit[]">
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-right w-100 border-0 credit" name="credit[]">
		</td>
	</tr>
</table>
</body>
<script>
$(document).ready(function() {
    $('#supplier_id').select2({
        placeholder: 'Search for a supplier',
        allowClear: true,
        tags: true,
        tokenSeparators: [',', ' '],
        createTag: function (params) {
            
            var term = $.trim(params.term);
            var match = $('#supplier_id').find('option').filter(function() {
                return $(this).text().localeCompare(term, undefined, { sensitivity: 'base' }) === 0;
            });
            if (match.length > 0) {
                return null;
            }
            return {
                id: params.term,
                text: params.term,
                newOption: true
            };
        },
        ajax: {
            url: 'journals/get_suppliers.php',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('.clickable-row').click(function() {
        var rfpNo = $(this).data('rfp');
        $('#rfp_no').val(rfpNo);
    });
});
$(document).ready(function() {
    $('.clickable-row').click(function() {
        $('.clickable-row').css('background-color', ''); 
        $(this).css('background-color', 'gainsboro'); 
    });
});
$(document).ready(function () {
    var accTable = $('#table2').DataTable({
        lengthChange: false,
        pageLength: 4 
    });
});
</script>
<script>
$(document).ready(function() {
    $('.table th, .table td').addClass('px-1 py-0 align-middle');
    $('#data-table').DataTable({
        "lengthMenu": [[2], [2]], 
        "paging": true 
    });
});
</script>   
<script>
document.getElementById('image').addEventListener('change', function() {
    var formData = new FormData(document.getElementById('picform'));

    fetch('journals/vs_attachments.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        if (data.startsWith('Attached na, ssob. Hihe.')) {
            alert_toast(data, 'success'); 
        } else {
            alert_toast(" Invalid file. Huwag ipilit bhe. Hindi iyan mag-save.", 'error'); 
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var selectedOption = document.getElementById('supplier_id').options[document.getElementById('supplier_id').selectedIndex];
    console.log("Selected Option:", selectedOption);
    if (selectedOption) {
        document.getElementById('sup_code').value = selectedOption.getAttribute('data-supplier-code');
    }
});
document.getElementById('supplier_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption) {
        document.getElementById('sup_code').value = selectedOption.getAttribute('data-supplier-code');
    } else {
        document.getElementById('sup_code').value = '';
    }
});

$(document).ready(function () {
    var clone = $("#item-clone").find(".po-item").clone();
    $("#item-clone").append(clone);

    $(document).on('change', '.po-item select', function () {
        updateHiddenOptions();
        updateAccCode($(this));
    });

    $('#add_row').on('click', function () {
        var newRow = $('#item-clone tr').first().clone();
        var rowCount = $('#acc_list tbody tr').length + 1;
        newRow.find('[name="ctr"]').val(rowCount);
        $('#acc_list tbody').append(newRow);
        initializeRowEvents(newRow);
        updateHiddenOptions();
    });

    function updateCounter() {
        $('#acc_list tbody tr').each(function (index) {
            $(this).find('[name="ctr"]').val(index + 1);
        });
    }

});
$('#acc_list').on('input', '.debit, .credit', function() {
    updateTotals();
    validateAndFormat(this);
});
$('#acc_list').on('change', '.debit, .credit', function() {
    if ($(this).hasClass('debit')) {
        updateAmountDebit(this);
    } else if ($(this).hasClass('credit')) {
        updateAmountCredit(this);
    }
    updateTotals();
});
$('#acc_list').on('blur', '.debit, .credit', function() {
    formatNumber(this);
});

$(document).ready(function () {
    var supplierSelect = $("#supplier_id");
    var supCodeInput = $("#sup_code");

    supplierSelect.on("change", function () {
        var selectedOption = supplierSelect.find("option:selected");
        var supplierCode = selectedOption.data("supplier-code");

        if (!supplierCode) {
            $.ajax({
                url: 'journals/get_max_supplier.php', 
                type: 'GET',
                success: function (maxId) {
                    supCodeInput.val(parseInt(maxId) + 1 || 'N/A');

                    console.log("supCodeInput:", supCodeInput.val());
                },
                error: function () {
                    supCodeInput.val('N/A');

                    console.log("supCodeInput:", supCodeInput.val());
                }
            });
        } else {
            supCodeInput.val(supplierCode);

            console.log("supCodeInput:", supCodeInput.val());
        }
    });
});

</script>
<script>
function validateAndFormat(input) {
    input.value = input.value.replace(/[^0-9.]/g, '');
}
function formatNumber(input) {
    let inputValue = input.value;
    let numericValue = inputValue.replace(/[^0-9.]/g, '');
    let floatValue = parseFloat(numericValue);
    if (!isNaN(floatValue)) {
        input.value = floatValue.toLocaleString('en-US');
    } else {
        input.value = 0;
    }
}
function initializeRowEvents(row) {
    row.find('.debit, .credit').on('input', function() {
        updateTotals();
    });
}

function updateTotals() {
    var totalDebit = 0;
    var totalCredit = 0;

    $('.po-item').each(function () {
        var debitValue = parseFloat($(this).find('.debit').val().replace(/,/g, '')) || 0;
        var creditValue = parseFloat($(this).find('.credit').val().replace(/,/g, '')) || 0;

        totalDebit += debitValue;
        totalCredit += creditValue;
    });

    $('.total_debit').text(addCommasWithoutRounding(totalDebit.toString()));
    $('.total_credit').text(addCommasWithoutRounding(totalCredit.toString()));

    var balance = totalDebit - totalCredit;

    $('.total-balance').text(addCommasWithoutRounding(balance.toString()));
}

function addCommasWithoutRounding(number) {
    return number.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function updateAmountDebit(debitInput) {
    var amountInput = debitInput.closest('tr').querySelector("input[name='amount[]']");
    var creditInput = debitInput.closest('tr').querySelector("input[name='credit[]']");

    if (debitInput.value.trim() === '') {
        if (creditInput) {
            amountInput.value = creditInput.value;
            debitInput.value = 0;
        }
    } else {
        amountInput.value = debitInput.value;
        if (creditInput) {
            creditInput.value = 0;
        }
    }
}
	
function updateAmountCredit(creditInput) {
    var amountInput = creditInput.closest('tr').querySelector("input[name='amount[]']");
    var debitInput = creditInput.closest('tr').querySelector("input[name='debit[]']");

    if (creditInput.value.trim() === '') {
        if (debitInput) {
            amountInput.value = debitInput.value; 
            creditInput.value = 0;
        }
    } else {
        amountInput.value = '-' + creditInput.value;
        if (debitInput) {
            debitInput.value = 0;
        }
    }
}

function rem_item(_this) {
    _this.closest('tr').remove();
    updateHiddenOptions();
    updateTotals();
}

function updateHiddenOptions() {
    var selectedAccountIds = $('.po-item select').map(function () {
        return $(this).val();
    }).get();

    $('.po-item select').each(function () {
        var currentSelect = $(this);
        var currentSelectedValue = currentSelect.val();

        currentSelect.find('option').each(function () {
            var optionValue = $(this).val();
            if (selectedAccountIds.includes(optionValue) && optionValue !== currentSelectedValue) {
                $(this).prop('disabled', true);
            } else {
                $(this).prop('disabled', false);
            }
        });
        currentSelect.trigger('change.select2');
    });
}

function updateAccCode(_this) {
    var selectedOption = _this.find('option:selected');
    var accCodeTextbox = _this.closest('.po-item').find('[name="account_id[]"]');
    accCodeTextbox.val(selectedOption.data('code'));
}

</script>
<script>
    $('#journal-form').submit(function (e) {
        e.preventDefault();
        var _this = $(this);
        var p_Id = document.getElementById('publicId').value;
        $('.pop-msg').remove();
        var el = $('<div>');
        el.addClass("pop-msg alert");
        el.hide();
        if ($('#acc_list tbody tr').length <= 0) {
            alert_toast(" Account Table is empty.", 'warning');
            return false;
        }

        if ($('#acc_list tfoot .total-balance').text() !== '0') {
            console.log($('#acc_list tfoot .total-balance').text());
            alert_toast(" Hindi equal. :((", 'warning');
            return false;
        }

        if ($('.total_debit').text() == '0' && $('.total_credit').text() == '0') {
            console.log($('#acc_list tfoot .total-balance').text());
            alert_toast(" Account table is empty.", 'warning');
            return false;
        }

        if (p_Id === null || p_Id.trim() === "") {
            if ($('#image').val() === "") {
                alert_toast("Attached file is required.", 'warning');
                return false;
            }
        }


        function hasAPT() {
            var hasAPT = false;

            $('#acc_list .po-item input[name="account_id[]"]').each(function () {
                var accountValue = $(this).val().trim();

                if (accountValue === '21002') {
                    hasAPT = true;
                    return false; 
                }
            });

            return hasAPT;
        }

        if (!hasAPT()) {
            alert_toast(" Accounts Payable Trade is missing!", 'warning');
            return false;
        }

        function hasZeroAmount() {
            var hasZeroAmount = false;

            $('#acc_list .po-item input[name="amount[]"]').each(function () {
                var amountValue = parseFloat($(this).val().trim());

                if (amountValue === 0 || isNaN(amountValue)) {
                    hasZeroAmount = true;
                    return false;
                }
            });

            return hasZeroAmount;
        }

        if (hasZeroAmount()) {
            alert_toast(" One or more amount fields have zero value.", 'warning');
            return false;
        }
        start_loader();
        var urlSuffix;
            <?php if (!empty($_GET['id'])) { ?>
                urlSuffix = "modify_voucher_nonpo";
            <?php } else{ ?>
                urlSuffix = "save_voucher_nonpo";
            <?php }?>
            console.log('urlSuffix:', urlSuffix);
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=" + urlSuffix,
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: function (err) {
                console.log(err);
                end_loader();
            },
            success: function (resp) {
                var el = $("<div class='alert'></div>");
                if (resp.status == 'success') {
                    // location.reload();
                    location.replace('./?page=journals')
                } else if (!!resp.msg) {
                    el.addClass("alert-danger");
                    el.text(resp.msg);
                    _this.prepend(el);
                } else {
                    el.addClass("alert-danger");
                    el.text("An error occurred due to an unknown reason.");
                    _this.prepend(el);
                }
                el.show('slow');
                $('html,body,.modal').animate({ scrollTop: 0 }, 'fast');
                end_loader();
            }
        });
    })
    $(document).ready(function() {
        $('.debit, .credit').each(function() {
            formatNumber(this);
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var saveJournalButton = document.getElementById("save_journal");
        //var submitButton = document.getElementById("picform_submit_button");

        saveJournalButton.addEventListener("click", function () {
           // submitButton.click();
        });
    });
</script>
</html>
