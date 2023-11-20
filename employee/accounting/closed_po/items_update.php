<?php
// require_once('../../../config.php');
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `po_approved_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="card card-outline card-info">
    <div class="card-header">
		<h5 class="card-title"><b><i>Update Items for PO # <?php echo $id; ?></b></i></h5>
	</div>
	
		
    <br>
    <div class="card-body">
    <div class="container-fluid">
            <div class="container-fluid">
            <form action="" id="item-form">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered" id="item-list">
                <thead>
                    <tr class="bg-navy disabled">
                        <th class="px-1 py-1 text-center">Item Code</th>
                        <th class="px-1 py-1 text-center">Unit</th>
                        <th class="px-1 py-1 text-center">Item</th>
                        <th class="px-1 py-1 text-center">Description</th>
                        <th class="px-1 py-1 text-center">Account Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($id)):
                    $order_items_qry = $conn->query("SELECT o.*, i.name, i.description, i.item_code, i.account_code
                    FROM approved_order_items o
                    INNER JOIN item_list i ON o.item_id = i.id
                    WHERE o.po_id = '$id'
                        AND o.gr_id = (
                        SELECT MAX(gr_id)
                        FROM approved_order_items
                        WHERE po_id = '$id'
                        );
                    ");
                    echo $conn->error;
                    while($row = $order_items_qry->fetch_assoc()):
                    ?>
                    <tr class="po-item" data-id="">
                        <td class="align-middle p-1">
                            <input type="text" class="text-center w-100 border-0" name="item_code[]" value="<?php echo $row['item_code'] ?>" style="pointer-events:none;border:none;background-color: transparent;"/>
                        </td>
                        <td class="align-middle p-1">
                            <input type="text" class="text-center w-100 border-0" name="unit[]" value="<?php echo $row['default_unit'] ?>" style="pointer-events:none;border:none;background-color: transparent;"/>
                        </td>
                        <td class="align-middle p-1">
                            <input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
                            <input type="text" class="w-100 border-0 item_id" value="<?php echo $row['name'] ?>" style="pointer-events:none;border:none;background-color: transparent;" required/>
                        </td>
                        <td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
                      
                        <td class="align-middle p-1">
                        <select name="account_title[]" class="form-control">
                        <option value="" disabled>Select an option</option>
                            <?php
                                $account_list_qry = $conn->query("SELECT * FROM account_list WHERE code !='2001' and code != '1201' and code != '2118'");
                                while($account_row = $account_list_qry->fetch_assoc()):
                            ?>
                                <option value="<?php echo $account_row['code']; ?>" <?php echo ($row['account_code'] == $account_row['code']) ? 'selected' : ''; ?>><?php echo $account_row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </td>

                    </tr>
                    <?php endwhile;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
	</form>
	<div class="card-footer" id="hidden-status">
		<table style="width:100%;">
			<tr>
				<td>
					<button class="btn btn-flat btn-default bg-maroon" style="width:100%;margin-right:5px;font-size:14px;" form="item-form" id="save-button">Save</button>
				</td>
				<td>
					<a class="btn btn-flat btn-default" style="width:100%;margin-left:5px;font-size:14px;" href="?page=closed_po"><i class="fa fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
				</td>
			</tr>
		</table>
	</div>
</div>
</div>
</div>
</div>

<script>
   $(function(){
    $('#item-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();

        // var vatableValue = $('#vatable').val();
        // if (vatableValue === '') {
        //     alert('Please select a value for Vatable.');
        //     end_loader();
        //     return false; 
        // }

        // var wtValue = $('#wt').val();
        // if (wtValue === '') {
        //     alert('Please enter a value for withholding tax.');
        //     end_loader();
        //     return false; 
        // }

        $.ajax({
            url: _base_url_+"classes/Master.php?f=save_item_setup",
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