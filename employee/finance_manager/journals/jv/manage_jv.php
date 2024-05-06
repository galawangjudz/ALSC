<?php 
require_once('../../config.php');
$userid = $_settings->userdata('user_code');
$totalCredit = 0;
$totalDebit = 0;
$publicId = '';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `jv_entries` WHERE jv_num = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        $publicId = $_GET['id'];

        if ($publicId > 0) {
            $docNoQuery = $conn->query("SELECT doc_no FROM tbl_gl_trans WHERE jv_num = '$publicId' and doc_type='JV'");
            if ($docNoQuery) {
                $docNoRow = $docNoQuery->fetch_assoc();
                $docNo = $docNoRow['doc_no'];
                $doc_no = $docNo;
            } 
        }
    }
}

$is_new_vn = true;

$query = $conn->query("SELECT COUNT(DISTINCT jv_num) AS max_doc_no FROM `tbl_gl_trans` WHERE doc_type='JV'");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    if ($maxDocNo === null) {
        $maxDocNo = 0;
    }
    if ($publicId > 0) {
        $newDocNo = $doc_no;
    } else {
        $newDocNo = '4' . sprintf('%05d', $maxDocNo + 1);
    }
} else {
    echo "Error executing query: " . $conn->error;
}

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $existing_v_id = $_GET['id'];

    $qry = $conn->query("SELECT jv_num FROM `jv_entries` WHERE jv_num = $existing_v_id");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $jv_number = $row['jv_num'];
        $is_new_vn = false;
    } else {
        $jv_number = 'Selected voucher not found';
    }
} else {
    $qry = $conn->query("SELECT MAX(jv_num) AS max_id FROM `jv_entries`");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $next_jv_number = $row['max_id'] + 1;
    } else {
        $next_jv_number = 1;
    }
    $jv_number = str_pad($next_jv_number, STR_PAD_LEFT);
}
?>

