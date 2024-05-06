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
    body{
        font-size:14px;
    }
    .form-control{
        font-size:14px;
    }
</style>
<div class="container fluid">
    <!-- <callout class="callout-primary">
        <dl class="row">
            <table class="table table-bordered">
                <tr>
                    <td><b>Name:</b></dt></td>
                    <td><b><?php echo $name ?></b></dd></td>
                </tr>
                <tr>
                    <td><b>Code:</b></dt></td>
                    <td><b><?php echo $item_code ?></b></dd></td>
                </tr>
                
                <tr>
                    <td><b>Supplier:</b></dt></td>
                    <td><?php
                        $supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE id = $supplier_id");
                        while ($row = $supplier_qry->fetch_assoc()) :
                        ?>
                        <?php echo $row['name'] ?>
                        <?php endwhile; ?>
                    </dd></td>
                </tr>
                <tr>
                <td><b>Category:</b></dt></td>
                    <td><?php 
                    $qry_sup = $conn->query("SELECT category FROM `supplier_list` WHERE id = $supplier_id");

                    if ($qry_sup->num_rows > 0) {
                        while ($row = $qry_sup->fetch_assoc()) :
                            ?>
                            <div class="form-group">
                                <?php 
                                if($row['category'] == 0){
                                    echo 'Goods';
                                } elseif($row['category'] == 1){
                                    echo 'Services';
                                }
                                ?>
                            </div>
                            <?php 
                        endwhile;
                    } else {
                        echo "No category found for the specified supplier.";
                    }
                ?></dd></td>
                </tr>
               
                <tr>
                    <td><b>Description:</b></dt></td>
                    <td><?php echo $description ?></dd></td>
                </tr>
                <tr>
                    <td><b>Unit of Measurement:</b></dt></td>
                    <td><?php echo $default_unit ?></dd></td>
                </tr>
                <tr>
                    <td><b>Last Date Purchased:</b></dt></td>
                    <td><?php
                        $formattedDate = !empty($date_purchased) ? date('Y-m-d', strtotime($date_purchased)) : null;
                        ?>
                        <?php echo $formattedDate; ?>
                    </dd></td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                   <td>
                        <?php if($status == 1): ?>
                            <span class="badge badge-success">Active</span>
                        <?php else: ?>
                            <span class="badge badge-secondary">Inactive</span>
                        <?php endif; ?>
                   </td>
                </tr>
            </table>
        </dl>
    </callout> -->
    <callout class="callout-primary">
        <dl class="row">
            <table class="table table-bordered">
                <tr>
                    <td><b>Code:</b></dt></td>
                    <td><b><?php echo $item_code ?></b></dd></td>
                </tr>
                <tr>
                    <td><b>Name:</b></dt></td>
                    <td><b><?php echo $name ?></b></dd></td>
                </tr>
                <tr>
                    <td><b>Description:</b></td>
                    <td><?php echo $description ?></td>
                </tr>
                <tr>
                    <td><b>Type:</b></td>
                    <td> <?php if($type == 1): ?>
                            Goods
                        <?php elseif($type == 2): ?>
                            Services
                        <?php else: ?>
                            <span class='badge badge-secondary'>Not yet tagged</span>
                        <?php endif; ?></td>
                </tr>
                <tr>
                    <td><b>Unit of Measure:</b></td>
                    <td><?php echo $default_unit ?></td>
                </tr>
                <!-- <tr>
                    <td><b>Last Date Purchased:</b></td>
                    <td>
                        <?php
                        if (!empty($date_purchased)) {
                            echo date("F j, Y", strtotime($date_purchased));
                        } else {
                            echo "<span class='badge badge-primary'>Not yet purchased</span>";
                        }
                        ?>
                    </td>
                </tr> -->
            </table><br><br>
        </dl>
    </callout>
</div>
<form action="" id="item-form">
     <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <hr>
    <div style="text-align:center;font-weight:bold;">GL Account:<br><hr></div>
    <div class="form-group">
        <label for="default_unit" class="control-label">Sales Account:</label>
        <select name="account_code" class="form-control">
            <option value="" disabled selected>Select an option</option>
            <?php
            $groupedAccounts = array(); 
            $query = "SELECT a.*, g.name AS group_name 
                    FROM account_list a 
                    INNER JOIN group_list g ON a.group_id = g.id 
                    WHERE a.code != '21002' AND a.code != '11076' AND a.code != '21012'
                    ORDER BY g.name, a.name";

            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()):
                $account_row['code'] = $row['code'];
                $account_row['name'] = $row['name'];
                $group_name = $row['group_name'];

                $groupedAccounts[$group_name][] = $account_row;
            endwhile;

            foreach ($groupedAccounts as $groupName => $accountsGroup):
                echo '<optgroup label="' . $groupName . '">';

                foreach ($accountsGroup as $account):
                    echo '<option value="' . $account['code'] . '" ' . (isset($account_code) && $account_code == $account['code'] ? 'selected' : '') . '>' . $account['name'] . '</option>';
                endforeach;

                echo '</optgroup>';
            endforeach;
            ?>
        </select>
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
                    url: _base_url_ + "/po/po_items/get_max_item_code.php",
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
                    url: _base_url_ + "employee/po/po_items/get_max_item_code.php",
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
