
<?php
	include_once('loan-calcu/classes/Calculation.php');
	$Calculation = new Calculation();
	
	if (isset($_POST['submit'])) {
		$Calculation->init();
	}
?>


<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<?php 

if (isset($_POST['submit'])) {
    $Calculation->init();
}

$usertype = "IT Admin";

if(isset($_GET['id'])){
    $ca = $conn->query("SELECT *,CONCAT_WS(' ',x.first_name, x.last_name)as full_name ,y.ra_id, y.c_csr_status, y.c_reserve_status, 
    y.c_ca_status, y.c_duration, y.c_csr_no as csr_num  FROM t_csr_view x , t_approval_csr y where md5(y.c_csr_no) = '{$_GET['id']}'");
    foreach($ca->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}

?>


<div class="card card-outline rounded-0 card-maroon">
    <div class="card-header">
    <h3 class="card-title">Reservation Application #<?php echo isset($meta['ra_id']) ? $meta['ra_id']: '';?></h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
        <div class="container-fluid">
            <form method="post" id="save_ca">
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">Applicant's Full Name</label>
                                <input type="text" name="buyer_name" value="<?php echo isset($meta['full_name']) ? $meta['full_name']: '' ;?>"  class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">Phase</label>
                                <input type="text" name="buyer_name" value="<?php echo isset($meta['c_acronym']) ? $meta['c_acronym']: '' ;?>"  class="form-control form-control-sm" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Block</label>
                                        <input type="text" name="project" id="project" value="<?php echo isset($meta['c_block']) ? $meta['c_block']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Contract Price</label>
                                        <input type="text" name="project" id="project" value="<?php echo isset($meta['c_net_tcp']) ? $meta['c_net_tcp']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Lot</label>
                                        <input type="text" name="project" id="project" value="<?php echo isset($meta['c_lot']) ? $meta['c_lot']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Loanable Amount</label>
                                        <input type="text" name="project" id="project" value="<?php echo isset($meta['c_amt_financed']) ? $meta['c_amt_financed']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                
                            </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
                           
						</div>
					</div>
				</div>
				<hr>
                
				<h4>On Documentary Requirements: </h4>				
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                          
                        <input type="checkbox" name="doc_req1" value="0" <?php echo isset($doc_req1) == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MANDATORY REQUIREMENTS<br />
                        <input type="checkbox" name="doc_req2" value="0" <?php echo isset($doc_req2) == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCOME/EMPLOYEMENT REQUIREMENTS<br />
                        <input type="checkbox" name="doc_req3" value="0" <?php echo isset($doc_req3) == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ADDITIONAL REQUIREMENTS<br />

                        <div class="form-group">
                            <label for="buyer_name" class="control-label">Remarks if fail:</label>
                            <input type="text" name="remark_doc" value="" class="form-control form-control-sm">
                        </div>

                        </ul>
                    </div>
               
                    <div class="col-md-4">
                
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <h4>On Verification of Documents:</h4>
                    <ul>
                        <input type="checkbox" name="ver_doc1" value="0" <?php echo isset($doc_req1) == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ON EMPLOYMENT & COMPENSATION<br />
                        <input type="checkbox" name="ver_doc2" value="0" <?php echo isset($doc_req1) == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ON BANK ACCOUNTS<br />
                           
                    <div class="form-group">
                            <label for="buyer_name" class="control-label">Remarks if fail:</label>
                            <input type="text" name="remark_ver" value="" class="form-control form-control-sm">
                    </div>
                    </ul>
                    </div>
                </div>
                <div class="col-md-4">
               
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                    
                    <h4>ON BANK LOAN CALCULATOR:</h4>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">LOAN AMOUNT APPLIED FOR :</label>
                                <input type="text" name="loant_amt" id="loan_amt" value="<?php echo isset($meta['c_amt_financed']) ? $meta['c_amt_financed']: '' ; ?>" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">MAX LOAN TERM PER AGE:(Years)</label>
                                <input type="text" name="max_year" id="max_year" maxlength="2" value="20" class="form-control form-control-sm max-loan">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">LOAN TERM APPLIED FOR:</label>
                                <input type="text" name="loan_term" id="loan_term"  maxlength="2" value="0" class="form-control form-control-sm loan-term">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">GROSS INCOME APPLICANT:</label>
                                <input type="text" name="gross_income" id="gross_income" value="0" class="form-control form-control-sm gross-inc">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">SPOUSES/CO-BORRROWER:</label>
                                <input type="text" name="co_borrower" id="co_borrower" value="0" class="form-control form-control-sm co-borrow">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">TOTAL :</label>
                                <input type="text" name="total" id="total" value="0" class="form-control form-control-sm">
                            </div>
                          
                           <!--  <div class="form-group">
                                <input type="submit" name="submit" value="Compute" class="button" />
                            </div> -->
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">INCOME REQ. PER CALCULATOR :</label>
                                <input type="text" name="income_req" id="income_req" value="<?php echo isset($income_req) ? $income_req: 0; ?>" class="form-control form-control-sm">
                            </div>
                            
                        </div>
                    </div> 
                    <hr>
                    <form method="post" id="loanCalcForm" role="">
                        <fieldset>
                            <legend>Loan Calculator</legend>
                                    <div class="col-md-6">
                                        <label for="loanAmount">Loan Amount</label>
                                        <input type="text" size="8" name="loanAmount" id="loanAmount" value="<?php echo isset($meta['c_amt_financed']) ? $meta['c_amt_financed']: '' ; ?>" />
                                        <?php if (isset($errorArray[0])) { echo $errorArray[0]; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="interest">Interest</label>
                                        <input type="text" size="8" name="interest" id="interest" value="<?php echo isset($interest) ? $interest: 0; ?>" />
                                        <?php if (isset($errorArray[1])) { echo $errorArray[1]; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numOfMonths">Number of Months</label>
                                        <input type="text" size="8" name="numOfMonths" id="numOfMonths" value="<?php echo isset($numOfMonths) ? $numOfMonths: 0; ?>" />
                                        <?php if (isset($errorArray[2])) { echo $errorArray[2]; } ?>
                                    </div>
                                <input type="submit" name="submit" value="Submit" class="button" />
                        </fieldset>
			        </form>
                    <div id="result" class="result">
                        <?php if (isset($result)) { echo $result; 
                            } ?>
                    </div>




                
                
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-flat btn-sm btn-default bg-maroon" form="save_csr">Save</button>
                    <a class="btn btn-flat btn-sm btn-default" href="./?page=credit_assestment">Cancel</a>
                </div>

             
            </div>
            </form>


            


        </div>
        </div>

    
    </div>
</div>

<script>
    $(document).on('keyup', ".gross-inc", function(e) {
        e.preventDefault();
        total_gross();
         
    });
    $(document).on('keyup', ".loan-term", function(e) {
        e.preventDefault();
        var l_a = $('.loan-term').val();
        l_mo = l_a * 12;
        $('#numOfMonths').val(parseInt(l_mo));
         
    });
    $(document).on('keyup', ".co-borrow", function(e) {
        e.preventDefault();
        total_gross();
 
    });
    function total_gross(){
        var l_a = $('.gross-inc').val();
        var l_b = $('.co-borrow').val();
        var l_total = parseFloat(l_a) + parseFloat(l_b);
        $('#total').val(l_total.toFixed(2));

    }

    function computeIncomeReq(){
		let int_rate = document.getElementById('int_rate').value;
		let int_terms = document.getElementById('term_rate').value;

		let n = int_terms;

		let i = (int_rate/100)/12;

		
		let fv = 0;
		let pv = document.getElementById('loan_amt').value;
		let type = 0;
		let ans = 0;
		let PMT = 0;
		let income_req = 0;
		if (int_terms != 0 || i != 0){
			ans = ((pv - fv) * i)/(1 - Math.pow((1 + i), (-n)));
			PMT = ans.toFixed(2);
			income_req = ans / 0.4;
			income_req = income_req.toFixed(2);
		}else{ 
			PMT = 0;
			income_req = 0;
		}   
		document.getElementById('income_req').value = income_req;
		document.getElementById('monthly').value = PMT;
	}
</script>