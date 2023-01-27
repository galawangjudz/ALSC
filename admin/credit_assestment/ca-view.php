
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

$ca = $conn->query("SELECT *,CONCAT_WS(' ',x.first_name, x.last_name)as full_name ,y.ra_id, y.c_csr_status, y.c_reserve_status, 
y.c_ca_status, y.c_duration, y.c_csr_no as csr_num  FROM t_csr_view x , t_approval_csr y where md5(y.c_csr_no) = '{$_GET['id']}'");
foreach($ca->fetch_array() as $k =>$v){
    $meta[$k] = $v;
}

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from t_ca_requirement where md5(c_csr_no) = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k =>$v){
        $$k = $v;
        }
    }
}



if(isset($id)){
   

  
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
             <input type="hidden" name="id" value="<?php echo isset($id) ? $id: '' ;?>" >
             <input type="hidden" name="csr_no" value="<?php echo isset($meta['c_csr_no']) ? $meta['c_csr_no']: '' ;?>" >
             <input type="text" name="interest" value="<?php echo isset($interest) ? $interest: 0 ;?>" >
             <input type="text" name="terms_month" value="<?php echo isset($numOfMonths) ? $numOfMonths: 0 ;?>" >
                     
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">Applicant's Full Name</label>
                                <input type="text" name="full_name" value="<?php echo isset($meta['full_name']) ? $meta['full_name']: '' ;?>"  class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">Phase</label>
                                <input type="text" name="project" value="<?php echo isset($meta['c_acronym']) ? $meta['c_acronym']: '' ;?>"  class="form-control form-control-sm" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Block</label>
                                        <input type="text" name="block"  value="<?php echo isset($meta['c_block']) ? $meta['c_block']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Contract Price</label>
                                        <input type="text" name="net_tcp"  value="<?php echo isset($meta['c_net_tcp']) ? $meta['c_net_tcp']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Lot</label>
                                        <input type="text" name="lot" value="<?php echo isset($meta['c_lot']) ? $meta['c_lot']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Loanable Amount</label>
                                        <input type="text" name="amt_financed" value="<?php echo isset($meta['c_amt_financed']) ? $meta['c_amt_financed']: '' ; ?>"  class="form-control form-control-sm" required>
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
                          
                        <input type="checkbox" name="doc_req1" value="1" <?php echo isset($doc_req1)&&$doc_req1 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MANDATORY REQUIREMENTS<br />
                        <input type="checkbox" name="doc_req2" value="1" <?php echo isset($doc_req2)&&$doc_req2 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCOME/EMPLOYEMENT REQUIREMENTS<br />
                        <input type="checkbox" name="doc_req3" value="1" <?php echo isset($doc_req3)&&$doc_req3 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ADDITIONAL REQUIREMENTS<br />

                        <div class="form-group">
                            <label for="buyer_name" class="control-label">Remarks if fail:</label>
                            <input type="text" name="remark_doc" value="<?php echo isset($remark_doc) ? $remark_doc: ''; ?>" class="form-control form-control-sm">
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
                        <input type="checkbox" name="ver_doc1" value="1" <?php echo isset($ver_doc1)&&$ver_doc1 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ON EMPLOYMENT & COMPENSATION<br />
                        <input type="checkbox" name="ver_doc2" value="1" <?php echo isset($ver_doc2)&&$ver_doc2 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ON BANK ACCOUNTS<br />
                           
                    <div class="form-group">
                            <label for="buyer_name" class="control-label">Remarks if fail:</label>
                            <input type="text" name="remark_ver" value="<?php echo isset($remark_ver) ? $remark_ver: ''; ?>" class="form-control form-control-sm">
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
                                <input type="text" name="loan_amt" id="loan_amt" value="<?php echo isset($loan_amt) ? $loan_amt : $meta['c_amt_financed'] ; ?>" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">MAX LOAN TERM PER AGE:(Years)</label>
                                <input type="text" name="max_year" id="max_year" maxlength="2" value="20" class="form-control form-control-sm max-loan">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">LOAN TERM APPLIED FOR:</label>
                                <input type="text" name="loan_term" id="loan_term"  maxlength="2" value="<?php echo isset($terms) ? $terms : 0 ; ?>" class="form-control form-control-sm loan-term">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">GROSS INCOME APPLICANT:</label>
                                <input type="text" name="gross_income" id="gross_income" value="<?php echo isset($gross_income) ? $gross_income : 0 ; ?>" class="form-control form-control-sm gross-inc">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">SPOUSES/CO-BORRROWER:</label>
                                <input type="text" name="co_borrower" id="co_borrower" value="<?php echo isset($co_borrower) ? $co_borrower : 0; ?>" class="form-control form-control-sm co-borrow">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">TOTAL :</label>
                                <input type="text" name="total" id="total" value="<?php echo isset($total) ? $total: 0 ; ?>" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">INCOME REQ. PER CALCULATOR :</label>
                                <input type="text" name="income_req" id="income_req" value="<?php echo isset($income_req) ? $income_req: 0; ?>" class="form-control form-control-sm">
                            </div>
                            
                        </div>
                    </div> 
            </form>
                    <hr>
                    <form method="post" id="loanCalcForm" role="">
                        <fieldset>
                            <legend>Loan Calculator</legend>
                                    <div class="col-md-6">
                                        <label for="loanAmount">Loan Amount</label>
                                        <input type="text" size="8" name="loanAmount" id="loanAmount" value="<?php echo isset($loan_amt) ? $loan_amt : $meta['c_amt_financed'] ; ?>" />
                                        <?php if (isset($errorArray[0])) { echo $errorArray[0]; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="interest">Interest</label>
                                        <input type="text" class="interest" size="8" name="interest" id="interest" value="<?php echo isset($interest) ? $interest: 0; ?>" />
                                        <?php if (isset($errorArray[1])) { echo $errorArray[1]; } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="numOfMonths">Number of Months</label>
                                        <input type="text" size="8" name="numOfMonths" id="numOfMonths" value="<?php echo isset($numOfMonths) ? $numOfMonths: 0; ?>" />
                                        <?php if (isset($errorArray[2])) { echo $errorArray[2]; } ?>
                                    </div>
                       <!--          <input type="submit" name="submit" value="Submit" class="button" /> -->
                        </fieldset>
			        </form>
                    <div id="result" class="result">
                        <?php if (isset($result)) { echo $result; 
                            } ?>
                    </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-flat btn-sm btn-default bg-maroon" form="save_ca">Save</button>
                    <a class="btn btn-flat btn-sm btn-default" href="./?page=credit_assestment">Cancel</a>
                </div>

             
            </div>
            </form>


            


        </div>
        </div>

    
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#save_ca').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_ca",
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
                            end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })

    });


    $(document).on('keyup', ".interest", function(e) {
        e.preventDefault();
        $Calculation->init();
         
    });


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
</script>