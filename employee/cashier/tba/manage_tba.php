<?php
require_once('../../config.php');
$usercode = $_settings->userdata('user_code'); 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * FROM `tbl_tba` WHERE tba_no = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k = stripslashes($v);
        }
    }
} else{
    $payment_form = "";
    $req_dept = "";
}
if(isset($_GET['id']) && $_GET['id'] > 0){
    $autoIncrementQry = $conn->query("SHOW TABLE STATUS LIKE 'tbl_tba'");
    
    if ($autoIncrementQry) {
        $autoIncrementRow = $autoIncrementQry->fetch_assoc();
        $nextAutoIncrement = $autoIncrementRow['Auto_increment'];
        $concatenatedValue = $tba_no;

        //echo $concatenatedValue;

    } else {
        echo "Error getting auto-increment value: " . $conn->error;
    }
}else{
    $autoIncrementQry = $conn->query("SHOW TABLE STATUS LIKE 'tbl_tba'");
    
    if ($autoIncrementQry) {
        $autoIncrementRow = $autoIncrementQry->fetch_assoc();
        $nextAutoIncrement = $autoIncrementRow['Auto_increment'];
        $concatenatedValue = '202100' . $nextAutoIncrement;

        //echo $concatenatedValue;

    } else {
        echo "Error getting auto-increment value: " . $conn->error;
    }
}

$attachment_count = 0;  

if (empty($_GET['id'])) {
    $qry = $conn->query("SELECT MAX(num) AS attachment_count FROM `tbl_vs_attachments` WHERE doc_type = 'TBA' and `doc_no` != '0'");
    
    if ($qry && $qry->num_rows > 0) {
        $result = $qry->fetch_assoc();
        $attachment_count = $result['attachment_count'] + 1;
        //echo "Number of attachments with doc_type 'TBA': $attachment_count";
    } else {
        //echo "Unable to retrieve attachment count from tbl_vs_attachments.";
    }
    
} else {
    $qry1 = $conn->query("SELECT num FROM `tbl_vs_attachments` WHERE doc_no = '{$_GET['id']}' ");
    
    if ($qry1 && $qry1->num_rows > 0) {
        $result1 = $qry1->fetch_assoc();
        $attachment_count = $result1['num'];
        //echo "Number from tbl_tba: $attachment_count";
    } else {
        //echo "Unable to retrieve attachment count from tbl_tba.";
    }
}
?>
<style>
    .select2{
        margin-top:30px;
    }
    #status1_orig {
        display: none!important;
    }
	.nav-tba{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-tba:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    .approversDiv{
        margin-top:25px;
    }
    #amountToWords{
        background-color:gainboro;
        border:solid 1px gainsboro;
        font-style: italic;
        font-weight: bold;
        padding-left:25px;
        text-transform: uppercase;
    }
    .custom-select1{
        width:100%;
    }
    .custom-select{
        margin-top:-5px;
        margin-bottom:10px;
    }

</style>
    <script src="../../libs/js/lightbox.min.js"></script>
    <link rel="stylesheet" href="../../libs/js/jquery.fancybox.min.css"/>
    <script src="../../libs/js/jquery.fancybox.min.js"></script>

