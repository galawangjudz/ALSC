<?php 
require_once('../../config.php');
$userid = $_settings->userdata('user_code');
$account_arr = [];
$group_arr = [];
$adjustedTotalDebit=0;
$wtTotal=0;
$totalCredit = 0;
$totalDebit = 0;
$due_date = date('Y-m-d', strtotime('+1 week'));
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `vs_entries` where v_num = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
$is_new_vn = true;

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
<?php
function format_num($number){
	$decimals = 0;
	$num_ex = explode('.',$number);
	$decimals = isset($num_ex[1]) ? strlen($num_ex[1]) : 0 ;
	return number_format($number,$decimals);
}
?>
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
    /* #sup-div{
        display:none;
    }
    #agent-div{
        display:none;
    }
    #emp-div{
        display:none;
    } */
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
</style>
<head>
    <?php                                 
    echo '<script>';
    echo 'var totalCredit = ' . json_encode($totalCredit) . ';';
    echo '</script>'; 
?>
<script>
function updateAmount(input) {
    var inputValue = parseFloat($(input).val()) || 0;
    var amountTextbox = $(input).closest('tr').find('.amount-textbox');
    $(amountTextbox).val(inputValue);

    var table = $(input).closest('table');

    var totalDebit = 0;
    var totalCredit = 0;

    table.find('.debit-amount-input').each(function () {
        var value = parseFloat($(this).val()) || 0;
        totalDebit += value;
    });

    table.find('.credit-amount-input').each(function () {
        var value = parseFloat($(this).val()) || 0;
        totalCredit += value;
    });

    table.find('.total_debit').text(totalDebit.toFixed(2));
    table.find('.total_credit').text(totalCredit.toFixed(2));

    var balance = totalDebit - totalCredit;
    table.find('.total-balance').text(balance.toFixed(2));
}

$(document).ready(function() {
    function handleAccountSelectChange() {
        var selectedOption = $(this).find(':selected');
        var type = selectedOption.data('type');

        var $row = $(this).closest('tr'); 
        var $debitInput = $row.find('.debit-amount-input');
        var $creditInput = $row.find('.credit-amount-input');

        if (type == 1) {
            $creditInput.prop('disabled', true);
            $debitInput.prop('disabled', false);
        } else if (type == 2) {
            $creditInput.prop('disabled', false);
            $debitInput.prop('disabled', true);
        }
    }

    $(document).on('change', '.accountSelect', handleAccountSelectChange);

    $('.accountSelect').each(function () {
        handleAccountSelectChange.call(this);
    });

});
</script>
</head>

