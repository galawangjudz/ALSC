<?php 
require_once('../../config.php');
$account_arr = [];
$group_arr = [];
// $due_date = date('Y-m-d', strtotime('+1 week'));
$publicId = '';
$acc_id = '';
$totalCredit = 0;
$totalDebit = 0;
$v_num = 0;
$globalSupId = '';
$globalSupType = '';
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT a.*, b.*
                        FROM `cv_entries` a
                        JOIN `cv_items` b ON a.c_num = b.journal_id
                        WHERE a.c_num = '{$_GET['id']}' and b.account_id != '21002';");

    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();

        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }
        $acc_id = $account_id;
        $publicId = $_GET['id'];

        if ($publicId > 0) {
            $docNoQuery = $conn->query("SELECT doc_no FROM tbl_gl_trans WHERE cv_num = '$publicId'");
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
$is_new_cn = true;
$query = $conn->query("SELECT COUNT(DISTINCT cv_num) AS max_doc_no FROM `tbl_gl_trans` WHERE doc_type = 'CV'");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    if ($maxDocNo === null) {
        $maxDocNo = 0;
    }
    if ($publicId > 0) {
        $newDocNo = $doc_no;
    } else {
        $newDocNo = '3' . sprintf('%05d', $maxDocNo + 1);
    }
    
} else {
    echo "Error executing query: " . $conn->error;
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $existing_c_id = $_GET['id'];

    $qry = $conn->query("SELECT c_num,v_num FROM `cv_entries` WHERE c_num = $existing_c_id");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $c_number = $row['c_num'];
        $v_num =$row['v_num'];
        $is_new_cn = false;
    } else {
        $c_number = 'Selected voucher not found';
    }
    
} else {
    $qry = $conn->query("SELECT MAX(c_num) AS max_id FROM `cv_entries`");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $next_c_number = $row['max_id'] + 1;
    } else {
        $next_c_number = 1;
    }
    $c_number = str_pad($next_c_number, STR_PAD_LEFT);
}
echo $publicId;
?>

<style>
.disabled-table {
    pointer-events: none;
}
.modal {
    display: none;
}
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('cv/preview.gif') center/contain no-repeat fixed;
    background-size: 20%;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); 
    z-index: 9998; 
}
.modal-overlay img {
    width: 100%;
    height: 100%;
}
#vs-cont{
    border-radius: 5px;
    border: 1px solid #ddd;  
    padding: 20px; 
    max-width:49%;
    margin-right:1%;
    font-size:13px;
    box-sizing: border-box; 
    float: left;
    overflow: auto;
}
#cv-cont{
    border-radius: 5px;
    border: 1px solid #ddd;  
    padding: 20px; 
    max-width:49%;
    margin-left:1%;
    font-size:13px;
    box-sizing: border-box; 
    float: right;
    overflow: auto;
}
#custom-container {
    border-radius: 5px;
    border: 1px solid #ddd; 
    padding: 20px; 
    transition: margin-left 0.5s;
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
.nav-check{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}
.nav-check:hover{
    background-color:#007bff!important;
    color:white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
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
.account-row:hover {
    cursor: pointer;
    background-color: #f5f5f5;
}
.account-row:hover, .account-row.selected {
    cursor: pointer;
    background-color: #f5f5f5; 
}
#acc-table {
    width: 100%;
    table-layout: fixed;
}

.account-row:hover {
    cursor: pointer;
    background-color: #f5f5f5; 
}

