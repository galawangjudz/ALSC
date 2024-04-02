<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>



<?php

$usertype = $_settings->userdata('user_type');
if (!isset($usertype)) {
    include '404.html';
  exit;
}

$user_role = $usertype;

if ($user_role != 'IT Admin') {
    include '404.html';
  exit;
}

?>
<?php

if (isset($_GET['id'])) {
    $prop_id = $_GET['id'];
    $user = $conn->query("SELECT * FROM property_payments WHERE property_id =" . $prop_id);
    $getPrin = $conn->query("SELECT SUM(principal) FROM property_payments WHERE property_id =" . $prop_id);
    $getSur = $conn->query("SELECT SUM(surcharge) FROM property_payments WHERE property_id =" . $prop_id);
    $getReb = $conn->query("SELECT SUM(rebate) FROM property_payments WHERE property_id =" . $prop_id);
    $getInt = $conn->query("SELECT SUM(interest) FROM property_payments WHERE property_id =" . $prop_id);

    if ($user && $getPrin && $getSur && $getReb && $getInt) {
        $userRow = $user->fetch_array();
        foreach ($userRow as $k => $v) {
            $meta[$k] = $v;
        }
        $sumRowPrin = $getPrin->fetch_array();
        $sumRowSur = $getSur->fetch_array();
        $sumRowReb = $getReb->fetch_array();
        $sumRowInt = $getInt->fetch_array();
        $sumPrin = $sumRowPrin[0];
        $sumSur = $sumRowSur[0];
        $sumReb = $sumRowReb[0];
        $sumInt = $sumRowInt[0];
    } else {
        // Handle query errors here
    }
}
?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}
.container-fluid p{
    margin: unset
}
#uni_modal .modal-footer{
    display: none;
} 
</style>
<body>
<div class="card card-outline rounded-0 card-maroon" style="width:100%;">
	<div class="card-header">
	    <h3 class="card-title"><?php echo !isset($_GET['id']) ? "Move to AV" :"Move to AV" ?></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form action="" id="manage-av">
                <input type="hidden" name="av_id" id="av_id" value="<?php echo isset($meta['property_id']) ? md5($meta['property_id']) : ''; ?>">
                <input type="hidden" name="p_id" id="p_id" value="<?php echo isset($prop_id) ? $prop_id : '' ?>">
                <div class="form-group">
                    <label class="control-label">AV No: </label>
                    <input type="text" class="form-control required" name="av_no" id="av_no">
                </div> 
                <div class="form-group">
                    <label class="control-label">AV Date: </label>
                    <input type="date" class="form-control required" name="av_date" id="av_date">
                </div>
                <div class="form-group">
                    <label for="name">AV Amount: </label>
                    <input type="text" class="form-control required" name="av_amount" id="av_amount" value="<?php echo isset($sumPrin) ? $sumPrin : '' ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Interest: </label>
                    <input type="text" class="form-control required" name="av_int" id="av_int" value="<?php echo isset($sumInt) ? $sumInt : '' ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Surcharge: </label>
                    <input type="text" class="form-control required" name="av_sur" id="av_sur" value="<?php echo isset($sumSur) ? $sumSur : '' ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Rebate: </label>
                    <input type="text" class="form-control required" name="av_reb" id="av_reb" value="<?php echo isset($sumReb) ? $sumReb : '' ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="name">New Account Number: </label>
                    <input type="number" class="form-control" name="new_acc_no"  id="new_acc_no">
                </div>
                <div class="form-group">
                    <label for="name">Remarks: </label>
                    <input type="text" class="form-control required" name="remarks" id="remarks">
                </div>

                <input type="hidden" class="form-control" name="paymentamt" id="paymentamt" value="<?php echo isset($meta['payment_amount']) ? ($meta['payment_amount']) : ''; ?>">
                <input type="hidden" class="form-control" name="paydate" id="paydate" value="<?php echo isset($meta['pay_date']) ? ($meta['pay_date']) : ''; ?>">
                <input type="hidden" class="form-control" name="duedate" id="duedate" value="<?php echo isset($meta['due_date']) ? ($meta['due_date']) : ''; ?>">
                <input type="hidden" class="form-control" name="orno" id="orno" value="<?php echo isset($meta['or_no']) ? ($meta['or_no']) : ''; ?>">
                <input type="hidden" class="form-control" name="amtdue" id="amtdue" value="<?php echo isset($meta['amount_due']) ? ($meta['amount_due']) : ''; ?>">
                <input type="hidden" class="form-control" name="reb" id="reb" value="<?php echo isset($meta['rebate']) ? ($meta['rebate']) : ''; ?>">
                <input type="hidden" class="form-control" name="sur" id="sur" value="<?php echo isset($meta['surcharge']) ? ($meta['surcharge']) : ''; ?>">
                <input type="hidden" class="form-control" name="interest" id="interest" value="<?php echo isset($meta['interest']) ? ($meta['interest']) : ''; ?>">
                <input type="hidden" class="form-control" name="prin" id="prin" value="<?php echo isset($meta['principal']) ? ($meta['principal']) : ''; ?>">
                <input type="hidden" class="form-control" name="rembal" id="rembal" value="<?php echo isset($meta['remaining_balance']) ? ($meta['remaining_balance']) : ''; ?>">
                <input type="hidden" class="form-control" name="stats" id="stats" value="<?php echo isset($meta['status']) ? ($meta['status']) : ''; ?>">
                <input type="hidden" class="form-control" name="stats_count" id="stats_count" value="<?php echo isset($meta['status_count']) ? ($meta['status_count']) : ''; ?>">
                <input type="hidden" class="form-control" name="p_count" id="p_count" value="<?php echo isset($meta['payment_count']) ? ($meta['payment_count']) : ''; ?>">
                <input type="hidden" class="form-control" name="excess" id="excess" value="<?php echo isset($meta['excess']) ? ($meta['excess']) : ''; ?>">
                <input type="hidden" class="form-control" name="acc_stats" id="acc_stats" value="<?php echo isset($meta['account_status']) ? ($meta['account_status']) : ''; ?>">
                <input type="hidden" class="form-control" name="gentime" id="gentime" value="<?php echo isset($meta['gen_time']) ? ($meta['gen_time']) : ''; ?>">
                <input type="hidden" class="form-control" name="transdate" id="transdate" value="<?php echo isset($meta['trans_date']) ? ($meta['trans_date']) : ''; ?>">
                <input type="hidden" class="form-control" name="surchargepercent" id="surchargepercent" value="<?php echo isset($meta['surcharge_percent']) ? ($meta['surcharge_percent']) : ''; ?>">
            </form>
		</div>
		<div class="card-footer">
				<button class="btn btn-flat btn-sm btn-default bg-maroon" form="manage-av">Save</button>
				<a class="btn btn-flat btn-sm btn-default" href="./?page=clients/property&id=<?php echo md5($meta['property_id']) ?>">Cancel</a>
		</div>
	</div>
