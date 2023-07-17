<?php 
require_once('../../../config.php');
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

// if ($user_role != 'IT Admin') {
//     include '404.html';
//   exit;
// }

?>
<?php

if (isset($_GET['id'])) {
    $prop_id = $_GET['id'];
    $total = $conn->query("SELECT property_id, sum(principal) as sumPrin,SUM(surcharge) as sumSur,SUM(rebate) as sumReb,SUM(interest) as sumInt FROM property_payments WHERE payment_amount != 0 and property_id =" . $prop_id);

    if ($total) {
        $userRow = $total->fetch_array();
        foreach ($userRow as $k => $v) {
            $meta[$k] = $v;
        }


        $sumPrin = $meta['sumPrin'];
        $sumSur =$meta['sumSur'];
        $sumReb = $meta['sumReb'];
        $sumInt = $meta['sumInt']; 

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
<body onload = "getTotalAV();">
<div class="card card-outline rounded-0 card-maroon" style="width:100%;">
	<div class="card-header">
	    <h3 class="card-title"><?php echo !isset($_GET['id']) ? "Move to AV" :"Move to AV" ?></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form action="" id="manage-av">
                <input type="hidden" name="av_id" id="av_id" value="<?php echo isset($meta['property_id']) ? md5($meta['property_id']) : ''; ?>">
                <input type="hidden" name="p_id" id="p_id" value="<?php echo isset($prop_id) ? $prop_id : '' ?>">
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="av_type" class="control-label">Type of AV: </label>
                                <select class="form-control required" name="av_type" id="av_type">
                                    <option value="1">1-Relocation</option>
                                    <option value="2">2-Transfer of Location</option>
                                    <option value="3">3-Change of Model House</option>
                                    <option value="4">4-Downgrade</option>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label class="control-label">AV No: </label>
                                <input type="number" class="form-control required" name="av_no" id="av_no">
                            </div> 
                            <div class="form-group">
                                <label class="control-label">AV Date: </label>
                                <input type="date" class="form-control required" name="av_date" id="av_date">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="name">Total Interest: </label>
                                <input type="text" class="form-control required" name="av_int" id="av_int" value="<?php echo isset($sumInt) ? $sumInt : '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Total Surcharge: </label>
                                <input type="text" class="form-control required" name="av_sur" id="av_sur" value="<?php echo isset($sumSur) ? $sumSur : '' ?>" readonly>
                            </div>   
                        </div>
                    </div>
                </div>

                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="form-group">
                                <label for="name">Total Principal: </label>
                                <input type="text" class="form-control required" name="av_prin" id="av_prin" value="<?php echo isset($sumPrin) ? $sumPrin : '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Total Rebate: </label>
                                <input type="text" class="form-control required" name="av_reb" id="av_reb" value="<?php echo isset($sumReb) ? $sumReb : '' ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Total of Other Deductions: </label>
                                <input type="text" class="form-control required" name="av_deduc" id="av_deduc" oninput = "getTotalAV();" required>
                            </div>

                            <table style="border:solid 1px black;width:100%;background-color:whitesmoke;">
                                <tr>
                                    <td>
                                        <div class="container-fluid">
                                            <div class="form-group">
                                                <label for="name">AV AMOUNT : </label>
                                                <input type="text" class="form-control required" name="total_av" id="total_av">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="container-fluid">
                          <!--   <div class="form-group">
                                <label for="name">New Account Number: </label>
                                <input type="number" class="form-control" name="new_acc_no"  id="new_acc_no">
                            </div> -->
                            <div class="form-group">
                                <label for="name">Remarks: </label>
                                <textarea  class="form-control required" name="remarks" id="remarks" rows="4" cols="50"></textarea>
                              <!--   <input type="text" class="form-control required" name="remarks" id="remarks"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
		</div>
		<div class="card-footer">
            <table style="width:100%;">
                <tr>
                    <td>
				        <button class="btn btn-flat btn-sm btn-default bg-maroon" form="manage-av" style="width:100%; margin-right:5px;font-size:14px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                    </td>
                    <td>
				        <a class="btn btn-flat btn-sm btn-default" href="./?page=clients/property&id=<?php echo md5($meta['property_id']) ?>" style="width:100%; margin-left:5px;font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                    </td>
            </table>
        </div>
	</div>
</div>
</body>
<script>



function getTotalAV() {
      var prin = parseFloat(document.getElementById('av_prin').value);
      var reb = parseFloat(document.getElementById('av_reb').value);
      var deduc = parseFloat(document.getElementById('av_deduc').value);

      var res = (prin + reb) - deduc;

      document.getElementById('total_av').value = res;
    }
  </script>
<script>

function validateForm() {
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

</script>
<script>
  var currentDate = new Date();

  var year = currentDate.getFullYear();
  var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
  var day = currentDate.getDate().toString().padStart(2, '0');
  var formattedDate = year + '-' + month + '-' + day;

  document.getElementById('av_date').value = formattedDate;
</script>