.account-row.selected {
    background-color: #a9cce3; 
}
#data-table tbody tr.selected {
    background-color: gainsboro; 
}
.small-btn {
    padding-top:2px;
    padding-bottom:2px;
}
tr:hover {
    cursor: pointer;
}
/* #account_list {
    display: none;
} */
.selected-row {
    background-color: gainsboro; 
}
</style>
<head>
<script>
    function updateCounter() {
        $('#acc_list tbody tr').each(function (index) {
            $(this).find('[name="ctr"]').val(index + 1);
        });
    }
    $(document).ready(function () {
        var accTable = $('#acc-table').DataTable({
        // dom: 'lrtip', 
        lengthChange: false,
    });

    $('#cancel').on('click', function() {
        var isConfirmed = confirm('Are you sure you want to cancel creating the check voucher?');

        if (isConfirmed) {
            // window.history.back();
            location.reload();
        }
    });
    $('#btnProceed').on('click', function(event) {
        var amountValue = $('#amount').val();
        var accNameValue = $('#AccName').val();
        var checkNum = $('#check_num').val();

        if (!checkNum || checkNum.trim() === '' || !amountValue || amountValue.trim() === '' || !accNameValue || accNameValue.trim() === '' || !checkNum || checkNum.trim() === '') {
            alert('Please check empty fields before proceeding.');
            event.preventDefault(); 
            return;
        } else {
            var isConfirmed = confirm('Are you sure you want to create the check voucher?');
            if (isConfirmed) {
                event.preventDefault();
                $('#loadingModal').show();
                setTimeout(function() {
                    
                    $('#loadingModal').hide();
                    $('#account_list').show();
                    $('#btnProceed').prop('disabled', true);
                    $('#check_date').prop('readonly', true);
                    $('#check_num').prop('readonly', true);
                    $('#data-table').addClass('disabled-table');
                    $('#acc-table').addClass('disabled-table');
                    $('#amount').prop('readonly', true);
                    $('#description').prop('readonly', true);
                    $('#save_journal').prop('disabled', false);
                }, 1000);
            }
        }
    });
});
    $(document).ready(function() {
        updateTotals();
        updateCounter();
    });
    $(document).ready(function () {
        var dataTable = $('#data-table').DataTable({
        lengthChange: false,
    });
});
</script>
</head>
<body>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($_GET['id']) ? "Update Check Voucher Entry": "Add New Check Voucher Entry" ?></b></i></h5>
	</div>
    <div class="card-body">
    <form action="" id="journal-form" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="height:auto;width:auto;">
            <div class="container-fluid" id="custom-container">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <input type="hidden" id="supplier_id" name="supplier_id" value="<?php echo $supplier_id ?>">
                        <div id="item_code_display" style="display:none;"></div>
                        <input type="hidden" id="globalSupTypeInput">
                        <label for="c_num" class="control-label">Check Voucher #:</label>
                        <input type="text" id="c_num" name="c_num" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $c_number ?>" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="check_date">Check Date: <span class="po_err_msg text-danger"></span></label>
                        <?php
                        if (!empty($check_date)) {
                            $checkformattedDate = date('Y-m-d', strtotime($check_date));
                        } else {
                            $checkformattedDate = '';
                        }
                        ?>     
                        <input type="date" class="form-control form-control-sm rounded-0" id="check_date" name="check_date" value="<?php echo isset($checkformattedDate) ? $checkformattedDate : '' ?>" readonly required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label class="control-label">Document #:</label>
                        <input type="text" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $newDocNo; ?>" readonly>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="check_num" class="control-label">Check #:</label>
                        <input type="text" id="check_num" name="check_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($check_num) ? $check_num : "" ?>" required>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="tran_date">Transaction Date: <span class="po_err_msg text-danger"></span></label>
                        <input type="date" class="form-control form-control-sm rounded-0" id="cv_date" name="cv_date" value="<?php echo isset($tranDate) ? $tranDate : date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="v_num" class="control-label">Voucher Setup #:</label>
                        <input type="text" class="form-control form-control-sm form-control-border rounded-0" name="v_num" id="v_num" value="<?php echo ($v_num == 0) ? '' : $v_num; ?>" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="po_no">P.O. #: </label>
                        <input type="text" class="form-control form-control-sm form-control-border rounded-0" name="po_no" id="po_no" value="<?php echo isset($po_no) ? $po_no : '' ?>" readonly>
                    </div>
                </div>
            </div>
            <br>
            <div class="container-fluid">
                <div class="row">                
                    <div class="col-md-6" id="vs-cont">
                        <table class="table table-bordered" id="data-table" style="text-align:center;width:100%;">
                            <colgroup>
                                <col width="7%">
                                <col width="10%">
                                <col width="13%">
                                <col width="50%">
                                <col width="10%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr class="bg-navy disabled">
                                    <th>#</th>
                                    <th>VS No.</th>
                                    <th>Code</th>
                                    <th>Supplier Name</th>
                                    <th>Amount</th>
                                    <th>Outstanding Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                $selectedVNum = isset($v_num) ? $v_num : null;
                                $idParameter = isset($_GET['id']) ? $_GET['id'] : null; 

                                $qry = $conn->query("SELECT DISTINCT 
                                ac.*,
                                vs.v_num,
                                vs.po_no,
                                vs.due_date,
                                vi.amount,
                                COALESCE(s.id, pc.client_id, ta.c_code, u.user_code) AS supId,
                                COALESCE(s.short_name, CONCAT(pc.last_name, ', ', pc.first_name, ' ', pc.middle_name), 
                                        CONCAT(ta.c_last_name, ', ', ta.c_first_name, ' ', ta.c_middle_initial),
                                        CONCAT(u.lastname, ', ', u.firstname)) AS supplier_name,
                                vs.due_date,
                                vi.amount
                            FROM `vs_entries` vs
                            JOIN `vs_items` vi ON vs.v_num = vi.journal_id
                            LEFT JOIN supplier_list s ON vs.supplier_id = s.id
                            LEFT JOIN property_clients pc ON vs.supplier_id = pc.client_id
                            LEFT JOIN t_agents ta ON vs.supplier_id = ta.c_code
                            LEFT JOIN users u ON vs.supplier_id = u.user_code
                            JOIN account_list ac ON vi.account_id = ac.code
                            WHERE ac.name='Accounts Payable Trade'
                            ORDER BY vs.`date_updated` DESC;
                            ");
                                while ($row = $qry->fetch_assoc()) {
                                    $selectedClass = ($row['v_num'] == $selectedVNum) ? 'selected-row' : '';
                                ?>
                                    <tr data-v-num="<?php echo $row['v_num']; ?>" data-v-amt="<?php echo $row['amount']; ?>" class="<?php echo $selectedClass; ?>" onclick="selectRow('<?php echo $row['v_num']; ?>', '<?php echo $row['po_no']; ?>', '<?php echo $row['due_date']; ?>', '<?php echo $row['amount']; ?>','<?php echo $row['supId']; ?>','<?php echo $row['supplier_name']; ?>')" onclick=" checkInputLength()">
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo ($row['v_num'] == 0) ? '-' : $row['v_num']; ?></td>
                                        <td><?php echo ($row['supId']) ?></td>
                                        <td><?php echo ($row['supplier_name']) ?></td>
                                        <td><?php echo preg_replace('/\.0+$/', '', number_format((abs($row['amount'])), 2)) ?></td>
                                        <td><?php echo ($row['due_date']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" id="cv-cont">
                        <div id="table-container">
                            <table class="table table-bordered" id="acc-table">
                                <colgroup>
                                    <col width="20%">
                                    <col width="70%">
                                    <col width="10%" style="display:none;">
                                </colgroup>
                                <thead>
                                    <tr class="bg-navy disabled">
                                        <th>Account Code</th>
                                        <th>Name</th>
                                        <th style="display:none;">Group Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qry = $conn->query("SELECT * from `account_list`");
                                    $selected_account_id = isset($acc_id) ? $acc_id : null; ?>
                                    <?php
                                    while($row = $qry->fetch_assoc()):
                                        $isSelected = ($selected_account_id != '' && $row['code'] == $selected_account_id) ? 'selected-row' : '';
                                    ?>
                                        <tr class="account-row <?php echo $isSelected; ?>" onclick="calculateVAT()">
                                            <td><?php echo $row['code']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td style="display:none;"><?php echo $row['group_id']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <script>
                                $('.account-row').on('click', function() {
                                    $('.account-row').removeClass('selected');
                                    $(this).addClass('selected');

                                    var vatCode = $('#vatCode').val();
                                    var vatName = $('#vatName').val();
                                    var vatAmt = $('#vat_amount').val();

                                    var apCode = $('#apCode').val();
                                    var apName = $('#apName').val();
                                    var apAmt = $('#amount').val();

                                    var divCode = $('#divCode').val();
                                    var divName = $('#divName').val();
                                    var divAmt = $('#div_amount').val();

                                    var accCode = $(this).find('td:eq(0)').text();
                                    var accName = $(this).find('td:eq(1)').text();


                                    $('#AccCode').val(accCode);
                                    $('#AccName').val(accName);
                                    var vsAmt = $('#amount').val();

                                    var globalSupType = '<?php echo $globalSupType; ?>';
                                });
                           
                        </script>
                    </div>
                </div>
                </div>
                <br>
                <div class="container-fluid" id="custom-container">
                <div class="row">
                    <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Check Name:</label>
                            <input type="text" id="supplier_name" name="check_name" class="form-control" value="<?php echo isset($check_name) ? $check_name : '' ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">Account Code:</label>
                            <?php
                                $sql = "SELECT code,name FROM account_list WHERE code = '$acc_id'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $code = $row['code'];
                                    $name = $row['name'];
                                } else {
                                    $code = '';
                                }
                            ?>
                            <input type="text" id="AccCode" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo isset($code) ? $code : '' ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">Account Name:</label>
                            <input type="text" id="AccName" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo isset($name) ? $name : '' ?>" readonly><br>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">Amount:</label>
                            <input type="text" id="amount" name="amount" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo isset($amount) ? $amount : '' ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <?php
                                $sql = "SELECT code,name FROM account_list WHERE name = 'Accounts Payable Trade'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $code = $row['code'];
                                    $name = $row['name'];
                                } else {
                                    $code = '';
                                }
                            ?>
                            <input type="text" id="apCode" class="form-control" value="<?php echo isset($code) ? $code : '' ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" id="apName" class="form-control" value="<?php echo isset($name) ? $name : '' ?>" readonly><br>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" id="apamount" name="apamount" class="form-control" value="<?php echo isset($amount) ? $amount : '' ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <?php
                                $sql = "SELECT code,name,group_id FROM account_list WHERE name = 'Input VAT'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $code = $row['code'];
                                    $name = $row['name'];
                                } else {
                                    $code = '';
                                }
                            ?>
                            <input type="text" id="vatCode" class="form-control" value="<?php echo isset($code) ? $code : '' ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" id="vatName" class="form-control" value="<?php echo isset($name) ? $name : '' ?>" readonly><br>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" id="vat_amount" name="vat_amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <?php
                                $sql = "SELECT code,name,group_id FROM account_list WHERE name = 'Deferred Input VAT'";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $code = $row['code'];
                                    $name = $row['name'];
                                } else {
                                    $code = '';
                                }
                            ?>
                            <input type="text" id="divCode" class="form-control" value="<?php echo isset($code) ? $code : '' ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" id="divName" class="form-control" value="<?php echo isset($name) ? $name : '' ?>" readonly><br>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" id="div_amount" name="div_amount" class="form-control">
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
                    <!-- <button id="btnProceed" class="btn btn-flat btn-sm btn-secondary"><i class="fas fa-money-check-alt"></i> Create Check Voucher</button> -->
                    <button type="button" id="addRowBtn" class="btn btn-flat btn-sm btn-secondary"><i class="fas fa-money-check-alt"></i> Create Check Voucher</button>


                    <div id="loadingModal" class="modal">
                        <div class="modal-overlay"></div>
                        <div class="overlay"></div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="container-fluid">
                    <input type="text" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <input type="text" id="c_num" name="c_num" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $c_number ?>" readonly>
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
                            if (isset($_GET['id'])):
                                
                                $jitems = $conn->query("
                                SELECT gl.account, gl.amount, gl.doc_no, gl.gtype, a.name 
                                FROM tbl_gl_trans gl
                                LEFT JOIN account_list a ON gl.account = a.code
                                WHERE gl.cv_num = '$publicId' AND gl.doc_type = 'CV'
                                ORDER BY (a.name = 'Accounts Payable Trade') DESC, (gl.gtype = 1) DESC, gl.gtype;
                            ");

                                $counter = 1;
                                while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr class="check-item" data-id="accname">
                                <td class="align-middle p-1 text-center">
                                    <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                </td>
                                <td class="align-middle p-0 text-center">
                                    <input type="number" class="text-center w-100 border-0" step="any" name="ctr" style="background-color:transparent;" readonly required/>
                                </td>
                                <td class="align-middle p-1">
                                    <input type="text" class="text-center w-100 border-0" name="account_id[]" value="<?= $row['account'] ?>" readonly>
                                    <input type="text" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_num) ? $v_num : "" ?>">
                                    <input type="text" name="doc_no[]" value="<?= $row['doc_no'] ?>" readonly>
                                    <input type="text" name="amount[]" value="<?= $row['amount'] ?>">
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
                                <td class="debit_amount text-right" name="debit"><input type="text" class="text-right w-100 border-0 debit" name="debit[]" value="<?= $row['gtype'] == 1 ? number_format(($row['amount']), 2) : '' ?>"></td>
                                <td class="credit_amount text-right" name="credit"><input type="text" class="text-right w-100 border-0 credit" name="credit[]" value="<?= $row['gtype'] == 2 ? number_format(abs($row['amount']), 2) : '' ?>"></td>
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
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Your data has been saved successfully!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button type="button" class="btn btn-secondary" id="printButton">Print</button>
            </div>
        </div>
    </div>
