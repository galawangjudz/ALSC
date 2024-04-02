<?php if($_settings->chk_flashdata('success')): ?>
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


<style>
.modal-content{
  width:1000px;
  margin-left:-200px;
}
.nav-agents{
  background-color:#007bff;
  color:white!important;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}
</style>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<h3 class="card-title"><b><i>Agent List</b></i></h3>
	<div class="card-tools">
		<a href="" class="btn btn-flat btn-default bg-maroon"><span class="fas fa-plus"></span>  Create New</a>
	</div>
</div>
<div class="card-body">
	<div class="container-fluid">
		<table class="table table-bordered table-stripped" id="data-table">
			<thead>
				<tr>
					<th>No</th>
					<th>Code</th>
					<th>Last Name</th>
					<th>First Name</th>
					<th>Position</th>
					<th>Status</th>
					<th class="actions">Actions</th>

				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 1;
					$agents = $conn->query("SELECT * FROM t_agents order by c_last_name asc");
					while($row=$agents->fetch_assoc()):
				?>
					<td class="text-center"><?php echo $i++ ?> </td>
					<td class="text-center"><?php echo $row['c_code'] ?></td>
					<td class="text-center"><?php echo $row["c_last_name"]?></td>
					<td class="text-center"><?php echo $row["c_first_name"]?></td>
					<td class="text-center"><?php echo $row["c_position"]?></td>
					<?php if($row['c_status'] == "ACTIVE" || $row['c_status'] == "Active" ): ?>
						<td class="text-center"><span class="label label-success">Active</span></td>
					<?php else: ?>
						<td class="text-center"><span class="label label-default">Inactive</span></td>
					<?php endif; ?>
					<td align="center">
						<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
							Action
						<span class="sr-only">Toggle Dropdown</span>
						</button>
						<div class="dropdown-menu" role="menu">
							<a class="dropdown-item view_data" href="#"><span class="fa fa-eye text-primary"></span> View</a>
						<div class="dropdown-divider"></div>
							<a class="dropdown-item edit_data" href="#"><span class="fa fa-edit text-primary"></span> Edit</a>
						<div class="dropdown-divider"></div>
							<a class="dropdown-item delete-lot" data-lot-id="#"><span class="fa fa-trash text-danger"></span> Delete</a>
						</div>
					</div>
				</td>
				</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
<div>

<script>

$(document).ready(function(){
		
	$('.table').dataTable();
	
})

$('#new_agent').click(function(){
	uni_modal('New Agent','manage_agent.php')
})

$('.edit-agent').click(function(){
	uni_modal('Edit Agent','manage_agent.php?id='+$(this).attr('data-agent-id'))
})


$('.delete-agent').click(function(){
		_conf("Are you sure you want to delete this agent information?","delete_agent",[$(this).attr('data-agent-id')])
	})

function delete_agent($id){
	start_load()
	$.ajax({
		url:'ajax.php?action=delete_agent',
		method:'POST',
		data:{id:$id},
		success:function(resp){
			if(resp==1){
				alert("Data successfully deleted",'success') 
				setTimeout(function(){
					location.reload()
				},1500)
				}
			else{
				console.log()
            	alert("An error occured2")
			}
		},
		error:err=>{
            console.log()
            alert("An error occured")
        }
	})
}


</script> 

