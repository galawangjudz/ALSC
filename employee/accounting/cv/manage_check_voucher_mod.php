<?php 
require_once('../../config.php');
$account_arr = [];
$group_arr = [];
// $due_date = date('Y-m-d', strtotime('+1 week'));
$publicId = '';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `cv_entries` where c_num = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        $publicId = $_GET['id'];
    }
    echo $publicId;
}
$is_new_cn = true;

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $existing_c_id = $_GET['id'];

    $qry = $conn->query("SELECT c_num FROM `cv_entries` WHERE c_num = $existing_c_id");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $c_number = $row['c_num'];
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
    //echo $c_number;
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
    #account_list {
        display: none;
    }

</style>
<head>
</head>
<body">
<div class="card card-outline card-primary">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Check Voucher Entry": "Add New Check Voucher Entry" ?></b></i></h5>
	</div>
    <div class="card-body">
    <form action="" id="journal-form">
        <div class="container-fluid" style="height:auto;width:auto;">
            <div class="container-fluid" id="custom-container">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="hidden" id="supplier_id" name="supplier_id">
                        <label for="c_num" class="control-label">Check Voucher #:</label>
                        <input type="text" id="c_num" name="c_num" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $c_number ?>" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="v_num" class="control-label">Voucher Setup #:</label>
                        <input type="text" class="form-control form-control-sm form-control-border rounded-0" name="v_num" id="v_num" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="po_no">P.O. #: </label>
                        <!-- <select name="po_no" id="po_no" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
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
                        </select> -->
                        <input type="text" class="form-control form-control-sm form-control-border rounded-0" name="po_no" id="po_no" readonly>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="tran_date">Transaction Date: <span class="po_err_msg text-danger"></span></label>
                        <input type="date" class="form-control form-control-sm rounded-0" id="cv_date" name="cv_date" value="<?php echo isset($tranDate) ? $tranDate : date('Y-m-d'); ?>" readonly>
                    </div>
                    <div class="col-md-4 form-group">
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
                    <div class="col-md-4 form-group">
                        <label for="check_num" class="control-label">Check #:</label>
                        <input type="text" id="check_num" name="check_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($check_num) ? $check_num : "" ?>">
                    </div>
                </div>
            </div>
            <br>

            <div class="container-fluid">
                <div class="row">                
                    <div class="col-md-6" id="vs-cont">
                        <table style="float:right;margin-bottom:10px;">
                            <tr>
                                <td>VS #: <input type="text" id="searchInput" style="border-radius:3px;border-color:#ddd;"></td>
                            </tr>
                        </table>
                        <table class="table table-bordered" id="data-table" style="text-align:center;width:100%;">
                            <colgroup>
                                <col width="10%">
                                <col width="30%">
                                <col width="60%">
                            </colgroup>
                            <thead>
                                <tr class="bg-navy disabled">
                                    <th>#</th>
                                    <th>VS No.</th>
                                    <th>Supplier Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $qry = $conn->query("SELECT DISTINCT ac.*, vs.v_num, vs.po_no, s.name, s.id as supId, vs.due_date, vi.amount, vi.group_id
                                FROM `vs_entries` vs
                                JOIN `vs_items` vi ON vs.v_num = vi.journal_id
                                JOIN supplier_list s ON vs.supplier_id = s.id
                                JOIN account_list ac ON vi.account_id = ac.id
                                WHERE ac.name='Accounts Payable Trade'
                                ORDER BY vs.`date_updated` DESC;
                                ");
                                while($row = $qry->fetch_assoc()):
                                ?>
                                    <tr data-v-num="<?php echo $row['v_num']; ?>" onclick="selectRow('<?php echo $row['v_num']; ?>', '<?php echo $row['po_no']; ?>', '<?php echo $row['due_date']; ?>', '<?php echo $row['amount']; ?>','<?php echo $row['supId']; ?>')">
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo ($row['v_num'] == 0) ? '-' : $row['v_num']; ?></td>
                                        <td><?php echo ($row['name']) ?></td>
                                       
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6" id="cv-cont">
                        <div id="table-container">
                            <div style="float:right;margin-bottom:10px;">Code: <input type="text" id="searchAccCode" style="border-radius:3px;border-color:#ddd;"></div>
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
                                    while($row = $qry->fetch_assoc()):
                                    ?>
                                        <tr class="account-row">
                                            <td><?php echo ($row['code']) ?></td>
                                            <td><?php echo ($row['name']) ?></td>
                                            <td style="display:none;"><?php echo ($row['group_id']) ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <script>
                            $(document).ready(function() {
                                $('#searchAccCode').on('input', function() {
                                    var searchTerm = $(this).val().trim().toLowerCase();

                                    $('.account-row').each(function() {
                                        var accountCode = $(this).find('td:eq(0)').text().toLowerCase();
                                        var accountName = $(this).find('td:eq(1)').text().toLowerCase();
                                        var grpId = $(this).find('td:eq(2)').text().toLowerCase();

                                        if (accountCode.includes(searchTerm) || accountName.includes(searchTerm)) {
                                            $(this).show();
                                        } else {
                                            $(this).hide();
                                        }
                                    });
                                });
                            
                                $('.account-row').on('click', function() {
                                    $('.account-row').removeClass('selected');
                                    $(this).addClass('selected');

                                    var accCode = $(this).find('td:eq(0)').text();
                                    var accName = $(this).find('td:eq(1)').text();
                                    var grpId = $(this).find('td:eq(2)').text();

                                    $('#AccCode').val(accCode);
                                    $('#AccName').val(accName);
                                    $('#grpId').val(grpId);
                                    var vsAmt = $('#amount').val();
                                    var grpId = $('#grpId').val();

                                    addRowToTable(accCode, accName, vsAmt, grpId);
                                    updateTotalCreditDebit();
                                });

                                function addRowToTable(accCode, accName, vsAmt, grpId) {
                                    var table = document.getElementById('account_list');
                                    var row = table.insertRow();
                                    row.insertCell(0).innerHTML = '<button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>';
                                    row.insertCell(1).innerHTML = '<input type="text" style="border:none;background-color:transparent; class="form-control" name="item_no[]" readonly>';
                                    row.insertCell(2).innerHTML = '<input type="hidden" name="account_id[]" value="' + accCode + '">' + accCode;
                                    row.insertCell(3).innerHTML = accName;
                                    var locationCell = row.insertCell(4);
                                    locationCell.innerHTML = '<label class="control-label">Phase: </label>' +
                                    '<select name="phase[]" class="phase">' +
                                    '<option value="" selected></option>' + 
                                    '<?php 
                                        $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                                        while ($row = $cat->fetch_assoc()):
                                            $cat_name[$row['c_code']] = $row['c_acronym'];
                                            $code = $row['c_code'];
                                    ?>' +
                                    '<option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>' +
                                    '<?php endwhile; ?>' +
                                    '</select>' +
                                    '<label class="control-label">Block: </label>' +
                                    '<input type="text" name="block[]" value="" class="block">' +
                                    '<label class="control-label">Lot: </label>' +
                                    '<input type="text" name="lot[]" value="" class="lot">';

                                    row.insertCell(5).innerHTML = '';
                                    row.insertCell(6).innerHTML = '<input type="text" style="border:none;background-color:transparent; id="amount" name="amount[]" class="form-control" value="' + vsAmt + '">';
                                    row.insertCell(7).innerHTML = '<input type="text" style="display:none;" name="group_id[]" value="' + grpId + '">';
                                    updateItemNumbers();
                                    updateTotalCreditDebit();
                                }

                                function updateItemNumbers() {
                                    var table = document.getElementById('account_list');
                                    for (var i = 1; i < table.rows.length; i++) {
                                        table.rows[i].cells[1].getElementsByTagName('input')[0].value = i;
                                    }
                                }
                                function updateTotalCreditDebit() {
                                    var table = document.getElementById('account_list');
                                    var totalCredit = 0;
                                    var totalDebit = 0;

                                    for (var i = 1; i < table.rows.length; i++) {
                                        var creditInput = table.rows[i].cells[6].querySelector('input');
                                        var debitInput = table.rows[i].cells[5].querySelector('input');
                                        
                                        if (creditInput && creditInput.value) {
                                            var creditValue = parseFloat(creditInput.value) || 0;
                                            totalCredit += creditValue;
                                        }
                                        if (debitInput && debitInput.value) {
                                            var debitValue = parseFloat(debitInput.value) || 0;
                                            totalDebit += debitValue;
                                        }
                                    }

                                    $('#account_list tfoot').remove();

                                    var tfoot = document.createElement('tfoot');
                                    var newRow = tfoot.insertRow();
                                        newRow.insertCell(0).innerHTML = '<td colspan="1"></td>'; 
                                        newRow.insertCell(1).innerHTML = '<td colspan="1"></td>';
                                        newRow.insertCell(2).innerHTML = '<td colspan="1"></td>';
                                        newRow.insertCell(3).innerHTML = '<td colspan="1"></td>';
                                        newRow.insertCell(4).innerHTML = '<td align="right">TOTAL: </td>';
                                        newRow.insertCell(5).innerHTML = '<td align="right">' + totalCredit.toFixed(2) + '</td>';
                                        newRow.insertCell(6).innerHTML = '<td align="right">' + totalDebit.toFixed(2) + '</td>';
                                    table.appendChild(tfoot);
                                }

                            });
                        </script>
                    </div>
                </div>
                </div>
                <br>
                <div class="container-fluid" id="custom-container">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label class="control-label">Account Code:</label>
                            <input type="text" id="AccCode" class="form-control" readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">Account Name:</label>
                            <input type="text" id="AccName" class="form-control" readonly><br>
                        </div>
                        <div class="col-md-4 form-group">
                            <label class="control-label">Amount:</label>
                            <input type="text" id="amount" name="amount" class="form-control">
                        </div>
                        <input type="hidden" id="grpId" class="form-control">
                    </div>
                    <hr>
                    <button id="btnProceed">Create Check Voucher</button>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="container-fluid">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                        <input type="hidden" id="c_num" name="c_num" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $c_number ?>" readonly>
             
                    <table id="account_list" class="table table-striped table-bordered">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="10%">
                            <col width="20%">
                            <col width="30%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%" style="display:none;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Item No.</th>
                                <th class="text-center">Account Code</th>
                                <th class="text-center">Account Name</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                                <th class="text-center" style="display:none;">Group Id</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-secondary">
                                <th colspan="4" class="text-center">Total</th>
                                <th class="text-right total_debit">0.00</th>
                                <th class="text-right total_credit">0.00</th>
                                <th colspan="4" class="text-center total-balance">0</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary" id="save_journal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
<script>
$('#btnProceed').on('click', function() {
    event.preventDefault();
    $('#account_list').show();
});
function selectRow(selectedVNum, poNo, checkDate, Amt, supId) {
    
    var tableRows = document.querySelectorAll('#data-table tbody tr');
    tableRows.forEach(function (row) {
        row.classList.remove('selected');
    });

    var selectedRow = document.querySelector('tr[data-v-num="' + selectedVNum + '"]');
    if (selectedRow) {
        selectedRow.classList.add('selected');
    }

    document.getElementById('v_num').value = selectedVNum;
    document.getElementById('po_no').value = poNo;
    document.getElementById('check_date').value = checkDate;
    document.getElementById('amount').value = Amt;
    document.getElementById('supplier_id').value = supId;

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

            displayDataInTable(vsItems);
        } catch (error) {
            console.error('Error parsing vsItems:', error);
        }
    }

    });
}

