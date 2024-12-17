<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>




<?php

if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM t_lots where c_lid =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
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
	<h3 class="card-title"><b><i><?php echo !isset($_GET['id']) ? "Add Privilege Lot" :"Edit Privilege Lot" ?></b></i></h3>
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
                    <label for="agent_assigned">Agent Assigned:</label>
                    <select class="form-control" id="agent_assigned" name="agent_assigned" required>
                        <option value="">Select Agent</option>
                        <?php 
                        $sql = "SELECT c_code, c_last_name, c_first_name, c_position FROM t_agents ORDER BY c_last_name ASC";
                        $agents = odbc_exec($conn2, $sql);
                            

                        if (!$agents) {
                            die("Error executing query: " . odbc_errormsg($conn2));
                        }

                        
                        while($row = odbc_fetch_array($agents)): ?>
                            <option value="<?= $row['c_code'] ?>" <?= isset($agent_assigned) && $agent_assigned == $row['c_code'] ? 'selected' : '' ?>>
                                <?= $row['c_last_name'] . ", " . $row['c_first_name'] ." - " . $row['c_position'] ?>
                            </option>
                        <?php endwhile; 
                        odbc_close($conn2);?>
                    </select>
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