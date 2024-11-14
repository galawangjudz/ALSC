<?php
require_once('../../config.php');
$usercode = $_settings->userdata('user_code'); 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE rfp_no = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k = stripslashes($v);
        }
    }
} else{
    $payment_form = "";
    $req_dept = "";
}
if(isset($_GET['id']) && $_GET['id'] > 0){
    $autoIncrementQry = $conn->query("SHOW TABLE STATUS LIKE 'tbl_rfp'");
    
    if ($autoIncrementQry) {
        $autoIncrementRow = $autoIncrementQry->fetch_assoc();
        $nextAutoIncrement = $autoIncrementRow['Auto_increment'];
        $concatenatedValue = $rfp_no;

        //echo $concatenatedValue;

    } else {
        echo "Error getting auto-increment value: " . $conn->error;
    }
}else{
    $autoIncrementQry = $conn->query("SHOW TABLE STATUS LIKE 'tbl_rfp'");
    
    if ($autoIncrementQry) {
        $autoIncrementRow = $autoIncrementQry->fetch_assoc();
        $nextAutoIncrement = $autoIncrementRow['Auto_increment'];
        $concatenatedValue = '186160' . $nextAutoIncrement;

        //echo $concatenatedValue;

    } else {
        echo "Error getting auto-increment value: " . $conn->error;
    }
}
?>
<style>
	.nav-rfp{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-rfp:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    #amountToWords{
        background-color:gainboro;
        border:solid 1px gainsboro;
        font-style: italic;
        font-weight: bold;
        padding-left:25px;
        text-transform: uppercase;
    }
</style>
    <script src="../../libs/js/lightbox.min.js"></script>
    <link rel="stylesheet" href="../../libs/js/jquery.fancybox.min.css"/>
    <script src="../../libs/js/jquery.fancybox.min.js"></script>
