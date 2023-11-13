<?php 
require_once('../../config.php');
$userid = $_settings->userdata('user_code');
$account_arr = [];
$group_arr = [];
$due_date = date('Y-m-d', strtotime('+1 week'));
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `vs_entries` where id = '{$_GET['id']}'");
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

    $qry = $conn->query("SELECT id FROM `vs_entries` WHERE id = $existing_v_id");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $v_number = $row['id'];
        $is_new_vn = false;
    } else {
        $v_number = 'Selected voucher not found';
    }
} else {
    $qry = $conn->query("SELECT MAX(id) AS max_id FROM `vs_entries`");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $next_v_number = $row['max_id'] + 1;
    } else {
        $next_v_number = 1;
    }
    $v_number = str_pad($next_v_number, 3, '0', STR_PAD_LEFT);
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
</style>
<head>
    <script>
        window.addEventListener('load', function () {
        var empDiv = document.getElementById('emp-div');
        var agentDiv = document.getElementById('agent-div');
        var supDiv = document.getElementById('sup-div');

        var supId = document.getElementById('supplier_id');
        var agentId = document.getElementById('agent_id');
        var empId = document.getElementById('emp_id');

        var supCode = document.getElementById('sup_code');
        var agentCode = document.getElementById('agent_code');
        var empCode = document.getElementById('emp_code');

        var paidToValue = <?php echo isset($paid_to) ? $paid_to : 0; ?>;

        empDiv.classList.add('hidden');
        agentDiv.classList.add('hidden');
        supDiv.classList.add('hidden');

        if (paidToValue === 1) {
            empDiv.classList.remove('hidden');
            agentId.value = '';
            supId.value = '';

            agentCode.value ='';
            supCode.value='';
        } else if (paidToValue === 2) {
            agentDiv.classList.remove('hidden');
            empId.value = '';
            supId.value = '';

            empCode.value ='';
            supCode.value='';
        } else if (paidToValue === 3) {
            supDiv.classList.remove('hidden');
            empId.value = '';
            agentId.value = '';

            agentCode.value ='';
            empCode.value='';
        }
    });
    </script>
