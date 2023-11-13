
<?php
$delivery_date = date('Y-m-d', strtotime('+1 week'));
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `cv` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}


?>
<?php
	$subtotal = 0;
	$usertype = $_settings->userdata('user_type'); 
	$type = $_settings->userdata('user_code');
	$level = $_settings->userdata('type');
?>
<style>
    .nav-vs{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-vs:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<body>
<div class="card card-outline card-info">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Voucher Setup": "Add Voucher Setup" ?></b></i></h5>
	</div>
	<div class="card-body">
		<form action="" id="cv-form">
			<input type="hidden" value="<?php echo $level; ?>">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="card-body">
					<div class="row">
                       
					
						<div class="col-md-6 form-group">
						<label for="supplier_id">Supplier:</label>
						<select id="supplier_id" class="custom-select custom-select-sm rounded-0 select2">
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
                         <!-- <div class="col-md-6 form-group">
							<label for="apv_no">APV No: <span class="po_err_msg text-danger"></span></label>
							<input type="text" class="form-control form-control-sm rounded-0" id="apv_no" name="apv_no" value="<?php echo isset($apv_no) ? $apv_no : '' ?>">
						</div> -->
                        <div class="col-md-6 form-group">
							<label for="ap_voucher_date">Voucher Date: <span class="po_err_msg text-danger"></span></label>
							<?php
							if (!empty($ap_voucher_date)) {
                                $voucherformattedDate = date('Y-m-d', strtotime($ap_voucher_date));
                            } else {
                                $voucherformattedDate = '';
                            }
                            ?>                            
							<input type="date" class="form-control form-control-sm rounded-0" id="ap_voucher_date" name="ap_voucher_date" value="<?php echo isset($voucherformattedDate) ? $voucherformattedDate : '' ?>">
						</div>
                        
					</div>

					<div class="row">
                        <div class="col-md-6 form-group">

                            <?php
							if (!empty($due_end_date)) {
                                $dueendformattedDate = date('Y-m-d', strtotime($due_end_date));
                            } else {
                                $dueendformattedDate = '';
                            }
                            ?>     
							
                            <label for="due_end_date">Due Date:</label><input type="date" class="form-control form-control-sm rounded-0" id="due_end_date" name="due_end_date" value="<?php echo isset($dueendformattedDate) ? $dueendformattedDate : '' ?>">
                        </div>
                        
					</div>

			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="cv-list">
						<thead>
							<tr class="bg-navy disabled">
							<th class="px-1 py-1 text-center"></th>
								<th class="px-1 py-1 text-center">Due Date</th>
								<th class="px-1 py-1 text-center">APV No.</th>
								<th class="px-1 py-1 text-center">Invoice No.</th>
								<th class="px-1 py-1 text-center">Supplier</th>
								<th class="px-1 py-1 text-center">Amount Due</th>
                                <th class="px-1 py-1 text-center">Amount to be Paid</th>
								<th class="px-1 py-1 text-center">WTax to be Paid</th>
							</tr>
						</thead>
						<tbody>
							<tr class="cv" data-id="">
								<!-- <td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
								<td class="align-middle p-0 text-center">
                                    <input type="date" class="align-middle p-1 due_date" step="any" name="due_date[]" value=""/>
                                </td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 apv_no" step="any" name="apv_no[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 invoice_no" step="any" name="invoice_no[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 supplier" step="any" name="supplier[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 amount_due" step="any" name="amount_due[]" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 amount_to_be_paid" step="any" value=""/>
								</td>
                                <td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 wtax" name="wtax[]" step="any" value=""/>
								</td> -->
							</tr>
						</tbody>
                        <tfoot>
							<tr class="bg-lightblue">
                                <tr>
                                    <!-- <th class="p-1 text-right" colspan="8"><span>
                                    <button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
                                    </span></th> -->
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
					<div class="row">
                        <div class="col-md-12">
							<label for="notes" class="control-label">Particulars:</label>
							<textarea id="notes" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($notes) ? $notes : '' ?></textarea>
						</div>
					</div>
			    </div>
            </div>
		</form>
	</div>

<div class="modal fade" id="apvModal" tabindex="-1" role="dialog" aria-labelledby="apvModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="apvModalLabel">APV List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th style="text-align:center;">APV No.</th>
                    <th style="text-align:center;">Due Date</th>
                    <th style="text-align:center;">Invoice No</th>
                    <th style="text-align:center;">Supplier</th>
                    <th style="text-align:center;">Amount Due</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query =$conn->query("SELECT ap.*, s.name as sname FROM `apv` ap inner join `supplier_list` s on ap.supplier_id = s.id;");
            while($row = $query->fetch_assoc()): ?>
                <tr>
                    <td style="text-align:center;"><?php echo $row["apv_no"] ?></td>
                    <td style="text-align:center;"><?php echo $row["due_date"] ?></td>
                    <td style="text-align:center;"><?php echo $row["invoice_no"] ?></td>
                    <td style="text-align:center;"><?php echo $row["sname"] ?></td>
                    <td style="text-align:center;"><?php echo $row["invoice_amount"] ?></td>
                    <td>
                        <a href="#" class="btn btn-flat btn-primary btn-xs select-apv" data-due-date="<?php echo $row["due_date"] ?>" data-apv-no="<?php echo $row["apv_no"] ?>" data-invoice-no="<?php echo $row["invoice_no"] ?>" data-supplier="<?php echo $row["sname"] ?>" data-amount-due="<?php echo $row["invoice_amount"] ?>">
                            <center><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Select</center>
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

	<div class="card-footer">
        <button class="btn btn-flat btn-default bg-maroon" form="cv-form" style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
        <a class="btn btn-flat btn-default" href="?page=po/cv/" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>		
	</div>
</div>
<script>
    $(document).ready(function() {
    $('#cv-list').on('click', '.btn-danger', function() {
        $(this).closest('tr.cv').remove();
    });
});

document.querySelectorAll('.select-apv').forEach(function(button) {
    button.addEventListener('click', function() {
        const dueDate = this.getAttribute('data-due-date');
        const apvNo = this.getAttribute('data-apv-no');
        const invoiceNo = this.getAttribute('data-invoice-no');
        const supplier = this.getAttribute('data-supplier');
        const amountDue = this.getAttribute('data-amount-due');

        const newRow = document.createElement('tr');
        newRow.className = 'cv';

        const cells = `
            <td class="align-middle p-1 text-center">
                <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this)"><i class="fa fa-times"></i></button>
            </td>
            <td class="align-middle p-0 text-center"><input type="date" class="align-middle p-1 due_date" step="any" name="due_date[]" value="${dueDate}"></td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 apv_no" step="any" name="apv_no[]" value="${apvNo}"></td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 invoice_no" step="any" name="invoice_no[]" value="${invoiceNo}"></td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 supplier" step="any" name="supplier[]" value="${supplier}"></td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 amount_due" step="any" name="amount_due[]" value="${amountDue}"></td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 amount_due" step="any" name="amount_due[]" value=""></td>
            <td class="align-middle p-0 text-center"><input type="text" class="align-middle p-1 amount_due" step="any" name="amount_due[]" value=""></td>
        `;
        newRow.innerHTML = cells;
        document.querySelector('#cv-list tbody').appendChild(newRow);
    });
});

 const showModalBtn = document.getElementById('btnfindAPV'); 
const apvModal = document.getElementById('apvModal');
const closeModalBtn = document.getElementById('closeModalBtn');

showModalBtn.addEventListener('click', function() {
    apvModal.style.display = 'block';
});

closeModalBtn.addEventListener('click', function() {
    apvModal.style.display = 'none';
});

window.addEventListener('click', function(event) {
    if (event.target == apvModal) {
        apvModal.style.display = 'none';
    }
});
    $(document).ready(function() {
        $("#add_row").on("click", function() {
            var $lastRow = $("tbody .cv:last").clone();

            $lastRow.find("input").val("");

            $("tbody").append($lastRow);

            $lastRow[0].scrollIntoView({ behavior: "smooth" });
        });
    });
    $('#cv-form').submit(function(e){
        e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        $('[name="po_no"]').removeClass('border-danger')
        if($('#cv-list .cv').length <= 0){
            alert_toast(" Please add atleast 1 item on the list.",'warning')
            return false;
        }
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=manage_cv",
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
                    location.href = "./?page=po/cv";
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
</script>
<script>
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
    function updatePurchaseAmount() {
        var totalPurchaseAmount = 0;

        $('tbody').on('input', '.gross-amt', function() {
            var row = $(this).closest('tr.cv');
            var grossAmt = parseFloat($(this).val()) || 0;
            var purchaseAmt = grossAmt;

            row.find('.purchase-amt').val(purchaseAmt);
            totalPurchaseAmount = 0; 
            $('tbody tr.cv').each(function() {
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

        $('tbody tr.cv').each(function() {
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

    $('tbody tr.cv').each(function() {
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

    function updateTotalAmountDue() {
        var totalVAT = parseFloat($('#total_vat').val()) || 0;
        var totalTax = parseFloat($('#total_tax').val()) || 0;
        var totalPurchase = parseFloat($('#total_purchase').val()) || 0;

        var totalAmountDue = totalVAT + totalTax + totalPurchase;

        $('#total').val(totalAmountDue);
    }

    $('body').on('input', '#total_vat, #total_tax, #total_purchase', updateTotalAmountDue);
});


</script>

<script>
    document.getElementById("payment_type").addEventListener("change", function() {
        var selectedPaymentType = this.value;
        var checkDateDiv = document.getElementById("checkDateDiv");

        if (selectedPaymentType === "Check") {
            checkDateDiv.style.display = "block"; 
        } else {
            checkDateDiv.style.display = "none"; 
        }
    });
</script>



