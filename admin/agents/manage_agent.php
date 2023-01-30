<?php 
include('functions.php');
/* include('includes/config.php'); */
if(isset($_GET['id'])){
$agent = $mysqli->query("SELECT * FROM t_agents where c_code =".$_GET['id']);
foreach($agent->fetch_array() as $k =>$v){
	$meta[$k] = $v;
    }
}

?>
<div class="container-fluid">
<form action="" id="manage-agent">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="panel panel-default">
                <div class="main_box">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="control-label">Code: </label>
                                <input type="text" class="form-control margin-bottom required" name="c_code" value="<?php echo isset($meta['c_code']) ? $meta['c_code']: '' ?>" readonly>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label class="control-label">Nick Name: </label>
                                <input type="text" class="form-control margin-bottom" name="c_nick_name" value="<?php echo isset($meta['c_nick_name']) ? $meta['c_nick_name']: '' ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">Last Name: </label>
                                <input type="text" class="form-control margin-bottom required" name="c_last_name" value="<?php echo isset($meta['c_last_name']) ? $meta['c_last_name']: '' ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">First Name: </label>
                                <input type="text" class="form-control margin-bottom required" name="c_first_name" value="<?php echo isset($meta['c_first_name']) ? $meta['c_first_name']: '' ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">Middle Name: </label>
                                <input type="text" class="form-control margin-bottom" name="c_middle_initial" value="<?php echo isset($meta['c_middle_initial']) ? $meta['c_middle_initial']: '' ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
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
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="control-label">Civil Status: </label>
                                <style>
                                    select:invalid { color: gray; }
                                </style>
                                <select name="c_civil_status" id="c__civil_status" class="form-control" tabindex = "7">
                                    <option value="Single" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Single" ? 'selected': '' ?>>Single</option>
                                    <option value="Married" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Married" ? 'selected': '' ?>>Married</option>
                                    <option value="Divorced" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Divorced" ? 'selected': '' ?>>Divorced</option>
                                    <option value="Widowed" <?php echo isset($meta['c_civil_status']) && $meta['c_civil_status'] == "Widowed" ? 'selected': '' ?>>Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="control-label">Birthdate: </label>
                                <div class="input-group date margin-bottom" id="birth_date" required>
                                    <input type="text" class="form-control birth_day required" name="c_birthdate" id = "c_birthdate" placeholder="YYYY-MM-DD" data-date-format="<?php echo DATE_FORMAT ?>" value="<?php echo isset($meta['c_birthdate']) ? $meta['c_birthdate']: '' ?>">		
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>	
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label class="control-label">Birth Place: </label>
                                <input type="text" class="form-control margin-bottom" name="c_birth_place" value="<?php echo isset($meta['c_birth_pace']) ? $meta['c_birth_place']: '' ?>" >
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Address 1: </label>
                                <input type="text" class="form-control margin-bottom required" name="c_address_ln1" value="<?php echo isset($meta['c_address_ln1']) ? $meta['c_address_ln1']: '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Address 2: </label>
                                <input type="text" class="form-control margin-bottom" name="c_address_ln2" value="<?php echo isset($meta['c_address_ln2']) ? $meta['c_address_ln2']: '' ?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">Contact Number: </label>
                                <input type="text" class="form-control margin-bottom required" name="c_tel_no" value="<?php echo isset($meta['c_tel_no']) ? $meta['c_tel_no']: '' ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">SSS #: </label>
                                <input type="text" class="form-control margin-bottom" name="c_sss_no" value="<?php echo isset($meta['c_sss_no']) ? $meta['c_sss_no']: '' ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">TIN: </label>
                                <input type="text" class="form-control margin-bottom" name="c_tin" value="<?php echo isset($meta['c_tin']) ? $meta['c_tin']: '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <style>
                                    select:invalid { color: gray; }
                                </style>
                                <label class="control-label">Status: </label>
                                <select name="c_status" id="agent_status" class="form-control" >
                                    <option value="Active" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Active" ? 'selected': '' ?>>Active</option>
                                    <option value="Inactive" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Inactive" ? 'selected': '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">Recruited by: </label>
                                <input type="text" class="form-control margin-bottom required" name="c_recruited_by" value="<?php echo isset($meta['c_recruited_by']) ? $meta['c_recruited_by']: '' ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label class="control-label">Date Hired: </label>
                                <div class="input-group date margin-bottom" id="hire_date" required>
                                    <input type="text" class="form-control hire_date required" name="c_hire_date" id = "c_hire_date" placeholder="YYYY-MM-DD"  tabindex ="17" data-date-format="<?php echo DATE_FORMAT ?>" value="<?php echo isset($meta['c_hire_date']) ? $meta['c_hire_date']: '' ?>" >		
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>	
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
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
                        <div class="col-xs-4">
                            <div class="form-group">
                                <style>
                                    select:invalid { color: gray; }
                                </style>
                                <label class="control-label">Network: </label>
                                <select name='c_network' id='c_network' class="c_network form-control" tabindex="19">
                                    <?php
                                        $user = $mysqli->query("SELECT * FROM t_network where ORDER BY c_network");
                                        foreach($user->fetch_array() as $k =>$v){
                                            $net[$k] = $v;
                                            }
                                        $sql = mysqli_query($mysqli,"SELECT * FROM t_network ORDER BY c_network");
                                        while($row = mysqli_fetch_array($sql)){
                                            ?>
                                            <option value="<?php echo $net['c_code'];?>" <?php echo isset($net['c_code']) && $net['c_code'] == $net['c_code'] ? 'selected': '' ?>>
                                            <?php echo $row['c_network'];?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <style>
                                    select:invalid { color: gray; }
                                </style>
                                <label class="control-label">Division: </label>
                                <select name='c_division' id='c_division' class="c_division form-control" value="<?php echo isset($meta['c_division']) ? $meta['c_division']: '' ?>">
                                </select>
                            </div>
                        </div>
                    </div> 
                   
                </div>
            </div>
    </form>	
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

	$('#manage-agent').submit(function(e){
		e.preventDefault();
	 	start_load() 
		var errorCounter = validateForm();
		if (errorCounter > 0) {
			alert_toast("It appear's you have forgotten to complete something!","warning")	  
            end_load()
		}else{

			$(".required").parent().removeClass("has-error")
			
			$.ajax({
				url:'ajax.php?action=save_agent',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
                        $("#response .message").html("<strong>" + "Success" + "</strong>: " + "Data successfully saved");
						$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
						$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                        setTimeout(function(){
							$(".modal").removeClass("visible");
							$(".modal").modal('hide');
							end_load()
						},1500)

						setTimeout(function(){
							location.reload()
						},3000)
					}
					else{
                        console.log()
                        $("#response .message").html("<strong> Error  </strong>: ");
						$("#response").removeClass("alert-success").addClass("alert-danger").fadeIn();
						$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
                        setTimeout(function(){
							$(".modal").removeClass("visible");
							$(".modal").modal('hide');
							end_load()
						},1500)

						setTimeout(function(){
							location.reload()
						},3000)
				}
			},
			error:err=>{
				console.log()
				alert("An error occured")
			}
			})
		}
	})

</script>