</div>
<table class="d-none" id="item-clone">
	<tr class="check-item" data-id="accname">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="ctr" style="background-color:transparent;" readonly required/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="account_id[]" readonly>
			<input type="text" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
            <input type="text" name="doc_no[]" value="<?php echo $newDocNo ?>" readonly>
            <input type="text" name="amount[]" value="">
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
    $("#addRowBtn").on('click', function(event) {
        var amountValue = $('#amount').val();
        var accNameValue = $('#AccName').val();
        var checkNum = $('#check_num').val();
        var globalSupTypeInputValue = $("#globalSupTypeInput").val();

        if (!checkNum || checkNum.trim() === '' || !amountValue || amountValue.trim() === '' || !accNameValue || accNameValue.trim() === '' || !checkNum || checkNum.trim() === '') {
            alert_toast(' Please check empty fields before proceeding.', 'warning');
            event.preventDefault(); 
            return;
        } else {
            // var isConfirmed = confirm('Are you sure you want to create the check voucher?');
            // if (isConfirmed) {
            //     event.preventDefault();
            // $('#loadingModal').show();
            // setTimeout(function() {
                // $('#loadingModal').hide();
                // $('#account_list').show();
                // $('#btnProceed').prop('disabled', true);
                // $('#check_date').prop('readonly', true);
                // $('#check_num').prop('readonly', true);
                // $('#data-table').addClass('disabled-table');
                // $('#acc-table').addClass('disabled-table');
                // $('#amount').prop('readonly', true);
                // $('#description').prop('readonly', true);
                // $('#save_journal').prop('disabled', false);

                console.log("Button Clicked");
                clearTable();
                var globalSupTypeInputValue = $("#globalSupTypeInput").val();

                addRow($('#apCode').val(), $('#amount').val(), 1);
                if (globalSupTypeInputValue === '1') {
                    addRow($('#vatCode').val(), $('#vat_amount').val(), 1);
                }
                addRow($('#AccCode').val(), $('#amount').val(), 2);
                if (globalSupTypeInputValue === '1') {
                    addRow($('#divCode').val(), $('#div_amount').val(), 2);
                }
                updateCounter();
                updateTotals();
                // }, 1000);
            //}
        }
    });
    function clearTable() {
        $('#acc_list tbody').empty();
    }
    function addRow(accountCode, amount, groupID) {
        var newRow = $("#item-clone tr.check-item").clone();
        newRow.find("input[name='account_id[]']").val(accountCode);

        var selectedOption = newRow.find("select#account_id option").filter(function() {
            return $.trim($(this).data('code')).toLowerCase() === $.trim(accountCode).toLowerCase();
        });
        selectedOption.prop('selected', true);

        newRow.find("input#vs_num").val(groupID);

        newRow.find("input[name='credit[]']").val(amount.replace(/\B(?=(\d{3})+(?!\d))/g, ','));

        var amountWithoutCommas = amount.replace(/,/g, '');
        var amountAsNumber = parseFloat(amountWithoutCommas);

        if (!isNaN(amountAsNumber)) {
            if (groupID === 1) {
                newRow.find("input[name='debit[]']").val(amount.replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                newRow.find("input[name='credit[]']").val('');
                newRow.find("input[name='amount[]']").val(amountAsNumber);
            } else if (groupID === 2) {
                newRow.find("input[name='debit[]']").val('');
                newRow.find("input[name='credit[]']").val(Math.abs(amountAsNumber).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                newRow.find("input[name='amount[]']").val(-amountAsNumber);
            } else {
                newRow.find("input[name='debit[]']").val('');
                newRow.find("input[name='credit[]']").val('');
                newRow.find("input[name='amount[]']").val('');
            }
        } else {
            console.log("Invalid number");
        }
            $("#acc_list").append(newRow);
            newRow.find("input[type='number']").val('');
        }
    });

