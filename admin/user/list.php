

















<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title">User List</h5>
			<div class="card-tools">
				<a class="btn btn-flat btn-default bg-maroon" href="<?php echo base_url.'admin/?page=user/manage_user' ?>"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Last Name</th>
                        <th>First Name </th>	
                        <th>Email</th>		
                        <th>Phone</th>
                        <th>Username</th>
                        <th>User type</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM users ORDER BY username ASC");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <td> <?php echo $row['id'] ?></td>
                        <td><?php echo $row["lastname"] ?></td>
                        <td><?php echo $row["firstname"] ?></td>
                        <td><?php echo $row["email"]  ?></td>
                        <td><?php echo $row["phone"]  ?></td>
                        <td><?php echo $row["username"]  ?></td>
                        <?php if($row['type'] == 1): ?>
                            <td class="text-center"><span class="badge badge-primary">Admin</span></td>
                        <?php elseif($row['type'] == 2): ?>
                            <td class="text-center"><span class="badge badge-primary">COO</span></td>
                        <?php elseif($row['type'] == 3): ?>
                            <td class="text-center"><span class="badge badge-primary">Manager</span></td>
                        <?php elseif($row['type'] == 4): ?>
                            <td class="text-center"><span class="badge badge-primary">Supervisor</span></td>
                        <?php elseif($row['type'] == 5): ?>
                            <td class="text-center"><span class="badge badge-primary">Employee</span></td>
                        <?php endif; ?>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item " href="./?page=user/manage_user&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                        </td>
                        
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
           
	        </div>                
            </div>

	</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

    $(document).ready(function(){
		
		$('.table').dataTable();

		
	})
	$(document).ready(function(){
		 $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})

    $('.delete_data').click(function(){
            _conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
    })

    function delete_user($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_user",
            method:"POST",
            data:{id: $id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp== 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occured.",'error');
                    end_loader();
                }
            }
        })
    }

    $(document).ready(function(){
		
		$('.table').dataTable();

		
	})
</script>



