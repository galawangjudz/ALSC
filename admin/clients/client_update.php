<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php


if(isset($_GET['id'])){
    $client = $conn->query("SELECT * FROM property_clients where client_id =".$_GET['id']);
    foreach($client->fetch_array() as $k =>$v){
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


</style>

<div class="card card-outline rounded-0 card-maroon">
    
<div class="card-header">
		<h1 class="card-title" style="font-size:18px;"><b>Client Information</b></h1>
</div>
	<div class="container-fluid">
	<form action="" id="update-client">
        <input type="hidden" name="client_id" value="<?php echo isset($meta['client_id']) ? $meta['client_id']: '' ?>">
       
        <input type="hidden" name="username" value="<?php echo $username ?>">
      
        <div class="panel panel-default">
            <div class="panel-body form-group form-group-sm">
               <!--  <div class="main_box"> -->
                    <div class="row">
                        <div class="col-md-4">		
                            <div class="form-group">
                                <label class="control-label">Last Name: </label>
                                <input type="text" class="form-control margin-bottom copy-input required" name="customer_last_name" id="customer_last_name" value="<?php echo isset($meta['last_name']) ? $meta['last_name']: '' ?>"readonly>
                            </div>
                           
                        </div>
                        <div class="col-md-3">		
                            <div class="form-group">
                                <label class="control-label">First Name: </label>
                                <input type="text" class="form-control margin-bottom copy-input required" name="customer_first_name" id="customer_first_name" value="<?php echo isset($meta['first_name']) ? $meta['first_name']: '' ?>"readonly>	
                            </div>
                           
                        </div>
                        <div class="col-md-3">		
                            <div class="form-group">
                                <label class="control-label">Middle Name: </label>
                                <input type="text" class="form-control margin-bottom copy-input" name="customer_middle_name" id="customer_middle_name" value="<?php echo isset($meta['middle_name']) ? $meta['middle_name']: '' ?>"readonly>	
                            </div>
                         
                        </div>
                        <div class="col-md-2">		
                            <div class="form-group">
                                <label class="control-label">Suffix Name: </label>
                                <input type="text" class="form-control margin-bottom copy-input" name="customer_suffix_name" id="customer_suffix_name" value="<?php echo isset($meta['suffix_name']) ? $meta['suffix_name']: '' ?>"readonly>	
                            </div>
                         
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-10">		
                            <div class="form-group">
                                <label class="control-label">Residential/Billing Address: </label>
                                <input type="text" class="form-control margin-bottom copy-input required" name="customer_address" id="customer_address" value="<?php echo isset($meta['address']) ? $meta['address']: '' ?>">		
                            </div>
                        </div>
                      
                        <div class="col-md-2">		
                            <div class="form-group">
                                <label class="control-label">Area Code: </label>
                                <input type="text" class="form-control copy-input required" name="customer_zip_code" id="customer_zip_code" value="<?php echo isset($meta['zip_code']) ? $meta['zip_code']: '' ?>">					
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Address Abroad (if any): </label>
                                <input type="text" class="form-control margin-bottom" name="customer_address_2" id="customer_address_2" value="<?php echo isset($meta['address_abroad']) ? $meta['address_abroad']: '' ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Birthdate: </label>
                                <input type="date" class="form-control birth_day required" name="birth_day" id = "birth_day" value="<?php echo isset($meta['birthdate']) ? $meta['birthdate']: '' ?>">		
                                	
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Age: </label>
                                <input type="text" class="form-control margin-bottom required" name="customer_age" id="customer_age" value="<?php echo isset($meta['age']) ? $meta['age']: '' ?>" readonly>
                            </div>
                        </div>	
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Contact Number: </label>
                                <input type="text" class="form-control margin-bottom required" name="contact_no" id="contact_no" value="<?php echo isset($meta['contact_no']) ? $meta['contact_no']: '' ?>" minlength="11">
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Viber Account: </label>
                                <input type="text" class="form-control margin-bottom" name="customer_viber" id="customer_viber" value="<?php echo isset($meta['viber']) ? $meta['viber']: '' ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Email Address: </label>
                                <div class="input-group float-right margin-bottom">
                                    <span class="input-group-addon"></span>
                                    <input type="email" class="form-control margin-bottom required" name="customer_email" id="customer_email" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                    <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Citizenship: </label>
                                <input type="text" class="form-control margin-bottom required" name="citizenship" id="citizenship" value="<?php echo isset($meta['citizenship']) ? $meta['citizenship']: '' ?>">
                            </div>	
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                             
                                <label class="control-label">Gender: </label>
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
                            <label class="control-label">Civil Status: </label>
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

        $('#update-client').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=update_prop_client",
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