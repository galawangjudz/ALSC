<?php
	include 'config.php';
?>
<!-- <?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?> -->
<?php 

if(isset($_GET['id'])){
$client = $dbo->query("SELECT * FROM t_agents where c_code =".$_GET['id']);
	foreach($client->fetch() as $k =>$v){
		$meta[$k] = $v;
	}
}
?>
<body>

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title">New Agent</h3>
	</div>
<div class="card-body">
	<div class="container-fluid">
	<form action="" id="manage-agent">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="panel panel-default">
			<div class="main_box">
				<div class="row">
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">Code: </label>
							<input type="text" class="form-control margin-bottom required" name="c_code" id="c_code" value="<?php echo isset($meta['c_code']) ? $meta['c_code']: '' ?>">
						</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">Nick Name: </label>
							<input type="text" class="form-control margin-bottom" name="c_nick_name" id="c_nick_name" value="<?php echo isset($meta['c_nick_name']) ? $meta['c_nick_name']: '' ?>">
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">		
						<div class="form-group">
							<label class="control-label">Last Name: </label>
							<input type="text" class="form-control margin-bottom required" name="c_last_name" id="c_last_name" value="<?php echo isset($meta['c_last_name']) ? $meta['c_last_name']: '' ?>">
						</div>
					</div>
					<div class="col-md-4">		
						<div class="form-group">
							<label class="control-label">First Name: </label>
							<input type="text" class="form-control margin-bottom required" name="c_first_name" id="c_first_name" value="<?php echo isset($meta['c_first_name']) ? $meta['c_first_name']: '' ?>">
						</div>
					</div>
					<div class="col-md-4">		
						<div class="form-group">
							<label class="control-label">Middle Name: </label>
							<input type="text" class="form-control margin-bottom" name="c_middle_initial" id="c_middle_initial" value="<?php echo isset($meta['c_middle_initial']) ? $meta['c_middle_initial']: '' ?>">
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-4">		
						<div class="form-group">
							<label class="control-label">Gender: </label>
							<style>
								select:invalid { color: gray; }
							</style>
							<select name="c_sex" id="c_sex" class="form-control" tabindex ="6">
								<option value="M" <?php echo isset($meta['c_gender']) && $meta['c_gender'] == "M" ? 'selected': '' ?>>Male</option>
								<option value="F"<?php echo isset($meta['c_gender']) && $meta['c_gender'] == "F" ? 'selected': '' ?>>Female</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">		   
						<div class="form-group">
							<label class="control-label">Civil Status: </label>
							<style>
								select:invalid { color: gray; }
							</style>
							<select name="c_civil_status" id="c_civil_status" class="form-control" tabindex = "7">
								<option value="Single" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Single" ? 'selected': '' ?>>Single</option>
								<option value="Married" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Married" ? 'selected': '' ?>>Married</option>
								<option value="Divorced" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Divorced" ? 'selected': '' ?>>Divorced</option>
								<option value="Widowed" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Widowed" ? 'selected': '' ?>>Widowed</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">		
						<div class="form-group">
							<label class="control-label">Birthdate: </label>
							<input type="date" class="form-control birth_day required" name="c_birthdate" id="c_birthdate" placeholder="YYYY-MM-DD" value="<?php echo isset($meta['c_birthdate']) ? $meta['c_birthdate']: '' ?>">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">SSS #: </label>
							<input type="text" class="form-control margin-bottom" name="c_sss_no" id="c_sss_no" value="<?php echo isset($meta['c_sss_no']) ? $meta['c_sss_no']: '' ?>">
						</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">TIN: </label>
							<input type="text" class="form-control margin-bottom" name="c_tin" id="c_tin" value="<?php echo isset($meta['c_tin']) ? $meta['c_tin']: '' ?>">
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">Birth Place: </label>
							<input type="text" class="form-control margin-bottom required" name="c_birth_place" id="c_birth_place" value="<?php echo isset($meta['c_birth_place']) ? $meta['c_birth_place']: '' ?>">
						</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">Tel #: </label>
							<input type="text" class="form-control margin-bottom required" name="c_tel_no" id="c_tel_no" value="<?php echo isset($meta['c_tel_no']) ? $meta['c_tel_no']: '' ?>">
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="control-label">Address 1: </label>
					<input type="text" class="form-control margin-bottom required" name="c_address_ln1" id="c_address_ln1" value="<?php echo isset($meta['c_address_ln1']) ? $meta['c_address_ln1']: '' ?>">
				</div>
				<div class="form-group">
					<label class="control-label">Address 2: </label>
					<input type="text" class="form-control margin-bottom" name="c_address_ln2" id="c_address_ln2" value="<?php echo isset($meta['c_address_ln2']) ? $meta['c_address_ln2']: '' ?>">
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">		
						<div class="form-group">
							<label class="control-label">Date Hired: </label>
							<div class="input-group date margin-bottom" id="hire_date" required>
								<input type="date" class="form-control hire_date required" name="c_hire_date" id = "c_hire_date" placeholder="YYYY-MM-DD"  tabindex ="17" value="<?php echo isset($meta['c_hire_date']) ? $meta['c_hire_date']: '' ?>" >		
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>	
						</div>
					</div>
					<div class="col-md-6">		
						<div class="form-group">
							<style>
								select:invalid { color: gray; }
							</style>
							<label class="control-label">Status: </label>
							<select name="c_status" id="c_status" class="form-control" >
								<option value="Active" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Active" ? 'selected': '' ?>>Active</option>
								<option value="Inactive" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Inactive" ? 'selected': '' ?>>Inactive</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Recruited by: </label>
					<input type="text" class="form-control margin-bottom required" name="c_recruited_by" id="c_recruited_by" value="<?php echo isset($meta['c_recruited_by']) ? $meta['c_recruited_by']: '' ?>">
				</div>
				<div class="row">
					<div class="col-md-4">	
						<div class="form-group">
							<style>
								select:invalid { color: gray; }
							</style>
							<label class="control-label">Position: </label>
							<select name="c_position" id="c_position" class="form-control" tabindex ="18">
								<option  value="AM" <?php echo isset($meta['c_position']) && $meta['c_position'] == "AM" ? 'selected': '' ?>>AM</option>
								<option  value="AVP" <?php echo isset($meta['c_position']) && $meta['c_position'] == "AVP" ? 'selected': '' ?>>AVP</option>
								<option  value="B." <?php echo isset($meta['c_position']) && $meta['c_position'] == "B." ? 'selected': '' ?>>B.</option>
								<option  value="Broker" <?php echo isset($meta['c_position']) && $meta['c_position'] == "Broker" ? 'selected': '' ?>>Broker</option>
								<option  value="DS" <?php echo isset($meta['c_position']) && $meta['c_position'] == "DS" ? 'selected': '' ?>>DS</option>
								<option  value="EMP" <?php echo isset($meta['c_position']) && $meta['c_position'] == "EMP" ? 'selected': '' ?>>EMP</option>
								<option  value="FM" <?php echo isset($meta['c_position']) && $meta['c_position'] == "FM" ? 'selected': '' ?>>FM</option>
								<option  value="HG" <?php echo isset($meta['c_position']) && $meta['c_position'] == "HG" ? 'selected': '' ?>>HG</option>
								<option  value="JAV" <?php echo isset($meta['c_position']) && $meta['c_position'] == "JAV" ? 'selected': '' ?>>JAV</option>
								<option  value="MA" <?php echo isset($meta['c_position']) && $meta['c_position'] == "MA" ? 'selected': '' ?>>MA</option>
								<option  value="PC" <?php echo isset($meta['c_position']) && $meta['c_position'] == "PC" ? 'selected': '' ?>>PC</option>
								<option  value="PD" <?php echo isset($meta['c_position']) && $meta['c_position'] == "PD" ? 'selected': '' ?>>PD</option>
								<option  value="PSMI" <?php echo isset($meta['c_position']) && $meta['c_position'] == "PSMI" ? 'selected': '' ?>>PSMI</option>
								<option  value="Remax" <?php echo isset($meta['c_position']) && $meta['c_position'] == "Remax" ? 'selected': '' ?>>Remax</option>
								<option  value="SG" <?php echo isset($meta['c_position']) && $meta['c_position'] == "SG" ? 'selected': '' ?>>SG</option>
								<option  value="Sales" <?php echo isset($meta['c_position']) && $meta['c_position'] == "Sales" ? 'selected': '' ?>>SM</option>
								<option  value="SMG" <?php echo isset($meta['c_position']) && $meta['c_position'] == "SMG" ? 'selected': '' ?>>SMG</option>
								<option  value="SPC" <?php echo isset($meta['c_position']) && $meta['c_position'] == "SPC" ? 'selected': '' ?>>SPC</option>
								<option  value="TF" <?php echo isset($meta['c_position']) && $meta['c_position'] == "TF" ? 'selected': '' ?>>TF</option>
								<option  value="VP" <?php echo isset($meta['c_position']) && $meta['c_position'] == "VP" ? 'selected': '' ?>>VP</option>
								<option  value="VPS" <?php echo isset($meta['c_position']) && $meta['c_position'] == "VPS" ? 'selected': '' ?>>VPS</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">	
						<label class="control-label">Division: </label>
						<select name="category" id="category" class="form-control" >
							<option value='' selected>Select</option>
							<?Php
							require "config.php";// connection to database 
							$sql="SELECT * from t_network "; // Query to collect data 

							foreach ($dbo->query($sql) as $row) {
							echo "<option value=$row[c_code]>$row[c_network]</option>";
							}
							?>
						</select>
					</div>
					<div class="col-md-4">	
						<label class="control-label">Network: </label>
						<select name="subcategory" id="subcategory" class="form-control">
						<?Php
							require "config.php";// connection to database 
							$sql="SELECT  * from t_division "; // Query to collect data 

							foreach ($dbo->query($sql) as $row) {
							echo "<option value=$row[c_code]>$row[c_division]</option>";
							}
							?>
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
        			<button class="btn btn-flat btn-sm btn-default bg-maroon" form="manage-agent" style="width:100%;margin-right:5px;">Save</button>
				</td>
				<td>
        			<a class="btn btn-flat btn-sm btn-default" href="./?page=agents" style="width:100%;margin-left:5px;">Cancel</a>
				</td>
			</tr>
		</table>
    </div>
	</div>
</div>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
////////////
	$('#category').change(function(){
	//var st=$('#category option:selected').text();
	var c_code=$('#category').val();
	$('#subcategory').empty(); //remove all existing options
	///////
	$.get('ddck.php',
	{'c_code':c_code},
	function(return_data){
	$.each(return_data.data, 
	function(key,value){
		$("#subcategory").append("<option value=" + value.c_code +">"+value.c_division+"</option>");
	});
	}, "json");
	///////
	});
/////////////////////
});
</script>
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

        $('#manage-agent').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_agent",
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
</body>
