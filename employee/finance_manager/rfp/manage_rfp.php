<?php
require_once('../../config.php');
$usercode = $_settings->userdata('user_code'); 
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * FROM `tbl_rfp` WHERE id = '{$_GET['id']}' ");
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
</style>
<body>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title"><b><i><?php echo isset($_GET['id']) ? "Update Request for Payment" : "Add New Request for Payment" ?></b></i></h5>
        </div>
        <div class="card-body">
            <form action="" id="rfp-form">
                <input type="text" name="preparer" value="<?php echo ($usercode); ?>">
                <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
                <input type="hidden" name="rfp_no" value="<?php echo isset($concatenatedValue) ? $concatenatedValue : '' ?>">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="description" class="control-label">Particulars:</label>
                            <textarea rows="10" name="description" id="description" class="form-control rounded-0" required><?php echo isset($description) ? $description :"" ?></textarea>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="amount" class="control-label">Amount:</label>
                            <textarea rows="10" name="amount" id="amount" class="form-control rounded-0" required><?php echo isset($amount) ? $amount :"" ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="control-label">Payable to:</label>
                        <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Address:</label>
                        <textarea rows="3" name="address" id="address" class="form-control rounded-0" required><?php echo isset($address) ? $address :"" ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="payment_form" class="control-label">Payment Form:</label>
                            <select name="payment_form" id="payment_form" class="form-control rounded-0" required>
                                <option value="" disabled selected>--Select Payment--</option>
                                <option value="1" <?php echo ($payment_form === "0") ? "selected" : ""; ?>>Check</option>
                                <option value="0" <?php echo ($payment_form === "1") ? "selected" : ""; ?>>Cash</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="bank_name" class="control-label">Bank Name:</label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control rounded-0" value="<?php echo isset($bank_name) ? $bank_name :"" ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-4 form-group">
                            <label for="release_date" class="control-label">Release Date:</label>
                            <?php
                            if (!empty($release_date)) {
                                $releaseformattedDate = date('Y-m-d', strtotime($release_date));
                            } else {
                                $releaseformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="release_date" name="release_date" value="<?php echo isset($releaseformattedDate) ? $releaseformattedDate : '' ?>" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="check_date" class="control-label">Check Date:</label>
                            <?php
                            if (!empty($check_date)) {
                                $checkformattedDate = date('Y-m-d', strtotime($check_date));
                            } else {
                                $checkformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="check_date" name="check_date" value="<?php echo isset($checkformattedDate) ? $checkformattedDate : '' ?>" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="transaction_date" class="control-label">Transaction Date:</label>
                            <?php
                            if (!empty($transaction_date)) {
                                $transactionformattedDate = date('Y-m-d', strtotime($transaction_date));
                            } else {
                                $transactionformattedDate = '';
                            }
                            ?>     
                            <input type="date" class="form-control form-control-sm rounded-0" id="transaction_date" name="transaction_date" value="<?php echo isset($transactionformattedDate) ? $transactionformattedDate : '' ?>" required>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="req_dept" class="control-label">Requesting Department:</label>
                            <select name="req_dept" id="req_dept" class="form-control rounded-0" required>
                                <option value="" disabled selected></option>
                                <option value="IT" <?php echo ($req_dept === "Information Technology") ? "selected" : ""; ?>>IT</option>
                                <option value="GSS" <?php echo ($req_dept === "GSS") ? "selected" : ""; ?>>GSS</option>
                                <option value="HR/CompBen" <?php echo ($req_dept === "HR/CompBen") ? "selected" : ""; ?>>HR/CompBen</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="pr_no" class="control-label">PR No:</label>
                            <input type="text" name="pr_no" id="pr_no" class="form-control rounded-0" value="<?php echo isset($pr_no) ? $pr_no :"" ?>" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="po_no" class="control-label">PO No:</label>
                            <input type="text" name="po_no" id="po_no" class="form-control rounded-0" value="<?php echo isset($po_no) ? $po_no :"" ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="cdv_no" class="control-label">CDV No:</label>
                            <input type="text" name="cdv_no" id="cdv_no" class="form-control rounded-0" value="<?php echo isset($cdv_no) ? $cdv_no :"" ?>" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="ofv_no" class="control-label">OFV No:</label>
                            <input type="text" name="ofv_no" id="ofv_no" class="form-control rounded-0" value="<?php echo isset($ofv_no) ? $ofv_no :"" ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="remarks" class="control-label">Remarks:</label>
                        <textarea rows="3" name="remarks" id="remarks" class="form-control rounded-0" required><?php echo isset($remarks) ? $remarks :"" ?></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <table style="width:100%;">
                        <tr>
                            <td>
                                <button class="btn btn-flat btn-default bg-maroon" style="width:100%;margin-right:5px;font-size:14px;" id="save_rfp"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
                            </td>
                            <td>
                                <a href="?page=journals/"  class="btn btn-flat btn-default" id="cancel" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        <div>
    <div>
</body>
<script>
    $(function(){
    $('#rfp-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        
        // var requiredFields = ['name', 'short_name', 'tin', 'address', 'contact_person', 'email', 'contact', 'mop', 'terms', 'vatable', 'status'];
        // var isValid = true;

        // for (var i = 0; i < requiredFields.length; i++) {
        //     var fieldName = requiredFields[i];
        //     var fieldValue = _this.find('[name="' + fieldName + '"]').val().trim();

        //     if (fieldValue === '') {
        //         isValid = false;
        //         var errorMsg = 'May kulang po. Hehe.';
        //         var existingError = _this.find('.err-msg:contains("' + errorMsg + '")');
                
        //         if (existingError.length === 0) {
        //             var el = $('<div>').addClass("alert alert-danger err-msg").text(errorMsg);
        //             _this.prepend(el);
        //             el.show('slow');
        //             $("html, body").animate({ scrollTop: 0 }, "fast");
        //         }
        //     }
        // }

        // if (!isValid) {
        //     return false;
        // }

        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_rfp",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                } else {
                    alert_toast("An error occurred", 'error');
                    console.log(resp);
                }
                end_loader();
            }
        });
    });
});

</script>