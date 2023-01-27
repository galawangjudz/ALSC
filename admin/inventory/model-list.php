<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title">House Model List</h5>
			 <div class="card-tools">
				<!-- <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a> -->
                <a class="btn btn-block btn-sm btn-primary btn-flat border-primary new_model" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Model</th>
                        <th>Acronym</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM t_model_house ORDER BY c_code ASC");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["c_code"] ?></td>
                        <td><?php echo $row["c_model"] ?></td>
                        <td><?php echo $row["c_acronym"] ?></td>
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
                        
                        </tr>
                    <?php endwhile; ?>
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
        _conf("Are you sure to delete this Lot?","delete_model",[$(this).attr('data-id')])
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
	

</script>