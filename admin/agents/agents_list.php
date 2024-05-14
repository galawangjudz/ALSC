<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.main_menu{
		float:left;
		width:227px;
		height:40px;
		line-height:40px;
		text-align:center;
		color:black!important;
		border-right:solid 3px white;
	}
	.main_menu:hover{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
	#container{
		margin-right:auto;
		margin-left:auto;
		width:100%;
		position:relative;
		padding-left:250px;
		padding-right:250px;
		background-color:transparent;
	}

</style>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Agent List</b></i></h5>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-primary btn-flat border-primary new_agent" href="<?php echo base_url.'admin/?page=agents/dd' ?>"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;">
                    <thead>
                        <th>No</th>
						<th>Code</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Position</th>
						<th>Status</th>
						<th class="actions">Actions</th>
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
						<?php if ($usertype == 'IT Admin'): ?>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
								<a class="dropdown-item" href="http://localhost/ALSC/admin/?page=agents_list/manage_agent&id=<?php echo $row['c_code'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete-agent" data-agent-id="<?php echo $row['c_code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                        </td>
                        <?php endif; ?>
					</tr>
					<?php endwhile; ?>
				</tbody>
                </table>
	        </div>                
            </div>

	</div>
<script>
    $(document).ready(function(){
		
		$('.table').dataTable();

		
	})
  
    // $('.new_agent').click(function(){
    //     uni_modal("<i class='fa fa-plus'></i> New Agent",'agents/manage_agent.php',"mid-large")
    // })

    // $('.edit-agent').click(function(){
    //     uni_modal("<i class='fa fa-paint-brush'></i> Edit Agent",'agents/dd.php?id='+$(this).attr('data-agent-id'),"mid-large")
    // })


    $('.delete-agent').click(function(){
        _conf("Are you sure you want to delete this agent information?","delete_agent",[$(this).attr('data-agent-id')])
    }) 

    function delete_agent($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_agent",
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
	


</script>