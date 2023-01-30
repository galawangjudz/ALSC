<?php 
require ('../../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/header.php" ?>
<body>
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
table th, table td{
	padding:5px 3px!important;
}
</style>
<h1 class="text-center"><b>Credit Assestment Evaluation Sheet</b></h1>

        <?php
        $qry = $conn->query("SELECT *,CONCAT_WS(' ',first_name, last_name)as full_name  from t_csr_view where c_csr_no = '{$c_csr_no}'");
        while($row=$qry->fetch_assoc()):

        ?>
        <img src="<?php echo validate_image($_settings->info('logo')) ?>" class="img-thumbnail" style="height:75px;width:75px;object-fit:contain" alt="">
        <p>Applicant Name: <u><?php echo $row['full_name'] ?></u></p>
        <p>Project: <u><?php echo $row['c_acronym'] ?></u></p>
        <p>Block: <u><?php echo $row['c_block'] ?></u></p>
        <p>Lot: <u><?php echo $row['c_lot'] ?></u></p>
        <p>Contract Price: <u><?php echo $row['c_net_tcp'] ?></u></p>
        <p>Loanable Amount: <u><?php echo $row['c_amt_financed'] ?></u></p>
     

         
        <?php endwhile; ?>
  
<hr>

        <p>ON DOCUMENTARY REQUIREMENTS:</p>
        <p>MANDATORY REQUIREMENTS</p>
        <p>INCOME/COMPLETE REQUIREMENTS</p>   
        <p>ADDITIONAL REQUIREMENTS</p>    

        <p>REMARKS IF FAIL:</p>  
        
        
        <p>ON DOCUMENTARY REQUIREMENTS:</p>
        <p>MANDATORY REQUIREMENTS</p>
        <p>INCOME/COMPLETE REQUIREMENTS</p>   
        <p>ADDITIONAL REQUIREMENTS</p>   
        
        <p>REMARKS IF FAIL:</p>  
        
<hr>
<p><b>Remarks:</b></p>

</body>
</html>