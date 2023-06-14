<?php 

if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id ='{$_GET['id']}'");
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;

}
}
?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-user">	
				<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
				<div class="form-group">
					<label for="name">First Name: </label>
					<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
				</div>
				<div class="form-group">
					<label for="name">Last Name: </label>
					<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
				</div>
				<div class="form-group">
					<label for="username">Username: </label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required  autocomplete="off">
				</div>
				<div class="form-group">
					<label for="username">Email: </label>
					<input type="text" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required  autocomplete="off">
				</div>
				<div class="form-group">
					<label for="username">Contact No: </label>
					<input type="text" name="phone" id="phone" class="form-control" value="<?php echo isset($meta['phone']) ? $meta['phone']: '' ?>" required  autocomplete="off">
				</div>
				<div class="form-group">
					<style>
						select:invalid { color: gray; }
					</style>
					<label class="control-label">Position: </label>
					<select name="type" id="type" class="form-control required">
						<option value="1" <?php echo isset($meta['type']) && $meta['type'] == "1" ? 'selected': '' ?>>Admin</option>
						<option value="2"<?php echo isset($meta['type']) && $meta['type'] == "2" ? 'selected': '' ?>> COO</option>
						<option value="3"<?php echo isset($meta['type']) && $meta['type'] == "3" ? 'selected': '' ?>>Manager</option>
						<option value="4" <?php echo isset($meta['type']) && $meta['type'] == "4" ? 'selected': '' ?>>Supervisor</option>
						<option value="5" <?php echo isset($meta['type']) && $meta['type'] == "5" ? 'selected': '' ?>>Employee</option>
					</select>
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
				<div class="form-group">
					<label for="password">Password: </label>
					<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
					<?php if(isset($_GET['id'])){?>
					<small style="color:red;"><i>Leave this blank if you dont want to change the password.</i></small>
					
					<?php }?>
				</div>
				<div class="form-group">
					<label for="" class="control-label">Avatar: </label>
					<div class="custom-file">
		              <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
		              <label class="custom-file-label" for="customFile">Choose file</label>
		            </div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
			</form>
		</div>
	</div>
	<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-flat btn-default bg-maroon" form="manage-user" style="width:100%;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
				</div>
			</div>
		</div>
</div>
<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_loader()
		$.ajax({
			url:_base_url_+'classes/Users.php?f=asave',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp ==1){
					location.reload()
				}else{
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_loader()
				}
			}
		})
	})

</script>