</script>
<script>
$(document).ready(function () {
    $(document).on('change', '.check-item select', function () {
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

    $('.check-item').each(function () {
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
    var selectedAccountIds = $('.check-item select').map(function () {
        return $(this).val();
    }).get();

    $('.check-item select').each(function () {
        var currentSelect = $(this);
        var currentSelectedValue = currentSelect.val();

        currentSelect.find('option').each(function () {
            var optionValue = $(this).val();
            if (selectedAccountIds.includes(optionValue) && optionValue !== currentSelectedValue) {
                $(this).attr('data-select2-id', null); 
                $(this).prop('disabled', true); 
            } else {
                $(this).prop('disabled', false);
            }
        });
        currentSelect.select2(); 
    });
}

function updateAccCode(_this) {
    var selectedOption = _this.find('option:selected');
    var accCodeTextbox = _this.closest('.check-item').find('[name="account_id[]"]');
    accCodeTextbox.val(selectedOption.data('code'));
}
</script>
<script>
function checkInputLength() {
    var supplierIdInput = document.getElementById('supplier_id');
    var supplierIdValue = supplierIdInput.value;

    if (supplierIdValue.length < 4) {
        console.log('Length is less than 4. Proceed with the query.');

        $.ajax({
            type: 'POST',
            url: 'cv/check_item_type.php',
            data: {
                action: 'checkItemType',
                supplierId: supplierIdValue
            },
            success: function (result) {
                console.log('Received result:', result);

                try {
                    var data = JSON.parse(result);
                   
                    if (data.length > 0) {
                        <?php $globalSupType = 1; ?>
                        document.getElementById('globalSupTypeInput').value = '<?php echo $globalSupType; ?>';
                    } else{
                        <?php $globalSupType = 0; ?>
                        document.getElementById('globalSupTypeInput').value = '<?php echo $globalSupType; ?>';
                    }
                    
                } catch (error) {
                    console.error('Error parsing result:', error);
                }
            }
        });
    } else {
        console.log('Length is 4 or more.');
        document.getElementById('globalSupTypeInput').value = '0';
    }
}
</script>
<script>
function calculateVAT() {
    var amountInput = document.getElementById('amount');
    var amount = parseFloat(amountInput.value.replace(/,/g, '')) || 0;
    var vatAmount = amount * 0.12;
    document.getElementById('vat_amount').value = vatAmount.toFixed(2);
    calculateDIV();
}

function calculateDIV() {
    var amountInput = document.getElementById('amount');
    var amount = parseFloat(amountInput.value.replace(/,/g, '')) || 0;
    var divAmount = amount * 0.12;
    document.getElementById('div_amount').value = divAmount.toFixed(2);
}

</script>
<script>
$(document).ready(function () {
    var cNumber = <?php echo json_encode($c_number); ?>;
    $('#printButton').on('click', function () {
        // console.log("Print button clicked"); 
        // alert("Print " + cNumber);

        window.location.href = "/ALSC/report/print_check_voucher.php?id=<?php echo htmlspecialchars($c_number); ?>";
    });
});
</script>
<script>
$(document).ready(function() {
    var id = <?php echo json_encode($id); ?>;
    
    if (id !== '') {
        disableElements();
    }

    function disableElements() {
        $('#btnProceed').prop('disabled', true);
        $('#data-table').addClass('disabled-table');
        $('#acc-table').addClass('disabled-table');
        $('#account_list').addClass('disabled-table');
        $('#amount').prop('readonly', true);
    }
});

</script>
<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$c_num = isset($c_num) ? $c_num : '';
?>
<script>
    var id = <?php echo json_encode($id); ?>;
    console.log(id);

    var c_num = <?php echo json_encode($c_num); ?>;
    console.log(c_num);

    if (id !== '' && id === c_num) {
        var table = document.getElementById('account_list');
        table.style.display = 'block';
    }

    function selectRow(selectedVNum, poNo, checkDate, Amt, supId, supName) {
    
    $('#data-table tbody tr').removeClass('selected');

   
    $('#data-table tbody tr[data-v-num="' + selectedVNum + '"][data-v-amt="' + Amt + '"]').addClass('selected');

  
    $('#v_num').val(selectedVNum);
    $('#po_no').val(poNo);
    $('#check_date').val(checkDate);
    $('#amount').val(Number(Math.abs(Amt)).toFixed(2).replace(/\.?0*$/, '').replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#apamount').val(Number(Math.abs(Amt)).toFixed(2).replace(/\.?0*$/, '').replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#supplier_id').val(supId);
    $('#supplier_name').val(supName);
    $('#AccName').val('');
    $('#AccCode').val('');

   
    $('#acc-table tbody tr').removeClass('selected-row');

    $('#acc-table tbody tr').each(function() {
        var rowAmount = parseFloat($(this).find('td:nth-child(1)').text()); 

        // if (Math.abs(rowAmount) === Math.abs(Amt)) {
        //     $(this).addClass('selected-row');
        // }
    });

    $.ajax({
        type: 'POST',
        url: 'cv/get_account_details.php',
        data: {
            v_num: selectedVNum
        },
        success: function (vsItems) {
            console.log("Received vsItems:", vsItems);
            try {
                vsItems = JSON.parse(vsItems);
            } catch (error) {
                console.error('Error parsing vsItems:', error);
            }
        }
    });
    checkInputLength();
}


</script>
<script>
$('#journal-form').submit(function (e) {
    e.preventDefault();
    var _this = $(this);
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
        alert_toast(" Hindi balance. :((", 'warning');
        return false;
    }

    if ($('.total_debit').text() == '0' && $('.total_credit').text() == '0') {
        console.log($('#acc_list tfoot .total-balance').text());
        alert_toast(" Account table is empty.", 'warning');
        return false;
    }

    function hasAPT() {
        var hasAPT = false;

        $('tr.check-item').each(function () {
            var accountValue = $(this).find('input[name="account_id[]"]').val().trim();

            if (accountValue === '21002') {
                hasAPT = true;
                return false; // Break the loop since we found the account
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
        urlSuffix = "modify_cv";
    <?php } else{ ?>
        urlSuffix = "manage_cv";
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
                $('#successModal .modal-body p').text('Your data has been saved successfully!');
                $('#successModal').modal('show');
                location.replace('./?page=cv')
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
});
</script>



