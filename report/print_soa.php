<?php require_once('../config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<style>

    @media print {
        @page {
            margin: 0mm;
            orientation: landscape;
            height:139.7mm;
            width:215.9mm;
        }
    }
    body {
        font-family: 'Armata', sans-serif;
        font-size: 13px;
    }
</style>
<?php $qry = $conn->query("SELECT * FROM property_clients where md5(property_id) = '{$_GET['id']}' ");
$row = $qry->fetch_assoc();
$client_id = md5($row['property_id']);
$property_id = $row['property_id'];
$p_last_name = $row['last_name'];
$p_first_name = $row['first_name'];
$p_middle_name = $row['middle_name'];
$p_address = $row['address'];
$p_zipcode = $row['zip_code'];
$acr = substr($property_id, 2, 3);
$blk = substr($property_id, 5, 3);
$lot = substr($property_id, 8, 2); ?>
<?php $qry2 = $conn->query("SELECT * from t_projects where c_code = '$acr'");
$row2 = $qry2->fetch_assoc();
$name = $row2['c_acronym']; ?>
<body>
<div class="img_container">
    <img src="../images/ALSC_OR.jpg" style="width:215.9mm;height:139.7mm;"><br>
    <div class="b_name" style="text-transform:uppercase;font-weight:bold;position:absolute;margin-top:-460px;margin-left:155px;">
        <?php echo $p_last_name; ?>, <?php echo $p_first_name; ?> <?php echo $p_middle_name; ?>
    </div>
    <div class="b_address" style="position:absolute;margin-top:-440px;margin-left:155px;">
        <?php echo $p_address; ?>, <?php echo $p_zipcode; ?>
    </div>
    <div class="b_date" style="position:absolute;margin-top:-460px;margin-left:645px;">
        <?php echo date("F j, Y"); ?>
    </div>
    <div class="b_loc" style="position:absolute;margin-top:-440px;margin-left:645px;">
        <?php echo $name; ?>
        <?php echo $blk; ?> /
        <?php echo $lot; ?>
    </div>
    <div class="b_prop_id" style="position:absolute;margin-top:-420px;margin-left:645px;">
        <?php echo $property_id; ?>
    </div>
    <div class="b_particulars" style="position:absolute;margin-top:-360px;margin-left:30px;">
        <textarea class="b_particulars" name="b_particulars" style="height:100px;width:450px;border:none;resize:none;"></textarea>
    </div>
<!-- <img src="../images/ALSC_OR.jpg" style="width:215.9mm;height:139.7mm;border:solid 1px; black;"> -->
</div>
</body>
<!-- <script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	document.loaded = function(){
		
	}
	window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
</script>  -->
</html>