<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 
$username = $_settings->userdata('username');
if(isset($_GET['id'])){
$client = $mysqli->query("SELECT * FROM t_buyer_info where id =".$_GET['id']);
foreach($client->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}

?>
<?php include '.././classes/new_functions.php'; ?>
<style>
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

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>New Client</i></b></h3>
	</div>
<div class="card-body">
<div class="container-fluid">
	<form action="" id="manage-client">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <input type="hidden" name="username" id="username" value="<?php echo $username?>">
        <input type="hidden" name="comm" id="comm" value="<?php echo $username ?> added a new client.">
        <div class="panel panel-default">
            <div class="panel-body form-group form-group-sm">
               <!--  <div class="main_box"> -->
                    <div class="row">
                        <div class="col-md-4">		
                            <div class="form-group">
                                <label for="customer_last_name" class="control-label">Last Name: </label>
                                <input type="text" class="form-control margin-bottom copy-input required" name="customer_last_name" id="customer_last_name" oninput="onlyLetters()" value="<?php echo isset($meta['last_name']) ? $meta['last_name']: '' ?>">

                            </div>
                           
                        </div>
                        <div class="col-md-3">		
                            <div class="form-group">
                                <label for="customer_first_name" class="control-label">First Name: </label>

                                <input type="text" class="form-control margin-bottom copy-input required" name="customer_first_name" id="customer_first_name" oninput="onlyLetters()" value="<?php echo isset($meta['first_name']) ? $meta['first_name']: '' ?>">	

                            </div>
                           
                        </div>
                        <div class="col-md-3">		
                            <div class="form-group">
                                <label for="customer_middle_name" class="control-label">Middle Name: </label>

                                <input type="text" class="form-control margin-bottom copy-input" name="customer_middle_name" id="customer_middle_name" oninput="onlyLetters()" value="<?php echo isset($meta['middle_name']) ? $meta['middle_name']: '' ?>">	

                            </div>
                         
                        </div>
                        <div class="col-md-2">		
                            <div class="form-group">
                                <label for="customer_suffix_name" class="control-label">Suffix Name: </label>

                                <input type="text" class="form-control margin-bottom copy-input" name="customer_suffix_name" id="customer_suffix_name" oninput="onlyLetters()" value="<?php echo isset($meta['suffix_name']) ? $meta['suffix_name']: '' ?>">	

                            </div>
                         
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">		
                            <div class="form-group">
                                <label for="customer_address" class="control-label">Residential/Billing Address: </label>
                                <input type="text" class="form-control margin-bottom required" name="customer_address" id="customer_address" value="<?php echo isset($meta['address']) ? $meta['address']: '' ?>">		
                            </div>
                        </div>
                      
                        <div class="col-md-2">		
                            <div class="form-group">
                                <label for="customer_zip_code" class="control-label">Area Code: </label>

                                <input type="number" class="form-control copy-input required" name="customer_zip_code" id="customer_zip_code" value="<?php echo isset($meta['zip_code']) ? $meta['zip_code']: '' ?>">					

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="customer_address_2" class="control-label">Address Abroad (if any): </label>
                                <input type="text" class="form-control margin-bottom" name="customer_address_2" id="customer_address_2" value="<?php echo isset($meta['address_abroad']) ? $meta['address_abroad']: '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="birth_day" class="control-label">Birthdate:</label>
                                <input type="text" class="form-control birth_day required" name="birth_day" id="birth_day" placeholder="YYYY-MM-DD" value="<?php echo isset($meta['birthdate']) ? $meta['birthdate']: '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="customer_age" class="control-label">Age: </label>
                                <input type="number" class="form-control margin-bottom required" name="customer_age" id="customer_age" value="<?php echo isset($meta['age']) ? $meta['age']: '' ?>" readonly>
                            </div>
                        </div>	
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contact_no" class="control-label">Contact Number: </label>

                                <input type="number" class="form-control margin-bottom required" name="contact_no" id="contact_no" oninput="limitContactNumberLength()" value="<?php echo isset($meta['contact_no']) ? $meta['contact_no']: '' ?>" autocomplete="nope">

                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_viber" class="control-label">Viber Account: </label>
                                <input type="number" class="form-control margin-bottom" name="customer_viber" id="customer_viber" value="<?php echo isset($meta['viber']) ? $meta['viber']: '' ?>" autocomplete="nope">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customer_email" class="control-label">Email Address: </label>
                                <div class="input-group float-right margin-bottom">
                                    <span class="input-group-addon"></span>
                                    <input type="email" class="form-control margin-bottom required" name="customer_email" id="customer_email" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" autocomplete="nope">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="citizenship" class="control-label">Citizenship: </label>
                                <input type="text" class="form-control margin-bottom required" name="citizenship" id="citizenship" value="<?php echo isset($meta['citizenship']) ? $meta['citizenship']: '' ?>">
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             
                                <label for="customer_gender" class="control-label">Gender: </label>
                                <style>
                                    select:invalid { color: gray; }
                                </style>
                                <select required name="customer_gender" id="customer_gender" class="form-control required" >
                                    <option value="M" <?php echo isset($meta['gender']) && $meta['gender'] == "M" ? 'selected': '' ?>>Male</option>
                                    <option value="F" <?php echo isset($meta['gender']) && $meta['gender'] == "F" ? 'selected': '' ?>>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="civil_status" class="control-label">Civil Status: </label>
                            <style>
                                select:invalid { color: gray; }
                            </style>
                            <select name="civil_status" id="civil_status" class="form-control required">
                                <option value="Single" <?php echo isset($meta['civil_status']) && $meta['civil_status'] == "Single" ? 'selected': '' ?>>Single</option>
                                <option value="Married" <?php echo isset($meta['civil_status']) && $meta['civil_status'] == "Married" ? 'selected': '' ?>>Married</option>
                                <option value="Divorced" <?php echo isset($meta['civil_status']) && $meta['civil_status'] == "Divorced" ? 'selected': '' ?>>Divorced</option>
                                <option value="Widowed" <?php echo isset($meta['civil_status']) && $meta['civil_status'] == "Widowed" ? 'selected': '' ?>>Widowed</option>
                            </select>
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
                    <button class="btn btn-flat btn-default bg-maroon" form="manage-client" style="width:100%;margin-right:5px;font-size:14px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                </td>
                <td>
                    <a class="btn btn-flat btn-default" href="./?page=sales" style="width:100%;margin-left:5px;font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
<script>

    $(document).ready(function(){
        $(".no-special").on("input", function() {
            //function validateNospecailchars exclude hypens and asphos
            validateNoSpecialChars(this);
        });
    
        $('#manage-client').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_client",
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
