<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    //$qry = $conn->query("SELECT i.*,x.c_active as xactive FROM t_csr_buyers i inner join t_csr_view x on i.c_csr_no = x.c_csr_no inner join customers_profile c on i.buyer_id = c.buyer_id WHERE i.c_csr_no = '{$_GET['id']}'");
    $qry = $conn->query("SELECT i.*,x.* FROM t_csr_buyers i inner join t_csr_view x on i.c_csr_no = x.c_csr_no WHERE i.c_csr_no = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<?php
$query2 = "SELECT * FROM t_csr_buyers WHERE c_csr_no = '{$_GET['id']}'";
$result2 = mysqli_query($conn, $query2);

if ($result2) {
    $buyer_counter = 0; 
    $displayTitle = false; 

    while ($row = mysqli_fetch_assoc($result2)) {
        $buyer_count = $row['c_buyer_count'];
        $customer_last_name = $row['last_name'];
        $customer_suffix_name = $row['suffix_name'];
        $customer_first_name = $row['first_name'];
        $customer_middle_name = $row['middle_name'];

        $cust_fullname = sprintf('%s %s, %s %s', $customer_last_name, $customer_suffix_name, $customer_first_name, $customer_middle_name);

        echo '<div class="view_box">';
        echo '<div class="float-left col-md-12">';
        echo '<table class="table table-bordered">';
        echo '<tr>';
        echo '<td style="width: 200px;"><b>Full Name (Buyer ' . ($buyer_counter + 1) . '): </b></td>';
        echo '<td>' . $cust_fullname . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="space"></div>';

        $buyer_counter++;
    }

    if ($buyer_counter > 1) {
        $displayTitle = true;
    }

    if ($displayTitle) {
        echo '<div class="title" style="text-align:center;font-weight:bold;">Principal Buyer\'s Information</div><br/>';
    }
}
?>
<div class="container-fluid">
    <form action="" id="account-form">
        <input type="hidden" id="id" name="id" value="<?php echo isset($buyer_id) ? $buyer_id : '' ?>">
        <table class="table table-bordered" id="data-table">
            <tr>
                <td style="width: 200px;"><label class="control-label">Location:</label></td>
                <td><?php echo isset($c_acronym) ? $c_acronym : '' ?> Block <?php echo isset($c_block) ? $c_block : '' ?> Lot <?php echo isset($c_lot) ? $c_lot : '' ?></td>
            </tr>
            <tr>
                <td style="width: 200px;"><label class="control-label">Address:</label></td>
                <td><?php echo isset($address) ? $address : '' ?>, <?php echo isset($zip_code) ? $zip_code : '' ?></td>
            </tr>
            <tr>
                <td style="width: 200px;"><label class="control-label">Contact Number:</label></td>
                <td><?php echo isset($contact_no) ? $contact_no : '' ?></td>
            </tr>
            <tr>
                <td style="width: 200px;"><label class="control-label">Email Address:</label></td>
                <td><?php echo isset($email) ? $email : '' ?></td>
            </tr>
            <tr>
                <td style="width: 200px;"><label class="control-label">Status:</label></td>
            <?php 
                $status = isset($c_active) ? $c_active : 0;
                    switch($status){
                        case 0:
                            echo '<td><span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span></td>';
                            break;
                        case 1:
                            echo '<td><span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Active</span></td>';
                            break;
                        default:
                            echo '<td><span class="badge badge-default border px-3 rounded-pill">N/A</span></td>';
                                break;
                    }
                ?>
        </tr>
        <?php 
            $c_qry = $conn->query("SELECT * FROM customers_profile WHERE buyer_id = '$buyer_id'");
            if($c_qry->num_rows > 0){
                $res = $c_qry->fetch_array();
                foreach($res as $k => $v){
                    if(!is_numeric($k))
                    $$k = $v;
                }
            }
        ?>
        
        <table class="table table-bordered" id="data-table">
            <tr>
                <td style="width: 200px;"><label for="mop" class="control-label">Payment Terms:</label></td>
                <td><select name="terms" id="terms" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;">
                    <option value="" disabled <?php echo !isset($terms) ? "selected" : '' ?>>Select Payment Terms</option>
                    <?php 
                        $terms_qry = $conn->query("SELECT * FROM `payment_terms`");
                        while ($row = $terms_qry->fetch_assoc()):
                    ?>
                    <option 
                        value="<?php echo $row['terms_indicator'] ?>" 
                        <?php echo isset($terms) && $terms == $row['terms_indicator'] ? 'selected' : '' ?> 
                    ><?php echo $row['terms'] ?></option>
                    <?php endwhile; ?>
                </select></td>
            </tr>
            <tr>
                <td style="width: 200px;"><label for="status" class="control-label">Vatable?</label></td>
                <td><select name="vatable" id="vatable" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;">
                <option value="" disabled <?php echo !isset($vatable) ? "selected" : '' ?>>Select Vatable Status</option>
                <option value="12" <?php echo isset($vatable) && $vatable == "12" ? "selected" : '' ?>>Yes</option>
                <option value="0" <?php echo isset($vatable) && $vatable == "0" ? "selected" : '' ?>>No</option>
                </select></td>
            </tr>

    </form>
</div>
<script>
    $(function(){
        $('#uni_modal #account-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_cprofile",
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
                success: function (resp) {
    if (resp.status == 'success') {
        location.reload();
    } else if (resp.status == 'failed') {
        // Display the specific error message from the server
        el.addClass("alert-danger")
        el.text(resp.err);
        _this.prepend(el);
    } else {
        el.addClass("alert-danger")
        el.text("An error occurred due to unknown reason.");
        _this.prepend(el);
    }
    el.show('slow');
    $('html,body,.modal').animate({scrollTop:0},'fast');
    end_loader();
}

            })
        })
    })
</script>