<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<?php 
include('includes/config.php');
if(isset($_GET['id'])){
$user = $mysqli->query("SELECT * FROM users where user_id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<form action="" id="manage-user">
		<input type="hidden" name="user_id" value="<?php echo isset($meta['user_id']) ? $meta['user_id']: '' ?>">
		<div class="form-group">
			<label for="name">Last Name</label>
			<input type="text" name="last_name" id="last_name" class="form-control required" value="<?php echo isset($meta['last_name']) ? $meta['last_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">First Name</label>
			<input type="text" name="first_name" id="first_name" class="form-control required" value="<?php echo isset($meta['first_name']) ? $meta['first_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Middle Name</label>
			<input type="text" name="middle_name" id="middle_name" class="form-control" value="<?php echo isset($meta['middle_name']) ? $meta['middle_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Email Address</label>
			<input type="text" name="email" id="email" class="form-control required" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Contact Number</label>
			<input type="text" name="phone" id="phone" class="form-control required" value="<?php echo isset($meta['phone']) ? $meta['phone']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Date Hired</label>
			<div class="input-group date margin-bottom" id="hire_date" required>
				<input type="text" class="form-control hire_date required" value="<?php echo isset($meta['date_hired']) ? $meta['date_hired']: '' ?>" name="date_hired" id = "date_hired" placeholder="YYYY-MM-DD" data-date-format="<?php echo DATE_FORMAT ?>" >		
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>	
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control required" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control required" value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
		</div>
		<div class="form-group">
			<style>
				select:invalid { color: gray; }
			</style>
			<label class="control-label">User Type: </label>
			<select name="user_type" id="user_type" class="form-control required">
				<option value="SOS" <?php echo isset($meta['user_type']) && $meta['user_type'] == "IT Admin" ? 'selected': '' ?>>Sales Operation Supervisor</option>
				<option value="COO"<?php echo isset($meta['user_type']) && $meta['user_type'] == "COO" ? 'selected': '' ?>> COO</option>
				<option value="IT Admin"<?php echo isset($meta['user_type']) && $meta['user_type'] == "IT Admin" ? 'selected': '' ?>>IT Admin</option>
				<option value="Agent" <?php echo isset($meta['user_type']) && $meta['user_type'] == "Agent" ? 'selected': '' ?>>Agent</option>
				<option value="Broker" <?php echo isset($meta['user_type']) && $meta['user_type'] == "Broker" ? 'selected': '' ?>>Broker</option>
				<option value="CA" <?php echo isset($meta['user_type']) && $meta['user_type'] == "CA Supervisor" ? 'selected': '' ?>>CA Supervisor</option>
				<option value="Cashier" <?php echo isset($meta['user_type']) && $meta['user_type'] == "Cashier" ? 'selected': '' ?>>Cashier</option>
			</select>
		</div>
	</form>
</div>
<script>

	$('#hire_date').datetimepicker({
		showClose: false,
		format : "YYYY-MM-DD"
	});


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

	$('#manage-user').submit(function(e){
		e.preventDefault();
	 	start_load() 
		var errorCounter = validateForm();
		if (errorCounter > 0) {
			alert("It appear's you have forgotten to complete something!","warning")	
			end_load()  
		}else{

			$(".required").parent().removeClass("has-error")
			
			$.ajax({
				url:'ajax.php?action=save_user',
				method:'POST',
				data:$(this).serialize(),
				success:function(resp){
					if(resp == 1){
						/* $("#response .message").html("<strong>" + "Success" + "</strong>: " + "Data successfully saved");
						$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
						$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000); */
						alert("Data successfully saved",'success')
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