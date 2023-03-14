<?php 
require ('../../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/header.php" ?>
<body onload="loadAll()">
<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `t_ca_requirement` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    body{
        font-size:18px;
    }

    .main_content{
        margin-left:50px;
    }
    .checkbox1{
        height:20px!important;
        width:20px!important;
    }
    table tr{
        height:25px!important;
        line-height:15px;
    }
    .small_table{
        border:none!important;
    }
</style>
<img src="images/Header.jpg" class="img-thumbnail" style="height:105px;width:670px;border:none;margin-left:190px;margin-top:-10px;" alt="">
<h5 class="text-center" style="position:absolute;margin-top:-55px;margin-left:405px;"><b>CREDIT ASSESSMENT EVALUATION SHEET</b></h5>
        <?php
        $qry = $conn->query("SELECT *,CONCAT_WS(' ',first_name, last_name)as full_name  from t_csr_view where c_csr_no = '{$c_csr_no}'");
        while($row=$qry->fetch_assoc()):
        ?>
        <!-- <img src="<?php echo validate_image($_settings->info('logo')) ?>" class="img-thumbnail" style="height:75px;width:75px;object-fit:contain" alt=""> -->
        <br>
        <br>
        <div class="main_content">
            <table style="border:none;">
                <tr>
                    <td style="width:200px;">
                        APPLICANT'S NAME: 
                    </td>
                    <td style="width:750px;">
                        <b><u><?php echo $row['full_name'] ?></u></b>
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;">
                        PROJECT: 
                    </td>
                    <td>
                        <?php
                            $acr = $row['c_acronym'];
                            $qry2 = $conn->query("SELECT * from t_projects where c_acronym = '$acr'");
                            while($row2=$qry2->fetch_assoc()){
                                $getname= $row2['c_name'];
                                ?>
                                <?php
                            }
                        ?>
                        <b><u><?php echo $getname ?></u></b>
                    </td>
                </tr>
            </table>
            <table class="small_table">
                <tr>
                    <td style="width:200px;">
                        BLOCK:
                    </td>      
                    <td style="width:274.5px;">  
                        <b><u><?php echo $row['c_block'] ?></u></b>
                    </td>
                    <td style="width:200px;">
                        CONTRACT PRICE: 
                    </td>
                    <td style="width:274.5px;">
                    <?php
                        $amt_tcp = $row['c_net_tcp'];
                        $format_tcp = number_format($amt_tcp);
                    ?>
                        <b><u><?php echo $format_tcp.".00" ?></u></b>
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;">
                        LOT: 
                    </td style="width:274.5px;">
                    <td>
                        <b><u><?php echo $row['c_lot'] ?></u></b>
                    </td>
                    <td style="width:200px;">
                        LOANABLE AMOUNT: 
                    </td>
                    <?php
                        $amt_financed = $row['c_amt_financed'];
                        $format_financed = number_format($amt_financed);
                    ?>
                    <td style="width:274.5px;">
                        <b><u><?php echo $format_financed.".00" ?></u></b>
                    </td>
                </tr>
            </table>
            <?php endwhile; ?>
            <?php
            $qry1 = $conn->query("SELECT * from t_ca_requirement where c_csr_no = '{$c_csr_no}'");
            while($row1=$qry1->fetch_assoc()):
            ?>
        <hr>
        <table style="width:950px;" class="small_table">
            <tr>
                <td></td>
                <td style="align-items:center;"><u><b>PASS</b></u></td>
                <td style="align-items:center;">&nbsp;&nbsp;<u><b>FAIL</b></u></td>
            </tr>
            <tr>
                <td>ON DOCUMENTARY REQUIREMENTS:</td><td></td>
            </tr>
            <ul>
            <tr>
                <td>
                    <li>
                        MANDATORY REQUIREMENTS
                    </li>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="pass1" name="chkOption1"/>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="fail1" name="chkOption1"/>
                </td>
                <input type="hidden" id="doc1" value="<?php echo $row1['doc_req1'] ?>">
            </tr>
            <tr>
                <td>
                    <li>
                        INCOME/COMPLETE REQUIREMENTS
                    </li>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="pass2" name="chkOption2"/>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="fail2" name="chkOption2"/>
                </td>
                <input type="hidden" id="doc2" value="<?php echo $row1['doc_req2'] ?>">
            </tr>
            <tr>
                <td>
                    <li>
                        ADDITIONAL REQUIREMENTS
                    </li>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="pass3" name="chkOption3"/>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="fail3" name="chkOption3"/>
                </td>
                <input type="hidden" id="doc3" value="<?php echo $row1['doc_req3'] ?>">
            </tr>
            <tr>
                <td>
                    <ul>REMARKS IF FAIL:<input type="text" id="doc3" value="<?php echo $row1['doc_req_remarks'] ?>" style="width:600px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                </td>
            </tr>
            </ul>
        </table>
        <table style="width:950px;" class="small_table">
            <tr>
                <td style="width:865px;">ON VERIFICATION DOCUMENTS:</td>
            </tr>
            <ul>
            <tr>
                <td>
                    <li>
                        ON EMPLOYMENT & COMPENSATION
                    </li>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="pass4" name="chkOption3"/>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="fail4" name="chkOption3"/>
                </td>
                <input type="hidden" id="verdoc1" value="<?php echo $row1['ver_doc1'] ?>">
            </tr>
            <tr>
                <td>
                    <li>
                        ON BANK ACCOUNTS
                    </li>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="pass5" name="chkOption3"/>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" id="fail5" name="chkOption3"/>
                </td>
                <input type="hidden" id="verdoc2" value="<?php echo $row1['ver_doc2'] ?>">
            </tr>
            <tr>
                <td>
                    <ul>REMARKS IF FAIL:<input type="text" id="doc3" value="<?php echo $row1['ver_doc_remarks'] ?>" style="width:600px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                </td>
            </tr>
            </ul>
        </table>
        <table style="width:950px;" class="small_table">
            <tr>
                <td style="width:865px;">ON BANK LOAN CALCULATOR:</td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" name="chkOption3"/>
                </td>
                <td>
                    &nbsp;&nbsp;&nbsp;<input class="checkbox1" type="checkbox" name="chkOption3"/>
                </td>
            </tr>
            <ul>
            <tr>
                <td>
                    <li>
                        <?php
                            $loan =  $row1['loan_amt'];
                            $gross =  $row1['gross_income'];
                            $borrower =  $row1['co_borrower'];
                            $total = $row1['total'];
                            $income_req = $row1['income_req'];
                            $format_loan = number_format($loan);
                            $format_gross = number_format($gross);
                            $format_borrower = number_format($borrower);
                            $format_total = number_format($total);
                            $format_income_req = number_format($income_req);
                        ?>
                        LOAN AMOUNT APPLIED FOR&#8195;&#8195;:<input type="text" value="<?php echo $format_loan.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>
                        MAX. LOAN TERM PER AGE&#8195;&#8195;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" value="<?php echo $format_loan.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>
                        LOAN TERM APPLIED FOR&#8195;&#8195;&#8195;&nbsp;&nbsp;:<input type="text" value="<?php echo $format_loan.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
            <tr>
                <td>
                    <ul>REMARKS IF FAIL:<input type="text" value="<?php echo $row1['ver_doc_remarks'] ?>" style="width:600px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>
                    <li>
                        GROSS INCOME
                    </li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>
                        APPLICANT&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&nbsp;&nbsp;:<input type="text" value="<?php echo $format_gross.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>
                        SPOUSES/CO-BORROWER&#8195;&#8195;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" value="<?php echo $format_borrower.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
            <tr>
                <td>
                    <li>
                        TOTAL&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&#8195;&nbsp;&nbsp;:<input type="text" value="<?php echo $format_total.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>
                    <li>
                        INCOME REQ. PER CALCULATOR&#8195;:<input type="text" value="<?php echo $format_income_req.".00" ?>" style="width:490px;border-top:none;border-left:none;border-right:none;margin-left:5px;">
                    </li>
                </td>
            </tr>
        </table>
        <br>
        <div class="loan_cal" style="margin-left:300px;">
            <table style="text-align:center;">

                <tr style="border:solid 1px black;">
                    <td style="border:solid 1px black;">
                        LOAN AMOUNT
                    </td>
                    <td style="border:solid 1px black;"><?php echo $format_loan.".00" ?></td>
                </tr>
                <tr style="border:solid 1px black;">
                    <td style="border:solid 1px black;">
                        INTEREST RATE
                    </td>
                    <?php
                        $interest = $row1['interest'];
                        $format_interest = number_format($interest);
                        $terms = $row1['terms'];
                        $format_terms = number_format($terms);
                        $terms_month = $row1['terms_month'];
                        $format_terms_month = number_format($terms_month);
                    ?>
                    <td style="border:solid 1px black;"><?php echo $format_interest ?></td>
                </tr>
                <tr style="border:solid 1px black;">
                    <td style="border:solid 1px black;">
                        TERM
                    </td>
                    <td style="border:solid 1px black;"><?php echo $format_terms ?></td>
                </tr>
                <tr style="border:solid 1px black;">
                    <td style="border:solid 1px black;">
                        MONTHLY
                    </td>
                    <td style="border:solid 1px black;"><?php echo $terms_month ?></td>
                </tr>
                <tr style="border:solid 1px black;">
                    <td style="border:solid 1px black;">
                        INCOME REQUIREMENT
                    </td>
                    <td style="border:solid 1px black;"><?php echo $format_income_req.".00" ?></td>
                </tr>
            </table>
        </div>
        <br>
        <tr>
            <td>
                <ul>REMARKS IF FAIL:__________________________________________________________________________</ul>
                <ul>________________________________________________________________________________________</ul>
            </td>
        </tr>

        <table style="float:left;" class="small_table">
            <tr>
                <td>Prepared by:</td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>
                <u>&nbsp;&nbsp;<?php echo $_settings->userdata('firstname') ?>&nbsp;<?php echo $_settings->userdata('lastname') ?>&nbsp;&nbsp;</u>
                </td>
            </tr>
        <tr>
            <?php $usertype = $_settings->userdata('user_type'); ?>

            <td style="text-align:center;"><?php echo $usertype ?></td>
        </tr>
        </table>
        <br><br>
        <table style="float:right;margin-top:-60px;position:absolute;margin-left:600px;" class="small_table">
            <tr>
                <td style="text-align:center;">Recommending:</td>
            </tr>
            <tr><td></td></tr>
            <tr>
                <td>
                    <div style="float:left;margin-right:2px;margin-top:3px;">
                        <input id="chkOption1" type="checkbox" name="chkOption3" class="checkbox1"/>
                    </div>
                    <div style="float:left">
                        <label style="font-weight:normal;margin-top:5px;">Approval<label>
                    </div>
                    
                    <div style="float:left;margin-right:2px;margin-top:3px;">
                        &#8195;&#8195;<input id="chkOption1" type="checkbox" name="chkOption3" class="checkbox1"/>
                    </div>
                    <div style="float:left">
                        <label style="font-weight:normal;margin-top:5px;">Disapproval<label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                &nbsp;&nbsp;&nbsp;<u>&#8195;&#8195;&#8195;Janine B. Cruz&#8195;&#8195;&#8195;</u>
                </td>
            </tr>
        <tr>
            <td style="text-align:left;position:relative;">&#8195;&#8195;&#8195;&nbsp;CAS - Supervisor</td>
        </tr>
        <tr></tr>
            <tr>
                <td>
                    <div style="float:left;margin-right:2px;margin-top:3px;">
                        <input id="chkOption1" type="checkbox" name="chkOption3" class="checkbox1"/>
                    </div>
                    <div style="float:left">
                        <label style="font-weight:normal;margin-top:5px;">Approved<label>
                    </div>
                    
                    <div style="float:left;margin-right:2px;margin-top:3px;">
                        &#8195;&#8195;<input id="chkOption1" type="checkbox" name="chkOption3" class="checkbox1"/>
                    </div>
                    <div style="float:left">
                        <label style="font-weight:normal;margin-top:5px;">Disapproved<label>
                    </div>
            </td>
            </tr>
            <tr>
                <td>
                &#8195;<u>&nbsp;Celine Angelica B. Gonzales&nbsp;</u>
                </td>
            </tr>
        <tr>
            <td style="text-align:center;">Chief Finance Officer</td>
        </tr>
        </table>
        <?php endwhile; ?>
       
    </div>
</body>
</html>
<script>
    function doc1_req(){
        var doc1_req = document.getElementById('doc1').value;
        if(doc1_req==1){
            document.getElementById('pass1').checked=true;
        }else{
            document.getElementById('fail1').checked=true;
        }
    }
    function doc2_req(){
        var doc2_req = document.getElementById('doc2').value;
        if(doc2_req==1){
            document.getElementById('pass2').checked=true;
        }else{
            document.getElementById('fail2').checked=true;
        }
    }
    function doc3_req(){
        var doc3_req = document.getElementById('doc3').value;
        if(doc3_req==1){
            document.getElementById('pass3').checked=true;
        }else{
            document.getElementById('fail3').checked=true;
        }
    }
    function ver_doc1(){
        var verdoc1_req = document.getElementById('verdoc1').value;
        if(verdoc1_req==1){
            document.getElementById('pass4').checked=true;
        }else{
            document.getElementById('fail4').checked=true;
        }
    }
    function ver_doc2(){
        var verdoc1_req = document.getElementById('verdoc2').value;
        if(verdoc1_req==1){
            document.getElementById('pass5').checked=true;
        }else{
            document.getElementById('fail5').checked=true;
        }
    }
    function loadAll(){
        doc1_req();
        doc2_req();
        doc3_req();
        ver_doc1();
        ver_doc2();
    }
</script>