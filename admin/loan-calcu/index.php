<?php
	include_once('classes/Calculation.php');
	$Calculation = new Calculation();
	
	if (isset($_POST['submit'])) {
		$Calculation->init();
	}
?>

<!DOCTYPE html>
<!--[if lte IE 9]> <html class="ie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Loan Payment Calculator</title>
<meta name="viewport" content="width=device-width">
<link href="css/style.css" rel="stylesheet">
</head>
<style>
	table tr td{
		border:solid 1px black;
		padding:3px;
	}
	.tdwidth{
		
	}
	.result{
		background-color:gainsboro;
		text-align:center;
		margin-top:10px;
		border-radius:5px;
		width:810px;
		margin-right:15%;
		margin-left:15%;
		font-weight:bold;
	}
</style>
<body>
<div class="card card-outline rounded-0 card-maroon" style="height:520px;">
    <div class="card-header">
    <h3 class="card-title"><b><i>Loan Calculator</b></i></h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
        <div class="container-fluid">

			<h2 class="heading">Instructions</h2>
			<ul>
				<li>This calculator outputs the monthly payments for a loan.</li>
				<li>The loan amount is the total amount of money you are borrowing and must be a whole number greater than zero.
					Do not enter commas, <abbr title="for example">e.g.</abbr>, 1,000 would be entered as 1000.</li>
				<li>Interest is the interest rate you are paying, this is a decimal or whole number greater than 0.1;
					do not include the percent sign.</li>
				<li>The number of months is how many months the loan will be carried out. This is a whole number greater than zero.</li>
			</ul>
			<br>
			<form method="post" id="loanCalcForm" role="">
				<table class="table table-bordered" style="margin-left:15.5%;margin-right:30%;width:800px;">
					<tr>
						<td style="max-width:75%;"><label for="loanAmount">Loan Amount: </label></td>
						<td><input type="text" size="8" style="width:250px;" name="loanAmount" id="loanAmount" value="<?php if (isset($loanAmount)) { echo $loanAmount; } ?>" />
							<?php if (isset($errorArray[0])) { echo $errorArray[0]; } ?></td>
					</tr>
					<tr>
						<td style="max-width:75%;"><label for="interest">Interest: </label></td>
						<td><input type="text" size="8" style="width:250px;" name="interest" id="interest" value="<?php if (isset($interest)) { echo $interest; } ?>" />
							<?php if (isset($errorArray[1])) { echo $errorArray[1]; } ?></td>
					</tr>
					<tr>
						<td style="max-width:75%;"><label for="numOfMonths">Number of Months: </label></td>
						<td><input type="text" size="8" style="width:250px;" name="numOfMonths" id="numOfMonths" value="<?php if (isset($numOfMonths)) { echo $numOfMonths; } ?>" />
							<?php if (isset($errorArray[2])) { echo $errorArray[2]; } ?></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" name="submit" value="" class="btn btn-flat btn-sm btn-info" style="width:70%;color:white;">
								<div style="margin-left:130px;margin-top:-28px;color:white;"><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;&nbsp;Compute</div>
						</td>
					</tr>
				</table>
			</form>
			<div id="result" class="result">
				<?php if (isset($result)) { echo $result; } ?>
			</div>
		</div>
		</div>
	</div>
</div> 
<script src="js/Utils.js"></script>
<script src="js/loanCalc.js"></script>
</body>
</html>