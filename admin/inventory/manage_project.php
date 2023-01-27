<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php

if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM t_projects where c_code =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
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
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<h3 class="card-title"><?php echo !isset($_GET['id']) ? "Add Project Site" :"Edit Project Site" ?></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <form action="" id="manage-project">
        <input type="hidden" name="prod_id" value="<?php echo isset($meta['c_code']) ? $meta['c_code']: '' ?>">
            <div class="form-group">
                <label class="control-label">Code: </label>
                <input type="number" class="form-control required" name="c_code" id="c_code" value="<?php echo isset($meta['c_code']) ? $meta['c_code']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Name: </label>
                <input type="text" class="form-control required" name="c_name" id="c_name" value="<?php echo isset($meta['c_name']) ? $meta['c_name']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Acronym: </label>
                <input type="text" class="form-control required" name="c_acronym" id="c_acronym" value="<?php echo isset($meta['c_acronym']) ? $meta['c_acronym']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Address: </label>
                <input type="text" class="form-control required" name="c_address" id="c_address" value="<?php echo isset($meta['c_address']) ? $meta['c_address']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">City/Province: </label>
                <input type="text" class="form-control required" name="c_province" id="c_province" value="<?php echo isset($meta['c_province']) ? $meta['c_province']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Zipcode: </label>
                <input type="text" class="form-control required" name="c_zip" id="c_zip" value="<?php echo isset($meta['c_zip']) ? $meta['c_zip']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Rate: </label>
                <input type="number" class="form-control required" name="c_rate" id="c_rate" value="<?php echo isset($meta['c_rate']) ? $meta['c_rate']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Reservation: </label>
                <input type="number" class="form-control required" name="c_reservation" id="c_reservation" value="<?php echo isset($meta['c_reservation']) ? $meta['c_reservation']: '' ?>">
            </div>
            <div class="form-group">
                <label for="c_status">Status</label>
                <select name="c_status" id="c_status" class="form-control required">
                    <option value="0" <?php echo isset($meta['c_status']) && $meta['c_status'] == 0 ? 'selected': '' ?>>Pre-Develop</option>
                    <option value="1" <?php echo isset($meta['c_status']) && $meta['c_status'] == 1 ? 'selected': '' ?>>Develop</option>
                </select>
            </div>
        </form>
        
		</div>
		<div class="card-footer">
				<button class="btn btn-flat btn-sm btn-default bg-maroon" form="manage-project">Save</button>
				<a class="btn btn-flat btn-sm btn-default" href="./?page=inventory/project-list">Cancel</a>
		</div>
	</div>
</div>
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

	$('#manage-project').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_project",
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