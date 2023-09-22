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
            <label for="item_code" class="control-label">Item Code:</label>
            <input type="text" name="item_code" id="item_code" class="form-control rounded-0" value="<?php echo isset($item_code) ? $item_code : "" ?>" readonly>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Item Name:</label>
            <input type="text" name="name" id="name" class="form-control rounded-0" value="<?php echo isset($name) ? $name :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description:</label>
            <textarea rows="3" name="description" id="description" class="form-control rounded-0" required><?php echo isset($description) ? $description :"" ?></textarea>
        </div>
        <div class="form-group">
            <label for="default_unit" class="control-label">Unit of Measurement:</label>
            <input type="text" name="default_unit" id="default_unit" class="form-control rounded-0" value="<?php echo isset($default_unit) ? $default_unit :"" ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Last Date Purchased:</label>
            <?php
                $formattedDate = !empty($date_purchased) ? date('Y-m-d', strtotime($date_purchased)) : null;
                ?>
                <input type="date" class="form-control form-control-sm rounded-0" id="last_date_purchased" name="last_date_purchased" value="<?php echo $formattedDate; ?>" readonly>

        <div class="form-group">
            <label for="status" class="control-label">Status:</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option value="1" <?php echo isset($status) && $status =="" ? "selected": "1" ?> >Active</option>
                <option value="0" <?php echo isset($status) && $status =="" ? "selected": "0" ?>>Inactive</option>
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
            start_loader();
            var supplierId = $('#supplier_id').val();
            if (supplierId) {
                $.ajax({
                    url: _base_url_ + "admin/po/items/get_max_item_code.php",
                    data: { supplier_id: supplierId },
                    method: 'GET',
                    dataType: 'json',
                    success: function (resp) {
                        if (resp.status === 'success') {
                            var countItemCode = resp.count_item_code;
                            var newItemCode = supplierId + '-' + countItemCode;
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
                    url: _base_url_ + "admin/po/items/get_max_item_code.php",
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