<body onload="cal_tb()">
<div class="card card-outline card-primary">
    <div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Voucher Setup Entry": "Add New Voucher Setup Entry" ?></b></i></h5>
	</div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <form action="" id="journal-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="v_num" class="control-label">Voucher Setup #:</label>
                            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="po_no">P.O. #: </label>
                            <select name="po_no" id="po_no" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                                <option value="" disabled <?php echo !isset($po_no) ? "selected" : '' ?>></option>
                                <?php 
                                $po_qry = $conn->query("SELECT * FROM `po_list` WHERE status = 1 ORDER BY `po_no` ASC");
                                while ($row = $po_qry->fetch_assoc()):
                                ?>
                                <option 
                                    value="<?php echo $row['id'] ?>" 
                                    <?php echo isset($po_no) && $po_no == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                                ><?php echo $row['po_no'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="journal_date" class="control-label">Date:</label>
                            <input type="date" id="journal_date" name="journal_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($journal_date) ? $journal_date : date("Y-m-d") ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="due_date" class="control-label">Due Date:</label>
                            <input type="date" id="due_date" name="due_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($due_date) ? $due_date : date("Y-m-d") ?>" required>
                        </div>
                    </div>

                    <div class="paid_to_main">
                        <div class="paid_to">
                            <label class="control-label">Paid To:</label>
                            <hr>
                            <div class="container" id="sup-div">
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:50%; padding-right: 10px;">
                                            <label for="supplier_id">Supplier:</label>
                                            <select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                                                <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                                <?php 
                                                $supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
                                                while ($row = $supplier_qry->fetch_assoc()):
                                                    $vatable = $row['vatable'];
                                                ?>
                                                <option 
                                                    value="<?php echo $row['id'] ?>" 
                                                    data-supplier-code="<?php echo $row['id'] ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                                                ><?php echo $row['name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td style="width:50%; padding-left: 10px;"> 
                                            <label for="sup_code" class="control-label">Supplier Code:</label>
                                            <input type="text" id="sup_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <br>
                            <div class="gr-container"></div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-md-4">
                            <label for="account_id" class="control-label">Account Name:</label>
                            <select id="account_id" class="form-control form-control-sm form-control-border select2">
                            <option value="" disabled selected></option>
							<?php 
							$accounts = $conn->query("SELECT a.*, g.name AS gname FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
							$currentGroup = null;
							$groupedAccounts = array();

							while($row = $accounts->fetch_assoc()):
								$account_arr[$row['id']] = $row;

								if ($row['gname'] != $currentGroup) {
									
									if ($currentGroup !== null) {
										echo '</optgroup>';

										foreach ($groupedAccounts[$currentGroup] as $account) {
											echo '<option value="' . $account['id'] . '" data-group-id="' . $account['group_id'] . '">' . $account['name'] . '</option>';
										}

										$groupedAccounts[$currentGroup] = array();
									}

									echo '<optgroup label="' . $row['gname'] . '">';
									$currentGroup = $row['gname'];
								}

								$groupedAccounts[$currentGroup][] = $row;
							endwhile;

							if ($currentGroup !== null) {
								echo '</optgroup>';

								foreach ($groupedAccounts[$currentGroup] as $account) {
									echo '<option value="' . $account['id'] . '" data-group-id="' . $account['group_id'] . '">' . $account['name'] . '</option>';
								}
							}
							?>
						</select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="account_code" class="control-label">Account Code:</label>
                            <input type="text" id="account_code" name="account_code" class="form-control form-control-sm form-control-border rounded-0">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="group_id" class="control-label">Account Group:</label>
                            <select id="group_id" class="form-control form-control-sm form-control-border select2">
                                <option value="" disabled selected></option>
                                <?php 
                                $groups = $conn->query("SELECT * FROM `group_list` where delete_flag = 0 and `status` = 1 order by `name` asc ");
                                while($row = $groups->fetch_assoc()):
                                    unset($row['description']);
                                    $group_arr[$row['id']] = $row;
                                ?>
                                <option value="<?= $row['id'] ?>" data-group-name="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="form-group col-md-12">
                            <label for="amount" class="control-label">Amount:</label>
                            <input type="number" step="any" id="amount" class="form-control form-control-sm form-control-border text-right">
                        </div>
                        <div class="form-group col-md-6">
                            <button class="btn btn-default bg-navy btn-flat" id="add_to_list" type="button"><i class="fa fa-plus"></i> Add Account</button>
                        </div>
                    </div> -->
                    <?php 
                        if (!isset($id) || $id === null) :
                            
                            $journalId = isset($_GET['id']) ? $_GET['id'] : null;
                            $jitems = $conn->query("SELECT j.*,a.code as account_code, a.name as account, g.name as `group`, g.type FROM `vs_items` j inner join account_list a on j.account_id = a.id inner join group_list g on j.group_id = g.id where journal_id = '{$journalId}'");
                            $groupedData = array();

                            while ($row = $jitems->fetch_assoc()) {
                                $grId = $row['gr_id'];
                                $groupedData[$grId][] = $row;
                            }
                        
                            foreach ($groupedData as $grId => $groupData) :
                        ?>
                    <hr>
                    <b>GR #: </b><?= $grId ?>
                    <table id="account_list_<?= $grId ?>" class="table table-bordered tbl_acc">
                    <colgroup>
        <col width="5%">
        <!-- <col width="5%"> -->
        <col width="2%">
        <col width="43%">
        <col width="30%">
        <!-- <col width="10%"> -->
        <col width="10%">
        <col width="10%">

    </colgroup>
    <thead>
        <tr>
            <th class="text-center"></th>
            <!-- <th class="text-center">Item No.</th> -->
            <th class="text-center">Account Code</th>
            <th class="text-center">Account Name</th>
            <th class="text-center">Location</th>
            <!-- <th class="text-center">Group</th> -->
            <!-- <th class="text-center">Item Type</th> -->
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $query = "SELECT gt.amount, gt.account, gt.item_code,al.name,al.id AS alId, gl.id AS glId,gl.type
    FROM tbl_gl_trans gt INNER JOIN
    account_list al ON gt.account = al.code 
    INNER JOIN group_list gl ON al.group_id = gl.id 
    WHERE gt.gr_id = $grId";
    $qry = $conn->query($query);
    while ($row = $qry->fetch_assoc()):
        $account_code = $row['account']; 
        $account_name = $row['name'];
        $alId = $row['alId'];
        $glId = $row['glId'];
        $glType = $row['type'];
        $amount = $row['amount'];

        if($account_name == 'Deferred Input VAT'){
             $iEWT = $row['amount'];
        }

        if($account_name == 'GR/IR'){
            $n_apTotal = $row['amount'];
        }

        if($account_name == 'Deferred Expanded Withholding Tax Payable'){
            $e_total = $row['amount'];
        }

        if ($account_name === 'Deferred Input VAT') {
            continue; 
        }
        $allowed_accounts = [
            'Deferred Expanded Withholding Tax Payable',
            'GR/IR',
            'Deferred Input VAT',
            'Input VAT',
            'Accounts Payable Trade',
            'Expanded Withholding Tax Payable'
        ];

        if (!in_array($account_name, $allowed_accounts)) {
            continue; 
        }
       ?>

    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $account_code ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $grId ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row['account'] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $amount; ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <!-- Name:<input type="text" name="account[]" value="<?php echo $account_name; ?>"> -->
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $grId ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

                <?php endwhile; ?>
            </select>
        </td>
        <td class="">
            <div class="loc-cont">
            <label class="control-label">Phase: </label>
            <select name="phase[]" class="phase">
                <?php 
                $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                while ($row = $cat->fetch_assoc()):
                    $cat_name[$row['c_code']] = $row['c_acronym'];
                    $code = $row['c_code'];
                ?>
                <option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>
                <?php endwhile; ?>
            </select>
            <label class="control-label">Block: </label>
            <input type="text" class="block" name="block[]" value="">
            <label class="control-label">Lot: </label>
            <input type="text" class="lot" name="lot[]" value="">
            <div class="lotExistsMsg" style="color: #ff0000;"></div>
            </div>
            <script>
            $(document).ready(function () {
                $('.lot, .block, .phase').on('input', function () {
                    var currentRow = $(this).closest('td');

                    var enteredPhase = currentRow.find('.phase').val();
                    var enteredBlock = currentRow.find('.block').val();
                    var enteredLot = currentRow.find('.lot').val();

                    console.log("AJAX Data:", {
                        phase: enteredPhase,
                        block: enteredBlock,
                        lot: enteredLot
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'journals/check_loc.php',
                        data: JSON.stringify({
                            phase: enteredPhase,
                            block: enteredBlock,
                            lot: enteredLot
                        }),
                        contentType: 'application/json',
                        success: function (response) {
                            console.log("AJAX Response:", response);
                            var lotExistsMsg = currentRow.find('.lotExistsMsg');
                            lotExistsMsg.html(response);
                        }
                    });
                });
            });
            </script>
        </td>
        <td class="debit_amount text-right">
            <?php if ($account_name == 'GR/IR' || $account_name == 'Deferred Expanded Withholding Tax Payable' || ($glType == 1 && $account_name != 'Deferred Input VAT')): ?>
                <input type="text" class="debit_amount" value="<?php echo number_format($amount, 2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
        <td class="credit_amount text-right">
            <?php if ($glType == 2 && $account_name != 'GR/IR' && $account_name != 'Deferred Expanded Withholding Tax Payable' || $account_name == 'Deferred Input VAT') : ?>
                <input type="text" class="credit_amount" value="<?php echo number_format($amount, 2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

    <?php 
    $query_iv = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.name = 'Input VAT';
    ";

    $qry_iv = $conn->query($query_iv);
    while ($row_iv = $qry_iv->fetch_assoc()):
        $groupname = $row_iv['group_name'];
        $glId = $row_iv['group_id'];
        $alId = $row_iv['id'];
        $glType = $row_iv['type'];
        $account_name = $row_iv['name'];
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_iv["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $grId ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_iv["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $iEWT; ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <!-- <input type="text" name="account[]" value="<?php echo $account_name; ?>"> -->
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $grId ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

                <?php endwhile; ?>
            </select>
        </td>
        <td class="">
            <div class="loc-cont">
            <label class="control-label">Phase: </label>
            <select name="phase[]" class="phase">
                <?php 
                $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                while ($row = $cat->fetch_assoc()):
                    $cat_name[$row['c_code']] = $row['c_acronym'];
                    $code = $row['c_code'];
                ?>
                <option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>
                <?php endwhile; ?>
            </select>
            <label class="control-label">Block: </label>
            <input type="text" class="block" name="block[]" value="">
            <label class="control-label">Lot: </label>
            <input type="text" class="lot" name="lot[]" value="">
            <div class="lotExistsMsg" style="color: #ff0000;"></div>
            </div>
            <script>
            $(document).ready(function () {
                $('.lot, .block, .phase').on('input', function () {
                    var currentRow = $(this).closest('td');

                    var enteredPhase = currentRow.find('.phase').val();
                    var enteredBlock = currentRow.find('.block').val();
                    var enteredLot = currentRow.find('.lot').val();

                    console.log("AJAX Data:", {
                        phase: enteredPhase,
                        block: enteredBlock,
                        lot: enteredLot
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'journals/check_loc.php',
                        data: JSON.stringify({
                            phase: enteredPhase,
                            block: enteredBlock,
                            lot: enteredLot
                        }),
                        contentType: 'application/json',
                        success: function (response) {
                            console.log("AJAX Response:", response);
                            var lotExistsMsg = currentRow.find('.lotExistsMsg');
                            lotExistsMsg.html(response);
                        }
                    });
                });
            });
            </script>
        </td>
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->

        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($iEWT,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($iEWT,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($iEWT,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

    <?php 
    $query_ap = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.name = 'Accounts Payable Trade';
    ";

    $qry_ap = $conn->query($query_ap);
    while ($row_ap = $qry_ap->fetch_assoc()):
        $groupname = $row_ap['group_name'];
        $glId = $row_ap['group_id'];
        $alId = $row_ap['id'];
        $glType = $row_ap['type'];
        $account_name = $row_ap['name'];
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_ap["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $grId ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ap["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $n_apTotal?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <!-- Name:<input type="text" name="account[]" value="<?php echo $account_name; ?>"> -->
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $grId ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

                <?php endwhile; ?>
            </select>
        </td>
        <td class="">
            <div class="loc-cont">
            <label class="control-label">Phase: </label>
            <select name="phase[]" class="phase">
                <?php 
                $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                while ($row = $cat->fetch_assoc()):
                    $cat_name[$row['c_code']] = $row['c_acronym'];
                    $code = $row['c_code'];
                ?>
                <option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>
                <?php endwhile; ?>
            </select>
            <label class="control-label">Block: </label>
            <input type="text" class="block" name="block[]" value="">
            <label class="control-label">Lot: </label>
            <input type="text" class="lot" name="lot[]" value="">
            <div class="lotExistsMsg" style="color: #ff0000;"></div>
            </div>
            <script>
            $(document).ready(function () {
                $('.lot, .block, .phase').on('input', function () {
                    var currentRow = $(this).closest('td');

                    var enteredPhase = currentRow.find('.phase').val();
                    var enteredBlock = currentRow.find('.block').val();
                    var enteredLot = currentRow.find('.lot').val();

                    console.log("AJAX Data:", {
                        phase: enteredPhase,
                        block: enteredBlock,
                        lot: enteredLot
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'journals/check_loc.php',
                        data: JSON.stringify({
                            phase: enteredPhase,
                            block: enteredBlock,
                            lot: enteredLot
                        }),
                        contentType: 'application/json',
                        success: function (response) {
                            console.log("AJAX Response:", response);
                            var lotExistsMsg = currentRow.find('.lotExistsMsg');
                            lotExistsMsg.html(response);
                        }
                    });
                });
            });
            </script>
        </td>
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->

        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($e_total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($n_apTotal,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($n_apTotal,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($n_apTotal,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

    <?php 
    $query_ewt = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.name = 'Expanded Withholding Tax Payable';
    ";

    $qry_ewt = $conn->query($query_ewt);
    while ($row_ewt = $qry_ewt->fetch_assoc()):
        $groupname = $row_ewt['group_name'];
        $glId = $row_ewt['group_id'];
        $alId = $row_ewt['id'];
        $glType = $row_ewt['type'];
        $account_name = $row_ewt['name'];
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_ewt["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $grId ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ewt["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $iEWT; ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <!-- <input type="text" name="account[]" value="<?php echo $account_name; ?>"> -->
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $grId ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

                <?php endwhile; ?>
            </select>
        </td>
        <td class="">
            <div class="loc-cont">
            <label class="control-label">Phase: </label>
            <select name="phase[]" class="phase">
                <?php 
                $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                while ($row = $cat->fetch_assoc()):
                    $cat_name[$row['c_code']] = $row['c_acronym'];
                    $code = $row['c_code'];
                ?>
                <option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>
                <?php endwhile; ?>
            </select>
            <label class="control-label">Block: </label>
            <input type="text" class="block" name="block[]" value="">
            <label class="control-label">Lot: </label>
            <input type="text" class="lot" name="lot[]" value="">
            <div class="lotExistsMsg" style="color: #ff0000;"></div>
            </div>
            <script>
            $(document).ready(function () {
                $('.lot, .block, .phase').on('input', function () {
                    var currentRow = $(this).closest('td');

                    var enteredPhase = currentRow.find('.phase').val();
                    var enteredBlock = currentRow.find('.block').val();
                    var enteredLot = currentRow.find('.lot').val();

                    console.log("AJAX Data:", {
                        phase: enteredPhase,
                        block: enteredBlock,
                        lot: enteredLot
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'journals/check_loc.php',
                        data: JSON.stringify({
                            phase: enteredPhase,
                            block: enteredBlock,
                            lot: enteredLot
                        }),
                        contentType: 'application/json',
                        success: function (response) {
                            console.log("AJAX Response:", response);
                            var lotExistsMsg = currentRow.find('.lotExistsMsg');
                            lotExistsMsg.html(response);
                        }
                    });
                });
            });
            </script>
        </td>
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->

        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($iEWT,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($e_total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($e_total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

    <?php 
    $query = "SELECT gt.amount, gt.account, gt.item_code,al.name,al.id AS alId, gl.id AS glId,gl.type
    FROM tbl_gl_trans gt INNER JOIN
    account_list al ON gt.account = al.code 
    INNER JOIN group_list gl ON al.group_id = gl.id 
    WHERE gt.gr_id = $grId";
    $qry = $conn->query($query);
    while ($row = $qry->fetch_assoc()):
        $account_code = $row['account']; 
        $account_name = $row['name'];
        $alId = $row['alId'];
        $glId = $row['glId'];
        $glType = $row['type'];
        $amount = $row['amount'];

        if($account_name == 'Deferred Input VAT'){
             $iEWT = $row['amount'];
        }

        $allowed_accounts = [
            'Deferred Input VAT'
        ];

        if (!in_array($account_name, $allowed_accounts)) {
            continue; 
        }
       ?>

    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $account_code ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $grId ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row['account'] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $amount; ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <!-- Name:<input type="text" name="account[]" value="<?php echo $account_name; ?>"> -->
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $grId ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

                <?php endwhile; ?>
            </select>
        </td>
        <td class="">
            <div class="loc-cont">
            <label class="control-label">Phase: </label>
            <select name="phase[]" class="phase">
                <?php 
                $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                while ($row = $cat->fetch_assoc()):
                    $cat_name[$row['c_code']] = $row['c_acronym'];
                    $code = $row['c_code'];
                ?>
                <option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>
                <?php endwhile; ?>
            </select>
            <label class="control-label">Block: </label>
            <input type="text" class="block" name="block[]" value="">
            <label class="control-label">Lot: </label>
            <input type="text" class="lot" name="lot[]" value="">
            <div class="lotExistsMsg" style="color: #ff0000;"></div>
            </div>
            <script>
            $(document).ready(function () {
                $('.lot, .block, .phase').on('input', function () {
                    var currentRow = $(this).closest('td');

                    var enteredPhase = currentRow.find('.phase').val();
                    var enteredBlock = currentRow.find('.block').val();
                    var enteredLot = currentRow.find('.lot').val();

                    console.log("AJAX Data:", {
                        phase: enteredPhase,
                        block: enteredBlock,
                        lot: enteredLot
                    });

                    $.ajax({
                        type: 'POST',
                        url: 'journals/check_loc.php',
                        data: JSON.stringify({
                            phase: enteredPhase,
                            block: enteredBlock,
                            lot: enteredLot
                        }),
                        contentType: 'application/json',
                        success: function (response) {
                            console.log("AJAX Response:", response);
                            var lotExistsMsg = currentRow.find('.lotExistsMsg');
                            lotExistsMsg.html(response);
                        }
                    });
                });
            });
            </script>
        </td>
        <td class="debit_amount text-right">
            <?php if ($account_name == 'GR/IR' || $account_name == 'Deferred Expanded Withholding Tax Payable' || ($glType == 1 && $account_name != 'Deferred Input VAT')): ?>
                <input type="text" class="debit_amount" value="<?php echo number_format($amount, 2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
        <td class="credit_amount text-right">
            <?php if ($glType == 2 && $account_name != 'GR/IR' && $account_name != 'Deferred Expanded Withholding Tax Payable' || $account_name == 'Deferred Input VAT') : ?>
                <input type="text" class="credit_amount" value="<?php echo number_format($amount, 2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

</tbody>
<tfoot>
    <tr>
        <td colspan="2"><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1 add_row" data-gr-id="<?= $grId ?>" type="button">Add Row</button><strong>Total</strong></td>

        <td class="text-right" id="total-debit"></td>
        <td class="text-right" id="total-credit"></td>
    </tr>
</tfoot>
                    </table>
                    <script>
                    $(document).ready(function () {
                        $('#account_list_<?= $grId ?>').on('change', '.accountSelect', function () {
                            var selectedOption = $(this).find(':selected');
                            var currentRow = $(this).closest('tr');
                            var accountInfo = currentRow.find('.accountInfo');

                            accountInfo.find('input[name="gr_id[]"]').val(selectedOption.data('gr-id'));
                            accountInfo.find('input[name="account_code[]"]').val(selectedOption.data('account-code'));
                            accountInfo.find('input[name="account_id[]"]').val(selectedOption.data('account-id'));
                            accountInfo.find('input[name="group_id[]"]').val(selectedOption.data('group-id'));
                            //accountInfo.find('input[name="amount[]"]').val(selectedOption.data('amount'));
                            accountInfo.find('.account_code').text(selectedOption.data('account-code'));
                            accountInfo.find('.type').text(selectedOption.data('type'));
                        });
                        $('.add_row[data-gr-id="<?= $grId ?>"]').click(function () {
                            var table = $('#account_list_<?= $grId ?>');
                            var lastRow = table.find('tbody tr:last');
                            var clone = lastRow.clone();

                            clone.find('input, select, span').val('');

                            clone.find('[name^="phase"]').val(clone.find('[name^="phase"] option:first').val());

                            clone.find('[name^="gr_id"]').val('');
                            clone.find('[name^="account_code"]').val('');
                            clone.find('[name^="account_id"]').val('');
                            clone.find('[name^="group_id"]').val('');
                            clone.find('[name^="amount"]').val('');
                            clone.find('.account_code').val('');
                            clone.find('.type').val('');

                            table.find('tbody').append(clone);


                            clone.find('.delete-row').click(function () {
                                $(this).closest('tr').remove();
                                cal_tb();
                            });
                        });
                    });
                    </script>

                    <?php endforeach; ?>
                <?php endif; ?>
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">TOTAL DEBIT</th>
                        <th class="text-center">TOTAL CREDIT</th>
                    </tr>
                    <tr>

                        <th class="text-center main_total_debit">0.00</th>
                        <th class="text-center main_total_credit">0.00</th>
                    </tr>
                </table>
                <div class="row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary" id="save_journal">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<div class="modal fade" id="zeroAccountCodeModal" tabindex="-1" role="dialog" aria-labelledby="zeroAccountCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="zeroAccountCodeModalLabel"><b>Unlinked Item/s</b></h5>
            </div>
            <div class="modal-body" id="zeroAccountCodeModalBody">
            </div>
        </div>
    </div>
</div>

<script>
function cal_tb(account_list_<?= $grId ?>) {
    var debit = 0;
    var credit = 0;

    $('#' + account_list_<?= $grId ?> + ' tbody tr').each(function () {
        debit += parseFloat($(this).find('.debit-amount-input').val()) || 0;
        credit += parseFloat($(this).find('.credit-amount-input').val()) || 0;
    });

    $('#' + account_list_<?= $grId ?>).find('.total_debit').text(debit.toFixed(2));
    $('#' + account_list_<?= $grId ?>).find('.total_credit').text(credit.toFixed(2));
    $('#' + account_list_<?= $grId ?>).find('.total-balance').text((debit - credit).toFixed(2));


    updateGrandTotals();
}

function updateGrandTotals() {
    var grandTotalDebit = 0;
    var grandTotalCredit = 0;

    $('.tbl_acc').each(function () {
        var currentTable = $(this);
        var totalDebit = parseFloat(currentTable.find('.total_debit').text()) || 0;
        var totalCredit = parseFloat(currentTable.find('.total_credit').text()) || 0;

        grandTotalDebit += totalDebit;
        grandTotalCredit += totalCredit;
    });

    $('.main_total_debit').text(grandTotalDebit.toFixed(2));
    $('.main_total_credit').text(grandTotalCredit.toFixed(2));
}

$(document).on('click', '.delete-row', function () {
    var grId = $(this).data('gr-id');
    $(this).closest('tr').remove();
    cal_tb(grId);
});


cal_tb('account_list_<?= $grId ?>');

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
    $("#account_id").on("change", function () {
        var selectedAccountId = $(this).val();
        var accountCodeInput = $("#account_code");
        var selectedOption = $("#account_id option:selected");

        if (selectedOption) {
            var groupId = selectedOption.data("group-id");
            $("#group_id").val(groupId).trigger('change.select2');
            if (selectedAccountId in account) {
                accountCodeInput.val(account[selectedAccountId].code);
            } else {
                accountCodeInput.val('');
            }
        }
    });
});


$(document).ready(function () {
    var supplierSelect = $("#supplier_id"); 
    var supCodeInput = $("#sup_code"); 

    supplierSelect.on("change", function () {
        var selectedOption = supplierSelect.find("option:selected"); 

        supCodeInput.val(selectedOption.val());

    });
});


    var account = $.parseJSON('<?= json_encode($account_arr) ?>');
    var group = $.parseJSON('<?= json_encode($group_arr) ?>');
    
    $(document).ready(function () {
    $('.tbl_acc').each(function () {
        cal_tb($(this).attr('id'));
    });
});


    $(function () {
        if ('<?= isset($id) ?>' == 1) {
            cal_tb();
        }
        $('#account_list th, #account_list td').addClass('align-middle px-2 py-1');
        var counter = 1; 

        $('#add_to_list').click(function () {
        var account_id = $('#account_id').val();
        var account_code = $('#account_code').val();
        var group_id = $('#group_id').val();
        var amount = $('#amount').val();


        if (account_code.trim() === '') {
            alert('Please enter an account code.'); 
            return; 
        }
        if (amount.trim() === '') {
            alert('Please enter amount.'); 
            return; 
        }

        var tr = $($('noscript#item-clone').html()).clone();
        var account_data = !!account[account_id] ? account[account_id] : {};
        var group_data = !!group[group_id] ? group[group_id] : {};

        tr.find('#item_no').val(counter);
        tr.find('input[name="account_code[]"]').val(account_code);
        tr.find('input[name="account_id[]"]').val(account_id);
        tr.find('input[name="group_id[]"]').val(group_id);
        tr.find('input[name="amount[]"]').val(amount);

        tr.find('.account').text(!!account_data.name ? account_data.name : "N/A");
        tr.find('.group').text(!!group_data.name ? group_data.name : "N/A");

        if (!!group_data.type && group_data.type == 1)
            tr.find('.debit_amount').text(parseFloat(amount).toLocaleString('en-US', { style: 'decimal' }));
        else
            tr.find('.credit_amount').text(parseFloat(amount).toLocaleString('en-US', { style: 'decimal' }));

        $('#account_list').append(tr);

        tr.find('.delete-row').click(function () {
            $(this).closest('tr').remove();
            cal_tb();
        });
        cal_tb();

        $('#account_code').val('').trigger('change');
        $('#account_id').val('').trigger('change');
        $('#group_id').val('').trigger('change');
        $('#amount').val('').trigger('change');

        counter++;
    });

        $('#journal-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>');
            el.addClass("pop-msg alert");
            el.hide();
            // if ($('#account_list tbody tr').length <= 0) {
            //     el.addClass('alert-danger').text(" Account Table is empty.");
            //     _this.prepend(el);
            //     el.show('slow');
            //     $('html, body').animate({ scrollTop: 0 }, 'fast');
            //     return false;
            // }
            // if ($('#account_list tfoot .total-balance').text() != '0') {
            //     el.addClass('alert-danger').text(" Trial Balance is not equal.");
            //     _this.prepend(el);
            //     el.show('slow');
            //     $('html, body').animate({ scrollTop: 0 }, 'fast');
            //     return false;
            // }
            start_loader();
            var urlSuffix;
            <?php if (!empty($_GET['id'])) { ?>
                urlSuffix = "modify_voucher_supplier";
            <?php } else{ ?>
                urlSuffix = "save_voucher_supplier";
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
    })
</script>
<script>
  $(document).ready(function () {
        $('#supplier_id').on('change', function () {
        var selectedSupplierId = $(this).val();
        console.log('Supplier ID:', selectedSupplierId);
        $.ajax({
            url: 'journals/items-link.php',
            type: 'POST',
            data: { supplier_id: selectedSupplierId },
            success: function (data) {
                var items = JSON.parse(data);

                console.log(items);
                var itemsWithZeroAccountCode = items.filter(function (item) {
                    return item.account_code == 0;
                });

                if (itemsWithZeroAccountCode.length > 0) {
                    displayZeroAccountCodeModal(itemsWithZeroAccountCode, selectedSupplierId);
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
        if (selectedSupplierId) {
            $.ajax({
                url: 'journals/show_gr.php',
                method: 'POST',
                data: { supplier_id: selectedSupplierId },
                dataType: 'json',
                success: function (data) {
                    if (data.gr_data.length > 0) {
                        var tableRows = buildMainTableRows(data.gr_data);
                        var tableHtml = buildMainTableHtml(tableRows);
                        $('.gr-container').empty().append(tableHtml);

                        console.log('Main Table Info:', {
                            Rows: data.gr_data.length,
                            Columns: 3,
                            Data: data.gr_data
                        });
                    } else {
                        $('.gr-container').html('<p>No Goods Receipts available for the selected supplier.</p>');
                    }
                },
                error: function (error) {
                    console.log('Error:', error);
                }
            });
        } else {
            $('.gr-container').empty();
            $('.additional-table-container').empty();
        }
    });
    function fetchAndAppendTable(grId) {
    return new Promise((resolve, reject) => {
        var supplierId = $('#supplier_id').val();

        if (!$('.additional-table-container[data-id="' + grId + '"]').hasClass('added-table')) {
            $.ajax({
                url: 'journals/view_gr_details.php',
                method: 'POST',
                data: { gr_id: grId, supplier_id: supplierId },
                success: function (additionalTableHtml) {
                    console.log('supplier_id:', supplierId);

                    $('.additional-table-container').append('<div class="additional-table-container added-table" data-id="' + grId + '">' + additionalTableHtml + '</div>');
                    resolve(additionalTableHtml);
                },
                error: function (error) {
                    console.log('Error fetching additional table:', error);
                    reject(error);
                }
            });
        } else {
            resolve('');
        }
    });
}
document.getElementById('display-selected-gr-details').addEventListener('click', function(event) {
    event.preventDefault();
});
$('#display-selected-gr-details').on('click', async function () {
    $('.additional-table-container').empty();
    $('#account_list').empty();

    let totalCredit = 0;
    let totalDebit = 0;

    const checkedGrIds = getCheckedGrIds();

    console.log('Checked GR IDs:', checkedGrIds);

    try {
        await processCheckboxes(checkedGrIds, totalCredit, totalDebit);
    } catch (error) {
        console.error('Error in processCheckboxes:', error);
    }
});
function buildMainTableRows(grData) {
    return grData.map(function (grData) {
        return '<tr>' +
            '<td>' +
            '<input type="checkbox" class="selected-gr-checkbox log-id" data-id="' + grData.gr_id + '">' +
            '<a href="#" class="basic-link view-gr-details" data-id="' + grData.gr_id + '">' + grData.gr_id + '</a>' +
            '</td>' +
            '<td>' + grData.po_no + '</td>' +
            '<td>' + grData.date_created + '</td>' +
            '</tr>';
    });
}
function buildMainTableHtml(tableRows) {
    return '<table class="table-bordered" style="width: 100%">' +
        '<thead><tr><th>GR #</th><th>PO #</th><th>Date/Time Received</th></tr></thead>' +
        '<tbody>' + tableRows.join('') + '</tbody></table>';
}
function getCheckedGrIds() {
    const checkedGrIds = [];
    $('.selected-gr-checkbox:checked').each(function () {
        const grId = $(this).data('id');
        if (checkedGrIds.indexOf(grId) === -1) {
            checkedGrIds.push(grId);
        }
    });
    return checkedGrIds;
}
async function processCheckboxes(checkedGrIds) {
    let displayedTableCount = 0;
    for (let i = 0; i < checkedGrIds.length; i++) {
        const grId = checkedGrIds[i];
        const additionalTableHtml = await fetchAndAppendTable(grId);
        displayedTableCount++;

        const additionalTableData = extractDataFromTable(additionalTableHtml);

        console.log('Additional Table Info for GR ID ' + grId + ':', {
            HTML: additionalTableHtml,
            Data: additionalTableData,
        });
        appendLogToTable(grId, additionalTableHtml);
    }
    console.log('Number of Tables Displayed:', displayedTableCount);
}
function appendLogToTable(grId, additionalTableHtml) {
    $('#account_list').append('<tr>' +
        '<td>' + additionalTableHtml + '</td>' +
        '</tr>');
}
function extractDataFromTable(tableHtml) {
    const extractedData = [];
    const tableRows = $(tableHtml).find('tbody tr');

    tableRows.each(function () {
        const rowData = [];
        $(this).find('td').each(function () {
            rowData.push($(this).text());
        });
        extractedData.push(rowData);
    });
    return extractedData;
}
function displayZeroAccountCodeModal(items, supplierId) {
    var modalBody = $('#zeroAccountCodeModalBody');
    modalBody.empty();
    var table = $('<table class="table table-bordered">');
    var thead = $('<thead>').append('<tr><th style="width:40%;">Name</th><th style="width:10%">Item Code</th><th style="width:50%">Description</th></tr>');

    table.append(thead);

    var tbody = $('<tbody>');
    items.forEach(function (item) {
        var row = $('<tr>');
        row.append('<td>' + item.name + '</td>');
        row.append('<td>' + item.item_code + '</td>');
        row.append('<td>' + item.description + '</td>');
        tbody.append(row);
    });
    table.append(tbody);
    modalBody.append(table);
    var modal = $('#zeroAccountCodeModal');
    modal.find('.modal-dialog').removeClass('modal-lg'); 
    modal.find('.modal-dialog').addClass('custom-modal-width'); 
    modalBody.append('<button id="redirectButton" class="btn btn-primary" style="width:100%;">Manage Items</button>');
    $('#zeroAccountCodeModal').modal({
    backdrop: 'static',
    keyboard: false
});

$('#zeroAccountCodeModal').modal('show');
    $('#redirectButton').on('click', function () {
        window.location.href = '.?page=po/items&supplier_id=' + supplierId;
    });    
    }
});
</script>
