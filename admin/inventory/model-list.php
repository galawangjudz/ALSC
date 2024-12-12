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
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color:transparent;
    }
	#model-link{
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
        <a href="<?php echo base_url ?>admin/?page=inventory/search-lot-list" class="main_menu" id="search-lot-link"><i class="nav-icon fas fa-search"></i>&nbsp;&nbsp;&nbsp;Search Lot</a>
        <a href="<?php echo base_url ?>admin/?page=inventory/lot-list" class="main_menu" id="lot-link" style="border-left:solid 3px white;"><i class="nav-icon fas fa-square"></i>&nbsp;&nbsp;&nbsp;Lot Inventory</a>
		<a href="<?php echo base_url ?>admin/?page=inventory/model-list" class="main_menu" id="model-link"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;House Model List</a>
		<a href="<?php echo base_url ?>admin/?page=inventory/project-list" class="main_menu" id="project-link"><i class="nav-icon fas fa-map"></i>&nbsp;&nbsp;&nbsp;Project List</a>
	</div>
</div>
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
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>House Model List</b></i></h5>
			 <div class="card-tools">
				<!-- <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a> -->
                <a class="btn btn-block btn-primary btn-flat border-primary new_model" href="javascript:void(0)" style="font-size:14px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New</a>
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
                        <th>Model</th>
                        <th>Acronym</th>
                        <?php if ($usertype == 'IT Admin'): ?>
                        <th>Actions</th>
                        <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                        $qry = odbc_exec($conn2, "SELECT * FROM t_model_house ORDER BY c_code ASC");

                        if (!$qry) {
                            echo "Query execution failed.";
                            exit;
                        }
                        
                        while ($row = odbc_fetch_array($qry)):
                        ?>
                        <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["c_code"] ?></td>
                        <td><?php echo $row["c_model"] ?></td>
                        <td><?php echo $row["c_acronym"] ?></td>
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
                    <?php endwhile;
                        odbc_close($conn2); ?>
                    </tbody></table>
           
	        </div>                
            </div>

	</div>
<script>
	 $('.new_model').click(function(){
        uni_modal("<i class='fa fa-plus'></i> New House Model",'inventory/manage_model.php',"mid-large")
    })

    $('.edit_data').click(function(){
        uni_modal("<i class='fa fa-paint-brush'></i> Edit House Model",'inventory/manage_model.php?id='+$(this).attr('data-id'),"mid-large")
    })
    $('.delete_data').click(function(){
        _conf("Are you sure you want to delete this house model?","delete_model",[$(this).attr('data-id')])
    }) 

    function delete_model($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_model",
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