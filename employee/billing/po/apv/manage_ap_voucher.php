
<?php
$delivery_date = date('Y-m-d', strtotime('+1 week'));
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `apv` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<?php
	$subtotal = 0;
	$usertype = $_settings->userdata('position'); 
	$type = $_settings->userdata('user_code');
	$level = $_settings->userdata('type');
?>
<style>
.nav-apv{
    background-color:#007bff;
    color:white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}
.nav-apv:hover{
    background-color:#007bff!important;
    color:white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
}
#spangreen{
    background-color:green;
    color:white !important;
}
#spanred{
    background-color:red;
    color: white !important;
}

</style>

</style>
<body>
<div class="card card-outline card-info">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Application Voucher": "Add New Application Voucher" ?></b></i></h5>
	</div>
	<div class="card-body">
		<form action="" id="apv-form">
			<input type="hidden" value="<?php echo $level; ?>">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="card-body">
					<div class="row">
                        <div class="col-md-12 form-group">
							<label for="invoice_no">APV No: <span class="po_err_msg text-danger"></span></label>
							<input type="text" class="form-control form-control-sm rounded-0" id="apv_no" name="apv_no" value="<?php echo isset($apv_no) ? $apv_no : '' ?>">
						</div>
						<div class="col-md-6 form-group">
						<label for="supplier_id">Supplier:</label>
						<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;">
							<option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
							<?php 
							$supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
							while ($row = $supplier_qry->fetch_assoc()):
								$vatable = $row['vatable'];
							?>
							<option 
								value="<?php echo $row['id'] ?>" 
								data-vatable="<?php echo $vatable ?>"
								<?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0? 'disabled' : '' ?>
							><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
						</div>
						<div class="col-md-6 form-group">
                            <label for="ap_voucher_date">AP Voucher Date: <span class="po_err_msg text-danger"></span></label>
                            <?php
                            if (!empty($ap_voucher_date)) {
                                $apformattedDate = date('Y-m-d', strtotime($ap_voucher_date));
                            } else {
                                $apformattedDate = date('Y-m-d'); 
                            }
                            ?>                            
                            <input type="date" class="form-control form-control-sm rounded-0" id="ap_voucher_date" name="ap_voucher_date" value="<?php echo isset($apformattedDate) ? $apformattedDate : '' ?>">
                        </div>
					</div>

					<div class="row">
                    <div class="col-md-6 form-group">
                        <label for="invoice_no">Invoice No: <span class="po_err_msg text-danger"></span></label>
                        <input type="text" class="form-control form-control-sm rounded-0" id="invoice_no" name="invoice_no">
                        <div id="invoiceCheckResult"></div>

                    </div>

						<div class="col-md-6 form-group">
							<label for="invoice_date">Invoice Date:</label>
                            <?php
							if (!empty($invoice_date)) {
                                $invoiceformattedDate = date('Y-m-d', strtotime($invoice_date));
                            } else {
                                $invoiceformattedDate = '';
                            }
                            ?>    
							<input type="date" class="form-control form-control-sm rounded-0" id="invoice_date" name="invoice_date" value="<?php echo isset($invoiceformattedDate) ? $invoiceformattedDate : '' ?>">
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-6 form-group">
							<label for="invoice_amount">Invoice Amount: <span class="po_err_msg text-danger"></span></label>
							<input type="text" class="form-control form-control-sm rounded-0" id="invoice_amount" name="invoice_amount" value="<?php echo isset($invoice_amount) ? $invoice_amount : '' ?>">
						</div>
						<div class="col-md-6 form-group">
							<label for="due_date">Due Date:</label>
                            <?php
							if (!empty($due_date)) {
                                $dueformattedDate = date('Y-m-d', strtotime($due_date));
                            } else {
                                $dueformattedDate = '';
                            }
                            ?>      
							<input type="date" class="form-control form-control-sm rounded-0" id="due_date" name="due_date" value="<?php echo isset($dueformattedDate) ? $dueformattedDate : '' ?>">
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="checkbox" id="loadPOCheckbox" value="0">
                            <label for="loadPO">Load From Purchase Orders</label>
                        </div>
                        <div class="col-md-6 form-group">
                        </div>
                        
                        <div class="col-md-6 form-group" id="loadPO_cont" style="display: none; margin-top:-10px;">
                            <label for="po_no">P.O. #: </label>
                            
                            <select name="po_no" id="po_no" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;">
                                <option value="" disabled <?php echo !isset($po_no) ? "selected" : '' ?>></option>
                                <?php 
                                $po_qry = $conn->query("SELECT * FROM `po_list` WHERE status = 1 ORDER BY `po_no` ASC");
                                while ($row = $po_qry->fetch_assoc()):
                                ?>
                                <option 
                                    value="<?php echo $row['id'] ?>" 
                                    <?php echo isset($po_no) && $po_no == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0 ? 'disabled' : '' ?>
                                ><?php echo $row['po_no'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
				</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="apv-list">
						<thead>
							<tr class="bg-navy disabled">
							<th class="px-1 py-1 text-center"></th>
								<th class="px-1 py-1 text-center" style="width:20%;">Account</th>
								<!-- <th class="px-1 py-1 text-center">Branch</th> -->
								<th class="px-1 py-1 text-center">Period</th>
								<th class="px-1 py-1 text-center">Description</th>
								<th class="px-1 py-1 text-center">Gross Amount</th>
								<th class="px-1 py-1 text-center">Purchase Amount</th>
                                <th class="px-1 py-1 text-center">WTax</th>
								<th class="px-1 py-1 text-center">VAT</th>
							</tr>
						</thead>
						<tbody>
							<tr class="apv" data-id="">
								<td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
								<td class="align-middle p-0 text-center">
                                    <select name="account_id[]" id="account_id" class="custom-select custom-select-sm rounded-0 select2" style="font-size:14px;">
                                        <option value="" disabled <?php echo !isset($account_id) ? "selected" : '' ?>></option>
                                        <?php 
                                    $acc_qry = $conn->query("SELECT id, name FROM account_list WHERE status = 1 ORDER BY `name` ASC");
                                    while ($row = $acc_qry->fetch_assoc()):
                                    ?>
                                    <option 
                                        value="<?php echo $row['id'] ?>" 
                                        <?php echo isset($account_id) && $account_id == $row['id'] ? 'selected' : '' ?>
                                    ><?php echo $row['name'] ?></option>
                                    <?php endwhile; ?>
                                    </select>
                                    
                                    
                                </td>
                                <td class="align-middle p-0 text-center">
									<input type="date" class="align-middle p-1 period" step="any" name="period[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 description" step="any" name="description[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 gross-amt" step="any" name="gross_amt[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 purchase-amt" step="any" name="purchase-amt[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 tax" step="any" name="tax[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 vat" step="any" name="vat[]" value=""/>
								</td>
							</tr>
						</tbody>
                        <tfoot>
							<tr class="bg-lightblue">
                                <tr>
                                    <th class="p-1 text-right" colspan="8"><span>
                                    <button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
                                    </span></th>
                                </tr>
                                <tr>
                                    <th class="p-1 text-right" colspan="8">Total Purchase Amount:
                                    <input type="number" step="any" id="total_purchase" class="border-light text-right" value="0">
                                    </th>
                                </tr>
                                <tr>
                                    <th class="p-1 text-right" colspan="8">Total VAT Amount:
                                    <input type="number" step="any" id="total_vat" class="border-light text-right" value="0" readonly>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="p-1 text-right" colspan="8">Total Tax Amount:
                                    <input type="number" step="any" id="total_tax" class="border-light text-right" value="0" readonly>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="p-1 text-right" colspan="8">Total Amount Due:
                                    <input type="number" step="any" id="total" class="border-light text-right" value="0" readonly>
                                    </th>
                                </tr>
                            </tr>
						</tfoot>
					</table>
			    </div>
            </div>
		</form>
	</div>
	<div class="card-footer" style="margin:10px;">
        <div class="row">
            <div class="col-md-6 form-group">
                <button class="btn btn-flat btn-default bg-maroon" form="apv-form" style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
            </div>
            <div class="col-md-6 form-group">
                <a class="btn btn-flat btn-default" href="?page=po/apv/" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>		
            </div>
        </div>
    </div>
</div>
<script>
  const invoiceNoInput = document.getElementById("invoice_no");
  const invoiceCheckResult = document.getElementById("invoiceCheckResult");

  invoiceNoInput.addEventListener("input", function() {
  const enteredInvoiceNo = invoiceNoInput.value;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "po/apv/check_invoice.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        const response = xhr.responseText;
        invoiceCheckResult.innerHTML = response;
      } else {
        invoiceCheckResult.innerHTML = "<span class='text-danger'>Error: " + xhr.status + "</span>";
      }
    }
  };
  xhr.onerror = function() {
    invoiceCheckResult.innerHTML = "<span class='text-danger'>Network error</span>";
  };
  xhr.send("invoice_no=" + enteredInvoiceNo);
});

