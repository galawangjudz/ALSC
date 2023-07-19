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


/* 
if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM t_lots where c_lid =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
 */
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
<div class="card card-outline rounded-0 card-dark">
	<div class="card-header">
	<h3 class="card-title"><b><i>Credit Memo</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			
            <form action="" id="manage-cm">
                <input type="hidden" name="prod_lid" id="prod_lid" value="<?php echo isset($meta['c_lid']) ? $meta['c_lid']: '' ?>">
                <div class="form-group">
                    <label class="control-label">Client Name: </label>
                </div> 
                <div class="form-group">
                    <label for="name">Date:</label>
                    <input type="date" class="form-control required" name="cm_date" id="cm_date" value="0">
                </div>
                <div class="form-group">
                    <label for="name">Credit Amount: </label>
                    <input type="number" class="form-control required" name="cm_amount" id="cm_amount" value="0">
                </div>
                <div class="form-group">
                    <label for="name">Reason: </label>
                    <input type="number" class="form-control required" name="cm_reason"  id="cm_reason" value="0">
                </div>
                <div class="form-group">
                    <label for="name">Reference: </label>
                    <input type="text" class="form-control required" name="cm_reference" id="cm_reference" value="0">
                </div>
            
                <div class="form-group">
                    <label class="control-label">Status: </label>
                    <div class="input-group">
                        <input type="text" name="cm_status" id="cm_status" value="" class="form-control" placeholder="0.00">
                    </div>
                </div>
              
            </form>
		</div>
		<div class="card-footer">
            <table style="width:100%;">
                <tr>
                    <td>
				        <button class="btn btn-flat btn-default bg-maroon" form="manage-lot"  style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
                    </td>
                    <td>
				        <a class="btn btn-flat btn-default" href="./?page=inventory/lot-list" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
                    </td>
                </tr>
            </table>
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
    $(document).ready(function(){

	$('#manage-cm').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_lot",
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

	})
</script>