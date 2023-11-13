<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline rounded-0 card-maroon" style="padding:5px;">
	<div class="card-header">
		<h3 class="card-title"><b><i>Customers' Profile</b></i></h3>
		<!-- <div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
            <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
                    <thead>
                        <tr>
                        <th>Buyer ID</th>
                        <th>Location</th>
                        <th>Name</th>
                        
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Email Address</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM t_csr_buyers i inner join t_csr_view x on i.c_csr_no = x.c_csr_no");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $row["buyer_id"] ?></td>
                            <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <td><?php echo $row["last_name"]. ', '  .$row["first_name"] .' ' .$row["middle_name"]?></td>
                            <td><?php echo $row["address"]. ', '  .$row["zip_code"]?></td>
                            <td><?php echo $row["contact_no"]?></td>
                            <td><?php echo $row["email"]?></td>
                            <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['c_csr_no'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_csr_no'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <!-- <div class="dropdown-menu" role="menu">
                                    <a class="dropdown-item" href="?page=customers_profile/view_cprofile&id=<?php echo $row['c_csr_no'] ?>" data-id ="<?php echo $row['c_csr_no'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                </div> -->
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
        $(document).ready(function(){
            $('.table').dataTable();
        })
		$('.view_data').click(function(){
			uni_modal_2("Customer Details","customers_profile/view_cprofile.php?id="+$(this).attr('data-id'),'mid-large')
		})
        $('.edit_data').click(function(){
            uni_modal("Update Customer Details","customers_profile/manage_cprofile.php?id="+$(this).attr('data-id'),'mid-large')
        })
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_account($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_account",
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
					console.log('dsdsds');
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>