<body>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title"><b><i>View Request for Payment (RFP #: <?php echo $concatenatedValue; ?>)</b></i></h5>
        </div>
        <div class="card-body">
        <div id="attachments-container">
            <table class="table table-striped table-bordered" id="data-table2" style="text-align:center;width:100%;">
                <colgroup>
                    <col width="50%">
                    <col width="50%">
                </colgroup>
                <thead>
                    <tr class="bg-navy disabled">
                        <th class="px-1 py-1 text-center">Attachment/s</th>
                        <th class="px-1 py-1 text-center">Date/Time Attached</th>
                    </tr>
                </thead>
                <?php 
                $i = 1;
                $rows = mysqli_query($conn, "SELECT * FROM tbl_vs_attachments WHERE doc_no = $concatenatedValue ORDER BY date_attached DESC");
                ?>
                <?php if (mysqli_num_rows($rows) > 0): ?>
                    <?php foreach($rows as $row):?>
                        <tr>
                            <td>
                                <?php
                                    $fileExtension = pathinfo($row['image'], PATHINFO_EXTENSION);
                                    $filePath = base_url . "employee/attachments/" . $row['image']; 

                                    if (strtolower($fileExtension) == 'pdf'): ?>
                                        <a data-fancybox data-src="<?php echo $filePath; ?>" data-type="iframe" href="javascript:;">
                                            <img src="<?php echo base_url . 'employee/icons/pdf-icon.png'; ?>" alt="PDF Icon" width="25" height="25">
                                        </a>
                                    <?php elseif (in_array(strtolower($fileExtension), ['xlsx'])): ?>
                                        <a href="<?php echo $filePath; ?>" download>
                                            <img src="<?php echo base_url . 'employee/icons/excel.png'; ?>" alt="XLSX Icon" width="25" height="25">
                                        </a>
                                    <?php elseif (in_array(strtolower($fileExtension), ['docx'])): ?>
                                        <a href="<?php echo $filePath; ?>" download>
                                            <img src="<?php echo base_url . 'employee/icons/docx.jpg'; ?>" alt="DOCX Icon" width="25" height="25">
                                        </a>
                                    <?php elseif (in_array(strtolower($fileExtension), ['csv'])): ?>
                                        <a href="<?php echo $filePath; ?>" download>
                                            <img src="<?php echo base_url . 'employee/icons/csv.png'; ?>" alt="CSV Icon" width="25" height="25">
                                        </a>
                                    <?php else: ?>
                                        <a data-fancybox="images" href="<?php echo $filePath; ?>" data-caption="<?php echo $row['image']; ?>">
                                            <img src="<?php echo $filePath; ?>" alt="" width="25" height="25">
                                        </a>
                                    <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                    $timestamp = strtotime($row["date_attached"]);
                                    $formattedDate = date('F j, Y g:i:sA', $timestamp);
                                    echo $formattedDate;
                                ?>
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
        <div class="card-body">
                <form action="" id="rfp-form">
                <input type="hidden" name="division" value="<?php echo $_settings->userdata('division'); ?>">
                <input type="hidden" name="usercode" value="<?php echo $_settings->userdata('user_code'); ?>">
                <input type="hidden" name="preparer" value="<?php echo ($usercode); ?>">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <input type="hidden" name="rfp_no" value="<?php echo isset($concatenatedValue) ? $concatenatedValue : '' ?>">
                <hr>
                <br>
                <div class="container-fluid">
                <div class="col-md-12 form-group">
                    <label for="rfp_no">Approved Vouchers:</label>
                    <br><hr>
                    <table class="table table-bordered" id="data-table1" style="text-align:center;width:100%;">
                        <thead>
                            <tr class="bg-navy disabled">
                                <th>#</th>
                                <th>VS #</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i = 1;
                            $qry = $conn->query("SELECT DISTINCT
                            vs.v_num AS mainId,
                            vs.supplier_id, 
                            vs.journal_date,
                                COALESCE(s.id, pc.client_id, ta.c_code, u.user_code) AS supId,
                                COALESCE(s.name, CONCAT(pc.last_name, ', ', pc.first_name, ' ', pc.middle_name), 
                                        CONCAT(ta.c_last_name, ', ', ta.c_first_name, ' ', ta.c_middle_initial),
                                        CONCAT(u.lastname, ', ', u.firstname)) AS supplier_name
                            FROM `vs_entries` vs
                            JOIN `vs_items` vi ON vs.v_num = vi.journal_id
                            LEFT JOIN supplier_list s ON vs.supplier_id = s.id
                            LEFT JOIN property_clients pc ON vs.supplier_id = pc.client_id
                            LEFT JOIN t_agents ta ON vs.supplier_id = ta.c_code
                            LEFT JOIN users u ON vs.supplier_id = u.user_code
                            WHERE 
                                vs.c_status = 1
                            ORDER BY 
                                vs.journal_date ASC;");
                            while ($row = $qry->fetch_assoc()) {
                            ?>
                            <tr class="clickable-row" data-vs="<?php echo $row['mainId']; ?>" style="cursor:pointer;">
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['mainId']); ?></td>
                                <td><?php echo htmlspecialchars($row['supplier_name']); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <hr class="custom-hr">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="rfp_no">Selected VS #:</label>
                            <input type="text" id="vs_no" name="vs_no" value="<?php echo isset($vs_no) ? $vs_no: ""; ?>" class="form-control form-control-sm form-control-border rounded-0" readonly> 
                        </div>
                    </div>

                    <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var rows = document.querySelectorAll('.clickable-row');
                        rows.forEach(function(row) {
                            row.addEventListener('click', function() {
                                var vsNo = this.querySelector('td:nth-child(2)').innerText;
                                document.getElementById('vs_no').value = vsNo;
                            });
                        });
                    });
                    </script>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="req_dept" class="control-label">Requesting Department:</label>
                            <input type="text" name="req_dept" id="req_dept" value="<?php echo $_settings->userdata('department'); ?>" class="form-control rounded-0" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="transaction_date" class="control-label">Transaction Date:</label>
                            <?php
                            if (!empty($transaction_date)) {
                                $transactionformattedDate = date('Y-m-d', strtotime($transaction_date));
                            } else {
                                $transactionformattedDate = date('Y-m-d');
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="transaction_date" name="transaction_date" value="<?php echo isset($transactionformattedDate) ? $transactionformattedDate : '' ?>" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="payment_form" class="control-label">Payment Form:</label>
                            <input type="text" name="payment_form" id="payment_form" class="form-control rounded-0" required value="<?php echo ($payment_form === "0") ? "Check" : "Cash"; ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="bank_name" class="control-label">Bank Name:</label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control rounded-0" value="<?php echo isset($bank_name) ? $bank_name :"" ?>" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="rfp_for" class="control-label">RFP For:</label>
                            <input 
                                type="text"               
                                name="rfp_for"            
                                id="rfp_for"              
                                class="form-control rounded-0" 
                                required                  
                                <?php 
                                    if ($rfp_for === "1") {
                                        echo 'value="Agent"'; 
                                    } elseif ($rfp_for === "2") {
                                        echo 'value="Employee"'; 
                                    } elseif ($rfp_for === "3") {
                                        echo 'value="Client"'; 
                                    } elseif ($rfp_for === "4") {
                                        echo 'value="Supplier"'; 
                                    } elseif ($rfp_for === "5") {
                                        echo 'value="Others"'; 
                                    } else {
                                        echo 'value=""'; 
                                    }
                                ?>
                                readonly                  
                            >
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="name" class="control-label">Payable to:</label>
                            <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="amount" class="control-label">Amount:</label>
                            <input type="text" name="amount" id="amount" class="form-control rounded-0" value="<?php echo isset($amount) ? number_format($amount,2) : ""; ?>" required readonly> 
                        </div>
                        <div class="col-md-6 form-group" style="padding-top:30px;">
                            <div id="amountToWords" class="text-display" style="background-color:gainsboro;height:40px;padding-top:5px; overflow: auto;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="address" class="control-label">Address:</label>
                            <textarea rows="1" name="address" id="address" class="form-control rounded-0" required readonly><?php echo isset($address) ? $address :"" ?></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="checkname" class="control-label">Check Name:</label>
                            <input type="text" name="check_name" id="check_name" class="form-control rounded-0" value="<?php echo isset($check_name) ? $check_name : ""; ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="check_date" class="control-label">Check Date:</label>
                            <?php
                            if (!empty($check_date)) {
                                $checkformattedDate = date('Y-m-d', strtotime($check_date));
                            } else {
                                $checkformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="check_date" name="check_date" value="<?php echo isset($checkformattedDate) ? $checkformattedDate : '' ?>" required readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="release_date" class="control-label">Release Date:</label>
                            <?php
                            if (!empty($release_date)) {
                                $releaseformattedDate = date('Y-m-d', strtotime($release_date));
                            } else {
                                $releaseformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="release_date" name="release_date" value="<?php echo isset($releaseformattedDate) ? $releaseformattedDate : '' ?>" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="pr_no" class="control-label">PR No:</label>
                            <input type="text" name="pr_no" id="pr_no" class="form-control rounded-0" value="<?php echo isset($pr_no) ? $pr_no :"" ?>" required readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="po_no" class="control-label">PO No:</label>
                            <input type="text" name="po_no" id="po_no" class="form-control rounded-0" value="<?php echo isset($po_no) ? $po_no :"" ?>" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="cdv_no" class="control-label">CDV No:</label>
                            <input type="text" name="cdv_no" id="cdv_no" class="form-control rounded-0" value="<?php echo isset($cdv_no) ? $cdv_no :"" ?>" required readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ofv_no" class="control-label">OFV No:</label>
                            <input type="text" name="ofv_no" id="ofv_no" class="form-control rounded-0" value="<?php echo isset($ofv_no) ? $ofv_no :"" ?>" required readonly>
                        </div>
                    </div>





                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="10" name="description" id="description" class="form-control rounded-0" required readonly><?php echo isset($description) ? $description :"" ?></textarea>
                        </div>
                    </div>
           
                    
                    
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="remarks" class="control-label">Remarks:</label>
                            <textarea rows="3" name="remarks" id="remarks" class="form-control rounded-0" required readonly><?php echo isset($remarks) ? $remarks :"" ?></textarea>
                        </div>
                    </div>
            
                    <br><hr><br>
                    <div class="card-body" style="border:1px solid gainsboro;">
                         <label for="" class="control-label"># of Approvers: </label>
                        <?php 
                        $rfp_query = $conn->prepare("SELECT status1, status2, status3, status4, status5, status6, status7 FROM tbl_rfp WHERE rfp_no = ?");
                        $rfp_query->bind_param("i", $_GET['id']);
                        $rfp_no = $_GET['id'];
                        $rfp_query->execute();
                        $rfp_result = $rfp_query->get_result();

                        $user_codes_from_db = array();

                        while ($row = $rfp_result->fetch_assoc()) {
                            foreach ($row as $status) {
                                if (!empty($status)) {
                                    $user_codes_from_db[] = $status;
                                }
                            }
                        }
                        
                        $total_count = count($user_codes_from_db);
                        ?>
                        
                        <input type="text" id="inputValue" value="<?php echo $total_count; ?>" style="width:50px;background-color:gainsboro;border:none;margin-left:10px;font-weight:bold;text-align:center;" readonly>
                        <br><hr>
                        <div class="container-fluid approversDiv">
                            <?php
                            for ($i = 0; $i < $total_count; $i++) {
                                $selected_user_qry = $conn->query("SELECT * FROM `users` WHERE user_code = '{$user_codes_from_db[$i]}'");
                                $selected_user_row = $selected_user_qry->fetch_assoc();

                                echo '<div class="approver-row">';
                                echo '<label for="status' . ($i + 1) . '">Approver ' . ($i + 1) . ':</label>';
                                echo '<input type="text" id="status' . ($i + 1) . '" class="form-control" readonly value="' . $selected_user_row['lastname'] . ', ' . $selected_user_row['firstname'] . '">';

                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        <div>
    <div>
</body>
<script>
    $(document).ready(function() {
        $('#data-table1').DataTable();
        $('#data-table2').DataTable();
    });
 document.addEventListener('DOMContentLoaded', function() {
        initialize();
    });

    function initialize() {
        var amountElement = document.getElementById('amount');
        amountElement.addEventListener('input', function() {
            var amount = this.value.trim();
            if (amount === '') {
                document.getElementById('amountToWords').innerText = '';
                return;
            }

            var amountInWords = convertAmountToWords(amount);
            document.getElementById('amountToWords').innerText =  amountInWords;
        });
        var initialAmount = amountElement.value.trim();
        if (initialAmount !== '') {
            var amountInWords = convertAmountToWords(initialAmount);
            document.getElementById('amountToWords').innerText = amountInWords;
        }
    }
    function convertAmountToWords(amount) {
        amount = amount.replace(/,/g, '');
        amount = parseFloat(amount).toFixed(2);
        var numArr = amount.split('.');

        var wholePart = numArr[0];
        var decimalPart = numArr[1] || '00';

        var words = convertToWords(wholePart);

        if (decimalPart != '00') {
            words += ' pesos and ' + convertToWords(decimalPart) + ' centavos ONLY';
        } else {
            words += ' pesos ONLY';
        }

        return words;
    }

    function convertToWords(number) {
        var units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        var teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        var tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        var words = '';

        if (number > 999999) {
            words += convertToWords(Math.floor(number / 1000000)) + ' Million ';
            number %= 1000000;
        }

        if (number > 999) {
            words += convertToWords(Math.floor(number / 1000)) + ' Thousand ';
            number %= 1000;
        }

        if (number > 99) {
            words += units[Math.floor(number / 100)] + ' Hundred ';
            number %= 100;
        }

        if (number > 10 && number < 20) {
            words += teens[number - 10];
        } else {
            words += tens[Math.floor(number / 10)] + ' ' + units[number % 10];
        }

        return words.trim();
    }

    document.getElementById('amount').addEventListener('input', function() {
        var amount = this.value.trim();
        if (amount === '') {
            document.getElementById('amountToWords').innerText = '';
            return;
        }

        var amountInWords = convertAmountToWords(amount);
      
        document.getElementById('amountToWords').innerText =  amountInWords;
    });
</script>