</div>
</body>
<script>
function validateForm() {
	    // error handling
	    var errorCounter = 0;

	    $(".required").each(function(i, obj) {

	        if($(this).val() === ''){
	            $(this).parent().addClass("has-error");
	            errorCounter++;
	        } else{ 
	            $(this).parent().removeClass("has-error"); 
	        }

	    });
		
	    return errorCounter;

	}
    $('#manage-av').submit(function(e){
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        
        var errorCounter = validateForm();
        if (errorCounter > 0) {
            alert_toast("It appear's you have forgotten to complete something!","warning");	  
            return false;
        }else{
            $(".required").parent().removeClass("has-error")
        }    
        start_loader();
        $.ajax({
                url:_base_url_+"classes/Master.php?f=save_av",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        move_av();
                        location.reload();
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })


function move_av(){
    start_loader();
    $.ajax({
        url:_base_url_+'classes/Master.php?f=move_av',
        method:'POST',
        data:{prop_id:'<?php echo $prop_id ?>'},
        dataType:"json",
        error:err=>{
            console.log(err)
            alert_toast("An error occured",'error');
            end_loader();
            },
        success:function(resp){
            if(typeof resp =='object' && resp.status == 'success'){
                // location.reload();
                // redirectSoa();
                location.reload();
        
            }else{
                alert_toast(resp.err,'error');
                end_loader();
                //console.log(resp)
            }
        }
    })
}
// function new_av($prop_id){
//         start_loader();
//         $.ajax({
//             url:_base_url_+"classes/Master.php?f=save_av",
//             method:"POST",
//             data:{prop_id: $prop_id},
//             dataType:"json",
//             error:err=>{
//                 console.log(err)
//                 alert_toast("An error occured!",'error');
//                 end_loader();
//             },
//             success:function(resp){
//                 if(typeof resp== 'object' && resp.status == 'success'){
//                     location.reload();
//                 }else{
//                     alert_toast("An error occured.",'error');
//                     end_loader();
//                 }
//             }
//         })
//     }
</script>