</head>
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
                            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" disabled>
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
                            <div class="rdo-btn">
                                <label>
                                    <input type="radio" name="paid_to" value="1" id="emp-radio" <?php echo isset($paid_to) && $paid_to == 1 ? 'checked' : ''; ?> required aria-required="true">
                                    Employee
                                </label>
                                <label>
                                    <input type="radio" name="paid_to" value="2" id="agent-radio" <?php echo isset($paid_to) && $paid_to == 2 ? 'checked' : ''; ?> required aria-required="true">
                                    Agent
                                </label>
                                <label>
                                    <input type="radio" name="paid_to" value="3" id="sup-radio" <?php echo isset($paid_to) && $paid_to == 3 ? 'checked' : ''; ?> required aria-required="true">
                                    Supplier
                                </label>
                            </div>                        
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

                            <div class="row" id="agent-div">
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:50%; padding-right: 10px;">
                                            <label for="supplier_id">Agent:</label>
                                            <select name="supplier_id" id="agent_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                                                <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                                <?php 
                                                $supplier_qry = $conn->query("SELECT * FROM `t_agents` ORDER BY `c_last_name` ASC");
                                                while ($row = $supplier_qry->fetch_assoc()):
                                                ?>
                                                <option 
                                                    value="<?php echo $row['c_code'] ?>" 
                                                    data-agent-code="<?php echo $row['c_code'] ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['c_code'] ? 'selected' : '' ?>
                                                ><?php echo $row['c_last_name'] ?>, <?php echo $row['c_first_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td style="width:50%; padding-left: 10px;"> 
                                            <label for="sup_code" class="control-label">Agent Code:</label>
                                            <input type="text" id="agent_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row" id="emp-div">
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:50%; padding-right: 10px;">
                                            <label for="supplier_id">Employee:</label>
                                            <select name="supplier_id" id="emp_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                                                <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                                <?php 
                                                $supplier_qry = $conn->query("SELECT * FROM `users` ORDER BY `lastname` ASC");
                                                while ($row = $supplier_qry->fetch_assoc()):
                                                ?>
                                                <option 
                                                    value="<?php echo $row['user_id'] ?>" 
                                                    data-emp-code="<?php echo $row['user_code'] ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['user_id'] ? 'selected' : '' ?>
                                                ><?php echo $row['lastname'] ?>, <?php echo $row['firstname'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td style="width:50%; padding-left: 10px;"> 
                                            <label for="sup_code" class="control-label">Employee Code:</label>
                                            <input type="text" id="emp_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="account_id" class="control-label">Account Name:</label>
                            <select id="account_id" class="form-control form-control-sm form-control-border select2">
                                <option value="" disabled selected></option>
                                <?php 
                                $accounts = $conn->query("SELECT a.*, g.name AS gname FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1;");
                                $currentGroup = null;
                                
                                while($row = $accounts->fetch_assoc()):
                                    $account_arr[$row['id']] = $row;
                                    if ($row['group_id'] != $currentGroup) {
                                        if ($currentGroup !== null) {
                                            echo '</optgroup>';
                                        }
                                        echo '<optgroup label="' . $row['gname'] . '">';
                                        $currentGroup = $row['group_id'];
                                    }
                                ?>
                                <option value="<?= $row['id'] ?>" data-group-id="<?= $row['group_id'] ?>"><?= $row['name'] ?></option>
                                <?php endwhile; ?>
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
                    </div>
                    <table id="account_list" class="table table-striped table-bordered">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="5%">
                            <col width="35%">
                            <col width="40%">
                            <col width="5%">
                            <col width="5%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Item No.</th>
                                <th class="text-center">Account Code</th>
                                <th class="text-center">Account Name</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Group</th>
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(isset($id)):
                                $counter = 1;
                                $jitems = $conn->query("SELECT j.*,a.code as account_code, a.name as account, g.name as `group`, g.type FROM `vs_items` j inner join account_list a on j.account_id = a.id inner join group_list g on j.group_id = g.id where journal_id = '{$id}'");
                                while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
                                </td>
                                <td class="text-center">
                                    <input type="text" id="item_no" value="<?= $counter; ?>" style="border: none;background:transparent;">
                                </td>
                                <td class="">
                                    <input type="hidden" name="account_code[]" value="<?= $row['account_code'] ?>">
                                    <input type="hidden" name="account_id[]" value="<?= $row['account_id'] ?>">
                                    <input type="hidden" name="group_id[]" value="<?= $row['group_id'] ?>">
                                    <input type="hidden" name="amount[]" value="<?= $row['amount'] ?>">
                                    <span class="account_code"><?= $row['account_code'] ?></span>
                                </td>
                                <td class="">
                                    <span class="account"><?= $row['account'] ?></span>
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
                                <td class="group"><?= $row['group'] ?></td>
                                <td class="debit_amount text-right"><?= $row['type'] == 1 ? format_num($row['amount']) : '' ?></td>
                                <td class="credit_amount text-right"><?= $row['type'] == 2 ? format_num($row['amount']) : '' ?></td>
                            </tr>
                            <?php 
                            $counter++;
                            endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-secondary">
                                <tr>
                                    <th colspan="6" class="text-center">Total</th>
                                    <th class="text-right total_debit">0.00</th>
                                    <th class="text-right total_credit">0.00</th>
                                </tr>
                                <tr>
                                    <th colspan="6" class="text-center"></th>
                                    <th colspan="4" class="text-center total-balance">0</th>
                                </tr>
                            </tr>
                        </tfoot>
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

<noscript id="item-clone">
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="text-center">
            <input type="text" id="item_no" style="border:none;background-color:transparent;" value="">
        </td>
        <td class="account_code"><input type="text" name="account_code[]" value="" style="border:none;background-color:transparent;" readonly></td>
        <td class="">
            <input type="hidden" name="account_code[]" value="">
            <input type="hidden" name="account_id[]" value="">
            <input type="hidden" name="group_id[]" value="">
            <input type="hidden" name="amount[]" value="">
            <span class="account"></span>
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

        <td class="group"></td>
        <td class="debit_amount text-right"></td>
        <td class="credit_amount text-right"></td>
    </tr>
</noscript>

<script>
    var empRadio = document.getElementById('emp-radio');
    var agentRadio = document.getElementById('agent-radio');
    var supRadio = document.getElementById('sup-radio');

    var empDiv = document.getElementById('emp-div');
    var agentDiv = document.getElementById('agent-div');
    var supDiv = document.getElementById('sup-div');

    empRadio.addEventListener('change', function () {
        if (empRadio.checked) {
            empDiv.style.display = 'block';
            agentDiv.style.display = 'none';
            supDiv.style.display = 'none';
            clearSelections();
        }
    });

    agentRadio.addEventListener('change', function () {
        if (agentRadio.checked) {
            empDiv.style.display = 'none';
            agentDiv.style.display = 'block';
            supDiv.style.display = 'none';
            clearSelections();
        }
    });

    supRadio.addEventListener('change', function () {
        if (supRadio.checked) {
            empDiv.style.display = 'none';
            agentDiv.style.display = 'none';
            supDiv.style.display = 'block';
            clearSelections();
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        var empId = document.getElementById('emp_id');
        var agentId = document.getElementById('agent_id');
        var supId = document.getElementById('supplier_id');

        var empCode = document.getElementById('emp_code');
        var agentCode = document.getElementById('agent_code');
        var supCode = document.getElementById('sup_code');

        function clearSelections() {
            empId.value = '';
            agentId.value = '';
            supId.value = '';

            empCode.value = '';
            agentCode.value = '';
            supCode.value = '';
        }

        empRadio.addEventListener('change', function() {
            if (empRadio.checked) {
                clearSelections();
            }
        });

        agentRadio.addEventListener('change', function() {
            if (agentRadio.checked) {
                clearSelections();
            }
        });

        supRadio.addEventListener('change', function() {
            if (supRadio.checked) {
                clearSelections();
            }
        });
    });
</script>
<script>
$(function () {
    $('input[name="paid_to"]').change(function () {
        $('#emp_code').removeAttr('required');
        $('#agent_code').removeAttr('required');
        $('#sup_code').removeAttr('required');

        if ($('#emp-radio').is(':checked')) {
            $('#emp_id').attr('required', 'required');
        }
        if ($('#agent-radio').is(':checked')) {
            $('#agent_id').attr('required', 'required');
        }
        if ($('#sup-radio').is(':checked')) {
            $('#sup_id').attr('required', 'required');
        }
    });
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var selectedOption = document.getElementById('agent_id').options[document.getElementById('agent_id').selectedIndex];
    console.log("Selected Option:", selectedOption);
    if (selectedOption) {
        document.getElementById('agent_code').value = selectedOption.getAttribute('data-agent-code');
    }
});
document.addEventListener("DOMContentLoaded", function() {
    var selectedOption = document.getElementById('emp_id').options[document.getElementById('emp_id').selectedIndex];
    console.log("Selected Option:", selectedOption);
    if (selectedOption) {
        document.getElementById('emp_code').value = selectedOption.getAttribute('data-emp-code');
    }
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
document.getElementById('emp_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption) {
        document.getElementById('emp_code').value = selectedOption.getAttribute('data-emp-code');
    } else {
        document.getElementById('emp_code').value = '';
    }
});
document.getElementById('agent_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption) {
        document.getElementById('agent_code').value = selectedOption.getAttribute('data-agent-code');
    } else {
        document.getElementById('agent_code').value = '';
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
</script>

<script>
    var account = $.parseJSON('<?= json_encode($account_arr) ?>');
    var group = $.parseJSON('<?= json_encode($group_arr) ?>');

    function cal_tb() {
        var debit = 0;
        var credit = 0;
        $('#account_list tbody tr').each(function () {
            if ($(this).find('.debit_amount').text() != "")
                debit += parseFloat(($(this).find('.debit_amount').text()).replace(/,/gi, ''));
            if ($(this).find('.credit_amount').text() != "")
                credit += parseFloat(($(this).find('.credit_amount').text()).replace(/,/gi, ''));
        });
        $('#account_list').find('.total_debit').text(parseFloat(debit).toLocaleString('en-US', { style: 'decimal' }));
        $('#account_list').find('.total_credit').text(parseFloat(credit).toLocaleString('en-US', { style: 'decimal' }));
        $('#account_list').find('.total-balance').text(parseFloat(debit - credit).toLocaleString('en-US', { style: 'decimal' }));
    }

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
            if ($('#account_list tbody tr').length <= 0) {
                el.addClass('alert-danger').text(" Account Table is empty.");
                _this.prepend(el);
                el.show('slow');
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            }
            if ($('#account_list tfoot .total-balance').text() != '0') {
                el.addClass('alert-danger').text(" Trial Balance is not equal.");
                _this.prepend(el);
                el.show('slow');
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            }
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_journal",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					//alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
              
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>