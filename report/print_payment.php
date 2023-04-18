

<?php require_once('../config.php'); ?>

<!DOCTYPE html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 
	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        font-size:12px;
    }
    .or_box{
        font-family: 'Armata', sans-serif;
        font-size:15px;
        background-color:black;
        color:white;
        float:right;
        padding:10px;
        margin-right:0px;
    }
    .or_address{
        font-family: 'Armata', sans-serif;
        font-size:11px;
        font-weight:light!important;
        margin-top:10px;
        /* position:absolute; */
    }
    .comp_name{
        font-family: 'Armata', sans-serif;
        font-size:18px;
        font-weight:bold;
        margin-top:0px;
        /* position:absolute; */
        float:left;
    }
    .cust_info{
        float:left;
        width:100%;
    }
    .div_particulars{
        text-align:center;
    }
@media print  
{ 
    @page {

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
        <img src="../images/ALSC_BnW.jpg" style="height:95px;width:115px;float:left;margin-top:-10px;z-index:-1;margin-bottom:2px;margin-left:-5px;">
        <div class="comp_name">ASIAN LAND STRATEGIES CORPORATION</div>
        <div class="or_box">INVOICE</div>
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
                <table style="width:100%;border:solid 1px black;">
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
    <br>
    <div class="card-body" id="tables" style="float:left;width:100%;">
        <table style="float:left;width:100%;text-align:center;">
            <thead>
                <tr>
                    <th>DUE DATE</th>
                    <th>PAY DATE</th>
                    <th>OR No.</th>
                    <th>PERIOD</th>
                    <th>AMOUNT PAID</th>
                    <th>REBATE</th>
                    <th>SURCHARGE</th>
                    <th>INTEREST</th>
                    <th>PRINCIPAL</th>
                    <th>BALANCE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $i = 1;
                        $qry = $conn->query("SELECT * FROM t_invoice where md5(property_id) = '{$_GET['id']}' ");
                        while($row = $qry->fetch_assoc()):         
                    ?>
                    <tr>
                    <td><?php echo $row["due_date"] ?></td>
                    <td><?php echo $row["pay_date"] ?></td>
                    <td><?php echo $row["or_no"] ?></td>
                    <td><?php echo $row["status"] ?></td>
                    <td><?php echo $row["payment_amount"] ?></td>
                    <td><?php echo $row["rebate"] ?></td>
                    <td><?php echo $row["surcharge"] ?></td>
                    <td><?php echo $row["interest"] ?></td>
                    <td><?php echo $row["principal"] ?></td>
                    <td><?php echo $row["remaining_balance"] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>  
    </div>
    <br><br>
    
    <br><br>
            <?php $qry_prin = "SELECT SUM(principal) AS p_principal FROM property_payments where md5(property_id) = '{$_GET['id']}'";

            $result = mysqli_query($conn, $qry_prin);

            // Check if the query was successful
            if (mysqli_num_rows($result) > 0) {
                // Fetch the result as an associative array
                $row = mysqli_fetch_assoc($result);
                // Get the sum value
                $total_prin = $row["p_principal"];
                // Display the sum value
            } else {
                echo "No results found.";
            }
            ?>
            <?php $qry_surcharge = "SELECT SUM(surcharge) AS p_surcharge FROM property_payments where md5(property_id) = '{$_GET['id']}'";

            $result = mysqli_query($conn, $qry_surcharge);

            // Check if the query was successful
            if (mysqli_num_rows($result) > 0) {
                // Fetch the result as an associative array
                $row = mysqli_fetch_assoc($result);
                // Get the sum value
                $total_surcharge = $row["p_surcharge"];
                // Display the sum value
            } else {
                echo "No results found.";
            }
            ?>
            <?php $qry_interest = "SELECT SUM(interest) AS p_interest FROM property_payments where md5(property_id) = '{$_GET['id']}'";

            $result = mysqli_query($conn, $qry_interest);

            // Check if the query was successful
            if (mysqli_num_rows($result) > 0) {
                // Fetch the result as an associative array
                $row = mysqli_fetch_assoc($result);
                // Get the sum value
                $total_interest = $row["p_interest"];
                // Display the sum value
            } else {
                echo "No results found.";
            }
            ?>
            <?php $qry_rebate = "SELECT SUM(rebate) AS p_rebate FROM property_payments where md5(property_id) = '{$_GET['id']}'";

            $result = mysqli_query($conn, $qry_rebate);

            // Check if the query was successful
            if (mysqli_num_rows($result) > 0) {
                // Fetch the result as an associative array
                $row = mysqli_fetch_assoc($result);
                // Get the sum value
                $total_rebate = $row["p_rebate"];
                // Display the sum value
            } else {
                echo "No results found.";
            }
            ?>
            <?php $qry_amt_due = "SELECT SUM(amount_due) AS p_amt_due FROM property_payments where md5(property_id) = '{$_GET['id']}'";

                $result = mysqli_query($conn, $qry_amt_due);

                // Check if the query was successful
                if (mysqli_num_rows($result) > 0) {
                    // Fetch the result as an associative array
                    $row = mysqli_fetch_assoc($result);
                    // Get the sum value
                    $total_amt_due = $row["p_amt_due"];

                    $main_total = $total_amt_due + $total_interest + $total_surcharge + $total_prin;
                    // Display the sum value
                } else {
                    echo "No results found.";
                }
                ?>
                <br><br>
        <table style="width:100%;background-color:#F8F8F8;border:solid 1px black;margin-top:10px;">
            <tr>
                <td style="width:10%;"><label class="control-label"><b>Total Principal: </b></label></td>
                
                <td style="width:10%;"><input type="text" class= "form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo number_format($total_prin,2) ?>" style="width:125px;border:none;font-family: 'Armata', sans-serif;font-size:12px;"></td>
                <td style="width:10%;"><label class="control-label"><b>Total Rebate: </b></label></td>
                <td style="width:10%;"><input type="text" class= "form-control-sm" name="tot_reb" id="tot_reb" value="<?php echo number_format($total_rebate,2) ?>" style="width:125px;border:none;font-family: 'Armata', sans-serif;font-size:12px;"></td>
                <td style="width:10%;"><label class="control-label"><b>Total Surcharge: </b></label></td>
                <td style="width:10%;"><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo number_format($total_surcharge,2) ?>" style="width:125px;border:none;font-family: 'Armata', sans-serif;font-size:12px;"></td>
                <td style="width:10%;"><label class="control-label"><b>Total Interest: </b></label></td>
                <td style="width:10%;"><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo number_format($total_interest,2) ?>" style="width:125px;border:none;font-family: 'Armata', sans-serif;font-size:12px;"></td>
                <td style="width:10%;"><label class="control-label"><b>Total Amount Due: </b></label></td>
                <td style="width:10%;"><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" value="<?php echo number_format($main_total,2) ?>" style="width:125px;border:none;font-family: 'Armata', sans-serif;font-size:12px;"></td>
            </tr>
        </table>
</div>
</body>
</html>