function displayDataInTable(vsItems) {
    var table = document.getElementById('account_list');
    while (table.rows.length > 1) {
        table.deleteRow(1);
    }

    if (Array.isArray(vsItems)) {
        vsItems.forEach(function (item, index) {
            var row = table.insertRow();


            row.insertCell(0).innerHTML = '<button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>';
            row.insertCell(1).innerHTML = '<input type="text" class="form-control" name="item_no[]" style="border:none;background-color:transparent;" value="' + (index + 1) + '" readonly>';

            row.insertCell(2).innerHTML = '<input type="text" style="border:none;background-color:transparent; name="account_id[]" value="' + item.account_id + '">';

            row.insertCell(3).innerHTML = item.account_name;

            var locationCell = row.insertCell(4);
            locationCell.innerHTML = '<label class="control-label">Phase: </label>' +
            '<select name="phase[]" class="phase">' +
            '<option value="" selected></option>' + 
            '<?php 
                $cat = $conn->query("SELECT * FROM t_projects ORDER BY c_acronym ASC ");
                while ($row = $cat->fetch_assoc()):
                    $cat_name[$row['c_code']] = $row['c_acronym'];
                    $code = $row['c_code'];
            ?>' +
            '<option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected' : '' ?>><?php echo $row['c_acronym'] ?></option>' +
            '<?php endwhile; ?>' +
            '</select>' +
            '<label class="control-label">Block: </label>' +
            '<input type="text" name="block[]" value="' + item.block + '" class="block">' +
            '<label class="control-label">Lot: </label>' +
            '<input type="text" name="lot[]" value="' + item.lot + '" class="lot">';

            row.insertCell(5).innerHTML = item.type == 1 ? '<input type="text" style="border:none;background-color:transparent; name="amount[]" class="form-control" value="' + item.amount + '">' : '';
            row.insertCell(6).innerHTML = item.type == 2 ? '<input type="text" style="border:none;background-color:transparent; name="amount[]" class="form-control" value="' + item.amount + '">' : '';
            row.insertCell(7).innerHTML = '<input type="hidden" name="group_id[]" value="' + item.group_id + '">';
        });
    } else {
        
    }
}

$(document).ready(function () {
        var dataTable = $('#data-table').DataTable({
        dom: 'lrtip', 
        lengthChange: false,
    });
});
$(document).ready(function () {
        var accTable = $('#acc-table').DataTable({
        dom: 'lrtip', 
        lengthChange: false,
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("#data-table tbody tr");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach(function (row) {
            const vsColumn = row.querySelector("td:nth-child(2)").textContent.toLowerCase();

            if (vsColumn.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
});

$(document).on('click', '.delete-row', function() {
    $(this).closest('tr').remove();
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
        urlSuffix = "manage_cv";
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
                // location.reload();
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




