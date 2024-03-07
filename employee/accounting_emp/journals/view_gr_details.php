<?php
require_once('../../../config.php');
if (isset($_POST['gr_id'])) {
    $gr_id = $_POST['gr_id'];
    $supplierId = $_POST['supplier_id'];

    $query1 = $conn->query("SELECT vatable from supplier_list where id = '{$supplierId}'");
    if ($query1->num_rows > 0) {

        $row1 = $query1->fetch_assoc(); 
        $vat = $row1['vatable'];

        echo "<br><b>GR #: </b><i> $gr_id</i>";
        echo "<br><b>Vat(%): </b><i> $vat</i>";
    } else {
        echo "No data found for GR ID: $gr_id";
    }

    $qry = $conn->query("SELECT * from approved_order_items where gr_id = '{$gr_id}'");

    if ($qry->num_rows > 0) {
        $totalCredit = 0;
        $totalDebit = 0;
        $iVAT = 0;
        $iEWT = 0;
        $subEWT = 0;
        $subEWTTotal = 0;
        $iTotal = 0;
        $n_apTotal = 0;

        while ($row2 = $qry->fetch_assoc()) {
            foreach ($row2 as $k => $v) {
                $$k = $v;
            }
        }
    } else {
        echo "No data found for GR ID: $gr_id";
    }
} else {
    echo "GR ID not provided in the request";
}

?>
<script>
  
function handleAccountSelectChange() {
    var selectedOption = $(this).find(':selected');
    var type = selectedOption.data('type');

    var $row = $(this).closest('tr');
    var $debitInput = $row.find('.debit_amount');
    var $creditInput = $row.find('.credit_amount');

    if (type == 1) {
        $creditInput.prop('disabled', true);
        $debitInput.prop('disabled', false);
    } else if (type == 2) {
        $debitInput.prop('disabled', true);
        $creditInput.prop('disabled', false);
    } else {
        $debitInput.prop('disabled', false);
        $creditInput.prop('disabled', false);
    }
}

$(document).on('change', '.accountSelect', handleAccountSelectChange);


$('.accountSelect').each(function () {
    handleAccountSelectChange.call(this);
});

