<?php 
include '../../config.php';

if(isset($_GET['id']) && $_GET['id'] > 0){
    $csr = $conn->query("select q.c_acronym, z.c_block, z.c_lot, y.last_name, y.first_name, 
							y.middle_name, y.suffix_name , x.* from t_csr x , t_csr_buyers y ,
							t_lots z,  t_projects q
							where x.c_csr_no = y.c_csr_no 
							and x.c_lot_lid = z.c_lid 
							and z.c_site = q.c_code 
							and y.c_buyer_count = 1 
							and x.c_csr_no = ".$_GET['id']);
    foreach($csr->fetch_assoc() as $k =>$v){
        $meta[$k] = $v;
    }
    }

$getID = $_GET['id'];
echo $getID;
?>

<div class="container-fluid">
	<form action="" id="approval-form">
		<input type="text" name="id"  id="id" value="<?php echo $getID; ?>">
		<input type="text" name="lid" id="lid" value="<?php echo isset($meta['c_lot_lid']) ? $meta['c_lot_lid']: '' ?>">
		<input type="text" name="reservation_amt" id="reservation_amt" value="<?php  echo isset($meta['c_reservation']) ? $meta['c_reservation']: '' ?>">
		<input type="text" name="value" id="value" value="1">

      	<p><b>Location: </b><?php echo isset($meta['c_acronym']) ?> <?php echo isset($meta['c_block']) ?> <?php echo isset($meta['c_lot']) ?></p>
        <p><b>Buyer's Name: </b><?php echo isset($meta['last_name']) ?> ,<?php echo isset($meta['first_name']) ?></p>
        <p><b>NET TCP: </b><?php echo 'P'.number_format(isset($meta['c_net_tcp']),2) ?></p>


		<div class="form-group">
			<label class="control-label">Approval Time Duration: (No of Days) </label>
			<input type="number" class="form-control duration-day required" name="duration" id="duration" value="1" min="1">
		</div>

		<?php 
			 $newDate = date('Y-m-d', strtotime('+1 days'));
		
		?>
	</form>
</div>


<script>
	
    $(document).ready(function(){

	
	


	$('#approval-form').submit(function(e){
		e.preventDefault();
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=coo_approval",
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
				
						alert_toast(resp.msg,'error');
						end_loader()
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


