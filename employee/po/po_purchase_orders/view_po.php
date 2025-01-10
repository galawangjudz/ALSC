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
        border:none !important;
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
    [name="tax_percentage"]{
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
    .nav-orders{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-orders:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    @media (max-width: 768px) {
    .card {
        flex-direction: column;
        align-items: center;
    }
    .table-container {
        overflow-x: auto;
        max-width: 100%;
    }
    table {
        table-layout: fixed;
        width: 100%;
    }
    body {
        font-size: 11px;
    }
    #imglogo {
        width: 100px;
        height: auto;
    }
    #h2-resize{
        font-size:17px;
    }
    .ftsmall{
        font-size:12px!important;
    }
}
</style>
<?php
    $usertype = $_settings->userdata('user_type'); 
    $type = $_settings->userdata('user_code');
    $level = $_settings->userdata('type');
?>
<body>
<div class="card-outline card-info">
	<div class="card-header">
    <form action="" id="view-po-form">
        <h5 class="card-title"><b><i>View Purchase Order Details</b></i></h5>
        <?php if ($status == 1 and $status2 == 1 and $status3 == 1): ?>
        <div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button" style="float:right;margin-left:5px;"><i class="fa fa-print"></i> Print</button>
            <!-- <a class="btn btn-sm btn-flat btn-primary" href="?page=po/purchase_orders/verify_po&id=<?php echo $id ?>" style="float:right;"><i class="fa fa-edit"></i> Edit</a> -->
        </div>
        <?php endif; ?>
	</div>
	<div class="card-body" id="out_print">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div>
                    <h2 id="h2-resize"><label style="backround-color:red;">PURCHASE ORDER</h2>
                    <p class="m-0"><b><?php echo $_settings->info('company_name') ?></b></p>
                    <p class="m-0"><?php echo $_settings->info('company_email') ?></p>
                    <p class="m-0"><?php echo $_settings->info('company_address') ?></p>
                </div>
            </div>
            <div class="col-6">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" id="imglogo" alt="" height="200px" style="float:right;">
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
                    <p><input class="ftsmall" type="text" value="<?php echo $po_no ?>" id="po_no" name="po_no" style="border:none;color:black;"></p>
                    <p  class="m-0 lblrdept"><b>Requesting Department:</b></p>
                    <p><input class="ftsmall lblrdept2" type="text" value="<?php echo isset($department) ? $department : '' ?>" id="department" name="department" style="border:none;color:black;"></p>
                    <input type="hidden" id="po_id" name="po_id" value="<?php echo $id; ?>">
                    <input type="hidden" id="usertype" name="usertype" value="<?php echo $usertype; ?>">
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Date Created:</b></p>
                    <p><input class="ftsmall" type="text" value="<?php echo date("F j, Y",strtotime($date_created)) ?>" style="border:none;color:black;"></p>

                    <p  class="m-0"><b>Requested Delivery Date:</b></p>
                    <p><input class="ftsmall" type="text" value="<?php echo date("F j, Y",strtotime($delivery_date)) ?>" style="border:none;color:black;"></p>
                </div>
            </div>
        </div>
        <br>
        <?php 
            $receiver_qry = $conn->query("SELECT * FROM users where user_code = '{$receiver_id}'");
            $receiver2_qry = $conn->query("SELECT * FROM users where user_code = '{$receiver2_id}'");
            $receiver = $receiver_qry->fetch_array();
            $receiver2 = $receiver2_qry->fetch_array();
        ?>

        <hr>
        <p class="m-0"><b>Ship To:</b></p>
        <div class="row mb-2">
            <div class="col-6">
                <div class="form-group">
                    <?php if ($receiver !== null): ?>
                        <p class="m-0"><b><?php echo $receiver['firstname'] ?> <?php echo $receiver['lastname'] ?></b></p>
                        <p class="m-0"><?php echo $receiver['phone'] ?></p>
                    <?php else: ?>
                        <p class="m-0"></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <?php if ($receiver2 !== null): ?>
                        <p class="m-0"><b><?php echo $receiver2['firstname'] ?> <?php echo $receiver2['lastname'] ?></b></p>
                        <p class="m-0"><?php echo $receiver2['phone'] ?></p>
                    <?php else: ?>
                        <p class="m-0"></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered table-striped" id="item-list" style="text-align: center; width: auto; min-width: 1000px;width:100%">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="30%">
                        <col width="30%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled" style="">
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Qty</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Unit</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Item</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Description</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Price</th>
                            <th class="bg-navy disabled text-light px-1 py-1 text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($id)):
                        $order_items_qry = $conn->query("SELECT o.*,i.name, i.description FROM `order_items` o inner join item_list i on o.item_id = i.id where o.`po_id` = '$id' and o.item_status != 2");
                        $sub_total = 0;
                        while($row = $order_items_qry->fetch_assoc()):
                            $sub_total += ($row['quantity'] * $row['unit_price']);
                        ?>
                        <tr class="po-item" data-id="">
                            <td class="align-middle p-0 text-center">
                                <input type="number" class="text-center w-100 border-0 ftsmall" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>" readonly/>
                            </td>
                            <td class="align-middle p-1">
                                <input type="text" class="text-center w-100 border-0 ftsmall" name="unit[]" value="<?php echo $row['default_unit'] ?>" readonly/>
                            </td>
                            <td class="align-middle p-1">
                                <input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>" readonly>
                                <input type="text" class="w-100 border-0 item_id ftsmall" value="<?php echo $row['name'] ?>"  readonly/>
                            </td>
                            <td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
                            <td class="align-middle p-1">
                                <input type="number" step="any" class="text-right w-100 border-0 ftsmall" name="unit_price[]"  value="<?php echo ($row['unit_price']) ?>" readonly/>
                            </td>
                            <td class="align-middle p-1 text-right total-price ftsmall"><?php echo number_format($row['quantity'] * $row['unit_price'], 2) ?></td>
                        </tr>
                        <?php endwhile;endif; ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-lightblue">
                            <tr>
                                <th class="p-1 text-right" colspan="5">Sub-total:</th>
                                <th class="p-1 text-right" id="sub_total"><?php echo number_format($sub_total,2) ?></th>
                            </tr>
                            <tr>
                            </tr>
                            <tr>

                                <th class="p-1 text-right" colspan="5">VAT:
                                </th>
                                
                                <th class="p-1 text-right" id="tax_amount" name="tax_amount"><?php echo isset($tax_amount) ? number_format($tax_amount,2) : 0 ?></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="5">TOTAL:</th>
                                
                                <?php if ($vatable == 2) { ?>
                                    <th class="p-1 text-right" id="total"><?php echo isset($tax_amount) ? number_format(($sub_total + $tax_amount), 2) : 0 ?></th>
                                <?php } else{ ?>
                                    <th class="p-1 text-right" id="total"><?php echo isset($tax_amount) ? number_format(($sub_total), 2) : 0 ?></th>
                                <?php } ?>
                            </tr>
                        </tr>
                    </tfoot>
                </table>
                </div>
                <div style="overflow-x: auto;">
                    <div class="row">
                        <div class="col-12">
                            <label for="notes" class="control-label">Remarks:</label>
                            <textarea id="notes" name="notes" cols="10" rows="4" class="form-control rounded-0 ftsmall" readonly><?php echo isset($notes) ? trim($notes) : '' ?></textarea>
                        </div>
                    </div><br>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
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