<!DOCTYPE html>
<html lang="en">
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
        .nav-jv{
            background-color:#007bff;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        }
        .nav-jv:hover{
            background-color:#007bff!important;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
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
        .custom-modal-width {
            max-width: 60%; 
        }
        .custom-modal-width .modal-header .close {
            display: none;
        }
        #uni_modal .modal-footer{
            display: none;
        }
    </style>
    <script>
    $(document).ready(function() {
        updateTotals();
    });
    </script>
        <script src="../../libs/js/lightbox.min.js"></script>
        <link rel="stylesheet" href="../../libs/js/jquery.fancybox.min.css"/>
    <script src="../../libs/js/jquery.fancybox.min.js"></script>
</head>
<body>
<div class="card card-outline card-primary">
    <div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($_GET['id']) ? "Update Journal Voucher Entry": "Add New Journal Voucher Entry" ?></b></i></h5>
	</div>
    <div class="card-body">
        <label class="control-label" style="float:left;">Add Attachment:</label><div class="asterisk" style="color:red;font-weight:bold;float:left;margin-left:10px;font-size:20px;"> *</div>
        <div id="picform-container">
            <form action="" method="post" enctype="multipart/form-data" id="picform">
                <table class="table table-bordered">
                    <input type="hidden" class="control-label" name="newDocNo" id="newDocNo" value="<?php echo $newDocNo; ?>" readonly>
                    <input type="hidden" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($jv_number) ? $jv_number : "" ?>" readonly>
                    <tr>
                        <td>
                        <!-- <label for="image" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i> Custom Upload
                        </label>
                        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" style="display:none;"> -->
                        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" value="">
                        </td>
                        <td style="display:none;">
                            <input type="text" name="imageName" id="imageName" class="form-control form-control-sm form-control-border rounded-0" readonly>
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
                    <td><?php $timestamp = strtotime($row["date_attached"]);
                        $formattedDate = date('F j, Y g:i:sA', $timestamp);
                        echo $formattedDate; ?>
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
                <form action="" id="journal-form">
                    <input type="hidden" name="id" value="<?= isset($_GET['id']) ? ($_GET['id']) :'' ?>">
                    <input type="hidden" id="publicId" value="<?php echo $publicId; ?>">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="jv_num" class="control-label">Journal Voucher #:</label>
                            <input type="text" id="jv_num" name="jv_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($jv_number) ? $jv_number : "" ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">Document #:</label>
                            <input type="text" id="newDocNo" name="newDocNo" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $newDocNo; ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">Reference #:</label>
                            <input type="text" id="ref_no" name="ref_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($ref_no) ? $ref_no : "" ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="transaction_date" class="control-label">Transaction Date:</label>
                            <input type="date" id="transaction_date" name="transaction_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($transaction_date) ? $transaction_date : "" ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="posting_date" class="control-label">Posting Date:</label>
                            <input type="date" id="posting_date" name="posting_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($posting_date) ? $posting_date : date("Y-m-d") ?>" required readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($name) ? $name : "" ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
					<table class="table table-striped table-bordered" id="acc_list">
					<colgroup>
                            <col width="5%">
                            <!-- <col width="10%"> -->
                            <col width="25%">
                            <col width="40%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
						<thead>
							<tr class="bg-navy disabled">
								<th class="px-1 py-1 text-center"></th>
								<!-- <th class="px-1 py-1 text-center">Item #</th> -->
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
                                $jitems = $conn->query("SELECT gl.c_status, gl.account,gl.amount, gl.doc_no, gl.gtype, a.name 
                                FROM tbl_gl_trans gl LEFT JOIN account_list a ON
                                gl.account = a.code
                                WHERE gl.jv_num = '{$journalId}' and gl.doc_type = 'JV'
                                ORDER BY (gl.gtype = 1) DESC, gl.gtype;
                                ");
                                $counter = 1;
                                while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr class="po-item" data-id="accname">
                                <td class="align-middle p-1 text-center">
                                    <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                </td>
                                <td class="align-middle p-0 text-center" style="display:none;">
                                    <input type="number" class="text-center w-100 border-0" step="any" name="ctr" value="<?= $counter ?>" readonly required/>
                                </td>
                                <td class="align-middle p-1">
                                    <input type="text" class="text-center w-100 border-0" name="account_id[]" value="<?= $row['account'] ?>" readonly>
                                    <input type="hidden" id="jv_num" name="jv_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($jv_number) ? $jv_number : "" ?>">
                                    <input type="hidden" name="doc_no[]" value="<?= $row['doc_no'] ?>" readonly>
                                    <input type="hidden" name="amount[]" value="<?= $row['amount'] ?>">
                                    <input type="hidden" name="c_status" value="<?= $row['c_status'] ?>">
                                </td>
                                <td class="align-middle p-1">
                                <select id="account_id" class="form-control form-control-sm form-control-border select2" required>
                                <option value="" disabled selected></option>
                                <?php 
                                $selectedAccountIds = array();
                                $accountsResult = $conn->query("SELECT a.*, g.name AS gname FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                                $currentGroup = null;
                                $groupedAccounts = array();

                                while ($accountRow = $accountsResult->fetch_assoc()):
                                    $account_arr[$accountRow['id']] = $accountRow;

                                    if ($accountRow['gname'] != $currentGroup) {
                                        
                                        if ($currentGroup !== null) {
                                            echo '</optgroup>';

                                            foreach ($groupedAccounts[$currentGroup] as $account) {
                                                $selected = ($account['code'] == $row['account']) ? 'selected' : '';
                                                echo '<option value="' . $account['id'] . '" data-group-id="' . $account['group_id'] . '" data-code="' . $account['code'] . '" ' . $selected . '>' . $account['name'] . '</option>';
                                            }

                                            $groupedAccounts[$currentGroup] = array();
                                        }

                                        echo '<optgroup label="' . $accountRow['gname'] . '">';
                                        $currentGroup = $accountRow['gname'];
                                    }
                                    $selected = '';
                                    $groupedAccounts[$currentGroup][] = $accountRow;
                                    if (in_array($accountRow['id'], $selectedAccountIds)) {
                                        $selected = 'disabled'; 
                                    }
                                endwhile;

                                if ($currentGroup !== null) {
                                    echo '</optgroup>';

                                    foreach ($groupedAccounts[$currentGroup] as $account) {
                                        $selected = ($account['id'] == $row['account_id']) ? 'selected' : '';
                                        echo '<option value="' . $account['id'] . '" data-group-id="' . $account['group_id'] . '" data-code="' . $account['code'] . '" ' . $selected . '>' . $account['name'] . '</option>';
                                    }
                                }
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
									<th class="p-1 text-right" colspan="2"><span>
									
                                    <th colspan="1" class="text-right"><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>TOTAL</th>
                                    <th class="text-right total_debit"></th>
                                    <th class="text-right total_credit"></th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center"></th>
                                    <th colspan="2" class="text-center total-balance"></th>
                                </tr>
                            </tr>
                        </tfoot>
					</table>
                </form>
            </div>
        </div>
	</div>
	<div class="card-footer">
		<table style="width:100%;">
			<tr>
				<td>
					<button class="btn btn-flat btn-default bg-maroon" form="journal-form" style="width:100%;margin-right:5px;font-size:14px;" id="save_journal"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
				</td>
				<td>
					<a class="btn btn-flat btn-default" href="?page=journals/jv" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
				</td>
			</tr>
		</table>
	</div>
</div>
<table class="d-none" id="item-clone">
	<tr class="po-item" data-id="accname">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center" style="display:none;">
			<input type="number" class="text-center w-100 border-0" step="any" name="ctr" required/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="account_id[]" readonly>
			<input type="hidden" id="jv_num" name="jv_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($jv_number) ? $jv_number : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo ?>" readonly>
            <input type="hidden" name="amount[]" value="">
            <input type="hidden" name="c_status" value="0">
		</td>
		<td class="align-middle p-1">
		<select id="account_id" class="form-control form-control-sm form-control-border select2" required>
            <option value="" disabled selected></option>
            <?php 
            $selectedAccountIds = array();
            $accounts = $conn->query("SELECT a.*, g.name AS gname FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
            $currentGroup = null;
            $groupedAccounts = array();

            while ($row = $accounts->fetch_assoc()):
                $account_arr[$row['id']] = $row;

                if ($row['gname'] != $currentGroup) {
                    
                    if ($currentGroup !== null) {
                        echo '</optgroup>';

                        foreach ($groupedAccounts[$currentGroup] as $account) {
                            echo '<option value="' . $account['id'] . '" data-group-id="' . $account['group_id'] . '" data-code="' . $account['code'] . '">' . $account['name'] . '</option>';
                        }

                        $groupedAccounts[$currentGroup] = array();
                    }

                    echo '<optgroup label="' . $row['gname'] . '">';
                    $currentGroup = $row['gname'];
                }
                $selected = '';
                $groupedAccounts[$currentGroup][] = $row;
                if (in_array($row['id'], $selectedAccountIds)) {
                    $selected = 'disabled'; 
                }
            endwhile;

            if ($currentGroup !== null) {
                echo '</optgroup>';

                foreach ($groupedAccounts[$currentGroup] as $account) {
                    echo '<option value="' . $account['id'] . '" data-group-id="' . $account['group_id'] . '" data-code="' . $account['code'] . '">' . $account['name'] . '</option>';
                }
            }
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
document.getElementById('image').addEventListener('change', function() {
    var formData = new FormData(document.getElementById('picform'));

    fetch('journals/jv_attachments.php', {
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
        var debitValue = parseFloat($(this).find('.debit').val().replace(',', '')) || 0;
        var creditValue = parseFloat($(this).find('.credit').val().replace(',', '')) || 0;

        totalDebit += debitValue;
        totalCredit += creditValue;
    });

    $('.total_debit').text(totalDebit.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 }));
    $('.total_credit').text(totalCredit.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 }));

    var balance = totalDebit - totalCredit;

    $('.total-balance').text(balance.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 }));
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
    //updateHiddenOptions();
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
    var accCodeTextbox = _this.closest('.po-item').find('[name="account_id[]"]');
    accCodeTextbox.val(selectedOption.data('code'));
}

