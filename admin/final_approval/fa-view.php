<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<?php

$username = $_settings->userdata('username');
if(isset($_GET['id'])){
    // $query = "SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no inner join properties a on x.c_csr_no = a.c_csr_no where a.c_csr_no = '{$_GET['id']}' ";
    $query = "SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no where x.c_csr_no = '{$_GET['id']}' ";
    $result = mysqli_query($conn, $query);
    if($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $ra_id = $row['ra_id'];
            $csr_no = $row['c_csr_no'];
            $block = $row["c_block"];
            $lot = $row["c_lot"];
            $acronym = $row["c_acronym"];
            $ref_no = $row["ref_no"];
            $last_name = $row["last_name"];
            $first_name = $row["first_name"];
            $middle_name = $row["middle_name"];
            $lid = $row["c_lot_lid"];
            // $prop_id = $row["property_id"];
        }
    }
}
?>

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<h3 class="card-title"><?php echo !isset($_GET['id']) ? "Approval" :"Approval" ?></h3>
	</div>
    
        <div class="card-body">
            <form action="" id="manage-booked">
            <input type="hidden" name="comm"  id="comm" value="<?php echo $username; ?>">
                <div class="container-fluid">
                    <table class="table table-striped table-hover table-bordered" id="data-table">
                        <tr>
                            <td><b>CSR #: </b></td><td><?php echo $csr_no ?></td>
                            <input type="hidden" value="<?php echo $csr_no ?>" id="csr_no" name="csr_no">
                        </tr>
                        <tr>
                            <td><b>RA #: </b></td><td><?php echo $ra_id ?></td>
                            <input type="hidden" value="<?php echo $ra_id ?>" id="ra_id" name="ra_id">
                        </tr>
                        <tr>
                            <td><b>Ref No: </b></td><td><?php echo $ref_no ?></td>
                            <input type="hidden" value="<?php echo $ref_no ?>" id="ref_no" name="ref_no">
                        </tr>
                        <tr>
                            <td><b>Location: </b></td><td><?php echo $acronym ?> Block <?php echo $block ?> Lot <?php echo $lot ?></td>
                        </tr>
                        <tr>
                            <td><b>Buyer Name: </b></td><td><?php echo $last_name ?>,  <?php echo $first_name ?> <?php echo $middle_name ?></td>
                        </tr>
                    </table>
                </div>
            </form>
            <div class="row-xs-3"> 
                <table style="width:100%;">
                    <tr>
                        <td>
                            <button class="btn btn-flat btn-default bg-maroon" form="manage-booked" style="width:100%; font-size:14px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-flat btn-secondary" data-dismiss="modal" style="width:100%; font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Close</button>
                        </td>
                </table>
            </div>
        </div>

</div>
<script>
$(document).ready(function(){

    $('#manage-booked').submit(function(e){
         e.preventDefault();
         var _this = $(this);
       
        start_loader();
        $.ajax({
			url:_base_url_+"classes/Master.php?f=cfo_booked",
			data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
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

    })
})
    // function cfo_approval($csr_no,$ra_id,$lid){
	// 	start_loader();
	// 	$.ajax({
	// 		url:_base_url_+"classes/Master.php?f=cfo_booked",
	// 		method:"POST",
	// 		data:{csr_no:$csr_no,ra_id:$ra_id,lid:$lid},
	// 		dataType:"json",
	// 		error:err=>{
	// 			console.log(err)
	// 			alert_toast("An error occured.",'error');
	// 			end_loader();
	// 		},
	// 		success:function(resp){
	// 			if(typeof resp== 'object' && resp.status == 'success'){
	// 				location.reload();
	// 			}else{
	// 				alert_toast("An error occured.",'error');
	// 				end_loader();
	// 			}
	// 		}
	// 	})
	// }

</script>
