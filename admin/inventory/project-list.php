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
	#proj-link{
		border-bottom: solid 2px blue;
        background-color:#E8E8E8;
	}
    .table-container {
  		overflow-x: auto;
  		max-width: 100%;
	}
	table {
		table-layout: fixed;
		width: 100%;
	}
</style>

<div class="card" id="container">
    <div class="navbar-menu">
    <a href="<?php echo base_url ?>admin/?page=inventory/lot-list" class="main_menu" id="lot-link" style="border-left:solid 3px white;"><i class="nav-icon fas fa-square"></i>&nbsp;&nbsp;&nbsp;Lot Inventory</a>
		<a href="<?php echo base_url ?>admin/?page=inventory/model-list" class="main_menu" id="ca-link"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;House Model List</a>
		<a href="<?php echo base_url ?>admin/?page=inventory/project-list" class="main_menu" id="proj-link"><i class="nav-icon fas fa-map"></i>&nbsp;&nbsp;&nbsp;Project List</a>
	</div>
</div>



<?php
$username = $_settings->userdata('username');
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
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Project List</b></i></h5>
			    <div class="card-tools">
				<!-- <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a> -->
                <a class="btn btn-block btn-primary btn-flat border-primary new_project" href="javascript:void(0)" style="font-size:14px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New</a>
			    </div> 
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Acronym</th>
                        <th>Address</th>
                        <th>Province</th>
                        <th>Zip</th>
                        <th>Rate</th>
                        <th>Reservation</th>
                        <?php if ($usertype == 'IT Admin'): ?>
                        <th>Actions</th>
                        <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM t_projects ORDER BY c_code ASC");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["c_code"] ?></td>
                        <td><?php echo $row["c_name"] ?></td>
                        <td><?php echo $row["c_acronym"] ?></td>
                        <td><?php echo $row["c_address"] ?></td>
                        <td><?php echo $row["c_province"] ?></td>
                        <td><?php echo $row["c_zip"] ?></td>
                        <td><?php echo $row["c_rate"] ?></td>
                        <td><?php echo number_format($row["c_reservation"],2) ?></td>
                        <?php if ($usertype == 'IT Admin'): ?>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" data-id="<?php echo $row['c_code'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" data-id="<?php echo $row['c_code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
	 $('.new_project').click(function(){
        uni_modal("<i class='fa fa-plus'></i> New Project Site",'inventory/manage_project.php',"mid-large")
    })

    $('.edit_data').click(function(){
        uni_modal("<i class='fa fa-paint-brush'></i> Edit Project",'inventory/manage_project.php?id='+$(this).attr('data-id'),"mid-large")
    })


    $('.delete_data').click(function(){
        _conf("Are you sure to you want to delete this lot information??","delete_project",[$(this).attr('data-id')])
    }) 

    function delete_project($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_project",
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