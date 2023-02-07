<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php

if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM t_model_house where c_code =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}

?>

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
	<h3 class="card-title"><?php echo !isset($_GET['id']) ? "Add House Model" :"Edit House Model" ?></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form action="" id="manage-model-h">
                <input type="hidden" name="prod_id" value="<?php echo isset($meta['c_code']) ? $meta['c_code']: '' ?>">
            <div class="form-group">
                <label class="control-label">Code: </label>
                <input type="number" class="form-control required" name="c_code" id="c_code" value="<?php echo isset($meta['c_code']) ? $meta['c_code']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Model: </label>
                <input type="text" class="form-control required" name="c_model" id="c_model" value="<?php echo isset($meta['c_model']) ? $meta['c_model']: '' ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Acronym: </label>
                <input type="text" class="form-control required" name="c_acronym" id="c_acronym" value="<?php echo isset($meta['c_acronym']) ? $meta['c_acronym']: '' ?>">
            </div>
        </form>
        
		</div>
		<div class="card-footer">
				<button class="btn btn-flat btn-sm btn-default bg-maroon" form="manage-model-h">Save</button>
				<a class="btn btn-flat btn-sm btn-default" href="./?page=inventory/model-list">Cancel</a>
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

	$('#manage-model-h').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_house_model",
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