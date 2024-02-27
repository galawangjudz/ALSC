<?php 
require_once('../../config.php');

$userid = $_settings->userdata('user_code');
$account_arr = [];
$group_arr = [];
$adjustedTotalDebit=0;
$wtTotal=0;
$totalCredit = 0;
$totalDebit = 0;
// $due_date = date('Y-m-d', strtotime('+1 week'));
$publicId = '';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `vs_entries` where v_num = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
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

$query = $conn->query("SELECT COUNT(DISTINCT vs_num) AS max_doc_no FROM `tbl_gl_trans` WHERE doc_type = 'AP'");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    if ($maxDocNo === null) {
        $maxDocNo = 0;
    }
    if ($publicId > 0) {

        $newDocNo = $doc_no;
        //echo "New_DOC" . $newDocNo . "<br>";
    } else {
        $newDocNo = '2' . sprintf('%05d', $maxDocNo + 1);
        //echo "Max_DOC" . $maxDocNo;
    }

    
    
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
    $v_number = str_pad($next_v_number, STR_PAD_LEFT);
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
</head>
<body onload="cal_tb()">
<div class="card card-outline card-primary">
    <div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($_GET['id']) ? "Update Voucher Setup Entry (Employee)": "Add New Voucher Setup Entry (Employee)" ?></b></i></h5>
	</div>
    <div class="card-body">
        <label class="control-label">Add Attachment:</label>
        <div id="picform-container">
            <form action="" method="post" enctype="multipart/form-data" id="picform">
                <table class="table table-bordered">
                    <input type="hidden" class="control-label" name="newDocNo" id="newDocNo" value="<?php echo $newDocNo; ?>" readonly>
                    <input type="hidden" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
                    <tr>
                        <td>
                        <!-- <label for="image" class="custom-file-upload">
                            <i class="fa fa-cloud-upload"></i> Custom Upload
                        </label>
                        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" style="display:none;"> -->
                        <input type="file" name="image" id="image" accept=".jpg, .png, .jpeg, .pdf, .gif" value="">
                        </td>
                        <td style="display:none;">
                            <input type="hidden" name="imageName" id="imageName" class="form-control form-control-sm form-control-border rounded-0" readonly>
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
                    <col width="25%">
                    <col width="50%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr class="bg-navy disabled">
                        <th class="px-1 py-1 text-center">Name</th>
                        <th class="px-1 py-1 text-center">Attachment</th>
                        <th class="px-1 py-1 text-center">Date/Time Attached</th>
                    </tr>
                </thead>
            <?php 
            $i = 1;
            $rows = mysqli_query($conn, "SELECT * FROM tbl_vs_attachments WHERE doc_no = $newDocNo;");
            ?>
            <?php if (mysqli_num_rows($rows) > 0): ?>
                <?php foreach($rows as $row):?>
                <tr>
                    <td>
                            <?php echo $row["name"]; ?>
                    </td>
                    <td>
                    <?php
                        $fileExtension = pathinfo($row['image'], PATHINFO_EXTENSION);
                        $filePath = "journals/attachments/" . $row['image'];

                        if (strtolower($fileExtension) == 'pdf'): ?>
                            <a data-fancybox data-src="<?php echo $filePath; ?>" data-type="iframe" href="javascript:;">
                                <img src="journals/vs/pdf-icon.png" alt="PDF Icon" width="25" height="25">
                            </a>
                        <?php else: ?>
                            <a data-fancybox="images" href="<?php echo $filePath; ?>" data-caption="<?php echo $row['name']; ?>">
                                <img src="<?php echo $filePath; ?>" alt="" width="200" height="200">
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
    <div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Voucher Setup Entry": "Add New Voucher Setup Entry" ?></b></i></h5>
	</div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <form action="" id="journal-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="v_num" class="control-label">Voucher Setup #:</label>
                            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="po_no">P.O. #: </label>
                            <!-- <select name="po_no" id="po_no" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px" required>
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
                            <input type="text" id="po_no" name="po_no" class="form-control form-control-sm form-control-border rounded-0" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">Document #:</label>
                            <input type="text" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $newDocNo; ?>" readonly>
                        </div>
                        <div class="col-md-3 form-group">
                            <label class="control-label">Reference #:</label>
                            <input type="text" id="ref_no" name="ref_no" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($ref_no) ? $ref_no : "" ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="journal_date" class="control-label">Transaction Date:</label>
                            <input type="date" id="journal_date" name="journal_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($journal_date) ? $journal_date : date("Y-m-d") ?>" required readonly>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="bill_date" class="control-label">Bill Date:</label>
                            <?php
                            $billformattedDate = empty($bill_date) ? date('Y-m-d') : date('Y-m-d', strtotime($bill_date));
                            ?>     
                            <input type="date" id="bill_date" name="bill_date" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $billformattedDate ?>" required style="background-color: yellow;">
                        </div>

                        <div class="col-md-4 form-group">
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
                                    <div class="col-md-4 form-group">
                                        <label for="supplier_id">Supplier:</label>
                                        <?php
                                        $supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
                                        $terms = '';
                                        ?>
                                        <select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px" required>
                                            <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                            <?php while ($row = $supplier_qry->fetch_assoc()): ?>
                                                <option
                                                    value="<?php echo $row['id'] ?>"
                                                    data-vatable="<?php echo $row['vatable'] ?>"
                                                    data-terms="<?php echo $row['terms']; ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?>
                                                    <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                                                ><?php echo $row['short_name'] ?></option>
                                                <?php
                                                if (isset($supplier_id) && $supplier_id == $row['id']) {
                                                    $terms = $row['terms'];
                                                }
                                                ?>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group">
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
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="sup_code" class="control-label">Supplier Code:</label>
                                        <input type="text" id="sup_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                    </div>
                                </div>
                                <input type="hidden" id="termsTextbox" value="<?php echo $terms; ?>" class="form-control">
                            </div>
                            </div>
                            <br>
                            <br>
                            <div class="gr-container"></div>
                            <hr>
                            <button id="display-selected-gr-details" class="btn btn-flat btn-sm btn-secondary"><i class="fas fa-table"></i> Display Selected Tables</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="2" id="description" name="description" class="form-control form-control-sm rounded-0" required><?= isset($description) ? $description : "" ?></textarea>
                        </div>
                    </div>
                    <table id="account_list" class="table table-bordered">
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
<noscript id="item-clone">
    <tr>
        <td class="text-center">
            <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
        </td>

        <td class="account_code"><input type="text" name="account_code[]" value="" style="border:none;background-color:transparent;" readonly></td>
        <td class="">
        <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($vs_num) ? $vs_num : "" ?>">

            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <!-- <input type="text" name="account_code[]" value=""> -->
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

        <!-- <td class="group"></td> -->
        <td class="debit_amount text-right"></td>
        <td class="credit_amount text-right"></td>
    </tr>
