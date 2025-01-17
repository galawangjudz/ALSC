<?php
require_once('./../../../config.php');
$last_date_purchased = date('Y-m-d', strtotime('now'));
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT i.*, o_approved.date_purchased, o_approved.item_id FROM `item_list` AS i LEFT JOIN `approved_order_items` AS o_approved ON i.id = o_approved.item_id WHERE i.id = {$_GET['id']} ORDER BY o_approved.date_purchased DESC LIMIT 1;");
    
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
$type="";
$status="";
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
    @media (min-width: 768px) {
        #uni_modal, #confirm_modal {
            display: none; 
            align-items: center;
            justify-content: center;
            margin: 0 140px;
        }
    }
    @media (min-width: 820px) {
        #uni_modal, #confirm_modal {
            display: none; 
            align-items: center;
            justify-content: center;
            margin: 0 160px;
        }
    }
    @media (min-width: 1024px) {
        #uni_modal, #confirm_modal {
            display: none; 
            align-items: center;
            justify-content: center;
            margin: 0 20px;
        }
    }
</style>
<form action="" id="item-form">
     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="container-fluid">
            <div class="form-group">
                <label for="supplier" class="supplier">Supplier:</label>
                <select name="supplier_id" id="supplier_id" class="form-control rounded-0">
                    <option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
                    <?php
                    $supplier_qry = $conn->query("SELECT * FROM `supplier_list` order by `name` asc");
                    while ($row = $supplier_qry->fetch_assoc()) :
                    ?>
                        <option value="<?php echo $row['id'] ?>" <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="item_code" class="control-label">Code:</label>
                <input type="text" name="item_code" id="item_code" class="form-control rounded-0" value="<?php echo isset($item_code) ? $item_code : "" ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="name" class="control-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required>
            </div>
            <div class="form-group">
                <label for="type" class="control-label">Type:</label>
                <select name="type" id="type" class="form-control rounded-0" required>
                    <option value="1" <?php echo ($type === "1") ? "selected" : ""; ?>>Goods</option>
                    <option value="2" <?php echo ($type === "2") ? "selected" : ""; ?>>Services</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Description:</label>
                <textarea rows="3" name="description" id="description" class="form-control rounded-0" required><?php echo isset($description) ? $description :"" ?></textarea>
            </div>
            <div class="form-group">
                <label for="default_unit" class="control-label">Unit of Measure:</label>
                <input type="text" name="default_unit" id="default_unit" class="form-control rounded-0" value="<?php echo isset($default_unit) ? $default_unit :"" ?>" required>
            </div>
            <div class="form-group">
                <label for="description" class="control-label">Last Date Purchased:</label>
                <?php
                    $formattedDate = !empty($date_purchased) ? date('Y-m-d', strtotime($date_purchased)) : null;
                    ?>
                    <input type="date" class="form-control form-control-sm rounded-0" id="last_date_purchased" name="last_date_purchased" value="<?php echo $formattedDate; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="status" class="control-label">Status:</label>
                <select name="status" id="status" class="form-control rounded-0" required>
                    <option value="1" <?php echo ($status ==="1") ? "selected": ""; ?>>Active</option>
                    <option value="0" <?php echo ($status ==="0") ? "selected": ""; ?>>Inactive</option>
                </select>
            </div>
        </div>
</form>
<script>
    $(function(){
        $('#item-form').submit(function(e){
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();

            var requiredFields = ['name','item_code','supplier_id','type','description','default_unit','status'];
            var isValid = true;

            for (var i = 0; i < requiredFields.length; i++) {
                var fieldName = requiredFields[i];
                var fieldValue = _this.find('[name="' + fieldName + '"]').val().trim();

                if (fieldValue === '') {
                    isValid = false;
                    var errorMsg = 'May kulang, par.';
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
            var supplierId = $('#supplier_id').val();
            var mainId = <?php echo isset($id) ? $id : 'null' ?>;

            if (supplierId) {
                $.ajax({
                    url: _base_url_ + "employee/po_m/pom_items/get_max_item_code.php",
                    data: { supplier_id: supplierId, item_id: mainId }, 
                    method: 'GET',
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status === 'success') {
                            var originalItemCode = $('#item_code').val();
                            var countItemCode = resp.count_item_code;
                            var newItemCode = supplierId + '-' + countItemCode;

                            if (mainId !== null) {
                                newItemCode = originalItemCode;
                            }

                            $('#item_code').val(newItemCode);

                            submitForm();
                        } else {
                            alert("Error!");
                            end_loader();
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        alert("An error occurred while fetching data.");
                        end_loader();
                    }
                });
            } else {
                submitForm();
            }
            function submitForm() {
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=save_item",
                    data: new FormData(_this[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST',
                    dataType: 'json',
                    error: err => {
                        console.log(err);
                        alert_toast("An error occurred", 'error');
                        end_loader();
                    },
                    success: function (resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            location.reload();
                        } else if (resp.status == 'failed' && !!resp.msg) {
                            var el = $('<div>');
                            el.addClass("alert alert-danger err-msg").text(resp.msg);
                            _this.prepend(el);
                            el.show('slow');
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                        } else {
                            alert_toast("An error occurred", 'error');
                            console.log(resp);
                        }
                        end_loader();
                    }
                });
            }
        });
        $('#supplier_id').change(function () {
            var supplierId = $(this).val();
            if (supplierId) {
                $.ajax({
                    url: _base_url_ + "employee/po_m/pom_items/get_max_item_code.php",
                    data: { supplier_id: supplierId },
                    method: 'GET',
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status === 'success') {
                            var countItemCode = resp.count_item_code;
                            var newItemCode = supplierId + '-' + countItemCode;
                            $('#item_code').val(newItemCode);
                        } else {
                            alert("Error!");
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        alert("An error occurred while fetching data.");
                    }
                });
            }
        });
    });
</script>
