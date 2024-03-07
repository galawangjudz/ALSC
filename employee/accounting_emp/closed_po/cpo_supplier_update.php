<?php
require_once('../../../config.php');
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
}
?>
<script src="js/cpo_setup.js"></script>
<body>
    <form action="" id="supplier-form">
    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
    <div class="container-fluid">
        <table class="table table-bordered">
            <tr>
                <td style="width:150px;"><b>Supplier Name:</b></td>
                <td><b><?php echo $name ?></b></td>
            </tr>
            <tr>
                <td><b>Address:</b></td>
                <td><?php echo $address ?></td>
            </tr>
            <tr>
                <td><b>Contact Person:</b></td>
                <td><?php echo $contact_person ?></td>
            </tr>
            <tr>
                <td><b>Contact #:</b></td>
                <td><?php echo $contact ?></td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <td>
                    <label for="mop" class="control-label">Mode of Payment:</label>
                </td>
                <td>
                    <?php if($mop == 0): ?>
                        <span>Cash on Delivery</span>
                    <?php else: ?>
                        <span>Check</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mop" class="control-label">Payment Terms:</label>
                </td>
                <td>
                    <?php
                    $terms_qry = $conn->prepare("SELECT * FROM `payment_terms` WHERE terms_indicator = ?");
                    $terms_qry->bind_param("i", $terms);
                    $terms_qry->execute();
                    $result = $terms_qry->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $recValue = $row['terms'];
                            echo $recValue . "<br>"; 
                        }
                    } else {
                        echo "No additional terms found.";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="status" class="control-label">Status:</label>
                </td>
                <td>
                    <?php if($status == 1): ?>
                        <span class="badge badge-success">Active</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">Inactive</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <td>
                    <label for="status" class="control-label">Vatable:</label>
                </td>
                <td>
                    <select name="vatable" id="vatable" class="form-control rounded-0" required>
                        <option value="" <?php echo (!isset($vatable) || $vatable === "") ? "selected" : "" ?>>Select an option</option>
                        <option value="0" <?php echo (isset($vatable) && $vatable == "0") ? "selected" : "" ?>>Non-VAT</option>
                        <option value="3" <?php echo (isset($vatable) && $vatable == "3") ? "selected" : "" ?>>Zero-rated</option>
                        <option value="1" <?php echo (isset($vatable) && $vatable == "1") ? "selected" : "" ?>>Inclusive</option>
                        <option value="2" <?php echo (isset($vatable) && $vatable == "2") ? "selected" : "" ?>>Exclusive</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="contact" class="control-label">Withholding Tax:</label>  
                </td>
                <td>
                    <table class="table">
                        <tr>
                            <td class="ewt-cell">
                                <label>
                                    <input type="radio" id="goodsRadio" name="ewt_type" class="form-check-input" value="1" onchange="updateEWT()" style="margin-left:5px;" <?php echo isset($wt) && $wt == 1 ? 'checked' : ''; ?>>
                                    <div class="rdo" style="margin-left:20px;">Goods</div>
                                </label>
                            </td>
                            <td class="ewt-cell">
                                <label>
                                    <input type="radio" id="servicesRadio" name="ewt_type" class="form-check-input" value="2" onchange="updateEWT()" style="margin-left:0px;" <?php echo isset($wt) && $wt == 2 ? 'checked' : ''; ?>>   
                                    <div class="rdo" style="margin-left:15px;">Services</div>
                                </label>
                            </td>
                            <td class="ewt-cell">
                                <label>
                                    <input type="radio" id="othersRadio" name="ewt_type" class="form-check-input" value="0" onchange="updateEWT()" style="margin-left:5px;" <?php echo isset($wt) && !in_array($wt, [1, 2]) ? 'checked' : ''; ?>>
                                    <div class="goods" style="margin-left:20px;">Others</div>
                                </label>
                            </td>
                        </tr>
                    </table>
                    <div style="width: 100%;">
                        <input type="text" name="wt" id="wt" placeholder="Enter a value here." value="<?php echo isset($wt) ? $wt :"" ?>">
                        <span>%</span>
                    </div>
                </td>
            </tr>
            </table>
        </div>
    </form>
</body>

<script>
function updateEWT() {
    var ewtInput = document.getElementById('wt');
    var goodsRadio = document.getElementById('goodsRadio');
    var servicesRadio = document.getElementById('servicesRadio');
    var othersRadio = document.getElementById('othersRadio');
    
    if (othersRadio.checked) {
        ewtInput.removeAttribute('readonly');

    } else if (servicesRadio.checked) {
        ewtInput.value = '2';
        ewtInput.placeholder = '';
        ewtInput.setAttribute('readonly','readonly')
    } else if (goodsRadio.checked) {
        ewtInput.value = '1';
        ewtInput.placeholder = '';
        ewtInput.setAttribute('readonly','readonly')
    } else {
        ewtInput.value = '';
        ewtInput.placeholder = '';
    }
}
updateEWT();
</script>
<script>
   $(function(){
    $('#supplier-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();

        var vatableValue = $('#vatable').val();
        if (vatableValue === '') {
            alert('Please select a value for Vatable.');
            end_loader();
            return false; 
        }

        var wtValue = $('#wt').val();
        if (wtValue === '') {
            alert('Please enter a value for withholding tax.');
            end_loader();
            return false; 
        }

        $.ajax({
            url: _base_url_+"classes/Master.php?f=save_supplier_setup",
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
            success: function(resp){
                if(typeof resp =='object' && resp.status == 'success'){
                    location.reload();
                } else if(resp.status == 'failed' && !!resp.msg){
                    var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    $("html, body").animate({ scrollTop: 0 }, "fast");
                } else {
                    alert_toast("An error occurred", 'error');
                    console.log(resp);
                }
                end_loader();
            }
        });
    });
});

</script>