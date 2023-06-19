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

	#container{
		margin-right:auto;
		margin-left:auto;
		width:100%;
		position:relative;
		padding-left:250px;
		padding-right:250px;
		background-color:transparent;
	}
    .nav-members{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    #onlink{
        border-bottom: solid 2px blue;
        background-color:#E8E8E8;
    }   
</style>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Family Members List</b></i></h5>
			<!-- <div class="card-tools">
				<a class="btn btn-primary btn-flat border-primary new_lot" href="javascript:void(0)" style="font-size:14px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New</a>
			</div> -->
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;overflow-x:auto;">
                    <thead>
                        <tr>
                        <th>Member ID</th>
                        <th>Client ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Suffix Name</th>
                        <!-- <th>Address</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Civil Status</th>
                        <th>Citizenship</th> -->
                        <th>Email</th>
                        <th>Contact Number</th>
                        <!-- <th>Relationship</th> -->
                        <?php if ($usertype == 'IT Admin'): ?>
				        <th>Actions</th>
                        <?php endif?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM family_members WHERE status=0 and client_id = '{$_GET['id']}'");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <td><?php echo $row["member_id"] ?></td>
                        <td><?php echo $row["client_id"] ?></td>
                        <td><?php echo $row["last_name"] ?></td>
                        <td><?php echo $row["first_name"] ?></td>
                        <td><?php echo $row["middle_name"] ?></td>
                        <td><?php echo $row["suffix_name"] ?></td>
                        <!-- <td><?php echo $row["address"] ?></td>
                        <td><?php echo $row["birthdate"] ?></td>
                        <td><?php echo $row["age"] ?></td>
                        <td><?php echo $row["gender"] ?></td>
                        <td><?php echo $row["civil_status"] ?></td>
                        <td><?php echo $row["citizenship"] ?></td> -->
                        <td><?php echo $row["email"] ?></td>
                        <td><?php echo $row["contact_no"] ?></td>
                        <!-- <td><?php echo $row["relationship"] ?></td> -->
                        <?php if ($usertype == 'IT Admin'): ?>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item add-data" data-id="<?php echo $row['member_id'] ?>"><span class="fa fa-thumbs-up"></span>&nbsp;&nbsp;Approve</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item update_family_mem" data-id="<?php echo $row['member_id'] ?>"><span class="fa fa-edit text-primary"></span>&nbsp;&nbsp;Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete-data" data-id="<?php echo $row['member_id'] ?>"><span class="fa fa-trash text-danger"></span>&nbsp;&nbsp;Delete</a>


                                </div>
                        </td>
                        <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
	            </div>                
            </div>
	</div>
<script>
    $(document).ready(function(){
		$('.table').dataTable();
	})

    $('.add-data').click(function(){
        _conf("Are you sure you want to accept this information?","add_data",[$(this).attr('data-id')])
    }) 

    $('.update_family_mem').click(function(){
      //uni_modal_right("<i class='fa fa-paint-brush'></i> Edit Client",'sales/client_update.php?id='+$(this).attr('client-id'),"mid-large")
      uni_modal("<i class='fa fa-paint-brush'></i> Update Member",'clients/save_member.php?id='+$(this).attr('data-id'),"mid-large")

    })

    $('.delete-data').click(function(){
        _conf("Are you sure you want to delete this information?","delete_data",[$(this).attr('data-id')])
    }) 

    function delete_data($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_data",
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
	
    function add_data($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=add_data",
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