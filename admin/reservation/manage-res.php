<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 

if(isset($_GET['id'])){
$res = $conn->query("SELECT CONCAT_WS(', ',last_name, first_name) as full_name, x.*,w.*,z.c_reservation_amt
						FROM  t_reservation x
						LEFT JOIN t_csr_view w
						ON x.c_csr_no = w.c_csr_no
						LEFT JOIN t_approval_csr z
						ON x.c_csr_no = z.c_csr_no
						WHERE md5(id) = '{$_GET['id']}'");
foreach($res->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
$username = $_settings->userdata('username');
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<style>
.box_big{
  width:50%;
  height:auto;
  margin-left:25%;
  margin-right:25%;
  background-color:#ffffff;
  border:none;
  float:left;
  padding:25px;
  border-radius:5px;
}
.main_box{
  float:left;
  width:100%;
  height:auto;
  padding-left:15px;
  padding-right:15px!important;
  padding-top:15px;
  border: solid #36454F 1px;
  padding-bottom:15px;
  border-radius:5px;
}
</style>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>New Reservation</b></i></h3>
		<div class="card-tools">
            <a class="btn btn-block btn-primary btn-flat border-primary select-ra" href="javascript:void(0)" style="font-size:14px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Select Existing RA</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<form method="" id="manage-reservation">
			<div class="box_big">
	    		<div class="main_box">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Ra No:</label>
								<input type="hidden" name="comm" id="comm" value="<?php echo $username ?> created a reservation for CSR # ">
								<input type="hidden" name="comm2" id="comm2" value="<?php echo $username ?> updated reservation for CSR # ">
								<input type="hidden" class="form-control margin-bottom" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
								<input type="text" class="form-control margin-bottom required" readonly name="ra_no" id="ra_no" value="<?php echo isset($meta['ra_no']) ? $meta['ra_no']: '' ?>" >
								<input type="hidden" class="form-control margin-bottom required" name="csr_no" id="csr_no" value="<?php echo isset($meta['c_csr_no']) ? $meta['c_csr_no']: '' ?> " >
								<input type="hidden" class="form-control margin-bottom required" name="lot_lid" id="lot_lid" value="<?php echo isset($meta['c_lot_id']) ? $meta['c_lot_id']: '' ?>" >
							
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Site:</label>
								<input type="text" class="form-control margin-bottom required" readonly name="reserve_site" id="reserve_site" value="<?php echo isset($meta['c_acronym']) ? $meta['c_acronym']: '' ?>" >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Block:</label>
								<input type="text" class="form-control margin-bottom required" readonly requiredname="reserve_block" id="reserve_block" value="<?php echo isset($meta['c_block']) ? $meta['c_block']: '' ?>" >	
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">   
							<div class="form-group">
								<label>Lot:</label>
								<input type="text" class="form-control margin-bottom required" readonly name="reserve_lot" id="reserve_lot" value="<?php echo isset($meta['c_lot']) ? $meta['c_lot']: '' ?>"   >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">   
							<div class="form-group">
								<label>Full name:</label>
								<input type="text" class="form-control margin-bottom required" readonly name="fullname" id="fullname" value="<?php echo isset($meta['full_name']) ? $meta['full_name']: '' ?>"  >
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">   
							<div class="form-group">
								<label>OR #:</label>
								<!-- <?php 
									$query02 = $conn->query("SELECT * FROM t_approval_csr i
									INNER JOIN t_csr_view x ON i.c_csr_no = x.c_csr_no
									INNER JOIN t_csr y ON x.c_csr_no = y.c_csr_no
									INNER JOIN t_av_summary z ON y.old_property_id = z.property_id
									WHERE (i.c_csr_status = 1 AND (i.c_reserve_status = 0 OR i.c_reserve_status = 2)) 
									ORDER BY c_date_approved");

									if($query02->num_rows > 0){
										?>
										<input type="text" class="form-control margin-bottom required" name="or_no" id="or_no" value=" <?php echo isset($meta['c_or_no']) ? $meta['c_or_no']: '' ?>" readonly>	
									<?php }else{ ?>
										<input type="text" class="form-control margin-bottom required" name="or_no" id="or_no" value="<?php echo isset($meta['c_or_no']) ? $meta['c_or_no']: '' ?>">	
									<?php } ?> -->
									<input type="text" class="form-control margin-bottom required" name="or_no" id="or_no" value="<?php echo isset($meta['c_or_no']) ? $meta['c_or_no']: '' ?>">

							</div>
						</div>
					</div>
		
					<div class="row">
						<div class="col-md-12">   
							<div class="form-group">
								<label>Remaining Reservation Fee: </label>
								<input type="text" class="form-control margin-bottom required" name="amount_paid" id="amount_paid" value="<?php echo isset($meta['c_amount_paid']) ? $meta['c_amount_paid']: '' ?>" readonly>
								</div>
							<div class="form-group">
								<label>Total Reservation Fee: </label>
								<input type="text" class="form-control margin-bottom required" readonly name="total_res" id="total_res" value="<?php echo isset($meta['c_reservation_amt']) ? $meta['c_reservation_amt']: '' ?>">	
							</div>
						</div>
					</div>      
					<div class="card-footer">
						<table style="width:100%;">
							<tr>
								<td>
									<button class="btn btn-flat btn-default bg-maroon" form="manage-reservation" style="width:100%; margin-right:5px;font-size:14px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
								</td>
								<td>
									<a class="btn btn-flat btn-default" href="./?page=reservation" style="width:100%; margin-left:5px;font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
								</td>
							</tr>
						</table>
					</div> 

				</div>
			</div>  		
			</form>
		</div>
		</div>
		
	</div>
</div>

<div id="insert_ra" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 --><h4 class="modal-title">Select RA</h4>
		</div>
		<div class="modal-body">
				<?php 
				$i = 0;
				$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no ORDER BY c_date_approved");
				while($row = $qry->fetch_assoc()):
				$i++;
				$ra_id = $row["ra_id"];
				$status=$row["c_csr_status"];
				$date_created=$row["c_date_created"];
				$id=$row["c_csr_no"];
				$lid = $row["c_lot_lid"];
				$exp_date=new DateTime($row["c_duration"]);
				$exp_date_str=$row["c_duration"];
				$exp_date_only=date("Y-m-d",strtotime($exp_date_str));
				//echo $exp_date_only;

				$today_date=date('Y/m/d H:i:s');
				$today_date_only=date("Y-m-d",strtotime($today_date));
				//echo $today_date_only;

				$exp=strtotime($exp_date_str);
				$td=strtotime($today_date);		
				if(($td>$exp) && ($row['c_reserve_status'] == 0)  && ($row['c_csr_status'] == 1)){
					$update_csr = $conn->query("UPDATE t_csr SET coo_approval = 2 WHERE c_csr_no = '".$id."'");	
					$update_app = $conn->query("UPDATE t_approval_csr SET c_csr_status = 2 WHERE c_csr_no = '".$id."'");
					$update_lot = $conn->query("UPDATE t_lots SET c_status = 'Available' WHERE c_lid = '".$lid."'");
				} 
				endwhile; ?>



			<table class="table table-bordered table-stripped">
				<thead>
					<tr>

						<th>RA No.</th>
						<th>Ref No</th>
						<th>Phase</th>
						<th>Block</th>
						<th>Lot</th>
						<th>Buyer Name</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
				<?php


				$query =$conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no INNER JOIN t_csr y ON x.c_csr_no = y.c_csr_no LEFT JOIN t_av_summary z ON y.old_property_id = z.property_id where (i.c_csr_status = 1 and (i.c_reserve_status = 0 or i.c_reserve_status = 2)) 
				ORDER BY c_date_approved");

				while($row = $query->fetch_assoc()): 
					$res = $row['c_reservation_amt'];
					$amt_paid = $row['c_amount_paid'];
					$remaining_res = $res - $amt_paid;
					?>

					<tr>
						<td><?php echo $row["ra_id"] ?></td>
						<td><?php echo $row["ref_no"] ?></td>
						<td><?php echo $row["c_acronym"] ?></td>
						<td><?php echo $row["c_block"] ?></td>
						<td><?php echo $row["c_lot"] ?></td>
						<td><?php echo $row["last_name"] ?>, <?php echo $row["first_name"] ?> <?php echo $row["middle_name"] ?> </td>

						<td><a href="#" class="btn btn-primary btn-xs ra-select" style="width:100%;font-size:14px;" data-ra-no="<?php echo $row['ra_id'] ?>" data-ra-lot-lid="<?php echo $row['c_lot_lid'] ?>" data-csr-no="<?php echo $row['c_csr_no'] ?>" data-ra-site="<?php echo $row['c_acronym'] ?>" data-ra-block="<?php echo $row['c_block'] ?>" data-ra-lot="<?php echo $row['c_lot'] ?>" data-res-remaining="<?php echo $remaining_res ?>" data-ra-res="<?php echo $row['c_reservation_amt'] ?>" data-ra-fname="<?php echo $row["last_name"] ?>, <?php echo $row["first_name"] ?> <?php echo $row["middle_name"] ?>" data-or-no="<?php echo $row["c_av_no"] ?>"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Select</a></td>
				   
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
			
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-flat btn-sm btn-default" style="width:100%;">Cancel</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->	
</div><!-- /.modal -->



<script>
$(document).ready(function() {
  $(document).on('click', '.ra-select', function() {
    var orNoInput = $('#or_no');
    if (orNoInput.val() !== '') {
      orNoInput.prop('readonly', true);
    }else{
		orNoInput.prop('readonly', false);
	}
  });

});


	$(document).ready(function(){
		
		$('.table').dataTable(
			{"ordering":false}
		);
		
	})
	
	$(document).on('click', ".select-ra", function(e) {

		e.preventDefault;

		var ra = $(this); 

		$('#insert_ra').modal({ backdrop: 'static', keyboard: false });

		return false;

		});

		$(document).on('click', ".ra-select", function(e) {

		var ra_no =  $(this).attr('data-ra-no');
		var lot_lid =  $(this).attr('data-ra-lot-lid');
		var csr_no =  $(this).attr('data-csr-no');
		var ra_site = $(this).attr('data-ra-site');
		var ra_block = $(this).attr('data-ra-block');
		var ra_lot = $(this).attr('data-ra-lot');
		var fullname = $(this).attr('data-ra-fname');

		var reserve_or_no = $(this).attr('data-or-no');
		var reserve_date = $(this).attr('data-reserve-date');
		/* var reserve_amt = $(this).attr('data-amt-paid'); */
		var reserve_amt = $(this).attr('data-res-remaining');
		var total_res = $(this).attr('data-ra-res');


		$('#ra_no').val(ra_no);
		$('#lot_lid').val(lot_lid);
		$('#csr_no').val(csr_no);
		$('#reserve_site').val(ra_site);
		$('#reserve_block').val(ra_block);
		$('#reserve_lot').val(ra_lot);
		$('#fullname').val(fullname);
		$('#or_no').val(reserve_or_no);
		$('#pay_date').val(reserve_date);
		$('#amount_paid').val(reserve_amt);
		$('#total_res').val(total_res);




		$('#insert_ra').modal('hide');

		});



	function validateForm() {
	    // error handling
	    var errorCounter = 0;

	    $(".required").each(function(i, obj) {

	        if($(this).val() === ''){
	            $(this).parent().addClass("has-error");
	            errorCounter++;
	        } else{ 
	            $(this).parent().removeClass("has-error"); 
	        }

	    });
		
	    return errorCounter;

	}

    $(document).ready(function(){

        $('#manage-reservation').submit(function(e){
			e.preventDefault();
            var _this = $(this)
		 	$('.err-msg').remove();
			
             var errorCounter = validateForm();
             if (errorCounter > 0) {
                alert_toast("It appear's you have forgotten to complete something!","warning");	  
                return false;
            }else{
                $(".required").parent().removeClass("has-error")
            }    
            start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_reservation",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
                        location.reload();
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
						
                            end_loader()
							window.scrollTo(0, 0);

                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
					
				}
			})
		})
        
	})
	
</script>