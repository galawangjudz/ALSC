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

$publicId = '';

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM `vs_entries` WHERE v_num = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k)) {
                $$k = $v;
            }
        }

        $publicId = $_GET['id'];

        if ($publicId > 0) {
            $docNoQuery = $conn->query("SELECT doc_no FROM tbl_gl_trans WHERE vs_num = '$publicId'");
            if ($docNoQuery) {
                $docNoRow = $docNoQuery->fetch_assoc();
                $docNo = $docNoRow['doc_no'];
                //echo "Document Number for vs_num $publicId: $docNo" . "<br>";


                $doc_no = $docNo;
            } else {
                //echo "Error executing doc_no query: " . $conn->error;
            }
        }
    }
    //echo "VS NO: " . $publicId . "<br>";
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
	.nav-client{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-client:hover{
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
                <form action="" id="journal-form" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="v_num" class="control-label">Voucher Setup #:</label>
                            <input type="text" id="v_num" name="v_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label">Document #:</label>
                            <input type="text" id="newDocNo" name="newDocNo" class="form-control form-control-sm form-control-border rounded-0" value="<?php echo $newDocNo; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="journal_date" class="control-label">Transaction Date:</label>
                            <input type="date" id="journal_date" name="journal_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($journal_date) ? $journal_date : date("Y-m-d") ?>" required readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="due_date" class="control-label">Due Date:</label>
                            <input type="date" id="due_date" name="due_date" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($due_date) ? $due_date : date("Y-m-d") ?>" required>
                        </div>
                    </div>

                    <div class="paid_to_main">
                        <div class="paid_to">
                            <label class="control-label">Paid To:</label><br>
                            <hr>          
                            <div class="row" id="client-div">
                                <table style="width:100%;">
                                    <tr>
                                        <td style="width:50%; padding-right: 10px;">
                                            <label for="client_id">Client:</label>
                                            <select name="client_id" id="client_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                                                <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                                                <?php 
                                                $supplier_qry = $conn->query("SELECT * FROM property_clients ORDER BY `last_name` ASC");
                                                while ($row = $supplier_qry->fetch_assoc()):
                                                ?>
                                                <option 
                                                    value="<?php echo $row['client_id'] ?>" 
                                                    data-client-code="<?php echo $row['client_id'] ?>"
                                                    <?php echo isset($supplier_id) && $supplier_id == $row['client_id'] ? 'selected' : '' ?>
                                                ><?php echo $row['last_name'] ?>, <?php echo $row['first_name'] ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td style="width:50%; padding-left: 10px;"> 
                                            <label for="client_code" class="control-label">Client ID:</label>
                                            <input type="text" name="client_id" id="client_code" class="form-control form-control-sm form-control-border rounded-0" readonly>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <br>
                            <br>
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
                                <option value="<?= $row['id'] ?>" data-group-type="<?= $row['type'] ?>" data-group-name="<?= $row['name'] ?>"><?= $row['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="gtype" name="gtype">
                    <script>
                        $(document).ready(function(){
                            function updateGType(selectedAccountId) {
                                var selectedOption = $('#account_id option[value="' + selectedAccountId + '"]');
                                var selectedGroupId = selectedOption.data('group-id');
                                var selectedType = $('#group_id option[value="' + selectedGroupId + '"]').data('group-type');
                                $('#gtype').val(selectedType);
                            }
                            $('#account_id').change(function(){
                                var selectedAccountId = $(this).val();
                                updateGType(selectedAccountId);
                            });
                        });
                    </script>
                    <div class="row align-items-end">
                        <div class="form-group col-md-12">
                            <label for="amount" class="control-label">Amount:</label>
                            <input type="number" step="any" id="amount" class="form-control form-control-sm form-control-border text-right">
                        </div>
                        <div class="form-group col-md-6">
                            <button class="btn btn-default bg-navy btn-flat" id="add_to_list" type="button"><i class="fa fa-plus"></i> Add Account</button>
                        </div>
                    </div>
                    <table id="account_list" class="table table-bordered">
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
                                <!-- <th class="text-center">Group</th> -->
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                            if (!isset($id) || $id === null) :
                               
                                $journalId = isset($_GET['id']) ? $_GET['id'] : null;
                                $jitems = $conn->query("SELECT j.*, a.code AS account_code, a.name AS account, g.name AS `group`, g.type, glt.doc_no FROM `vs_items` j INNER JOIN account_list a ON j.account_id = a.id INNER JOIN group_list g ON j.group_id = g.id INNER JOIN tbl_gr_list glt ON j.journal_id = glt.vs_num WHERE j.journal_id ='{$journalId}'");
                                while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline btn-danger btn-flat delete-row" type="button"><i class="fa fa-times"></i></button>
                                </td>
                               
                                <td class="">
                                    <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
                                    <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo ?>" readonly>
                                    <input type="hidden" name="account_code[]" value="<?= $row['account_code'] ?>">
                                    <input type="hidden" name="type[]" value="<?= $row['type'] ?>">
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
                                <!-- <td class="group"><?= $row['group'] ?></td> -->
                                <td class="debit_amount text-right"><?= $row['type'] == 1 ? $row['amount'] : '' ?></td>
                                <td class="credit_amount text-right"><?= $row['type'] == 2 ? $row['amount'] : '' ?></td>
                            </tr>
                            <?php 
                            if ($row['type'] == 2) {
                                $totalCredit += $row['amount'];
                            }
                            if ($row['type'] == 1) {
                                $totalDebit += $row['amount'];
                            }
                            endwhile; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-secondary">
                                <tr>
                                    <th colspan="4" class="text-right">TOTAL</th>
                                    <th class="text-right total_debit">0.00</th>
                                    <th class="text-right total_credit">0.00</th>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-center"></th>
                                    <th colspan="4" class="text-center total-balance">0</th>
                                </tr>
                            </tr>
                        </tfoot>
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
            <input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
            <input type="hidden" name="doc_no[]" value="<?php echo $newDocNo; ?>" readonly>
            <!-- <input type="hidden" name="account_code[]" value=""> -->
            <input type="hidden" name="type[]" value="<?= $row['type'] ?>">
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
        alert(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
<script>
$(document).ready(function () {
    $('.delete-row').on('click', function () {
        $(this).closest('tr').remove();
        cal_tb();
    });
});
document.addEventListener("DOMContentLoaded", function() {
    var selectedOption = document.getElementById('client_id').options[document.getElementById('client_id').selectedIndex];
    console.log("Selected Option:", selectedOption);
    if (selectedOption) {
        document.getElementById('client_code').value = selectedOption.getAttribute('data-client-code');
    }
});

document.getElementById('client_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    if (selectedOption) {
        document.getElementById('client_code').value = selectedOption.getAttribute('data-client-code');
    } else {
        document.getElementById('client_code').value = '';
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
            var type = $('#gtype').val();
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
            tr.find('input[name="type[]"]').val(type);
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
            $('#type').val('').trigger('change');
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
                el.addClass('alert-danger').text(" Hindi equal, lods.");
                _this.prepend(el);
                el.show('slow');
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            }
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
    document.addEventListener("DOMContentLoaded", function () {
        var saveJournalButton = document.getElementById("save_journal");
        var submitButton = document.getElementById("picform_submit_button");

        saveJournalButton.addEventListener("click", function () {
            submitButton.click();
        });
    });
</script>