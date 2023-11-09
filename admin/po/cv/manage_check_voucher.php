<?php 
require_once('../config.php');
$account_arr = [];
$group_arr = [];
$due_date = date('Y-m-d', strtotime('+1 week'));
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `cv_entries` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
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

<div class="card card-outline card-primary">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Check Voucher Entry": "Add New Check Voucher Entry" ?></b></i></h5>
	</div>
    <!-- <button type="button" id="btnfindAPV" class="btn btn-primary" data-toggle="modal" data-target="#apvModal">
        <i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Search for Voucher Setup Entries
    </button> -->
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <form action="" id="journal-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="c_num" class="control-label">Check Voucher #:</label>
                            <input type="text" id="c_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($id) ? $id : "" ?>" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="v_num" class="control-label">Voucher Setup #:</label>
                            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" disabled>
                        </div>
                        <div class="col-md-4 form-group">
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
                            <label for="cv_date">Date: <span class="po_err_msg text-danger"></span></label>
                            <?php
                            if (!empty($cv_date)) {
                                $voucherformattedDate = date('Y-m-d', strtotime($cv_date));
                            } else {
                                $voucherformattedDate = '';
                            }
                            ?>                            
                            <input type="date" class="form-control form-control-sm rounded-0" id="cv_date" name="cv_date" value="<?php echo isset($voucherformattedDate) ? $voucherformattedDate : '' ?>">
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
                            <input type="date" class="form-control form-control-sm rounded-0" id="check_date" name="check_date" value="<?php echo isset($checkformattedDate) ? $checkformattedDate : '' ?>">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="check_num" class="control-label">Check #:</label>
                            <input type="text" id="check_num" name="check_num" class="form-control form-control-sm form-control-border rounded-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
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
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="sup_code" class="control-label">Supplier Code:</label>
                            <input type="text" id="sup_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                        </div>
                    </div>
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
                                $accounts = $conn->query("SELECT a.*, g.name AS gname FROM `account_list` a INNER JOIN group_list g ON a.group_id = g.id WHERE a.delete_flag = 0 AND a.status = 1 ORDER BY `group_id`, `name` ASC ");
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
                            <col width="10%">
                            <col width="35%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Account Code</th>
                                <th class="text-center">Account Name</th>
                                <th class="text-center">Group</th>
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(isset($id)):
                            $jitems = $conn->query("SELECT j.*,a.code as account_code, a.name as account, g.name as `group`, g.type FROM `vs_items` j inner join account_list a on j.account_id = a.id inner join group_list g on j.group_id = g.id where journal_id = '{$v_number}'");
                            while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
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
                                <td class="group"><?= $row['group'] ?></td>
                                <td class="debit_amount text-right"><?= $row['type'] == 1 ? format_num($row['amount']) : '' ?></td>
                                <td class="credit_amount text-right"><?= $row['type'] == 2 ? format_num($row['amount']) : '' ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-secondary">
                                <tr>
                                    <th colspan="3" class="text-center">Total</th>
                                    <th class="text-right total_debit">0.00</th>
                                    <th class="text-right total_credit">0.00</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center"></th>
                                    <th colspan="3" class="text-center total-balance">0</th>
                                </tr>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="modal fade" id="apvModal" tabindex="-1" role="dialog" aria-labelledby="apvModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="apvModalLabel">Voucher Setup Entries</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                            <tr>
                                                <th style="text-align:center;">Voucher Setup #</th>
                                                <th style="text-align:center;">Date Created</th>
                                                <th style="text-align:center;">PO Linked</th>
                                                <th style="text-align:center;">Supplier Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = $conn->query("SELECT vse.*, s.name AS sname
                                                                FROM vs_entries vse
                                                                INNER JOIN supplier_list s ON vse.supplier_id = s.id;
                                            ");
                                            while ($row = $query->fetch_assoc()): ?>
                                                <tr>
                                                    <td style="text-align:center;"><?php echo $row["id"] ?></td>
                                                    <td style="text-align:center;"><?php echo $row["date_created"] ?></td>
                                                    <td style="text-align:center;"><?php echo $row["po_no"] ?></td>
                                                    <td style="text-align:center;"><?php echo $row["sname"] ?></td>
                                                    <td>
                                                        <?php
                                                        $query1 = $conn->query("SELECT acc_list.*, vs.* FROM account_list acc_list INNER JOIN vs_items vs ON acc_list.id = vs.account_id;
                                                        ");
                                                        while ($row1 = $query1->fetch_assoc()):
                                                            $jid = $row1['journal_id'];
                                                            $aid = $row1['account_id'];
                                                            $gid = $row1['group_id'];
                                                            $amt = $row1['amount'];
                                                        ?>
                                                        <a href="#" class="btn btn-flat btn-primary btn-xs select-apv"

                                                            data-amount="<?php echo $row1["amount"] ?>">
                                                            <center><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Select</center>
                                                        </a>

                                                        <?php endwhile; ?>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
<tr id="selected-account-row">
    <td class="text-center">
        <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
    </td>
    <td class="account_code"><input type="text" name="account_code[]" value="" style="border:none;background-color:transparent;" readonly></td>
    <td class="">
        <input type="hidden" name="account_code[]" value="">
        <input type="hidden" name="account_id[]" value="">
        <input type="hidden" name="group_id[]" value="">
        <input type="hidden" name="amount[]" value="">
        <span class="account"></span>
    </td>
    <td class="group"></td>
    <td class="debit_amount text-right"></td>
    <td class="credit_amount text-right"></td>
</tr>
</noscript>
<script>
    $(document).ready(function () {
        $(".select-apv").on("click", function () {
            // Get the data attributes from the clicked button
            // var accountCode = $(this).data("account-code");
            // var accountName = $(this).data("account-name");
            // var groupId = $(this).data("group-id");
            var amount = $(this).data("amount");

            // Update the selected row with the account information
            var selectedRow = $("#selected-account-row");
            // selectedRow.find(".account_code input").val(accountCode);
            // selectedRow.find("input[name='account_code[]']").val(accountCode);
            // selectedRow.find("input[name='account_id[]']").val(accountId);
            // selectedRow.find("input[name='group_id[]']").val(groupId);
            selectedRow.find("input[name='amount[]']").val(amount);
            // selectedRow.find(".account").text(accountName);
            // selectedRow.find(".group").text(groupId);
            // selectedRow.find(".debit_amount").text(amount);
            // selectedRow.find(".credit_amount").text(amount);
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var selectedOption = document.getElementById('supplier_id').options[document.getElementById('supplier_id').selectedIndex];
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
</script>
<script>

document.querySelectorAll('.select-apv').forEach(function(button) {
    button.addEventListener('click', function() {
        const accId = this.getAttribute('acc-id');

        const newRow = document.createElement('tr');
        newRow.className = 'cv';

        const cells = `
            <td class="align-middle p-1 text-center">
                <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this)"><i class="fa fa-times"></i></button>
            </td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 acc_id" step="any" name="acc_id[]" value="${accId}"></td>
        `;
        newRow.innerHTML = cells;
        document.querySelector('#cv-list tbody').appendChild(newRow);
    });
});

const showModalBtn = document.getElementById('btnfindAPV'); 
const apvModal = document.getElementById('apvModal');
const closeModalBtn = document.getElementById('closeModalBtn');

showModalBtn.addEventListener('click', function() {
    apvModal.style.display = 'block';
});

closeModalBtn.addEventListener('click', function() {
    apvModal.style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == apvModal) {
        apvModal.style.display = 'none';
    }
});
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            var $lastRow = $("tbody .cv:last").clone();

            $lastRow.find("input").val("");

            $("tbody").append($lastRow);

            $lastRow[0].scrollIntoView({ behavior: "smooth" });
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
        $('#add_to_list').click(function () {
            var account_id = $('#account_id').val();
            var account_code = $('#account_code').val();
            var group_id = $('#group_id').val();
            var amount = $('#amount').val();

            var account_data = !!account[account_id] ? account[account_id] : {};
            var group_data = !!group[group_id] ? group[group_id] : {};
            var tr = $($('noscript#item-clone').html()).clone();
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
                url:_base_url_+"classes/Master.php?f=manage_cv",
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