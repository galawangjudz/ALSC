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
?>
<?php
$publicId = '';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT a.*, b.* FROM `vs_entries` AS a INNER JOIN `tbl_gr_list` AS b ON a.v_num = b.vs_num WHERE a.v_num = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        $doc_no = $res['doc_no'];
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        $publicId = $_GET['id'];
    }
    //echo $publicId;
}
$is_new_vn = true;

$query = $conn->query("SELECT MAX(CAST(SUBSTRING(doc_no, 2) AS UNSIGNED)) AS max_doc_no FROM `tbl_gl_trans`");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    if ($maxDocNo === null) {
        $maxDocNo = 0;
    }
    if($publicId > 0){
        $newDocNo = '2' . sprintf('%05d', $maxDocNo);
    }else{
        $newDocNo = '2' . sprintf('%05d', $maxDocNo + 1);
    }

    //echo $newDocNo;
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
    $vs_num = str_pad($next_v_number, STR_PAD_LEFT);
    //echo $vs_num;
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
	.nav-sup{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-sup:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
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

    table.find('.total_debit').text(totalDebit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    table.find('.total_credit').text(totalCredit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

    var balance = totalDebit - totalCredit;
    table.find('.total-balance').text(balance.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
}

// $(document).ready(function() {
//     function handleAccountSelectChange() {
//         var selectedOption = $(this).find(':selected');
//         var type = selectedOption.data('type');

//         var $row = $(this).closest('tr'); 
//         var $debitInput = $row.find('.debit-amount-input');
//         var $creditInput = $row.find('.credit-amount-input');

//         if (type == 1) {
//             $creditInput.prop('disabled', true);
//             $debitInput.prop('disabled', false);
//         } else if (type == 2) {
//             $creditInput.prop('disabled', false);
//             $debitInput.prop('disabled', true);
//         }
//     }

//     $(document).on('change', '.accountSelect', handleAccountSelectChange);

//     $('.accountSelect').each(function () {
//         handleAccountSelectChange.call(this);
//     });

// });
</script>
</head>

<body onload="cal_tb()">
<form action="" method="post" enctype="multipart/form-data" id="picform">
        <table class="table table-bordered">
            <input type="hidden" class="control-label" name="newDocNo" id="newDocNo" value="<?php echo $newDocNo; ?>" readonly>
            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
            <tr>
                <td>
                    <label for="name" class="control-label">Name:</label>
                </td>
                <td>
                    <input type="text" name="name" id="name" required value="">
                </td>
                <td>
                    <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" value="">
                </td>
                <td>
                    <button type="submit" name="submit" id="picform_submit_button">Submit</button>
                </td>
            </tr>
        </table>    
    </form>
<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td>Name</td>
        <td>Attachment</td>
    </tr>
    <?php 
    $i = 1;
    $rows = mysqli_query($conn, "SELECT * FROM tbl_vs_attachments WHERE doc_no = $newDocNo;");
    ?>
    <?php foreach($rows as $row):?>
    <tr>
        <td><?php echo $row["name"]; ?></td>
        <td>
            <?php
            $fileExtension = pathinfo($row['image'], PATHINFO_EXTENSION);
            $filePath = "journals/attachments/" . $row['image'];
            if (strtolower($fileExtension) == 'pdf'): ?>
                <a href="<?php echo $filePath; ?>" data-lightbox="pdfs" data-title="<?php echo $row['name']; ?>">
                    <img src="path/to/pdf-icon.jpg" alt="PDF Icon" width="200" height="200">
                </a>
            <?php else: ?>
                <a href="<?php echo $filePath; ?>" data-lightbox="images" data-title="<?php echo $row['name']; ?>">
                    <img src="<?php echo $filePath; ?>" alt="<?php echo $row['name']; ?>" width="200" height="200">
                </a>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>
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
                            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
                        </div>
                        <!-- <div class="col-md-4 form-group">
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
                            <input type="text" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>" readonly>
                        </div> -->
                        <div class="col-md-6 form-group">
                            <label class="control-label">Document #:</label>
                            <input type="text" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $newDocNo; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="journal_date" class="control-label">Transaction Date:</label>
                            <input type="date" id="journal_date" name="journal_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($journal_date) ? $journal_date : date("Y-m-d") ?>" required readonly>
                        </div>
                        <!-- <div class="col-md-4 form-group">
                            <label for="bill_date" class="control-label">Bill Date:</label>
                            <?php
                            if (!empty($bill_date)) {
                                $billformattedDate = date('Y-m-d', strtotime($bill_date));
                            } else {
                                $billformattedDate = '';
                            }
                            ?>     
                            <input type="date" id="bill_date" name="bill_date" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo isset($billformattedDate) ? $billformattedDate : '' ?>" required style="background-color:yellow;">
                        </div> -->
                        <div class="col-md-6 form-group">
                            <label for="due_date" class="control-label">Due Date:</label>
                            <?php
                            if (!empty($due_date)) {
                                $dueformattedDate = date('Y-m-d', strtotime($due_date));
                            } else {
                                $dueformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="due_date" name="due_date" value="<?php echo isset($dueformattedDate) ? $dueformattedDate : '' ?>" required readonly>
                        </div>
                            <!-- <input type="date" id="due_date" name="due_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($due_date) ? $due_date : date("Y-m-d") ?>" required> -->
                    </div>

                    <div class="paid_to_main">
                        <div class="paid_to">
                            <label class="control-label">Paid To:</label>
                            <hr>
                            <div class="container" id="sup-div">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="supplier_id">Supplier:</label>
                                            <?php
                                            $supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
                                            $terms = '';
                                            ?>
                                            <select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                                                <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                                <?php while ($row = $supplier_qry->fetch_assoc()): 
                                                    
                                                    ?>
                                                <option 
                                                    value="<?php echo $row['id'] ?>" 
                                                    data-supplier-code="<?php echo $row['id'] ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                                                ><?php echo $row['name'] ?></option>
                                                <?php
                                                if (isset($supplier_id) && $supplier_id == $row['id']) {
                                                    $terms = $row['terms'];
                                                   
                                                }
                                                ?>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <!-- <div class="col-md-4 form-group">
                                            <label for="p_terms">Payment Terms:</label>
                                            <?php if ($terms !== ''): ?>
                                            <?php
                                            $terms_qry = $conn->query("SELECT terms FROM `payment_terms` WHERE terms_indicator = $terms;");
                                            while ($row = $terms_qry->fetch_assoc()):
                                                $pterms = $row['terms'];
                                                ?>
                                                <input type="text" id="p_terms" class="form-control form-control-sm rounded-0" value="<?php echo $pterms; ?>" readonly>
                                            <?php endwhile; ?>
                                            <?php else: ?>
                                            <input type="text" id="p_terms" class="form-control form-control-sm rounded-0" readonly>
                                        <?php endif; ?>
                                        </div> -->
                                        <div class="col-md-6 form-group">
                                            <label for="sup_code" class="control-label">Supplier Code:</label>
                                            <input type="text" id="sup_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="gr-container"></div>
                        </div>
                    </div>
                    <hr>
                    <input type="hidden" id="termsTextbox" value="<?php echo $terms; ?>" class="form-control">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
                    <?php 
                        if (!isset($id) || $id === null) :
                            $journalId = isset($_GET['id']) ? $_GET['id'] : null;
                            $jitems = $conn->query("SELECT j.*,a.code as account_code, a.name as account, g.name as `group`, g.type FROM `vs_items` j inner join account_list a on j.account_id = a.id inner join group_list g on j.group_id = g.id where journal_id = '{$journalId}'");
                            $groupedData = array();
                            while ($row = $jitems->fetch_assoc()) {
                                $grId = $row['gr_id'];
                                $account_name = $row['account'];
                                $groupedData[$grId][] = $row;
                            }
                            foreach ($groupedData as $grId => $groupData) :
                        ?>
                    <hr>
                    <i><b>GR #: </b><b><?= $grId ?></b></i>
                    <table id="account_list_<?= $grId ?>" class="table table-bordered tbl_acc">
                    <colgroup>
                            <col width="5%">
                            <!-- <col width="5%"> -->
                            <col width="10%">
                            <col width="20%">
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
                                <!-- <th class="text-center">GR #</th> -->
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($groupData as $row) : ?>
                            
                            <tr>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" data-gr-id="account_list_<?= $grId ?>" type="button"><i class="fa fa-times"></i></button>
                                </td>
                               
                                <td class="accountInfo">
                                <input type="hidden" name="gr_id[]" value="<?= $row['gr_id'] ?>">
                                <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
                                <input type="hidden" name="doc_no[]" value="<?php echo $doc_no; ?>" readonly>
                                <input type="hidden" name="account_code[]" value="<?= $row['account_code'] ?>">
                                <input type="hidden" name="account_id[]" value="<?= $row['account_id'] ?>">
                                <input type="hidden" name="group_id[]" value="<?= $row['group_id'] ?>">
                                <input type="hidden" name="amount[]" value="<?= abs($row['amount']) ?>" class="amount-textbox">
                                <span class="account_code"><?= $row['account_code'] ?></span>
                                <span class="type" style="display:none;"><?= $row['type'] ?></span>
                                </td>
                                <td class="">
                                    <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                                        <option value="" disabled selected></option>
                                        <?php 
                                        $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                                        $currentGroup = null;
                                        $groupedAccounts = array();

                                        while($account = $accounts->fetch_assoc()):
                                        ?>
                                            <option value="<?= $account['id'] ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-gr-id="<?= $row['gr_id'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($row['account_id'] == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

                                        <?php endwhile; ?>
                                    </select>
                                </td>
                                <td class="">
                                <div class="loc-cont">
                                <label class="control-label">Phase: </label>
                                <select name="phase[]" id="phase[]" class="phase">
                                <?php 
                                    $meta = array();
                                    $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                                    while($row1 = $cat->fetch_assoc()):
                                ?>
                                    <?php
                                        echo "Meta Phase: " . $row['phase'] . ", Row1 c_code: " . $row1['c_code'];
                                    ?>
                                    <option value="<?php echo $row1['c_code'] ?>" <?php echo isset($row['phase']) && $row['phase'] == $row1['c_code'] ? 'selected' : '' ?>><?php echo $row1['c_acronym'] ?></option>
                                <?php
                                    endwhile;
                                ?>
                                </select>
                                    <label class="control-label">Block: </label>
                                    <input type="text" name="block[]" class="block" value="<?= $row['block'] ?>">
                                    <label class="control-label">Lot: </label>
                                    <input type="text" name="lot[]" class="lot" value="<?= $row['lot'] ?>">
                                    <div class="lotExistsMsg" style="color: #ff0000;"></div>

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
                                </div>
                                </td>
                                <!-- <td class="group"><?= $row['gr_id'] ?></td> -->
                                <td class="debit_amount text-right">
                                    <?php if ($row['account'] == 'Goods Receipt' || $row['account'] == 'Deferred Expanded Withholding Tax Payable' || ($row['type'] == 1 && $row['account'] != 'Deferred Input VAT')): ?>
                                        <input type="text" class="debit-amount-input" value="<?= abs($row['amount']) ?>" oninput="updateAmount(this)">
                                        <input type="hidden" name="gtype[]" value="1">
                                        <?php else : ?>
                                        <input type="text" class="debit-amount-input" value="" oninput="updateAmount(this)">
                                    <?php endif; ?>
                                </td>
                                <td class="credit_amount text-right">
                                    <?php if ($row['type'] == 2 && $row['account'] != 'Goods Receipt' && $row['account'] != 'Deferred Expanded Withholding Tax Payable' || $row['account'] == 'Deferred Input VAT') : ?>
                                        <input type="text" class="credit-amount-input" value="<?= abs($row['amount']) ?>" oninput="updateAmount(this)">
                                        <input type="hidden" name="gtype[]" value="2">
                                    <?php else : ?>
                                        <input type="text" class="credit-amount-input" value="" oninput="updateAmount(this)">
                                    <?php endif; ?>
                                </td>

                            </tr>
                            <?php 
                            if ($row['type'] == 2) {
                                $totalCredit += $row['amount'];
                            }
                            if ($row['type'] == 1) {
                                $totalDebit += $row['amount'];
                            }
                            ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">
                                    <button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1 add_row" data-gr-id="<?= $grId ?>" type="button">Add Row</button>
                                    TOTAL
                                </th>
                                <th class="text-right total_debit">0.00</th>
                                <th class="text-right total_credit">0.00</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center"></th>
                                <th colspan="2" class="text-center total-balance">0</th>
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
function updateDueDate() {
    var termsId = $('#termsTextbox').val();

    $.ajax({
        type: 'POST',
        url: 'journals/get_terms.php',
        data: { termsId: termsId },
        success: function(response) {
                try {
                    var data = JSON.parse(response);
                    var billDateInput = $('#bill_date');
                    var dueDateInput = $('#due_date');  
                    var pterms = $('#p_terms');
                    var daysToAdd = parseInt(data.days_before_due);
                    var daysInMonth = parseInt(data.days_in_following_month);
                    if (!billDateInput.val()) {
                  
                    alert('Please provide a billing date.');
                    return;
                }
                    if (daysToAdd === 0) {
                        daysToAdd = parseInt(data.days_in_following_month);
                    }

                    if (daysInMonth === 0) {
                        daysToAdd = parseInt(data.days_before_due);
                    }

                    if (daysToAdd === 0 && parseInt(data.days_in_following_month) === 0) {
                        var currentDate = new Date();
                        daysToAdd = 0;
                        pterms.val(data.terms);
                        return;
                    }

                    console.log("DAYS TO ADD", daysToAdd);

                    var userProvidedBillDate = new Date(billDateInput.val());

                    var dueDate = new Date(userProvidedBillDate);
                    dueDate.setDate(userProvidedBillDate.getDate() + daysToAdd);

                    dueDateInput.val(dueDate.toISOString().split('T')[0]);

                    pterms.val(data.terms);

                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                }

        },
        error: function(xhr, status, error) {
            console.error('Error in AJAX request:', xhr.responseText);
        }
    });
}
function cal_tb(account_list_<?= $grId ?>) {
    var debit = 0;
    var credit = 0;

    $('#' + account_list_<?= $grId ?> + ' tbody tr').each(function () {
        debit += parseFloat($(this).find('.debit-amount-input').val()) || 0;
        credit += parseFloat($(this).find('.credit-amount-input').val()) || 0;
    });

    $('#' + account_list_<?= $grId ?>).find('.total_debit').text(debit.toFixed(2));
    $('#' + account_list_<?= $grId ?>).find('.total_credit').text(credit.toFixed(2));
    $('#' + account_list_<?= $grId ?>).find('.total-balance').text((debit - credit).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));


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

    $('.main_total_debit').text(grandTotalDebit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('.main_total_credit').text(grandTotalCredit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
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
    $('#bill_date').on('change', function () {
       updateDueDate();
    });
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
                urlSuffix = "modify_voucher";
            <?php } else{ ?>
                urlSuffix = "save_voucher";
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
