<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `po_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    .label-danger {
    background-color: #FF0000;
    color: #FFFFFF;
    }
    .label-success {
        background-color: #28A745;
        color: #FFFFFF;
    }
    .label-secondary {
        background-color: #888888; 
        color: #ffffff; 
    }
    #notes {
        min-width: 590px;
        min-height: 100px;
        resize: none; 
    }
    input{
        border:none;
    }
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		}
		input[type=number] {
		-moz-appearance: textfield;
		}
		[name="tax_percentage"],[name="discount_percentage"]{
			width:5vw;
		}
        .disabled-link {
            pointer-events: none;
            opacity: 0.6; 
        }
        input{
            pointer-events:none;
            border:none;
            background-color: transparent;
        }
        .nav-gr{
		    background-color:#007bff;
		    color:white!important;
		    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        }
        .nav-gr:hover{
            background-color:#007bff!important;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
        }
</style>
<?php
    $usertype = $_settings->userdata('user_type'); 
    $type = $_settings->userdata('user_code');
    $level = $_settings->userdata('type');
?>
<div class="card card-outline card-info">
	<div class="card-header">
    <form action="" id="view-po-form">
        <h5 class="card-title"><b><i>View Purchase Request Details</b></i></h5>
        <div class="card-tools">
        <?php if($status == 1) { ?>
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button" style="font-size:14px;float:right;margin-left:5px;"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
        <?php }elseif($status == 0){ ?>
            <a class="btn btn-sm btn-flat btn-primary" href="?page=po/requisitions/manage_req&id=<?php echo $id ?>" style="font-size:14px;float:right;margin-left:5px;"><i class="fa fa-edit"></i>&nbsp;&nbsp;Edit</a>
            <?php } ?>
        </div>
	</div>
	<div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                <h2><label style="backround-color:red;">PURCHASE REQUEST</h2>
                    <p class="m-0"><b><?php echo $_settings->info('company_name') ?></b></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-6">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px" style="float:right;">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <p class="m-0"><b>Vendor:</b></p>
                <?php 
                $sup_qry = $conn->query("SELECT * FROM supplier_list where id = '{$supplier_id}'");
                $supplier = $sup_qry->fetch_array();
                ?>
                <div>
                    <p class="m-0"><input type="hidden" id="supplier_id" name="supplier_id" value="<?php echo $supplier['id'] ?>"></p>
                    <p class="m-0"><b><?php echo $supplier['name'] ?></b></p>
                    <p class="m-0"><?php echo $supplier['address'] ?></p>
                    <p class="m-0"><?php echo $supplier['contact_person'] ?></p>
                    <p class="m-0"><?php echo $supplier['contact'] ?></p>
                    <p class="m-0"><?php echo $supplier['email'] ?></p>
                </div>
            </div>
            <div class="col-6 row">
                <div class="col-6">
                    <p  class="m-0"><b>P.O. #:</b></p>
                    <p><input type="text" value="<?php echo $po_no ?>" id="po_no" name="po_no" style="border:none;color:black;"></p>

                    <p  class="m-0"><b>Requesting Department:</b></p>
                    <p><input type="text" value="<?php echo isset($department) ? $department : '' ?>" id="department" name="department" style="border:none;color:black;"></p>
                    <input type="hidden" id="po_id" name="po_id" value="<?php echo $id; ?>">
                    <input type="hidden" id="usertype" name="usertype" value="<?php echo $usertype; ?>">
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Date Created:</b></p>
                    <p><input type="text" value="<?php echo date("F j, Y",strtotime($date_created)) ?>" style="border:none;color:black;"></p>

                    <p  class="m-0"><b>Requested Delivery Date:</b></p>
                    <p><input type="text" value="<?php echo date("F j, Y",strtotime($delivery_date)) ?>" style="border:none;color:black;"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="item-list">
                    <colgroup>
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="30%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled" style="">
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Qty</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Unit</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Item</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($id)):
                        $order_items_qry = $conn->query("SELECT o.*,i.name, i.description FROM `order_items` o inner join item_list i on o.item_id = i.id where o.`po_id` = '$id' ");
                        $sub_total = 0;
                        while($row = $order_items_qry->fetch_assoc()):
                            $sub_total += ($row['quantity'] * $row['unit_price']);
                        ?>
                        <tr class="po-item" data-id="">
                            <td class="align-middle p-0 text-center"><?php echo $row['quantity'] ?></td>
                            <td class="align-middle p-1"><?php echo $row['unit'] ?></td>
                            <td class="align-middle p-1"><?php echo $row['name'] ?></td>
                            <td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
                        </tr>
                        <?php endwhile;endif; ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-8">
                        <label for="notes" class="control-label">Remarks:</label>
                        <textarea id="notes" name="notes" cols="10" rows="4" class="form-control rounded-0" readonly><?php echo isset($notes) ? trim($notes) : '' ?></textarea>
                    </div>
                    <div class="col-md-4" id="hidden-status">
                        <label for="status" class="control-label">Status:</label>
                        <br>
                        <?php
                        $statusText = '';
                        switch (true) {
                            case ($status == 1 && $status2 == 0 && $status3 == 0):
                                $statusText = "Approved by the Purchasing Officer and waiting for the Finance Manager's approval.";
                                $labelClass = 'label-success';
                                break;
                            case ($status == 2 && $status2 == 0 && $status3 == 0):
                                $statusText = "Declined by the Purchasing Officer";
                                $labelClass = 'label-danger';
                                break;
                            case ($status == 1 && $status2 == 1 && $status3 == 0):
                                $statusText = "Approved by the Finance Manager and waiting for the COO's or CFO's approval.";
                                $labelClass = 'label-success';
                                break;
                            case ($status == 1 && $status2 == 2 && $status3 == 0):
                                $statusText = "Declined by the Finance Manager.";
                                $labelClass = 'label-danger';
                                break;
                            case ($status == 1 && $status2 == 1 && $status3 == 1):
                                $statusText = "Approved by the COO/CFO.";
                                $labelClass = 'label-success';
                                break;
                            case ($status == 0 && $status2 == 0 && $status3 == 0):
                                $statusText = "Waiting for the Purchasing Officer's approval.";
                                $labelClass = 'label-success';
                                break;
                            default:
                                $statusText = "Declined by the COO/CFO.";
                                $labelClass = 'label-danger';
                        }
                        echo "<span class='py-1 px-4 label $labelClass' style='border-radius: 5px; display: block; font-weight:bold; text-align: center; font-style: italic;'>$statusText</span>";
                        ?>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<table class="d-none" id="item-clone">
	<tr class="po-item" data-id="">
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="qty[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0" name="unit[]"/>
		</td>
		<td class="align-middle p-1">
			<input type="hidden" name="item_id[]">
			<input type="text" class="text-center w-100 border-0 item_id" required/>
		</td>
		<td class="align-middle p-1 item-description"></td>
		<td class="align-middle p-1">
			<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
	</tr>
</table>
<script>
    $(function(){
        $('#print').click(function(e){
            e.preventDefault();
            start_loader();
            var _h = $('head').clone()
            var _p = $('#out_print').clone()
            var _el = $('<div>')
                _p.find('thead th').attr('style','color:black !important')
                _el.append(_h)
                _el.append(_p)
                
                _el.find('#hidden-status').css('display', 'none');

            var nw = window.open("","","width=1200,height=950")
                nw.document.write(_el.html())
                nw.document.close()
                setTimeout(() => {
                    nw.print()
                    setTimeout(() => {
                        end_loader();
                        nw.close()
                    }, 300);
                }, 200);
        })
    })
    $(document).ready(function() {
        $('#notes').on('input', function() {
            const textarea = $(this);
            const value = textarea.val();
            const lines = value.split('\n').length;
        
            const minHeight = 100; 
            const maxHeight = 300; 
            const lineHeight = 20; 
            
            const newHeight = Math.min(maxHeight, Math.max(minHeight, lines * lineHeight));
            textarea.css('height', newHeight + 'px');
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
        var disabledLinks = document.querySelectorAll(".disabled-link");
        
        disabledLinks.forEach(function(link) {
            link.addEventListener("click", function(event) {
            event.preventDefault(); 
            });
        });
    });
</script>