<?php
require_once('../../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `account_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="account-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="name" class="control-label">Code:</label>
            <input type="text" name="code" id="code" class="form-control form-control-border" placeholder="Enter account code" value ="<?php echo isset($code) ? $code : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="group" class="control-label">Group:</label>

            <select name="group_id" id="group_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;">
                <option value="" disabled <?php echo !isset($id) ? "selected" : '' ?>></option>
                <?php 
                $group_qry = $conn->query("SELECT * FROM `group_list` WHERE delete_flag = 0");
                while ($row = $group_qry->fetch_assoc()):
                ?>
                <option 
                    value="<?php echo $row['id'] ?>" 
                    <?php echo isset($group_id) && $group_id == $row['id'] ? 'selected' : '' ?> 
                    <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                ><?php echo $row['name'] ?></option>
                <?php endwhile; ?>
            </select>

        </div>
        
        <div class="form-group">
            <label for="name" class="control-label">Account Name:</label>
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Enter account Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
        <!-- <div class="form-group">
            <label for="description" class="control-label">Description:</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo isset($description) ? html_entity_decode($description) : '' ?></textarea>
        </div> -->
        <div class="form-group">
            <label for="status" class="control-label">Status:</label>
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>

<script>
    $(function(){
        $('#uni_modal #account-form').submit(function(e){
            e.preventDefault();
            if(validateForm()) {
       
                var _this = $(this);
                $('.pop-msg').remove();
                var el = $('<div>');
                el.addClass("pop-msg alert");
                el.hide();
                start_loader();
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=save_account",
                    data: new FormData($(this)[0]),
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
                        if (resp.status == 'success') {
                            location.reload();
                        } else if (!!resp.msg) {
                            el.addClass("alert-danger");
                            el.text(resp.msg);
                            _this.prepend(el);
                        } else {
                            el.addClass("alert-danger");
                            el.text("An error occurred due to an unknown reason.");
                            _this.prepend(el);
                        }
                        el.show('slow');
                        $('html,body,.modal').animate({ scrollTop: 0 }, 'fast');
                        end_loader();
                    }
                });
            }
        });

        function validateForm() {
            var isValid = true;
            $('#account-form [required]').each(function () {
                if (!$(this).val().trim()) {
                    isValid = false;
                    alert_toast('Please fill in all required fields.', 'warning');
                    return false; 
                }
            });
            return isValid;
        }
    });
</script>