</noscript>
</body>
<script>
    document.getElementById('picform').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData(this);
        fetch('journals/vs_attachments.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
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
    document.getElementById('image').addEventListener('change', function() {
    var formData = new FormData(document.getElementById('picform'));

    fetch('journals/vs_attachments.php', {
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
</script>
<script>

document.getElementById('picform').addEventListener('submit', function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);
    fetch('journals/vs_attachments.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        //alert(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
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
$(document).ready(function () {
    $('.delete-row').on('click', function () {
        $(this).closest('tr').remove();
        cal_tb();
    });
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
</script>

<script>
    var account = $.parseJSON('<?= json_encode($account_arr) ?>');
    var group = $.parseJSON('<?= json_encode($group_arr) ?>');

    function cal_tb() {
        var totalCreditEchoed = <?= json_encode($totalCredit) ?>;
        var debit = 0;
        var credit = 0;
        $('#account_list tbody tr').each(function () {
            if ($(this).find('.debit_amount').text() != "")
                debit += parseFloat(($(this).find('.debit_amount').text()).replace(/,/gi, ''));
            if ($(this).find('.credit_amount').text() != "")
                credit += parseFloat(($(this).find('.credit_amount').text()).replace(/,/gi, ''));
        });
        //credit -= totalCreditEchoed;
        $('#account_list').find('.total_debit').text(parseFloat(debit).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 }));
        $('#account_list').find('.total_credit').text(parseFloat(credit).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 }));
        $('#account_list').find('.total-balance').text(parseFloat(debit - credit).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 }));
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

  $(document).ready(function () {
        $('#supplier_id').on('change', function () {
        var billDateInput = $('#bill_date');
            if (!billDateInput.val()) {
                alert('Please provide a billing date.');
                return;
            }
        var terms = $(this).find(':selected').data('terms');
        $('#termsTextbox').val(terms);
        
        updateDueDate();
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
                url: 'journals/view_gr_details_20240102.php',
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

    checkedGrIds.forEach(function (grId) {
        let localTotalCredit = 0;
        let localTotalDebit = 0;

        $('table[data-gr-id="' + grId + '"] .debit_amount').each(function () {
            localTotalDebit += parseFloat($(this).val().replace(/,/g, '')) || 0;
        });

        $('table[data-gr-id="' + grId + '"] .credit_amount').each(function () {
            localTotalCredit += parseFloat($(this).val().replace(/,/g, '')) || 0;
        });

        $('table[data-gr-id="' + grId + '"] #total-debit').text(localTotalDebit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
        $('table[data-gr-id="' + grId + '"] #total-credit').text(localTotalCredit.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    });
});


function buildMainTableHtml(tableRows) {
    return '<table class="table-bordered" style="width: 100%">' +
        '<thead><tr><th>GR #</th><th>PO #</th><th>Date/Time Received</th></tr></thead>' +
        '<tbody>' + tableRows.join('') + '</tbody></table>';
}
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
$(document).on('change', '.selected-gr-checkbox', function () {
    updatePoNoTextbox();
});
function updatePoNoTextbox() {
        var selectedPoNos = [];

        $('.selected-gr-checkbox:checked').each(function () {
            var grId = $(this).data('id');
            var poNo = $('[data-id="' + grId + '"]').closest('tr').find('td:eq(1)').text();
            selectedPoNos.push(poNo);
        });


        $('#po_no').val(selectedPoNos.join(', '));
    }
    $('#mainTable').append(buildMainTableRows(grData));
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
    var thead = $('<thead>').append('<tr><th style="width:40%;">Name</th><th style="width:10%">Code</th><th style="width:50%">Description</th></tr>');

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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var saveJournalButton = document.getElementById("save_journal");
        var submitButton = document.getElementById("picform_submit_button");

        saveJournalButton.addEventListener("click", function () {
            submitButton.click();
        });
    });
</script>
</html>