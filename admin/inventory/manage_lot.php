<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>



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
<?php



if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $query = "SELECT * FROM t_lots WHERE c_lid = $id";
    $result = odbc_exec($conn2, $query);
    
    if (!$result) {
        die("Query failed: " . odbc_errormsg($conn2));
    }
    
    // Fetch the results into an associative array
    $meta = array();
    while ($row = odbc_fetch_array($result)) {
        foreach ($row as $k => $v) {
            $meta[$k] = $v;
        }
    }
    
    // Close the connection
    odbc_close($conn2);
}

?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}
.container-fluid p{
    margin: unset
}
#uni_modal .modal-footer{
    display: none;
} 

</style>
<body onload="lcp()">
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<h3 class="card-title"><b><i><?php echo !isset($_GET['id']) ? "Add Lot" :"Edit Lot" ?></b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <form action="" id="manage-lot">
                <input type="hidden" name="comm" id="comm" value="<?php echo $username ?> added a new lot ">
                <input type="hidden" name="comm2" id="comm2" value="<?php echo $username ?> updated lot ">
                <input type="hidden" name="prod_lid" id="prod_lid" value="<?php echo isset($meta['c_lid']) ? $meta['c_lid']: '' ?>">
                <div class="form-group">
                    <label class="control-label">Phase: </label>
                        <select name="prod_code" id= "prod_code" class="form-control">
                            <?php 
                            $cat = $conn->query("SELECT * FROM t_projects order by c_acronym asc ");
                            while($row= $cat->fetch_assoc()):
                                $cat_name[$row['c_code']] = $row['c_acronym'];
                                $code = $row['c_code'];
                                ?>
                                <option value="<?php echo $row['c_code'] ?>" <?php echo isset($meta['c_site']) && $meta['c_site'] == "$code" ? 'selected': '' ?>><?php echo $row['c_acronym'] ?></option>
                            <?php
                            endwhile;
                            ?>
                        </select>
                </div> 
                <div class="form-group">
                    <label for="name">Block</label>
                    <input type="number" class="form-control required" name="prod_block" id="prod_block" value="<?php echo isset($meta['c_block']) ? $meta['c_block']: '' ?>">
                </div>
                <div class="form-group">
                    <label for="name">Lot</label>
                    <input type="number" class="form-control required" name="prod_lot" id="prod_lot" value="<?php echo isset($meta['c_lot']) ? $meta['c_lot']: '' ?>">
                </div>
                <div class="form-group">
                    <label for="name">Lot Area</label>
                    <input type="number" class="form-control required" name="prod_lot_area"  id="prod_lot_area" value="<?php echo isset($meta['c_lot_area']) ? $meta['c_lot_area']: '' ?>" onchange="lcp()">
                </div>
                <div class="form-group">
                    <label for="name">Price per SQM</label>
                    <input type="text" class="form-control required" name="prod_lot_price" id="prod_lot_price" value="<?php echo isset($meta['c_price_sqm']) ? $meta['c_price_sqm']: '' ?>" onchange="lcp()">
                </div>
                <div class="form-group">
                    <label class="control-label">Status: </label>
                        <style>
                            select:invalid { color: gray; }
                        </style>
                        <select required name="prod_status" id="prod_status" class="form-control" >
                            <option value="Available" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Available" ? 'selected': '' ?>>Available</option>
                            <option value="Reserved" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Reserved" ? 'selected': '' ?>>Reserved</option>
                            <option value="Pre-Reserved" <?php echo isset($meta['c_status']) && $meta['c_status'] == "Pre-Reserved" ? 'selected': '' ?>>Pre-Reserved</option>
                            <option value="Sold"<?php echo isset($meta['c_status']) && $meta['c_status'] == "Sold" ? 'selected': '' ?>> Sold</option>
                            <option value="Packaged"<?php echo isset($meta['c_status']) && $meta['c_status'] == "Packaged" ? 'selected': '' ?>>Packaged</option>
                            <option value="On Hold" <?php echo isset($meta['c_status']) && $meta['c_status'] == "On Hold" ? 'selected': '' ?>>On Hold</option>
                        </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Lot Contract Price: </label>
                    <div class="input-group">
                        <input type="text" name="prod_lcp" id="prod_lcp" value="<?php echo isset($meta['prod_lcp']) ? $meta['prod_lcp']: '' ?>" id="prod_lcp" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Remarks: </label>
                    <div class="input-group form-group-sm textarea no-margin-bottom">
                        <input type="text" class="form-control" name="prod_remarks" id="prod_remarks" value="<?php echo isset($meta['c_remarks']) ? $meta['c_remarks']: '' ?>">
                    </div>
                </div>
            </form>
		</div>
		<div class="card-footer">
            <table style="width:100%;">
                <tr>
                    <td>
				        <button class="btn btn-flat btn-default bg-maroon" form="manage-lot" style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
                    </td>
                    <td>
				        <a class="btn btn-flat btn-default" href="./?page=inventory/lot-list" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
                    </td>
                </tr>
            </table>
		</div>
	</div>
</div>
</body>
<script>
    function lcp(){
		var lot_area = document.getElementById('prod_lot_area').value;
		var lot_price = document.getElementById('prod_lot_price').value;
		var res = lot_area * lot_price;
		document.getElementById('prod_lcp').value=res;
	}


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

	$('#manage-lot').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_lot",
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