</script>

<script>
    $(document).ready(function() {
        $('#apv-list').on('click', '.btn-danger', function() {
            $(this).closest('tr.apv').remove();
        });
    });
    const loadPOCheckbox = document.getElementById('loadPOCheckbox');
    const loadPOCont = document.getElementById('loadPO_cont');
    loadPOCheckbox.addEventListener('change', function () {
        if (loadPOCheckbox.checked) {
            loadPOCont.style.display = 'block';
        } else {
            loadPOCont.style.display = 'none';
        }
    });
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            var $lastRow = $("tbody .apv:last").clone();

            $lastRow.find("input").val("");

            $("tbody").append($lastRow);

            $lastRow[0].scrollIntoView({ behavior: "smooth" });
        });
    });
    $('#apv-form').submit(function(e){
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        $('[name="po_no"]').removeClass('border-danger')
        if($('#apv-list .apv').length <= 0){
            alert_toast(" Please add atleast 1 item on the list.",'warning')
            return false;
        }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=manage_apv",
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
                    location.href = "./?page=po/apv";
                }else if((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg){
                    var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                        end_loader()
                        if(resp.status == 'po_failed'){
                            $('[name="po_no"]').addClass('border-danger').focus()
                        }
                }else{
                    alert_toast("An error occured",'error');
                    end_loader();
                    console.log(resp)
                }
            }
        })
    })
    $(document).ready(function() {
        function updatePurchaseAmount() {
            var totalPurchaseAmount = 0;

            $('tbody').on('input', '.gross-amt', function() {
                var row = $(this).closest('tr.apv');
                var grossAmt = parseFloat($(this).val()) || 0;
                var purchaseAmt = grossAmt;

                row.find('.purchase-amt').val(purchaseAmt);
                totalPurchaseAmount = 0; 
                $('tbody tr.apv').each(function() {
                    var rowPurchaseAmt = parseFloat($(this).find('.purchase-amt').val()) || 0;
                    totalPurchaseAmount += rowPurchaseAmt;
                });

                $('#total_purchase').val(totalPurchaseAmount);
            });
        }
        updatePurchaseAmount();
    });
    $(document).ready(function() {
        function updateTotalVAT() {
            var totalVATAmount = 0;

            $('tbody tr.apv').each(function() {
                var vatRate = parseFloat($(this).find('.vat').val()) || 0;
                var purchaseAmt = parseFloat($(this).find('.purchase-amt').val()) || 0;
                var vatAmount = purchaseAmt * (vatRate / 100);
                totalVATAmount += vatAmount;
            });

            $('#total_vat').val(totalVATAmount);
        }

        updateTotalVAT();

        $('tbody').on('input', '.vat', updateTotalVAT);
    });
    $(document).ready(function() {

    function updateTotalTax() {
        var totalTaxAmount = 0;

        $('tbody tr.apv').each(function() {
            var taxRate = parseFloat($(this).find('.tax').val()) || 0;
            var purchaseAmt = parseFloat($(this).find('.purchase-amt').val()) || 0;
            var taxAmount = purchaseAmt * (taxRate / 100);
            totalTaxAmount += taxAmount;
        });

        $('#total_tax').val(totalTaxAmount);
    }

    updateTotalTax();

    $('tbody').on('input', '.tax', updateTotalTax);
    });

    







    $(document).ready(function() {
    function updatePurchaseAmount() {
        var totalPurchaseAmount = 0;

        $('tbody').on('input', '.gross-amt', function() {
            var row = $(this).closest('tr.apv');
                var grossAmt = parseFloat($(this).val()) || 0;
                var purchaseAmt = grossAmt;

                row.find('.purchase-amt').val(purchaseAmt);
                totalPurchaseAmount = 0; 
                $('tbody tr.apv').each(function() {
                    var rowPurchaseAmt = parseFloat($(this).find('.purchase-amt').val()) || 0;
                    totalPurchaseAmount += rowPurchaseAmt;
                });

            $('#total_purchase').val(totalPurchaseAmount);
            updateTotal();
        });
    }

    function updateTotalVAT() {
        var totalVATAmount = 0;
        $('tbody tr.apv').each(function() {
                var vatRate = parseFloat($(this).find('.vat').val()) || 0;
                var purchaseAmt = parseFloat($(this).find('.purchase-amt').val()) || 0;
                var vatAmount = purchaseAmt * (vatRate / 100);
                totalVATAmount += vatAmount;
            });

        $('#total_vat').val(totalVATAmount);
        updateTotal();
    }

    function updateTotalTax() {
        var totalTaxAmount = 0;
        $('tbody tr.apv').each(function() {
            var taxRate = parseFloat($(this).find('.tax').val()) || 0;
            var purchaseAmt = parseFloat($(this).find('.purchase-amt').val()) || 0;
            var taxAmount = purchaseAmt * (taxRate / 100);
            totalTaxAmount += taxAmount;
        });

        $('#total_tax').val(totalTaxAmount);
        updateTotal();
    }

    function updateTotal() {
        var totalPurchaseAmount = parseFloat($('#total_purchase').val()) || 0;
        var totalVATAmount = parseFloat($('#total_vat').val()) || 0;
        var totalTaxAmount = parseFloat($('#total_tax').val()) || 0;

        var totalAmount = totalPurchaseAmount + totalVATAmount + totalTaxAmount;
        $('#total').val(totalAmount);
    }

    updatePurchaseAmount();
    updateTotalVAT();
    updateTotalTax();

    $('tbody').on('input', '.vat', updateTotalVAT);
    $('tbody').on('input', '.tax', updateTotalTax);

    updateTotal();
});

</script>





