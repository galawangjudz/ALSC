<?php
require_once('../../../../config.php');
$vatable='';
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `supplier_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}else{
    $mop = "";
    $status = "";
    $category = "";
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
    body{
        font-size:14px;
    }
    .form-control{
        font-size:14px;
    }
</style>
<form action="" id="supplier-form">
     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
    <div class="container-fluid">
        <div class="form-group">
            <label for="name" class="control-label">Supplier Name:</label>
            <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Supplier Short Name:</label>
            <input type="text" name="short_name" id="short_name" class="form-control rounded-0" value="<?php echo isset($short_name) ? $short_name :"" ?>" required>
        </div>
        <!-- <div class="form-group">
            <label for="category" class="control-label">Category:</label>
                <select name="category" id="category" class="form-control rounded-0" required onchange="updateEWT()">
                <option value="" disabled selected></option>
                <option value="0" <?php echo ($category === "0") ? "selected" : ""; ?>>Goods</option>
                <option value="1" <?php echo ($category === "1") ? "selected" : ""; ?>>Services</option>
            </select>
        </div> -->
        <div class="form-group">
            <label for="tin" class="control-label">TIN #:</label>
            <input type="text" rows="3" name="tin" id="tin" class="form-control rounded-0" value="<?php echo isset($tin) ? $tin :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="atc_code" class="control-label">ATC Code:</label>
            <input type="text" name="atc_code" id="atc_code" class="form-control rounded-0" value="<?php echo isset($atc_code) ? $atc_code :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="address" class="control-label">Address:</label>
            <textarea rows="3" name="address" id="address" class="form-control rounded-0" required><?php echo isset($address) ? $address :"" ?></textarea>
        </div>
        <div class="form-group">
            <label for="contact_person" class="control-label">Contact Person:</label>
            <input type="text" name="contact_person" id="contact_person" class="form-control rounded-0" value="<?php echo isset($contact_person) ? $contact_person :"" ?>">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control rounded-0" value="<?php echo isset($email) ? $email :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="contact" class="control-label">Contact #:</label>
            <input type="text" name="contact" id="contact" class="form-control rounded-0" value="<?php echo isset($contact) ? $contact :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="mop" class="control-label">Mode of Payment:</label>
            <select name="mop" id="mop" class="form-control rounded-0" required>
                <option value="" disabled selected></option>
                <option value="1" <?php echo ($mop === "1") ? "selected" : ""; ?>>Check</option>
                <option value="0" <?php echo ($mop === "0") ? "selected" : ""; ?>>Cash on Delivery</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mop" class="control-label">Payment Terms:</label>
            <select name="terms" id="terms" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px">
                <option value="" disabled selected></option>
                <?php 
                $terms_qry = $conn->query("SELECT * FROM `payment_terms` WHERE inactive = 0 ORDER BY `terms_indicator` ASC");
                while ($terms_row = $terms_qry->fetch_assoc()):
                ?>
                <option 
                    value="<?php echo $terms_row['terms_indicator'] ?>" 
                    <?php echo isset($terms) && $terms == $terms_row['terms_indicator'] ? 'selected' : '' ?>
                ><?php echo $terms_row['terms'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="vatable" class="control-label">Tax Group:</label>
            <select name="vatable" id="vatable" class="form-control rounded-0" required>
                <option value="" <?php echo (!isset($vatable) || $vatable === "") ? "selected" : "" ?> disabled></option>
                <option value="0" <?php echo (isset($vatable) && $vatable == "0") ? "selected" : "" ?>>Non-VAT</option>
                <option value="3" <?php echo (isset($vatable) && $vatable == "3") ? "selected" : "" ?>>Zero-rated</option>
                <option value="1" <?php echo (isset($vatable) && $vatable == "1") ? "selected" : "" ?>>Inclusive</option>
                <option value="2" <?php echo (isset($vatable) && $vatable == "2") ? "selected" : "" ?>>Exclusive</option>
            </select>
        </div> 
        <!-- <div class="form-group">
            <label for="contact" class="control-label">Withholding Tax:</label>     
            <input type="text" name="wt" id="wt" class="form-control rounded-0" value="<?php echo isset($wt) ? $wt :"" ?>">
        </div> -->
        <div class="form-group">
            <label for="status" class="control-label">Status:</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option value="1" <?php echo ($status === "1") ? "selected": ""; ?>>Active</option>
                <option value="0" <?php echo ($status === "0") ? "selected": ""; ?>>Inactive</option>
            </select>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        updateEWT();
    });

    function updateEWT() {
        var category = document.getElementById('category');
        var ewtInput = document.getElementById('wt');

        if (category.value === '0') {
            
            ewtInput.value = '1';
        } else if (category.value === '1') {
            
            ewtInput.value = '2';
        } 
    }
</script>

<script>
    $(function(){
        $('#supplier-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();

             var requiredFields = ['name', 'short_name', 'tin', 'atc_code', 'address', 'email', 'contact', 'mop', 'terms', 'vatable', 'status'];
            var isValid = true;

            for (var i = 0; i < requiredFields.length; i++) {
                var fieldName = requiredFields[i];
                var fieldValue = _this.find('[name="' + fieldName + '"]').val().trim();

                if (fieldValue === '') {
                    isValid = false;
                    var errorMsg = 'May kulang po. Hehe.';
                    var existingError = _this.find('.err-msg:contains("' + errorMsg + '")');
                    
                    if (existingError.length === 0) {
                        var el = $('<div>').addClass("alert alert-danger err-msg").text(errorMsg);
                        _this.prepend(el);
                        el.show('slow');
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                    }
                }
            }

            if (!isValid) {
                return false;
            }
            
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