</script>
<?php
if ($vat == 1){ ?>
<table class="table-bordered tbl_acc" style="width: 100%" data-gr-id="<?php echo $gr_id; ?>" id="account_list_<?= $gr_id ?>" >
    <colgroup>
        <col width="5%">
        <!-- <col width="5%"> -->
        <col width="10%">
        <col width="20%">
        <col width="30%">
        <!-- <col width="10%"> -->
        <col width="10%">
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
            <th class="text-center">Item Type</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
        </tr>
    </thead>

    <tbody>
        
    <?php 
    $id = $gr_id;
    $query = "SELECT 
        il.type AS ilType,
        gl.id AS glId,al.id AS alId,
        al.code,ao.unit_price,ao.received,
        al.name AS account_name,
        gl.name AS group_name,
        gl.type
    FROM 
        approved_order_items ao
    INNER JOIN 
        item_list il ON ao.item_id = il.id
    INNER JOIN 
        account_list al ON il.account_code = al.code
    INNER JOIN 
        group_list gl ON al.group_id = gl.id
    WHERE 
        ao.gr_id = $gr_id";


    $qry = $conn->query($query);
    while ($row = $qry->fetch_assoc()):
        $groupname = $row['group_name'];
        $glId = $row['glId'];
        $alId = $row['alId'];
        $glType = $row['type'];
        $account_name = $row['account_name'];
        $ilType = $row['ilType'];

        $total = $row["unit_price"] * $row["received"];


        $item_vat = (($total/1.12)*0.12);
       
        $iVAT += $item_vat;
        
        /////////////////////////////////////
        if ($ilType == 1){
            //$ewt = number_format((($total - $total_vat) * 0.01),2);
            $ewt = (($total - $item_vat) * 0.01);
           
        }else if($ilType == 2){
            //$ewt = number_format((($total - $total_vat) * 0.02),2);
            $ewt = (($total - $item_vat) * 0.02);
        }
        else{
            $ewt = 0;
        }

        /////////////////////////////////////
        if ($glType == 1) {
            $totalDebit += $total;
        } elseif ($glType == 2) {
            $totalCredit += $total;
        }
        $iEWT += $ewt;
        $subEWT = $total - $item_vat;
        $iTotal += ($item_vat + $subEWT);
        $subEWTTotal += $subEWT;
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $subEWT; ?>" class="amount-textbox">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td class="gl_type">
            <?php
            if ($ilType == 1) {
                echo "Goods";
            } else {
                echo "Service";
            }
            ?> VAT = <?= $item_vat; ?>   SUBTOTAL EWT = <?= number_format($ewt,2); ?> 
        </td>

        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($subEWT,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($subEWT,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>        

    <?php 
    $id = $gr_id;
    $query_vat = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '11076';
    ";

    $qry_vat = $conn->query($query_vat);
    while ($row_vat = $qry_vat->fetch_assoc()):
        $groupname = $row_vat['group_name'];
        $glId = $row_vat['group_id'];
        $alId = $row_vat['id'];
        $glType = $row_vat['type'];
        $account_name = $row_vat['name'];
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_vat["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_vat["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $iVAT; ?>" class="amount-textbox">
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
        <td></td>
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($iVAT,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($iVAT,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    
    <?php 
    $id = $gr_id;
    $query_ewt = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '21012';
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
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td></td>
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($iEWT,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
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
    $id = $gr_id;
    $query_ap = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '21002';
    ";

    $qry_ap = $conn->query($query_ap);
    while ($row_ap = $qry_ap->fetch_assoc()):
        $groupname = $row_ap['group_name'];
        $glId = $row_ap['group_id'];
        $alId = $row_ap['id'];
        $glType = $row_ap['type'];
        $account_name = $row_ap['name'];

      
        $apTotal = ($subEWTTotal + $iVAT) - $iEWT;
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_ap["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ap["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $apTotal; ?>" class="amount-textbox">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td></td>
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($apTotal,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($apTotal,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="5"><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1 add_row" data-gr-id="<?= $gr_id ?>" type="button">Add Row</button><strong>Total</strong></td>
        <td class="text-right" id="total-debit"><?= number_format($totalDebit, 2) ?></td>
        <td class="text-right" id="total-credit"><?= number_format($totalCredit + ($apTotal + $iEWT),2); ?></td>
    </tr>
</tfoot>
</table>
<script>
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
<?php }else if($vat == 2){ ?>
    <table class="table-bordered tbl_acc" style="width: 100%" data-gr-id="<?php echo $gr_id; ?>" id="account_list_<?= $gr_id ?>" >
    <colgroup>
        <col width="5%">
        <!-- <col width="5%"> -->
        <col width="10%">
        <col width="20%">
        <col width="30%">
        <!-- <col width="10%"> -->
        <col width="10%">
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
            <th class="text-center">Item Type</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
        </tr>
    </thead>

    <tbody>
        
    <?php 
    $id = $gr_id;
    $e_query = "SELECT 
        il.type AS ilType,
        gl.id AS glId,al.id AS alId,
        al.code,ao.unit_price,ao.received,
        al.name AS account_name,
        gl.name AS group_name,
        gl.type
    FROM 
        approved_order_items ao
    INNER JOIN 
        item_list il ON ao.item_id = il.id
    INNER JOIN 
        account_list al ON il.account_code = al.code
    INNER JOIN 
        group_list gl ON al.group_id = gl.id
    WHERE 
        ao.gr_id = $gr_id";


    $e_qry = $conn->query($e_query);
    while ($e_row = $e_qry->fetch_assoc()):
        $groupname = $e_row['group_name'];
        $glId = $e_row['glId'];
        $alId = $e_row['alId'];
        $glType = $e_row['type'];
        $account_name = $e_row['account_name'];
        $ilType = $e_row['ilType'];

        $e_total = $e_row["unit_price"] * $e_row["received"];

        $e_item_vat = ($e_total*0.12);
       
        $iVAT += $e_item_vat;
        
        /////////////////////////////////////
        if ($ilType == 1){
            $e_ewt = $e_total * 0.01;
           
        }else if($ilType == 2){
            $e_ewt = $e_total * 0.02;
        }
        else{
            $e_ewt = 0;
        }

        /////////////////////////////////////
        if ($glType == 1) {
            $totalDebit += $e_total;
        } elseif ($glType == 2) {
            $totalCredit += $e_total;
        }
        $iEWT += $e_ewt;
        //$subEWT = $e_total - $e_item_vat;
        $iTotal += ($e_item_vat);
        //$subEWTTotal += $subEWT;
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $e_row["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $e_row["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $e_total; ?>" class="amount-textbox">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td class="gl_type">
            <?php
            if ($ilType == 1) {
                echo "Goods";
            } else {
                echo "Service";
            }
            ?> VAT = <?= $e_item_vat; ?>   SUBTOTAL EWT = <?= number_format($e_ewt,2); ?> 
        </td>

        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($e_total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($e_total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>        

    <?php 
    $id = $gr_id;
    $query_vat = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '11076';
    ";

    $qry_vat = $conn->query($query_vat);
    while ($row_vat = $qry_vat->fetch_assoc()):
        $groupname = $row_vat['group_name'];
        $glId = $row_vat['group_id'];
        $alId = $row_vat['id'];
        $glType = $row_vat['type'];
        $account_name = $row_vat['name'];

    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_vat["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_vat["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $iVAT; ?>" class="amount-textbox">
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
        <td></td>
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($iVAT,2) : '' ?></td>accountSelectupdateppp
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($iVAT,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
    
    <?php 
    $id = $gr_id;
    $query_ewt = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '21012';
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
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td></td>
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($e_total,2) : '' ?></td>
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
                <input type="text" class="credit_amount" value="<?= number_format($iEWT,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>

    <?php 
    $id = $gr_id;
    $query_ap = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '21002';
    ";

    $qry_ap = $conn->query($query_ap);
    while ($row_ap = $qry_ap->fetch_assoc()):
        $groupname = $row_ap['group_name'];
        $glId = $row_ap['group_id'];
        $alId = $row_ap['id'];
        $glType = $row_ap['type'];
        $account_name = $row_ap['name'];

      
        $e_apTotal = ($e_total + $iVAT) - $iEWT;
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_ap["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
        <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ap["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $e_apTotal; ?>" class="amount-textbox">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td></td>
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($e_total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($e_apTotal,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($e_total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($e_apTotal,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="5"><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1 add_row" data-gr-id="<?= $gr_id ?>" type="button">Add Row</button><strong>Total</strong></td>
            <td class="text-right" id="total-debit"><?= number_format($totalDebit + $iVAT, 2) ?></td>
            <td class="text-right" id="total-credit"><?= number_format($totalCredit + ($e_apTotal + $iEWT),2); ?></td>
    </tr>
</tfoot>
</table>
<script>
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

            // Update the account_code outside the accountInfo
            currentRow.find('.account_code input[name="account_code[]"]').val(selectedOption.data('account-code'));

            // Your existing code for updating other fields in the accountInfo
        });

        clone.find('.delete-row').click(function () {
            $(this).closest('tr').remove();
        });
    });
});
</script>
<?php }else if($vat == 0 || $vat == 3){ ?>
    <table class="table-bordered tbl_acc" style="width: 100%" data-gr-id="<?php echo $gr_id; ?>" id="account_list_<?= $gr_id ?>" >
    <colgroup>
        <col width="5%">
        <!-- <col width="5%"> -->
        <col width="10%">
        <col width="20%">
        <col width="30%">
        <!-- <col width="10%"> -->
        <col width="10%">
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
            <th class="text-center">Item Type</th>
            <th class="text-center">Debit</th>
            <th class="text-center">Credit</th>
        </tr>
    </thead>

    <tbody>
        
    <?php 
    $id = $gr_id;
    $n_query = "SELECT 
        il.type AS ilType,
        gl.id AS glId,al.id AS alId,
        al.code,ao.unit_price,ao.received,
        al.name AS account_name,
        gl.name AS group_name,
        gl.type
    FROM 
        approved_order_items ao
    INNER JOIN 
        item_list il ON ao.item_id = il.id
    INNER JOIN 
        account_list al ON il.account_code = al.code
    INNER JOIN 
        group_list gl ON al.group_id = gl.id
    WHERE 
        ao.gr_id = $gr_id";


    $n_qry = $conn->query($n_query);
    while ($n_row = $n_qry->fetch_assoc()):
        $groupname = $n_row['group_name'];
        $glId = $n_row['glId'];
        $alId = $n_row['alId'];
        $glType = $n_row['type'];
        $account_name = $n_row['account_name'];
        $ilType = $n_row['ilType'];

        $n_total = $n_row["unit_price"] * $n_row["received"];

        //$e_item_vat = ($e_total*0.12);
       
        //$iVAT += $e_item_vat;
        
        /////////////////////////////////////
        if ($ilType == 1){
            $n_ewt = $n_total * 0.01;
           
        }else if($ilType == 2){
            $n_ewt = $n_total * 0.02;
        }
        else{
            $n_ewt = 0;
        }

        /////////////////////////////////////
        if ($glType == 1) {
            $totalDebit += $n_total;
        } elseif ($glType == 2) {
            $totalCredit += $n_total;
        }
        $iEWT += $n_ewt;
        $n_apTotal += ($n_total);
        //$subEWT = $e_total - $e_item_vat;
        //$iTotal += ($n_item_vat);
        //$subEWTTotal += $subEWT;
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $n_row["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td class="accountInfo">
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $n_row["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $n_total; ?>" class="amount-textbox">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td class="gl_type">
            <?php
            if ($ilType == 1) {
                echo "Goods = " . $n_ewt;
            } else {
                echo "Service " . $n_ewt;
            }?>
        </td>

        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($n_total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($n_total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>        

    <?php 
    $id = $gr_id;
    $query_ewt = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '21012';
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
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td></td>
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($n_total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($iEWT,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($n_total,2) ?>" oninput="updateAmount(this)">
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
    $id = $gr_id;
    $query_ap = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '21002';
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
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ap["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $n_apTotal - $iEWT; ?>" class="amount-textbox">
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
        <!-- <td class="group_name"><input type="text" name="group[]" value="<?php echo $groupname; ?>"></td> -->
        <td></td>
        <!-- <td class="debit_amount text-right"><?= $glType == 1 ? number_format($e_total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($n_apTotal - $iEWT ,2) : '' ?></td> -->
        <td class="debit_amount text-right">
            <?php if ($glType == 1) : ?>
                <input type="text" class="debit_amount" value="<?= number_format($e_total,2) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="debit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>

        <td class="credit_amount text-right">
            <?php if ($glType == 2) : ?>
                <input type="text" class="credit_amount" value="<?= number_format($n_apTotal - $iEWT) ?>" oninput="updateAmount(this)">
            <?php else : ?>
                <input type="text" class="credit_amount" value="" oninput="updateAmount(this)">
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="5"><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1 add_row" data-gr-id="<?= $gr_id ?>" type="button">Add Row</button><strong>Total</strong></td>
            <td class="text-right" id="total-debit"><?= number_format($totalDebit, 2) ?></td>
            <td class="text-right" id="total-credit"><?= number_format($totalCredit + ($n_apTotal),2); ?></td>
    </tr>
</tfoot>
</table>
<script>
function handleAccountSelectChange() {
    var selectedOption = $(this).find(':selected');
    var type = selectedOption.data('type');

    var $row = $(this).closest('tr');
    var $debitInput = $row.find('.debit_amount');
    var $creditInput = $row.find('.credit_amount');

    if (type == 1) {
        $creditInput.prop('disabled', true);
        $debitInput.prop('disabled', false);
    } else if (type == 2) {
        $debitInput.prop('disabled', true);
        $creditInput.prop('disabled', false);
    } else {
        $debitInput.prop('disabled', false);
        $creditInput.prop('disabled', false);
    }
}

$(document).on('change', '.accountSelect', handleAccountSelectChange);


$('.accountSelect').each(function () {
    handleAccountSelectChange.call(this);
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
            $(this).closest('tr').remove();
        });
    });
});
</script>
<?php } ?>
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