<body onload=initialize()">
    <div class="card card-outline card-primary">
               <div class="card-header">
            <h5 class="card-title"><b><i><?php echo isset($_GET['id']) ? "Update TBA" : "Add New TBA" ?> (TBA #: <?php echo $concatenatedValue; ?>)</b></i></h5>
        </div>
        
        <div class="card-body">
            <label class="control-label" style="float:left;">Add Attachment:</label>
            <div id="picform-container">
                <form action="" method="post" enctype="multipart/form-data" id="picform">
                    <table class="table table-bordered">
                        <input type="hidden" class="control-label" name="tba_no" id="tba_no" value="<?php echo $concatenatedValue; ?>" readonly>
                        <input type="hidden" class="control-label" name="num" id="num" value="<?php echo $attachment_count; ?>" readonly>
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
                    $rows = mysqli_query($conn, "SELECT * FROM tbl_vs_attachments WHERE doc_no = $concatenatedValue ORDER BY date_attached DESC");
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
        <div class="card-body">
            <form action="" id="tba-form">
                <input type="hidden" name="division" value="<?php echo $_settings->userdata('division'); ?>">
                <input type="hidden" name="usercode" value="<?php echo $_settings->userdata('user_code'); ?>">
                <input type="hidden" name="preparer" value="<?php echo ($usercode); ?>">
                <input type="hidden" name="id" id="mainId" value="<?php echo isset($id) ? $id : '' ?>">
                <input type="hidden" class="control-label" name="tba_no" id="tba_no" value="<?php echo $concatenatedValue; ?>" readonly>
                <input type="hidden" class="control-label" name="num" id="num" value="<?php echo $attachment_count; ?>" readonly>
                <hr>
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="req_dept" class="control-label">Requesting Department:</label>
                            <input type="text" name="req_dept" id="req_dept" value="<?php echo $_settings->userdata('department'); ?>" class="form-control rounded-0" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="transaction_date" class="control-label">Transaction Date:</label>
                            <?php
                            if (!empty($transaction_date)) {
                                $transaction_date = date('Y-m-d');
                                $transactionformattedDateTime = date('Y-m-d\TH:i:s', strtotime($transaction_date));
                            } else {
                                $transaction_date = date('Y-m-d');
                                $transactionformattedDateTime = date('Y-m-d\TH:i:s');
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" value="<?php echo isset($transaction_date) ? $transaction_date : '' ?>" readonly>
                            <input type="datetime-local" class="form-control form-control-sm rounded-0" style="display:none;" id="transaction_date" name="transaction_date" value="<?php echo isset($transactionformattedDateTime) ? $transactionformattedDateTime : '' ?>" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="payment_form" class="control-label" style="float:left;">Payment Form:</label>
                            <input type="hidden" name="payment_form" id="payment_form" value="1">
                            <input type="text" class="form-control rounded-0" value="Check" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="date_needed" class="control-label" style="float:left;">Date Needed:</label>
                            <?php
                            if (!empty($date_needed)) {
                                $dneededformattedDate = date('Y-m-d', strtotime($date_needed));
                            } else {
                                $dneededformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="date_needed" name="date_needed" value="<?php echo isset($dneededformattedDate) ? $dneededformattedDate : '' ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="tba_for" class="control-label" style="float:left;">TBA For:</label>
                            <input type="text" class="form-control rounded-0" value="Employee" readonly>
                            <select name="tba_for" id="tba_for" class="form-control rounded-0" style="display:none;" required onchange="populatePayableToSelect()" <?php echo !empty($_GET['id']) ? "disabled" : "" ?>>
                                <option value="" disabled <?php echo !isset($tba_for) ? "selected" : '' ?>>Select an Item</option>
                                <option value="1" <?php echo isset($tba_for) && $tba_for == 1 ? "selected" : '' ?>>Agents</option>
                                <option value="2" <?php echo isset($tba_for) && $tba_for == 2 ? "selected" : '' ?>>Employees</option>
                                <option value="3" <?php echo isset($tba_for) && $tba_for == 3 ? "selected" : '' ?>>Clients</option>
                                <option value="4" <?php echo isset($tba_for) && $tba_for == 4 ? "selected" : '' ?>>Suppliers</option>
                                <option value="5" <?php echo isset($tba_for) && $tba_for == 5 ? "selected" : '' ?>>Others</option>
                            </select>

                        </div>
                        <div class="col-md-6 form-group">
                            
                        <?php 
                        
                        if (!isset($_GET['id']) || $_GET['id'] == "") { ?>
                            <label for="payable_to" class="control-label" style="float:left;">Accountable Person:</label>
                            <select name="acc_person" id="acc_person" class="custom-select1 custom-select-sm rounded-0 select2" style="font-size:14px" <?php echo !empty($_GET['id']) ? "disabled" : "" ?> required>
                            </select>
                        <?php } else { ?>
                            <input type="text" name="acc_person" class="form-control rounded-0" value="<?php echo isset($acc_person) ? $acc_person :"" ?>" style="margin-top:30px;" required readonly>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="amount" class="control-label" style="float:left;">Amount:</label>
                            <input type="text" name="amount" id="amount" class="form-control rounded-0" value="<?php echo isset($amount) ? $amount : ""; ?>" required>
                        </div>
                        <div class="col-md-6 form-group" style="padding-top:30px;">
                           <div id="amountToWords" class="form-control rounded-0 text-display" style="background-color: gainsboro; overflow: auto;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label" style="float:left;">Particulars:</label>
                            <textarea rows="10" name="description" id="description" class="form-control rounded-0" required><?php echo isset($description) ? $description :"" ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="remarks" class="control-label" style="float:left;">Remarks:</label>
                        <textarea rows="3" name="remarks" id="remarks" class="form-control rounded-0" required><?php echo isset($remarks) ? $remarks :"" ?></textarea>
                    </div>
                </div>
                <br><hr><br>
                <?php 
                if (isset($_GET['id']) == ''){ ?>
                <div class="container-fluid">
                    <div class="card-body" style="border:1px solid gainsboro;">
                        <label for="remarks" class="control-label">List of Approvers </label>
                        <hr>
                        <input type="number" id="inputValue" style="display:none;"> 
                        <div class="container-fluid approversDiv"></div>
                        <select id="status1_orig" class="custom-select custom-select-sm rounded-0 select2" style="display: none">
                            <?php 
                            $approver_qry = $conn->query("SELECT * FROM `users` WHERE division = 'SPVR' || division = 'MNGR' || position = 'EXECUTIVE ASSISTANT TO THE COO'");
                            $isApproverIdZero = isset($approver_id) && $approver_id == 0;
                            ?>
                            <option value="" <?php echo $isApproverIdZero ? "selected" : '' ?>></option>
                            <?php 
                            while($row = $approver_qry->fetch_assoc()):
                                $approverValue = $row['firstname'] . ' ' . $row['lastname'];
                            ?>
                            <option 
                                value="<?php echo $row['user_code'] ?>" 
                                <?php echo (isset($approver_id) && $approver_id == $row['user_code']) ? 'selected' : '' ?>>
                                <?php echo $approverValue ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var inputValue = document.getElementById('inputValue').value;
                        var container = document.querySelector('.approversDiv');
                        var originalSelect = document.getElementById('status1_orig');
                        var section = '<?php echo $_settings->userdata('section'); ?>'; 
                        container.innerHTML = '';

                        var clonedSelectContainer = document.createElement('div');
                        clonedSelectContainer.className = 'clonedSelectContainer';

                        for (var i = 1; i < inputValue; i++) { 
                            var clonedSelect = originalSelect.cloneNode(true);
                            clonedSelect.id = 'status' + (i + 1); 
                            clonedSelect.name = 'status' + (i + 1); 
                            clonedSelect.selectedIndex = 0;
                            clonedSelectContainer.appendChild(cloneSelectWithLabel(clonedSelect, (i + 1)));
                        }

                        if (inputValue > 1) {
                            container.appendChild(cloneSelectWithLabel(originalSelect, 1)); 
                            container.appendChild(clonedSelectContainer);
                        } else {
                            container.appendChild(cloneSelectWithLabel(originalSelect, 1)); 
                        }

                        document.querySelectorAll('.custom-select').forEach(function (select, index) {
                            select.style.display = 'block';

                            if (section === 'Accounting') {
                                if (index === (inputValue - 4)) {
                                    select.value = '10184';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10030';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                           
                            if (section === 'Documentation and Loan' && code == '20084') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10009';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Documentation and Loan' && code != '20084') {
                                if (index === (inputValue - 4)) {
                                    select.value = '20084';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10009';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 

                            if (section === 'Documentation and Loan' && code == '10009') {
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 

                            if (section === 'IT' && code == '20181') {
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 

                            if (section === 'IT' && code != '20181') {
                                if (index === (inputValue - 3)) {
                                    select.value = '20181';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 

                            if (section === 'Legal' && code != '10102') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10102';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Legal' && code == '10102') {
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Audit' && code != '20018') {
                                if (index === (inputValue - 4)) {
                                    select.value = '20018';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10030';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Audit' && code == '20018') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10030';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Inventory Control' && (code != '20003' || code != '20017')) {
                                if (index === (inputValue - 4)) {
                                    select.value = '20017';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10009';
                                }
                                if (index === (inputValue - 2)) {
                                    select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Inventory Control' && (code == '20003' || code == '20017')) {
                                if (index === (inputValue - 3)) {
                                    select.value = '10009';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'General Services' && code != '10143') {
                                if (index === (inputValue - 4)) {
                                    select.value = '10143';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10070';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'General Services' && code == '10143') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10070';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Marketing' && code != '10100') {
                                if (index === (inputValue - 5)) {
                                    select.value = '10100';
                                }
                                if (index === (inputValue - 4)) {
                                    select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Marketing' && code == '10100') {
                                if (index === (inputValue - 4)) {
                                    select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                    select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Corporate Communications' && code != '10131') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10131';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Corporate Communications' && code == '10131') {
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Personnel' && code == '10041') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10070';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Personnel' && code != '10041') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10041';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10070';
                                }
                                if (index === (inputValue - 2)) {
                                    select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Project Admin' && code != '20001') {
                                if (index === (inputValue - 5)) {
                                    select.value = '20001';
                                }
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Project Admin' && code == '20001') {
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Treasury' && code != '10017') {
                                if (index === (inputValue - 4)) {
                                select.value = '10017';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10007';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Treasury' && code == '10017') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10007';
                                }
                                if (index === (inputValue - 2)) {
                                    select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'CALS' && code != '10012') {
                                if (index === (inputValue - 4)) {
                                select.value = '10012';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10030';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            }
                            if (section === 'CALS' && code == '10012') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10030';
                                }
                                if (index === (inputValue - 2)) {
                                    select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            }
                            if (section === 'Contracts and Doc.' || section === 'Design and Devt.' && (code == '10026')) {
                                if (index === (inputValue - 5)) {
                                select.value = '10026';
                                }
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Contracts and Doc.' || section === 'Design and Devt.' && (code != '10026')) {
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Technical Planning' && (code != '20186')) {
                                if (index === (inputValue - 6)) {
                                select.value = '20186';
                                }
                                if (index === (inputValue - 5)) {
                                select.value = '10026';
                                }
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Technical Planning' && (code == '20186')) {
                                if (index === (inputValue - 5)) {
                                select.value = '10026';
                                }
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Const. and Impln.' && code != '10006') {
                                if (index === (inputValue - 5)) {
                                    select.value = '10006';
                                }
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            
                            if (section === 'Const. and Impln.' && code == '10006') {
                                if (index === (inputValue - 4)) {
                                select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Permits and Licenses') {
                                if (index === (inputValue - 3)) {
                                    select.value = '10009';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Electrical' && code != '10038') {
                                if (index === (inputValue - 6)) {
                                    select.value = '10038';
                                }
                                if (index === (inputValue - 5)) {
                                select.value = '10026';
                                }
                                if (index === (inputValue - 4)) {
                                    select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Electrical' && code == '10038') {
                                if (index === (inputValue - 5)) {
                                select.value = '10026';
                                }
                                if (index === (inputValue - 4)) {
                                    select.value = '10114';
                                }
                                if (index === (inputValue - 3)) {
                                    select.value = '10051';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                            if (section === 'Purchasing') {
                                if (index === (inputValue - 4)) {
                                select.value = '10015';
                                }
                                if (index === (inputValue - 3)) {
                                select.value = '10030';
                                }
                                if (index === (inputValue - 2)) {
                                select.value = '20124';
                                }
                                if (index === (inputValue - 1)) {
                                    select.value = '10055';
                                }
                            } 
                        });
                    });


                    function cloneSelectWithLabel(select, index) {
                        var cloneContainer = document.createElement('div');
                        cloneContainer.className = 'clonedSelectContainer';

                        var label = document.createElement('label');
                        label.htmlFor = 'status' + index;
                        label.textContent = 'Approver ' + index + ': ';

                        cloneContainer.appendChild(label);

                        var clonedSelect = select.cloneNode(true);
                        clonedSelect.id = 'status' + index;
                        clonedSelect.name = 'status' + index;

                        cloneContainer.appendChild(clonedSelect);

                        return cloneContainer;
                    }

                    </script>
                    <?php } else {?>
                    <div class="card-body" style="border:1px solid gainsboro;">
                        <label for="" class="control-label"># of Approvers: </label>
                        
                        <?php 
                        $tba_query = $conn->prepare("SELECT status1, status2, status3, status4, status5, status6, status7 FROM tbl_tba WHERE tba_no = ?");
                        $tba_query->bind_param("i", $_GET['id']);
                        $tba_no = $_GET['id'];
                        $tba_query->execute();
                        $tba_result = $tba_query->get_result();

                        $user_codes_from_db = array();

                        while ($row = $tba_result->fetch_assoc()) {
                            foreach ($row as $status) {
                                if (!empty($status)) {
                                    $user_codes_from_db[] = $status;
                                }
                            }
                        }
                        
                        $total_count = count($user_codes_from_db);
                        ?>
                        
                        <input type="number" id="inputValue" value="<?php echo $total_count; ?>" style="width:50px;background-color:gainsboro;border:none;text-align:center;" readonly><hr>
                        <!--                          <button type="button" id="addApproverButton" class="btn btn-primary btn-sm ml-2">Add</button> --> 
                        <div class="container-fluid approversDiv">
                            <?php
                            for ($i = 0; $i < $total_count; $i++) {
                                $approver_qry = $conn->query("SELECT * FROM `users` WHERE division = 'SPVR' OR division = 'MNGR' OR position = 'EXECUTIVE ASSISTANT TO THE COO'");
                                echo '<div class="approver-row">';
                                echo '<label for="status' . ($i + 1) . '">Approver ' . ($i + 1) . ':</label>';
                                echo '<select id="status' . ($i + 1) . '" class="custom-select custom-select-sm rounded-0 select2" name="status' . ($i + 1) . '">';

                                while ($row = $approver_qry->fetch_assoc()) {
                                    $selected = ($user_codes_from_db[$i] == $row['user_code']) ? 'selected' : '';
                                                                        echo '<option value="' . $row['user_code'] . '" ' . $selected . '>' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';
                                }
                                echo '</select>';
                                // //echo '<button type="button" id="removeApproverButton' . ($i + 1) . '" class="btn btn-danger btn-sm removeApproverButton">Remove</button>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="card-footer">
                    <table style="width:100%;">
                        <tr>
                            <td>
                                <button class="btn btn-flat btn-default bg-maroon" style="width:100%;margin-right:5px;font-size:14px;" id="save_tba"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
                            </td>
                            <td>
                                <a href="?page=tba/tba_list"  class="btn btn-flat btn-default" id="cancel" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        <div>
    <div>
</body>

<?php 
if (isset($_GET['id']) == ''){ 
    echo '<script>';
    echo 'window.onload = function() {';
    echo 'var inputValue = document.getElementById("inputValue").value;'; 
    echo 'var section = "' . $_settings->userdata('section') . '";'; 
    echo 'var code = "' . $_settings->userdata('user_code') . '";'; 


    echo 'if (section === "Accounting") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10184", "10030", "20124", "10055"];';
        echo '} else if (section === "Billing") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["20016", "10030", "20124", "10055"];';
        echo '} else if (section === "Const. and Impln." && code != "10006") {';
        echo '    inputValue = 5; '; 
        echo '    var selects = ["10006", "10114", "10051", "20124", "10055"];';
        echo '} else if (section === "Const. and Impln." && code == "10006") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10114", "10051", "20124", "10055"];';
        echo '} else if (section === "Documentation and Loan" && code != "20084") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["20084", "10009", "20124", "10055"];';
        echo '} else if (section === "Documentation and Loan" && code == "20084") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10009", "20124", "10055"];';
        echo '} else if (section === "Documentation and Loan" && code == "10009") {';
        echo '    inputValue = 2; '; 
        echo '    var selects = ["20124", "10055"];';
        echo '} else if (section === "IT" && code != "20181") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["20181", "20124", "10055"];';
        echo '} else if (section === "IT" && code == "20181") {';
        echo '    inputValue = 2; '; 
        echo '    var selects = ["20124", "10055"];';
        echo '} else if (section === "Legal" && code != "10102") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10102", "20124", "10055"];';
        echo '} else if (section === "Legal" && code == "10102") {';
        echo '    inputValue = 2; '; 
        echo '    var selects = ["20124", "10055"];';
        echo '} else if (section === "Audit" && code != "20018") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["20018", "10030","20124", "10055"];';
        echo '} else if (section === "Audit" && code == "20018") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10030","20124", "10055"];';
        echo '} else if (section === "Inventory Control" && (code == "20003" || code == "20017")) {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10009","20124", "10055"];';
        echo '} else if (section === "Inventory Control" && (code != "20003" || code != "20017")) {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["20017","10009","20124", "10055"];';
        echo '} else if (section === "General Services" && code != "10143") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10143", "10070","20124", "10055"];';
        echo '} else if (section === "General Services" && code == "10143") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10070","20124", "10055"];';
        echo '} else if (section === "Marketing" && code == "10100") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10114","10051","20124", "10055"];';
        echo '} else if (section === "Marketing" && code != "10100") {';
        echo '    inputValue = 5; '; 
        echo '    var selects = ["10100","10114","10051","20124", "10055"];';
        echo '} else if (section === "Corporate Communications" && code != "10131") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10131","20124", "10055"];';
        echo '} else if (section === "Corporate Communications" && code == "10131") {';
        echo '    inputValue = 2; '; 
        echo '    var selects = ["20124", "10055"];';
        echo '} else if (section === "Personnel" && code != "10041") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10041","10070","20124", "10055"];';
        echo '} else if (section === "Personnel" && code == "10041") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10070","20124", "10055"];';
        echo '} else if (section === "Project Admin" && code != "20001") {';
        echo '    inputValue = 5; '; 
        echo '    var selects = ["20001","10114","10051","20124", "10055"];';
        echo '} else if (section === "Project Admin" && code == "20001") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10114","10051","20124", "10055"];';
        echo '} else if (section === "Treasury" && code != "10017") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10017","10007","20124", "10055"];';
        echo '} else if (section === "Treasury" && code == "10017") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10007","20124", "10055"];';
        echo '} else if (section === "CALS" && code != "10012") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10012","10030","20124", "10055"];';
        echo '} else if (section === "CALS" && code == "10012") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10030","20124", "10055"];';
        echo '} else if (section === "Contracts and Doc." && code != "10026") {';
        echo '    inputValue = 5; '; 
        echo '    var selects = ["10026","10114","10051","20124", "10055"];';
        echo '} else if (section === "Contracts and Doc." && code == "10026") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10114","10051","20124", "10055"];';
        echo '} else if (section === "Design and Devt.") {';
        echo '    inputValue = 5; '; 
        echo '    var selects = ["10026","10114","10051","20124", "10055"];';
        echo '} else if (section === "Purchasing") {';
        echo '    inputValue = 4; '; 
        echo '    var selects = ["10015","10030","20124", "10055"];';
        echo '} else if (section === "Technical Planning" && code != "20186") {';
        echo '    inputValue = 6; '; 
        echo '    var selects = ["20186","10026","10114","10051","20124", "10055"];';
        echo '} else if (section === "Technical Planning" && code == "20186") {';
        echo '    inputValue = 5; '; 
        echo '    var selects = ["10026","10114","10051","20124", "10055"];';
        echo '} else if (section === "Permits and Licenses") {';
        echo '    inputValue = 3; '; 
        echo '    var selects = ["10009","20124", "10055"];';
        echo '} else if (section === "Electrical" && code != "10038") {';
        echo '    inputValue = 6; '; 
        echo '    var selects = ["10038","10026", "10114","10051","20124", "10055"];';
        echo '} else if (section === "Electrical" && code == "10038") {';
        echo '    inputValue = 6; '; 
        echo '    var selects = ["10026", "10114","10051","20124", "10055"];';
        echo '}';
              
        echo 'if (code === "10009") {';
        echo '    inputValue = 2; '; 
        echo '    var selects = ["20124", "10055"];';
        echo '} else if (code === "10007") {';
        echo '    inputValue = 2; '; 
        echo '    var selects = ["20124", "10055"];';
        echo '}';
        
    echo 'var container = document.querySelector(".approversDiv");';
    echo 'var originalSelect = document.getElementById("status1_orig");';
    echo 'container.innerHTML = "";';
    echo 'var clonedSelectContainer = document.createElement("div");';
    echo 'clonedSelectContainer.className = "clonedSelectContainer";';
    echo 'for (var i = 1; i < inputValue; i++) { ';
    echo '    var clonedSelect = originalSelect.cloneNode(true);';
    echo '    clonedSelect.id = "status" + (i + 1); ';
    echo '    clonedSelect.name = "status" + (i + 1); ';
    echo '    clonedSelect.selectedIndex = 0;';
    echo '    clonedSelect.value = selects[i - 1];'; 
    echo '    clonedSelectContainer.appendChild(cloneSelectWithLabel(clonedSelect, (i + 1)));';
    echo '}';
    
    echo 'if (inputValue > 1) {';
    echo '    container.appendChild(cloneSelectWithLabel(originalSelect, 1)); ';
    echo '    container.appendChild(clonedSelectContainer);';
    echo '} else {';
    echo '    container.appendChild(cloneSelectWithLabel(originalSelect, 1)); ';
    echo '}';
    
    echo 'document.querySelectorAll(".custom-select").forEach(function (select, index) {';
    echo '    select.style.display = "block";';
    echo '    select.value = selects[index];'; 
    echo '});';
    
    echo '};';
    echo '</script>';
} 
?>
 <script>
    document.getElementById('amount').addEventListener('input', function (e) {
        var value = e.target.value;
        value = value.replace(/[^\d.]/g, '');
        var parts = value.split('.');
        if (parts.length > 2) {
            value = parts[0] + '.' + parts.slice(1).join('');
        }
        e.target.value = value;
    });
</script>
<script>
$(document).ready(function() {
    $('#data-table').DataTable({
        "paging": true,      
        "lengthChange": true, 
        "searching": true,   
        "ordering": true,    
        "info": true,        
        "autoWidth": false  
    });
    $('.table th, .table td').addClass('px-1 py-0 align-middle');
});
</script>
<script>
$(document).ready(function() {
  $('#acc_person').select2({
    tags: true 
  });
});

function populatePayableToSelect() {
var tbaForSelect = document.getElementById('tba_for');
var payableToSelect = document.getElementById('acc_person');
var mainId = document.getElementById('mainId').value; 
var tbaNo = document.getElementById('tba_no').value; 
var selectedValue = tbaForSelect.value;
payableToSelect.innerHTML = '';

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
        console.log("XHR Status:", xhr.status);
        if (xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            console.log("Data received:", data);
            if (data.alert) {
                console.log("Alert message:", data.alert);
            }
            if (data.data) {
                data.data.forEach(function(item) {
                    var option = document.createElement('option');
                    if (selectedValue == '2' && mainId == '') {
                        option.value = item.firstname + ' ' + item.lastname;
                        option.text = item.firstname + ' ' + item.lastname;
                    } else if (selectedValue == '2' && mainId != '') {
                        option.value = item.name;
                        option.text = item.name;
                    }else {
                        option.value = item.name;
                        option.text = item.name;
                    }
                    payableToSelect.appendChild(option);
                });
            }
        } else {
            console.error("Error fetching data:", xhr.statusText);
        }
    }
};
xhr.open('GET', 'tba/get_dropdown.php?tba_for=' + selectedValue + '&tba_no=' + tbaNo + '&mainId=' + mainId, true);
xhr.send();
}

document.getElementById('tba_for').addEventListener('change', populatePayableToSelect);
populatePayableToSelect();

</script>
<script>
    document.getElementById("tba_for").value = "2";
    populatePayableToSelect();
</script>

<script>
    function getUrlParameter(name) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(window.location.href);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    document.querySelectorAll('.removeApproverButton').forEach(function(button, index) {
    button.addEventListener('click', function() {
        console.log('Remove button clicked for select #' + (index + 1));
        var selectName = 'status' + (index + 1);
        console.log('Removed select: ' + selectName);

        var selectValue = document.getElementById(selectName).value;
        console.log('Value of select to be removed: ' + selectValue);
        
        var confirmed = window.confirm('Are you sure you want to remove this approver? This action is irreversible.');
        
        if (confirmed) {
            var approverRow = button.parentElement;
            if (approverRow) {
                approverRow.remove();
            }

            var selects = document.querySelectorAll('.approver-row select');
            for (var i = 0; i < selects.length; i++) {
                selects[i].setAttribute('acc_person', 'status' + (i + 1));
                console.log('Updated select: status' + (i + 1));
            }

            var allSelectValues = {};
            for (var i = 1; i <= 7; i++) {
                var select = document.querySelector('select[name="status' + i + '"]');
                if (select) {
                    allSelectValues['status' + i] = select.value;
                }
            }
            
            console.log('All select values:', allSelectValues);
            var tba_no = getUrlParameter('id');
            console.log('TBA number: ' + tba_no);
            
            var xhr1 = new XMLHttpRequest();
            xhr1.open('POST', 'tba/update_approvers.php', true);
            xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr1.onreadystatechange = function() {
                if (xhr1.readyState === 4 && xhr1.status === 200) {
                    console.log(xhr1.responseText);
                }
            };
        
            var payload = 'removedSelect=' + selectName + '&tba_no=' + tba_no;
            for (var key in allSelectValues) {
                payload += '&' + key + '=' + allSelectValues[key];
            }
            
            xhr1.send(payload);
        }
    });
});
</script>
<script>
    document.getElementById('addApproverButton').addEventListener('click', function() {
        var approversDiv = document.querySelector('.approversDiv');
        var totalCount = approversDiv.querySelectorAll('.approver-row').length + 1;

        var newApproverRow = document.createElement('div');
        newApproverRow.classList.add('approver-row');

        var newLabel = document.createElement('label');
        newLabel.setAttribute('for', 'status' + totalCount);
        newLabel.textContent = 'Approver ' + totalCount + ':';
        
        var newSelect = document.createElement('select');
        newSelect.setAttribute('id', 'status' + totalCount);
        newSelect.setAttribute('class', 'custom-select custom-select-sm rounded-0 select2');
        newSelect.setAttribute('acc_person', 'status' + totalCount);

        <?php
        $approver_qry = $conn->query("SELECT * FROM `users` WHERE division = 'SPVR' OR division = 'MNGR' OR position = 'EXECUTIVE ASSISTANT TO THE COO'");
        while ($row = $approver_qry->fetch_assoc()) {
            echo 'var option = document.createElement("option");';
            echo 'option.value = "' . $row['user_code'] . '";';
            echo 'option.text = "' . $row['lastname'] . ', ' . $row['firstname'] . '";';
            echo 'newSelect.appendChild(option);';
        }
        ?>
        newApproverRow.appendChild(newLabel);
        newApproverRow.appendChild(newSelect);
        approversDiv.appendChild(newApproverRow);
    });

</script>
<script>
    function handleAddApprover() {
        var inputValue = document.getElementById('inputValue');
        var addApproverButton = document.getElementById('addApproverButton');
        
        function checkLimitAndDisableButton() {
            var currentCount = parseInt(inputValue.value);
            if (currentCount >= 7) {
                addApproverButton.disabled = true; 
            }
        }

        addApproverButton.addEventListener('click', function() {
            var currentCount = parseInt(inputValue.value);
            if (currentCount < 7) {
                var newCount = currentCount + 1;
                inputValue.value = newCount;
                checkLimitAndDisableButton(); 
            } else {
                checkLimitAndDisableButton(); 
            }
        });
        checkLimitAndDisableButton();
    }
    window.addEventListener('load', handleAddApprover);
</script>
<script>
 document.addEventListener('DOMContentLoaded', function() {
        initialize();
    });

    function initialize() {
        var amountElement = document.getElementById('amount');
        amountElement.addEventListener('input', function() {
            var amount = this.value.trim();
            if (amount === '') {
                document.getElementById('amountToWords').innerText = '';
                return;
            }

            var amountInWords = convertAmountToWords(amount);
            document.getElementById('amountToWords').innerText =  amountInWords;
        });
        var initialAmount = amountElement.value.trim();
        if (initialAmount !== '') {
            var amountInWords = convertAmountToWords(initialAmount);
            document.getElementById('amountToWords').innerText = amountInWords;
        }
    }
    function convertAmountToWords(amount) {
        amount = amount.replace(/,/g, '');
        amount = parseFloat(amount).toFixed(2);
        var numArr = amount.split('.');

        var wholePart = numArr[0];
        var decimalPart = numArr[1] || '00';

        var words = convertToWords(wholePart);

        if (decimalPart != '00') {
            words += ' pesos and ' + convertToWords(decimalPart) + ' centavos ONLY';
        } else {
            words += ' pesos ONLY';
        }

        return words;
    }

    function convertToWords(number) {
        var units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        var teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        var tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        var words = '';

        if (number > 999999) {
            words += convertToWords(Math.floor(number / 1000000)) + ' Million ';
            number %= 1000000;
        }

        if (number > 999) {
            words += convertToWords(Math.floor(number / 1000)) + ' Thousand ';
            number %= 1000;
        }

        if (number > 99) {
            words += units[Math.floor(number / 100)] + ' Hundred ';
            number %= 100;
        }

        if (number > 10 && number < 20) {
            words += teens[number - 10];
        } else {
            words += tens[Math.floor(number / 10)] + ' ' + units[number % 10];
        }

        return words.trim();
    }

    document.getElementById('amount').addEventListener('input', function() {
        var amount = this.value.trim();
        if (amount === '') {
            document.getElementById('amountToWords').innerText = '';
            return;
        }

        var amountInWords = convertAmountToWords(amount);
      
        document.getElementById('amountToWords').innerText =  amountInWords;
    });
</script>
<script>
    document.getElementById('image').addEventListener('change', function() {
        var formData = new FormData(document.getElementById('picform'));

        fetch('tba/tba_attachments.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
        if (data.startsWith('Error:')) {
            alert_toast(data, 'error');
        } else if (data.startsWith('Attached na, ssob. Hihe.')) {
            alert_toast(data, 'success');
        } else {
            alert_toast("Invalid file. Huwag ipilit bhe. Hindi iyan mag-save.", 'error');
        }
    })
});

$(function(){
    $('#tba-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_tba",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: function(xhr, status, error) {
                var errorMessage = xhr.status + ': ' + xhr.statusText;
                alert_toast(errorMessage, 'error');
                console.log(errorMessage);
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    //location.reload();
                    location.replace('./?page=tba/tba_list');
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                } else {
                    var errorMessage = 'Unknown error occurred';
                    alert_toast(errorMessage, 'error');
                    console.log(errorMessage);
                }
                end_loader();
            }
        });

    });
});

</script>