<?php
require_once('./../../../config.php');
$vatable='';
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `supplier_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
</style>
<input type="hidden" name="vat" id="vat" value="<?php echo isset($vatable) ? $vatable : ''; ?>">
<script>
    var vat = document.getElementById("vat").value;
    if (vat == 0) {
        document.getElementById("vatable").selectedIndex = 1;
    }
</script>
<form action="" id="supplier-form">
     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
    <div class="container-fluid">
        <div class="form-group">
            <label for="name" class="control-label">Supplier Name:</label>
            <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Address:</label>
            <textarea rows="3" name="address" id="address" class="form-control rounded-0" required><?php echo isset($address) ? $address :"" ?></textarea>
        </div>
        <div class="form-group">
            <label for="contact_person" class="control-label">Contact Person:</label>
            <input type="text" name="contact_person" id="contact_person" class="form-control rounded-0" value="<?php echo isset($contact_person) ? $contact_person :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control rounded-0" value="<?php echo isset($email) ? $email :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Contact:</label>
            <input type="text" name="contact" id="contact" class="form-control rounded-0" value="<?php echo isset($contact) ? $contact :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="status" class="control-label">Vatable?</label>
            <select name="vatable" id="vatable" class="form-control rounded-0" required>
                <option value="12" <?php echo isset($vatable) && $vatable =="" ? "selected": "12" ?> >Yes</option>
                <option value="0" <?php echo isset($vatable) && $vatable =="" ? "selected": "0" ?>>No</option>
            </select>
        </div>
        <!-- <div class="form-group" id="textbox-container" style="display: none;">
            <label for="vatable" class="control-label">Vatable Percentage (%):</label>
            <input type="text" name="vatable" id="vatable" class="form-control rounded-0" value="<?php echo isset($vatable) ? $vatable :"" ?>">
        </div> -->
        <div class="form-group">
            <label for="status" class="control-label">Status:</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option value="1" <?php echo isset($status) && $status =="" ? "selected": "1" ?> >Active</option>
                <option value="0" <?php echo isset($status) && $status =="" ? "selected": "0" ?>>Inactive</option>
            </select>
        </div>
    </div>
</form>
<!-- 
<script>
    var select = document.getElementById("vatable");
    var textboxContainer = document.getElementById("textbox-container");
    select.addEventListener("change", function () {
        if (select.value === "1") {
            textboxContainer.style.display = "block";
            document.getElementById("vatable").value = "0";
        } else {
            textboxContainer.style.display = "none";
            document.getElementById("vatable").value = "0";
        }
    });
    if (select.value === "1") {
        textboxContainer.style.display = "block";
    } else {
        textboxContainer.style.display = "none";
        document.getElementById("vatable").value = "0";
    }
</script> -->

<script>
    $(function(){
        $('#supplier-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_supplier",
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
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                    }else{
						alert_toast("An error occured",'error');
                        console.log(resp)
					}
                    end_loader()
				}
			})
		})
	})
</script>