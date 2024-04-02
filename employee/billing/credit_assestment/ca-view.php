
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<?php 
$username = $_settings->userdata('username');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from t_ca_requirement where md5(c_csr_no) = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_array() as $k =>$v){
        $$k = $v;
        }
    }
    $ca = $conn->query("SELECT *,CONCAT_WS(' ',x.first_name, x.last_name)as full_name ,y.ra_id, y.c_csr_status, y.c_reserve_status, 
    y.c_ca_status, y.c_duration, z.age as csr_num  FROM t_csr_view x LEFT JOIN t_approval_csr y ON x.c_csr_no = y.c_csr_no 
    LEFT JOIN t_csr_buyers z ON z.c_csr_no = x.c_csr_no where z.c_buyer_count = 1 and md5(y.c_csr_no) = '{$_GET['id']}'");
    foreach($ca->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<div class="card card-outline rounded-0 card-maroon">
    <div class="card-header">
    <i><h3 class="card-title"><b>Reservation Application #<?php echo isset($meta['ra_id']) ? $meta['ra_id']: '';?></b></h3></i>
    </div>
    <br>
    <div class="card-body" style="width:60%;margin-left:20%;margin-right:20%;border:1px solid black;border-radius:5px;">
        <div class="container-fluid">
            <div class="container-fluid">
                <form method="post" id="save_ca">
                    <input type="hidden" name="comm"  id="comm" value="<?php echo $username; ?>">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id: '' ;?>" >
                    <input type="hidden" name="csr_no" value="<?php echo isset($meta['c_csr_no']) ? $meta['c_csr_no']: '' ;?>" >
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">Applicant's Full Name:</label>
                                <input type="text" name="full_name" value="<?php echo isset($meta['full_name']) ? $meta['full_name']: '' ;?>"  class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="buyer_name" class="control-label">Phase:</label>
                                <input type="text" name="project" value="<?php echo isset($meta['c_acronym']) ? $meta['c_acronym']: '' ;?>"  class="form-control form-control-sm" required>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Block:</label>
                                        <input type="text" name="block"  value="<?php echo isset($meta['c_block']) ? $meta['c_block']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Contract Price:</label>
                                        <input type="text" name="net_tcp"  value="<?php echo isset($meta['c_net_tcp']) ? $meta['c_net_tcp']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Lot:</label>
                                        <input type="text" name="lot" value="<?php echo isset($meta['c_lot']) ? $meta['c_lot']: '' ; ?>"  class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Project" class="control-label">Loanable Amount:</label>
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
                        <div class="col-md-11">
                            <ul>
                                <input type="checkbox" name="doc_req1" value="1" <?php echo isset($doc_req1)&&$doc_req1 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MANDATORY REQUIREMENTS<br />
                                <input type="checkbox" name="doc_req2" value="1" <?php echo isset($doc_req2)&&$doc_req2 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; INCOME/EMPLOYEMENT REQUIREMENTS<br />
                                <input type="checkbox" name="doc_req3" value="1" <?php echo isset($doc_req3)&&$doc_req3 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ADDITIONAL REQUIREMENTS<br />
                                <div class="form-group">
                                    <label for="buyer_name" class="control-label">Remarks if fail:</label>
                                    <input type="text" name="remark_doc" value="<?php echo isset($doc_req_remarks) ? $doc_req_remarks: ''; ?>" class="form-control form-control-sm">
                                </div>
                            </ul>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                </div>
                    <div class="col-md-11">
                        <div class="form-group">
                        <h4>On Verification of Documents:</h4>
                        <ul>
                            <input type="checkbox" name="ver_doc1" value="1" <?php echo isset($ver_doc1)&&$ver_doc1 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ON EMPLOYMENT & COMPENSATION<br />
                            <input type="checkbox" name="ver_doc2" value="1" <?php echo isset($ver_doc2)&&$ver_doc2 == 1 ? "checked='checked'" : ''; ?> />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ON BANK ACCOUNTS<br />
                            
                        <div class="form-group">
                                <label for="buyer_name" class="control-label">Remarks if fail:</label>
                                <input type="text" name="remark_ver" value="<?php echo isset($ver_doc_remarks) ? $ver_doc_remarks: ''; ?>" class="form-control form-control-sm">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="buyer_name" class="control-label">LOAN AMOUNT APPLIED FOR :</label>
                                    <input type="text" name="loan_amt" id="loan_amt" value="<?php echo isset($loan_amt) ? $loan_amt : $meta['c_amt_financed'] ; ?>" class="form-control form-control-sm">
                                </div>
                                <?php 
                                $x = 20;
                                $y = 15;
                                $age = $meta['age'];
                                $dp = $meta['c_no_payments'];

                                if ($age >= 65){
                                    $max = 0;
                                    $max_terms_month = 0;
                                
                                }
                                else{
                                    $max_loan_age = (65 - $age ) - ($dp/12);
                                    if ($max_loan_age >= 20){
                                        $max = 20;
                                        $max_terms_month = $max * 12;
                                    
                                    }else{
                                        $max = $max_loan_age;
                                        $max_terms_month = $max * 12;
                                    
                                    }  
                                }
                                ?> 
                                <div class="form-group">
                                    <label for="buyer_name" class="control-label">MAX LOAN TERM PER AGE:(Years)</label>
                                    <input type="text" name="max_term" id="max_term" value="<?php echo isset($terms) ? $terms: $max ;?>" class="form-control form-control-sm max-loan" readonly>
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
                                    <label for="buyer_name" class="control-label">TOTAL:</label>
                                    <input type="text" name="total" id="total" value="<?php echo isset($total) ? $total: 0 ; ?>" class="form-control form-control-sm">
                                </div>
                            
                                <div class="form-group">
                                    <label class="control-label">Interest Rate: </label>
                                    <input type="text" class="form-control margin-bottom int-rate required" name="int_rate" id="int_rate" value="<?php echo isset($interest) ? $interest: $meta['c_interest_rate'] ?>" onkeyup="computeIncomeReq();">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Terms: </label>
                                    <input type="text" class="form-control margin-bottom term-rate equired" name="term_rate" id="term_rate" maxlength="3" value="<?php echo isset($terms_month) ? $terms_month: $max_terms_month ; ?>" onkeyup="computeIncomeReq();">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Monthly: </label>
                                    <input type="text" class="form-control margin-bottom required" name="monthly" id="monthly" value="<?php echo isset($monthly) ? $monthly: 0 ?>" onkeyup="computeIncomeReq();">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Income Requirement: </label>
                                    <input type="text" class="form-control margin-bottom required" name="income_req" id="income_req" value="<?php echo isset($income_req) ? $income_req: 0 ?>" onkeyup="computeIncomeReq();">
                                </div>
                                    
                                
                            </div>
                        </div> 
                        <div class="card-footer">
                        <table style="width:100%;">
                            <tr>
                                <td>
                                    <button class="btn btn-flat btn-default bg-maroon" form="save_ca" style="width:100%;margin-right:5px;font-size:14px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
                                </td>
                                <td>
                                    <a class="btn btn-flat btn-default" href="./?page=credit_assestment" style="width:100%;margin-left:5px;font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
                    <hr>
                    </div>
                </div>    <br>
            </div>
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
                        var nw = window.open("./credit_assestment/print.php?id="+resp.id,"_blank","width=700,height=500")
							setTimeout(()=>{
								nw.print()
								setTimeout(()=>{
									nw.close()
									end_loader();
									location.replace('./?page=credit_assestment/ca-view&id='+resp.id_encrypt)
								},500)
							},500)
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


    $(document).on('keyup', ".gross-inc", function(e) {
        e.preventDefault();
        total_gross();
         
    });

    $(document).on('keyup', ".loan-term", function(e) {
        e.preventDefault();

        computeIncomeReq();
         
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

    function maxterm(){
        let x = 20;
        let y = 15;
        let age = document.getElementById('age').value;
        let dp = document.getElementById('downpayment').value;

        if (age >= 65){
            max = 0;
            document.getElementById('max_term').value =  max;
            $('#max_term').val(max);
        }
        else{
            max_loan_age = (65 - age ) - (dp/12);
            if (max_loan_age >= 20){
                max = 20;
                document.getElementById('max_term').value =  max;
                $('#max_term').val(max);
            }else{
                max = max_loan_age;
                document.getElementById('max_term').value =  max;
                $('#max_term').val(max);
            }
        }
        

    }

</script>