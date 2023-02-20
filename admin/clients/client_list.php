

<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title">Clients</h5>
			<!-- <div class="card-tools">
				<a class="btn btn-block btn-sm btn-primary btn-flat border-primary new_lot" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div> -->
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table">
                    <thead>
                        <tr>
                        <?php if ($usertype == 'IT Admin'): ?>
				        <th>Actions</th>
                        <?php endif?>
                        <th>Client ID</th>
                        <th>Client Name</th>
                        <th>Gender</th>
                        <th>Status </th>
                        <th>Date of Birth</th>
                        <th>Mobile No.</th>
                        <th>Email</th>  
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT client_id, CONCAT_WS(' ',first_name, last_name) as full_name, gender, civil_status, 
                            birthdate, contact_no, email FROM property_clients ORDER BY last_name, first_name , middle_name");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <?php if ($usertype == 'IT Admin'): ?>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item view-clients" data-lot-id="<?php echo $row['client_id'] ?>"><span class="fa fa-eye text-success"></span> View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete-clients" data-lot-id="<?php echo $row['client_id'] ?>"><span class="fa fa-edit text-primary  "></span> Edit</a>
                                </div>
                        </td>
                        <?php endif; ?>
                        <?php 
                        $client_id = $row["client_id"];
                        $client_id_part1 = substr($client_id, 0, 2);
                        $client_id_part2 = substr($client_id, 2, 6);
                        $client_id_part3 = substr($client_id, 8, 5);
                        ?>
                        <td><?php echo $client_id_part1 . "-" . $client_id_part2 . "-" . $client_id_part3 ?></td>
                        <td><?php echo $row["full_name"] ?></td>
                        <td><?php echo $row["gender"] ?></td>
                        <td><?php echo $row["civil_status"] ?></td>
                        <td><?php echo $row["birthdate"] ?></td>
                        <td><?php echo $row["contact_no"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                    
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
           
	        </div>                
            </div>

	</div>
<script>
  
    $('.new_lot').click(function(){
        uni_modal("<i class='fa fa-plus'></i> New Lot",'inventory/manage_lot.php',"mid-large")
    })

    $('.edit-lot').click(function(){
        uni_modal("<i class='fa fa-paint-brush'></i> Edit Lot",'inventory/manage_lot.php?id='+$(this).attr('data-lot-id'),"mid-large")
    })


    $('.delete-lot').click(function(){
        _conf("Are you sure to delete this Lot?","delete_lot",[$(this).attr('data-lot-id')])
    }) 

    function delete_lot($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_lot",
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