

<?php require_once('../config.php'); ?>

<!DOCTYPE html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 
	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    <link href="https://fonts.googleapis.com/css2?family=Armata&display=swap" rel="stylesheet">
</head>
<!DOCTYPE html>
<html lang="en">
<?php $qry = $conn->query("SELECT * FROM property_clients where md5(property_id) = '{$_GET['id']}' ");
	$row= $qry->fetch_assoc();
    $client_id = md5($row['property_id']);
    $property_id = $row['property_id'];
    $p_last_name = $row['last_name'];
    $p_first_name = $row['first_name'];
    $p_middle_name = $row['middle_name'];
    $p_address = $row['address'];
    $p_zipcode = $row['zip_code'];
    $acr = substr($property_id, 2, 3);
    $blk = substr($property_id, 5, 3);
    $lot = substr($property_id, 8, 2);
?>
<?php $qry2 = $conn->query("SELECT * from t_projects where c_code = '$acr'");
    $row2 = $qry2->fetch_assoc();
    $name = $row2['c_acronym'];
?>
<style>
    /* .container_content{
        margin-top:-20px;
    } */
    body{
        font-family: 'Armata', sans-serif;
        font-size:8px;
    }
    .or_box{
        font-family: 'Armata', sans-serif;
        font-size:10px;
        background-color:black;
        color:white;
        float:right;
        padding:10px;
        margin-right:0px;
    }
    .or_address{
        font-family: 'Armata', sans-serif;
        font-size:7.5px;
        font-weight:light!important;
        margin-top:10px;
        /* position:absolute; */
    }
    .comp_name{
        font-family: 'Armata', sans-serif;
        font-size:14px;
        font-weight:bold;
        margin-top:0px;
        /* position:absolute; */
        float:left;
    }
    .cust_info{
        float:left;
        background-color:gainsboro;
        width:100%;
    }
    .div_particulars{
        text-align:center;
    }
    table tr td{
        border: solid 1px black;
    }
@media print  
{ 
    @page {
    size: A5;  

    /* this affects the margin in the printer settings */ 
    margin: 1mm;  
    orientation: portrait;
    transform: scale(0.8)!important;
    /* 
    transform: scale(0.8)!important; */
    /* dpi: 300; */
    }
} 

</style>

<body>
<div class="whole_content">
<!-- <div class="text-center" style="padding:20px;">
	<input type="button" id="rep" value="Print" class="btn btn-info btn_print">
</div> -->
    <div class="container_content" id="container_content">
        <img src="../images/ALSC_BnW.jpg" style="height:75px;width:95px;float:left;margin-top:-10px;z-index:-1;margin-bottom:2px;margin-left:-5px;">
        <div class="comp_name">ASIAN LAND STRATEGIES CORPORATION</div>
        <div class="or_box">OFFICIAL RECEIPT</div>
        <div class="or_address">
            <br>
            <br>
            Asian Land Corporate Center, Mc Arthur Highway
            <br>
            Grand Royale Subd., Bulihan, City of Malolos, (Capital), Bulacan 3000
            <br>
            VAT REG. TIN: 003-873-255-00000
            <br>
            Tel. No. (044) 791 2508 - 09
        </div>
        <br>
        <br><br>
        <div class="card-body" style="margin-top:-25px;">
            <div class="cust_info">
                <table style="width:100%;">
                    <tr>
                        <td style="padding-right:5px;">
                            Received From: 
                        </td>
                        <td>
                            <?php echo $p_last_name; ?>, <?php echo $p_first_name; ?> <?php echo $p_middle_name; ?>
                        </td>
                        <td>
                            Date: 
                        </td>
                        <td>
                            <?php echo date("F j, Y"); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-right:5px;">
                            Address:  
                        </td>
                        <td>
                            <?php echo $p_address; ?>, <?php echo $p_zipcode; ?>
                        </td>
                        <td>
                            Location: 
                        </td>
                        <td>
                        <?php echo $name;?> <?php echo $blk;?> / <?php echo $lot;?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <div class="card-body" id="tables">
        <!-- <table style="background-color:red;float:left;width:100%;">
            <tr>
                <td>
                    <div class="div_particulars">PARTICULARS</div>
                </td>
            </tr>
            <tr>
            </tr>
            <br>
            <br>
        </table> -->


        <table style="background-color:gainsboro;float:left;width:100%;">
        <thead>
            <tr>
            <th>Invoice ID#</th>
            <th>Payment Amount</th>
            <th>Pay Date</th>
            <th>Due Date</th>
            <th>OR #</th>
            <th>Amount Due</th>
            <th>Rebate</th>
            <th>Surcharge</th>
            <th>Interest</th>
            <th>Principal</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $i = 1;
                $qry = $conn->query("SELECT * FROM t_invoice where md5(property_id) = '{$_GET['id']}' ");
                while($row = $qry->fetch_assoc()):
                    
            ?>
            <tr>
            <td><?php echo $row["invoice_id"] ?></td>
            <td><?php echo $row["payment_amount"] ?></td>
            <td><?php echo $row["pay_date"] ?></td>
            <td><?php echo $row["due_date"] ?></td>
            <td><?php echo $row["or_no"] ?></td>
            <td><?php echo $row["amount_due"] ?></td>
            <td><?php echo $row["rebate"] ?></td>
            <td><?php echo $row["surcharge"] ?></td>
            <td><?php echo $row["interest"] ?></td>
            <td><?php echo $row["principal"] ?></td>
            <td><?php echo $row["status"] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody></table>

























        <!-- <table style="background-color:blue;float:left;width:30%;">
        <tr>
            <td>
                <div class="div_particulars">AMOUNT</div>
            </td>
            <td></td>
        </tr>
            <tr>
                <td>Principal: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Interest: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Surcharge: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Others: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Amount Due: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Less: Rebate/ </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Discount: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Total Payment: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr></tr>
            <tr></tr>
            <tr>
                <td>VATABLE Sales: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>VAT Exempt Sales: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Zero Rated Sales: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>VAT Amount: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Total Sales: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>Less: EWT: </td><td style="background-color:gainsboro;"></td>
            </tr>
            <tr>
                <td>NET SALES: </td><td style="background-color:gainsboro;">10,555.74</td>
            </tr>
        </table> -->
    </div>
</div>
</body>
</html>