$(document).ready(function () {
    var clone = $("#item-clone").find(".po-item").clone();
    $("#item-clone").append(clone);

    $(document).on('change', '.po-item select', function () {
        //updateHiddenOptions();
        updateAccCode($(this));
    });

    $('#add_row').on('click', function () {
        var newRow = $('#item-clone tr').first().clone();
        var rowCount = $('#acc_list tbody tr').length + 1;
        newRow.find('[name="ctr"]').val(rowCount);
        $('#acc_list tbody').append(newRow);
        initializeRowEvents(newRow);
        //updateHiddenOptions();
    });

    function updateCounter() {
        $('#acc_list tbody tr').each(function (index) {
            $(this).find('[name="ctr"]').val(index + 1);
        });
    }

});

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

    // function hasAPT() {
    //     var hasAPT = false;

    //     $('#acc_list .po-item input[name="account_id[]"]').each(function () {
    //         var accountValue = $(this).val().trim();

    //         if (accountValue === '21002') {
    //             hasAPT = true;
    //             return false; 
    //         }
    //     });

    //     return hasAPT;
    // }

    // if (!hasAPT()) {
    //     alert_toast(" Accounts Payable Trade is missing!", 'warning');
    //     return false;
    // }

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
            urlSuffix = "modify_jv";
        <?php } else{ ?>
            urlSuffix = "save_jv";
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
                location.replace('./?page=journals/jv')
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
