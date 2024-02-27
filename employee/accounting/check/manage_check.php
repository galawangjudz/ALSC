<?php
require_once('../../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM check_details WHERE c_num = {$_GET['id']};");

    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
        $existingDetails = true;
    } else {
        $existingDetails = false;
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
    body {
        font-size: 14px;
    }

    .form-control {
        font-size: 14px;
    }
</style>

<?php if (!$existingDetails) { ?>
    <!-- Only display the form if there are no existing details -->
    <form action="" id="check-form">
        <input type="text" id="check_id" name="check_id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="container-fluid">
            <div class="form-group">
                <label for="c_num" class="control-label">Check Voucher #:</label>
                <input type="text" name="c_num" id="c_num" class="form-control rounded-0" value="<?php echo isset($c_num) ? $c_num : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="check_name" class="control-label">Check Name:</label>
                <input type="text" name="check_name" id="check_name" class="form-control rounded-0" value="<?php echo isset($check_name) ? $check_name : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="check_num" class="control-label">Check #:</label>
                <input type="text" name="check_num" id="check_num" class="form-control rounded-0" value="<?php echo isset($check_num) ? $check_num : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="amount" class="control-label">Amount:</label>
                <input type="text" name="amount" id="amount" class="form-control rounded-0" value="<?php echo isset($amount) ? $amount : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="check_date" class="control-label">Check Date:</label>
                <input type="date" name="check_date" id="check_date" class="form-control rounded-0" value="<?php echo isset($check_date) ? $check_date : "" ?>" required>
            </div>
        </div>
    </form>
<?php } else { ?>
    <!-- Display the table and button to toggle the form -->
    <table id="check-details-table">
        <tr>
            <th>Check Voucher #</th>
            <th>Check Name</th>
            <th>Check #</th>
            <th>Amount</th>
            <th>Check Date</th>
        </tr>
        <?php
        $query = "SELECT * FROM check_details WHERE c_num = {$_GET['id']}";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['c_num'] . '</td>';
                echo '<td>' . $row['check_name'] . '</td>';
                echo '<td>' . $row['check_num'] . '</td>';
                echo '<td>' . number_format($row['amount'], 2) . '</td>';
                echo '<td>' . $row['check_date'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No matching rows found.</td></tr>';
        }
        ?>
    </table>
    <button id="toggle-form-btn">Create Check Details</button>

    <!-- Hidden form initially -->
    <form action="" id="check-form" style="display: none;">
        <input type="text" id="check_id" name="check_id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="container-fluid">
            <div class="form-group">
                <label for="c_num" class="control-label">Check Voucher #:</label>
                <input type="text" name="c_num" id="c_num" class="form-control rounded-0" value="<?php echo isset($c_num) ? $c_num : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="check_name" class="control-label">Check Name:</label>
                <input type="text" name="check_name" id="check_name" class="form-control rounded-0" value="<?php echo isset($check_name) ? $check_name : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="check_num" class="control-label">Check #:</label>
                <input type="text" name="check_num" id="check_num" class="form-control rounded-0" value="<?php echo isset($check_num) ? $check_num : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="amount" class="control-label">Amount:</label>
                <input type="text" name="amount" id="amount" class="form-control rounded-0" value="<?php echo isset($amount) ? $amount : "" ?>" required>
            </div>
            <div class="form-group">
                <label for="check_date" class="control-label">Check Date:</label>
                <input type="date" name="check_date" id="check_date" class="form-control rounded-0" value="<?php echo isset($check_date) ? $check_date : "" ?>" required>
            </div>
        </div>
    </form>

    <script>
        $(function () {
            $('#toggle-form-btn').click(function () {
                // Toggle the visibility of the form
                $('#check-form').toggle();
            });

            // Rest of your existing JavaScript code remains unchanged
        });
    </script>
<?php } ?>

<script>
    $(function(){
        $('#check-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_check",
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