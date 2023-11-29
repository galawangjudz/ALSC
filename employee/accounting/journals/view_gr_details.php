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
    } else {
        echo "No data found for GR ID: $gr_id";
    }

    $qry = $conn->query("SELECT * from approved_order_items where gr_id = '{$gr_id}'");

    if ($qry->num_rows > 0) {
        $totalCredit = 0;
        $totalDebit = 0;
        $ewtSub = 0;

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
<table class="table-bordered" style="width: 100%" data-gr-id="<?php echo $gr_id; ?>">
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

        if ($ilType == 1){
            $ewt = $total * 0.01;
        }else if($ilType == 2){
            $ewt = $total * 0.02;
        }
        else{
            $ewt = 0;
        }

        if ($glType == 1) {
            $totalDebit += $total;
        } elseif ($glType == 2) {
            $totalCredit += $total;
        }

        $ewtSub += $ewt;
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td>
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $total; ?>">
            <input type="text" name="account[]" value="<?php echo $account_name; ?>">
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
            ?> EWT = <?= $ewt; ?>
        </td>

        <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td>
    </tr>
    <?php endwhile; ?>        

    <?php 
    $id = $gr_id;
    $query_vat = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '1201';
    ";

    $qry_vat = $conn->query($query_vat);
    while ($row_vat = $qry_vat->fetch_assoc()):
        $groupname = $row_vat['group_name'];
        $glId = $row_vat['group_id'];
        $alId = $row_vat['id'];
        $glType = $row_vat['type'];
        $account_name = $row_vat['name'];

        if ($vat == 2){
            $total_vat = $totalDebit * 0.12;
        }elseif($vat == 1){
            $vat_partial = $totalDebit / 1.12;
            $total_vat = $vat_partial * 0.12;
        }else{
            $total_vat = 0;
        }
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_vat["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td>
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_vat["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $total_vat; ?>">
            <input type="text" name="account[]" value="<?php echo $account_name; ?>">
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
        <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total_vat,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total,2) : '' ?></td>
    </tr>
    <?php endwhile; ?>
    
    <?php 
    $id = $gr_id;
    $query_ewt = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '2118';
    ";

    $qry_ewt = $conn->query($query_ewt);
    while ($row_ewt = $qry_ewt->fetch_assoc()):
        $groupname = $row_ewt['group_name'];
        $glId = $row_ewt['group_id'];
        $alId = $row_ewt['id'];
        $glType = $row_ewt['type'];
        $account_name = $row_ewt['name'];

        $total_ewt = ($totalDebit) * 0.01;

        // if ($vat == 2){
        //     $total_vat = $totalDebit * 0.12;
        // }elseif($vat == 1){
        //     $vat_partial = $totalDebit / 1.12;
        //     $total_vat = $vat_partial * 0.12;
        // }
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_ewt["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td>
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ewt["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $total_ewt; ?>">
            <input type="text" name="account[]" value="<?php echo $account_name; ?>">
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
        <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($ewtSub,2) : '' ?></td>
    </tr>
    <?php endwhile; ?>

    <?php 
    $id = $gr_id;
    $query_ap = "SELECT al.*, gl.id as glId,gl.name as group_name, gl.type
    FROM `account_list` al
    JOIN `group_list` gl ON al.group_id = gl.id
    WHERE al.code = '2001';
    ";

    $qry_ap = $conn->query($query_ap);
    while ($row_ap = $qry_ap->fetch_assoc()):
        $groupname = $row_ap['group_name'];
        $glId = $row_ap['group_id'];
        $alId = $row_ap['id'];
        $glType = $row_ap['type'];
        $account_name = $row_ap['name'];

      
        $total_ap = ($totalDebit + $total_vat) - $total_ewt;
        // if ($vat == 2){
        //     $total_vat = $totalDebit * 0.12;
        // }elseif($vat == 1){
        //     $vat_partial = $totalDebit / 1.12;
        //     $total_vat = $vat_partial * 0.12;
        // }
    ?>
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="<?php echo $row_ap["code"] ?>" style="border:none;background-color:transparent;" readonly></td>
            <td>
            <input type="hidden" name="gr_id[]" value="<?php echo $gr_id ?>">
            <input type="hidden" name="account_code[]" value="<?php echo $row_ap["code"] ?>">
            <input type="hidden" name="account_id[]" value="<?php echo $alId; ?>">
            <input type="hidden" name="group_id[]" value="<?php echo $glId; ?>">
            <input type="hidden" name="amount[]" value="<?php echo $total_ap; ?>">
            <input type="text" name="account[]" value="<?php echo $account_name; ?>">
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
        <td class="debit_amount text-right"><?= $glType == 1 ? number_format($total,2) : '' ?></td>
        <td class="credit_amount text-right"><?= $glType == 2 ? number_format($total_ap,2) : '' ?></td>
    </tr>
    <?php endwhile; ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="5"><strong>Total</strong></td>
        <td class="text-right" id="total-debit"><?= number_format($totalDebit + $total_vat, 2) ?></td>
        <td class="text-right" id="total-credit"><?= number_format($totalCredit + $total_ewt + $total_ap,2); ?></td>
    </tr>
</tfoot>
</table>
<script>
   function updateTotals(totalCredit, totalDebit) {
    $('#total-credit').text(totalCredit.toFixed(2));
    $('#total-debit').text(totalDebit.toFixed(2));
}

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
        totalDebit += parseFloat($(this).text()) || 0;
    });

    $('table[data-gr-id="' + grId + '"] .credit_amount').each(function () {
        totalCredit += parseFloat($(this).text()) || 0;
    });

    $('table[data-gr-id="' + grId + '"] tfoot #total-debit').text(totalDebit.toFixed(2));
    $('table[data-gr-id="' + grId + '"] tfoot #total-credit').text(totalCredit.toFixed(2));

    urlSuffix = "save_journal";
    $.ajax({
        type: 'POST',
        url: _base_url_ + "classes/Master.php?f=" + urlSuffix,
        data: {
            grId: grId,
            totalCredit: totalCredit,
            totalDebit: totalDebit
        },
        success: function (response) {
            console.log('Totals updated on the server:', response);
        },
        error: function (error) {
            console.error('Error updating totals on the server:', error);
        }
    });
}


</script>

