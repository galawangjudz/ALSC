<?php
require_once('../../../config.php');
if (isset($_POST['gr_id'])) {
    $gr_id = $_POST['gr_id'];
}
?>
<!-- <script>
function handleAccountSelectChange() {
    var selectedOption = $(this).find(':selected');
    var type = selectedOption.data('type');
    var $row = $(this).closest('tr');
    var $debitInput = $row.find('.debit_amount');
    var $creditInput = $row.find('.credit_amount');
    // if (type == 1) {
    //     $creditInput.prop('disabled', true);
    //     $debitInput.prop('disabled', false);
    // } else if (type == 2) {
    //     $debitInput.prop('disabled', true);
    //     $creditInput.prop('disabled', false);
    // } else {
    //     $debitInput.prop('disabled', false);
    //     $creditInput.prop('disabled', false);
    // }
}
$(document).on('change', '.accountSelect', handleAccountSelectChange);

$('.accountSelect').each(function () {
    handleAccountSelectChange.call(this);
});

</script> -->

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
    echo $publicId;
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
    echo "<strong><i>GR #:</i></strong> " . "<strong><i>" . $gr_id . "</i></strong>";
}
?>
<body>
<table class="table-bordered tbl_acc" style="width: 100%" data-gr-id="<?php echo $gr_id; ?>" id="account_list_<?= $gr_id ?>" >
<colgroup>
        <col style="width: 10%;">
        <col style="width: 10%;">
        <col style="width: 30%;">
        <col style="width: 30%;">
        <col style="width: 10%;">
        <col style="width: 10%;">
    </colgroup>
    <thead>
        <tr>
            <th class="text-center"></th>
            <th class="text-center">Account Code</th>
            <th class="text-center">Account Name</th>
            <th class="text-center">Location</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $id = $gr_id;
    $query = "SELECT gt.amount, gt.account, gt.item_code,al.name,al.id AS alId, gl.id AS glId,gl.type
    FROM tbl_gl_trans gt INNER JOIN
    account_list al ON gt.account = al.code 
    INNER JOIN group_list gl ON al.group_id = gl.id 
    WHERE gt.gr_id = $gr_id";
    $qry = $conn->query($query);
    while ($row = $qry->fetch_assoc()):
        $account_code = $row['account']; 
        $account_name = $row['name'];
        $alId = $row['alId'];
        $glId = $row['glId'];
        $glType = $row['type'];
        $amount = $row['amount'];

        $allowed_accounts = [
            'Goods Receipt'
        ];

        if($account_name == 'Goods Receipt'){
            $n_apTotal = $row['amount'];
        }

        if (!in_array($account_name, $allowed_accounts)) {
            continue; 
        }
       ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" value="<?php echo $account_code ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
            <input type="hidden" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <input type="hidden" name="account_code[]" value="<?php echo $row['account'] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo abs($amount); ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $gr_id ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

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
            <?php if ($account_name == 'Goods Receipt' || $account_name == 'Deferred Expanded Withholding Tax Payable' || ($glType == 1 && $account_name != 'Deferred Input VAT')): ?>
                <input type="text" class="debit_amount" value="<?php echo number_format(abs($amount), 2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="1">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
        <td class="credit_amount text-right">
            <?php if ($glType == 2 && $account_name != 'Goods Receipt' && $account_name != 'Deferred Expanded Withholding Tax Payable' || $account_name == 'Deferred Input VAT') : ?>
                <input type="text" class="credit_amount" value="<?php echo number_format(abs($amount), 2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="2">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>


    <?php 
    $id = $gr_id;
    $query = "SELECT po.po_no, po.vatable, gt.amount, gt.account, gt.item_code, al.name,al.id AS alId, gl.id AS glId,gl.type
    FROM tbl_gl_trans gt INNER JOIN
    account_list al ON gt.account = al.code 
    INNER JOIN po_approved_list po ON
    po.po_no = gt.po_id
    INNER JOIN group_list gl ON al.group_id = gl.id 
    WHERE gt.gr_id = $gr_id";
    $qry = $conn->query($query);
    while ($row = $qry->fetch_assoc()):
        $account_code = $row['account']; 
        $account_name = $row['name'];
        $alId = $row['alId'];
        $glId = $row['glId'];
        $glType = $row['type'];
        $amount = $row['amount'];
        $vat = $row['vatable'];
        $po_no = $row['po_no'];

        if($account_name == 'Goods Receipt'){
            $n_apTotal = $row['amount'];
            continue;
        }
        if($account_name == 'Deferred Input VAT'){
             $iEWT = $row['amount'];
        }
        
        if($account_name == 'Deferred Expanded Withholding Tax Payable'){
            $e_total = $row['amount'];
        }
        if ($account_name === 'Deferred Input VAT') {
            continue; 
        }
        $allowed_accounts = [
            
            'Goods Receipt',
            'Input VAT',
            'Deferred Expanded Withholding Tax Payable',
            'Accounts Payable Trade',
            'Deferred Input VAT',
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
        <td class="account_code"><input type="text" value="<?php echo $account_code ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
            <input type="hidden" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <input type="hidden" name="account_code[]" value="<?php echo $row['account'] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo abs($amount); ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $gr_id ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

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
            <?php if ($account_name == 'Goods Receipt' || $account_name == 'Deferred Expanded Withholding Tax Payable' || ($glType == 1 && $account_name != 'Deferred Input VAT')): ?>
                <input type="text" class="debit_amount" value="<?php echo number_format(abs($amount), 2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="1">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
        <td class="credit_amount text-right">
            <?php if ($glType == 2 && $account_name != 'Goods Receipt' && $account_name != 'Deferred Expanded Withholding Tax Payable' || $account_name == 'Deferred Input VAT') : ?>
                <input type="text" class="credit_amount" value="<?php echo number_format(abs($amount), 2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="2">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    <?php 
    if($vat == 1 || $vat == 2){
    $id = $gr_id;
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
    <input type="hidden" value="<?php echo $vat ?>">
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" value="<?php echo $row_iv["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
            <input type="hidden" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <input type="hidden" name="account_code[]" value="<?php echo $row_iv["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo abs($iEWT); ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();
                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $gr_id ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>
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
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format(abs($iEWT),2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="1">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format(abs($iEWT),2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="2">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    <?php }; ?>
    <?php 
    $id = $gr_id;
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
        <td class="account_code"><input type="text" value="<?php echo $row_ap["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
            <input type="hidden" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <input type="hidden" name="account_code[]" value="<?php echo $row_ap["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo abs($n_apTotal) ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $gr_id ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

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
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format(abs($n_apTotal),2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="1">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format(abs($n_apTotal),2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="2">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

    <?php 
    if($vat == 1 || $vat == 2){
    $id = $gr_id;
    $query = "SELECT gt.amount, gt.account, gt.item_code,al.name,al.id AS alId, gl.id AS glId,gl.type
    FROM tbl_gl_trans gt INNER JOIN
    account_list al ON gt.account = al.code 
    INNER JOIN group_list gl ON al.group_id = gl.id 
    WHERE gt.gr_id = $gr_id";
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
        <td class="account_code"><input type="text" value="<?php echo $account_code ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
            <input type="hidden" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <input type="hidden" name="account_code[]" value="<?php echo $row['account'] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo abs($amount); ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $gr_id ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

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
            <?php if ($account_name == 'Goods Receipt' || $account_name == 'Deferred Expanded Withholding Tax Payable' || ($glType == 1 && $account_name != 'Deferred Input VAT')): ?>
                <input type="text" class="debit_amount" value="<?php echo number_format(abs($amount), 2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="1">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
        <td class="credit_amount text-right">
            <?php if ($glType == 2 && $account_name != 'Goods Receipt' && $account_name != 'Deferred Expanded Withholding Tax Payable' || $account_name == 'Deferred Input VAT') : ?>
                <input type="text" class="credit_amount" value="<?php echo number_format(abs($amount), 2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="2">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    <?php }; ?>      

    <?php 
    $id = $gr_id;
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
        <td class="account_code"><input type="text" value="<?php echo $row_ewt["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">
            <input type="hidden" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($po_no) ? $po_no : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <input type="hidden" name="account_code[]" value="<?php echo $row_ewt["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo abs($e_total); ?>" class="amount-textbox">
            <span class="type" style="display:none;"><?= $glType ?></span>
            <select id="account_id[]" class="form-control form-control-sm form-control-border select2 accountSelect">
                <option value="" disabled selected></option>
                <?php 
                $accounts = $conn->query("SELECT a.*, g.name AS gname, g.type FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY gname, a.name;");
                $currentGroup = null;
                $groupedAccounts = array();

                while($account = $accounts->fetch_assoc()):
                ?>
                    <option value="<?= $account['id'] ?>" data-gr-id="<?= $gr_id ?>" data-group-id="<?= $account['group_id'] ?>" data-type="<?= $account['type'] ?>" data-account-code="<?= $account['code'] ?>" data-account-id="<?= $account['id'] ?>" data-amount="" <?= ($alId == $account['id']) ? 'selected' : '' ?>><?= $account['name'] ?></option>

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
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format(abs($e_total),2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="1">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format(abs($e_total),2) ?>" oninput="updateAmount(this)">
                <input type="hidden" name="gtype[]" value="2">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
      
</tbody>
<tfoot>
    <tr>
        <td colspan="4">
            <button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1 add_row" data-gr-id="<?= $gr_id ?>" type="button">Add Row</button>
            <strong>Total</strong>
        </td>
        <td class="text-right" id="total-debit"></td>
        <td class="text-right" id="total-credit"></td>
    </tr>
</tfoot>

</table>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    updateTotalsAfterRowDeletion(grId);
});
$(document).ready(function () {
    $('#account_list_<?= $gr_id ?>').on('change', '.accountSelect', function () {
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
    $('.add_row[data-gr-id="<?= $gr_id ?>"]').click(function () {
        var table = $('#account_list_<?= $gr_id ?>');
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
        clone.find('.accountSelect').change(function () {
            var selectedOption = $(this).find(':selected');
            var currentRow = $(this).closest('tr');
            var accountInfo = currentRow.find('.accountInfo');

            currentRow.find('.account_code input[name="account_code[]"]').val(selectedOption.data('account-code'));
        });

        clone.find('.delete-row').click(function () {
            var deletedRow = $(this).closest('tr');
            var grId = deletedRow.closest('table').data('gr-id');

            console.log('Deleted Row Number:', deletedRow.index() + 1);

            deletedRow.remove();
            updateTotalsAfterRowDeletion(grId);
            console.log(grId);
        });
    });
});
</script>

<script>
    $(document).ready(function () {
        $(".accountSelect").change(function () {

            var selectedAccountCode = $(this).find(":selected").data("account-code");


            var accountCodeInput = $(this).closest('.accountInfo').prev('.account_code').find("input[name='account_code[]']");

            accountCodeInput.val(selectedAccountCode);
        });
    });
</script>
<script>
$(document).off('click', '.delete-row').on('click', '.delete-row', function () {
    var deletedRow = $(this).closest('tr');
    var grId = deletedRow.closest('table').data('gr-id');

    console.log('Deleted Row Number:', deletedRow.index() + 1);

    deletedRow.remove();
    updateTotalsAfterRowDeletion(grId);
    console.log(grId);
});

function updateTotalsAfterRowDeletion(grId) {
    let totalCredit = 0;
    let totalDebit = 0;

    $('table[data-gr-id="' + grId + '"] .debit_amount').each(function () {
        totalDebit += parseFloat($(this).val().replace(/,/g, '')) || 0;
    });

    $('table[data-gr-id="' + grId + '"] .credit_amount').each(function () {
        totalCredit += parseFloat($(this).val().replace(/,/g, '')) || 0;
    });

    $('table[data-gr-id="' + grId + '"] tfoot #total-debit').text(totalDebit.toFixed(2));
    $('table[data-gr-id="' + grId + '"] tfoot #total-credit').text(totalCredit.toFixed(2));
}
</script>
<script>
function updateAmount(input) {
    var inputValue = parseFloat($(input).val().replace(/,/g, '')) || 0;
    var amountTextbox = $(input).closest('tr').find('.amount-textbox');
    $(amountTextbox).val(inputValue);

    var table = $(input).closest('table');

    var totalDebit = 0;
    var totalCredit = 0;

    table.find('.debit_amount').each(function () {
        var value = parseFloat($(this).val().replace(/,/g, '')) || 0;
        totalDebit += value;
    });

    table.find('.credit_amount').each(function () {
        var value = parseFloat($(this).val().replace(/,/g, '')) || 0;
        totalCredit += value;
    });

    table.find('#total-debit').text(totalDebit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    table.find('#total-credit').text(totalCredit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ''));
}
</script>
