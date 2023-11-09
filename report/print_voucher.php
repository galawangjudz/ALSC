<?php require ('../config.php'); ?>
<?php include "../inc/header.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script> 
	<script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Armata&display=swap" rel="stylesheet">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $qry = $conn->query("SELECT * FROM vs_entries WHERE id = '{$_GET['id']}' ");
    $row = $qry->fetch_assoc();
    $vs_id = $row['id'];
    $po_no = $row['po_no'];
    $supp_code = $row['supplier_id'];
    $jdate = $row['journal_date'];
    $due = $row['due_date'];
    $desc = $row['description'];

    $qry_supp = $conn->query("SELECT * FROM supplier_list WHERE id = '$supp_code'; ");
    $row_supp = $qry_supp->fetch_assoc();
    if (!empty($row_supp)) {
        $supp_name = $row_supp['name'];
    } else {
        $qry_supp = $conn->query("SELECT * FROM users WHERE user_id = '$supp_code'; ");
        $row_supp = $qry_supp->fetch_assoc();
        if (!empty($row_supp)) {
            $supp_name = $row_supp['firstname'] . ' ' . $row_supp['lastname'];
        } else {
            $qry_supp = $conn->query("SELECT * FROM t_agents WHERE c_code = '$supp_code'; ");
            $row_supp = $qry_supp->fetch_assoc();
            if (!empty($row_supp)) {
                $supp_name = $row_supp['c_first_name'] . ' ' . $row_supp['c_last_name'];
            } else {
                $supp_name = "Not found in any source";
            }
        }
    }
    ?>

<table class="report-container" style="margin-top:-10px;width:100%;">
    <thead class="report-header">
        <tr>
            <th class="report-header-cell">
                <div class="header-info">
                    <img src="images/Header.jpg" class="img-thumbnail" style="margin-left:120px;height:110px;width:750px;border:none;margin-bottom:-5px;z-index:-1;position:relative;margin-bottom:-35px;" alt="">
                    <h6 style="margin-top:-25px;margin-left:335px;font-weight:normal;">Grand Royale Subdivision, Bulihan, Malolos City, Bulacan, Philippines</h6>

                    <h3 style="margin-top:50px;margin-left:435px;font-weight:bold;font-family: 'Armata', sans-serif;">VOUCHER SETUP</h3>

                    <div class="container" style="margin-top:15px;">
                        <table class="table table-bordered">
                            <tr>
                                <td style="width:10%;font-weight:bold; padding: 4px 10px;">Voucher #:</td>
                                <td style="width:50%; padding: 4px 10px;"><?php echo $vs_id; ?></td>
                                <td style="font-weight:bold; padding: 4px 10px;">Date:</td>
                                <td style="padding: 4px 10px;"><?php echo $jdate; ?></td>
                            </tr>
                            <tr>
                                <td style="width:15%;font-weight:bold; padding: 4px 10px;">PO #:</td>
                                <td style="padding: 4px 10px;"><?php echo $po_no; ?></td>
                                <td style="width:15%;font-weight:bold; padding: 4px 10px;">Due Date:</td>
                                <td style="padding: 4px 10px;"><?php echo $due; ?></td>
                            </tr>
                            <tr>
                                <td style="width:15%;font-weight:bold; padding: 4px 10px;">Paid To:</td>
                                <td style="padding: 4px 10px;"><?php echo $supp_name; ?></td>
                                <td style="width:15%;font-weight:bold; padding: 4px 10px;">Supplier Code:</td>
                                <td style="padding: 4px 10px;"><?php echo $supp_code; ?></td>
                            </tr>
                        </table>
                        <hr>
                        <h6 style="font-weight:bold;margin-left:10px;">Particulars:</h6>
                        <table class="table table-bordered">
                            <tr>
                                <td><?php echo $desc; ?></td>
                            </tr>
                        </table>
                        <table id="account_list" class="table table-striped table-bordered">
                        <colgroup>
                            <col width="10%">
                            <col width="50%">
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Code</th>
                                <th class="text-center">Account Name</th>
                                <th class="text-center">Debit</th>
                                <th class="text-center">Credit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $jitems = $conn->query("SELECT j.*,a.code as account_code, a.name as account, g.name as `group`, g.type FROM `vs_items` j inner join account_list a on j.account_id = a.id inner join group_list g on j.group_id = g.id where journal_id = '{$_GET['id']}'");
                            while($row = $jitems->fetch_assoc()):
                            ?>
                            <tr>  
                                <td class="" style="padding: 4px 10px;">
                                    <span class="account_code"><?= $row['account_code'] ?></span>
                                </td>
                                <td class="" style="padding: 4px 10px;">
                                    <span class="account"><?= $row['account'] ?></span>
                                </td>
                                <td class="debit_amount text-right" style="padding: 4px 10px;"><?= $row['type'] == 1 ? number_format($row['amount']) : '' ?></td>
                                <td class="credit_amount text-right" style="padding: 4px 10px;"><?= $row['type'] == 2 ? number_format($row['amount']) : '' ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gradient-secondary">
                                <tr>
                                    <th colspan="2" class="text-center">Total</th>
                                    <th class="text-right total_debit">0.00</th>
                                    <th class="text-right total_credit">0.00</th>
                                </tr>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </th>
        </tr>
    </thead>
</table>
</body>
<script>
    function cal_tb() {
        var debit = 0;
        var credit = 0;
        $('#account_list tbody tr').each(function () {
            if ($(this).find('.debit_amount').text() != "") {
                debit += parseFloat(($(this).find('.debit_amount').text()).replace(/,/gi, ''));
            }
            if ($(this).find('.credit_amount').text() != "") {
                credit += parseFloat(($(this).find('.credit_amount').text()).replace(/,/gi, ''));
            }
        });

        $('#account_list').find('.total_debit').text(parseFloat(debit).toLocaleString('en-US', { style: 'decimal' }));
        $('#account_list').find('.total_credit').text(parseFloat(credit).toLocaleString('en-US', { style: 'decimal' }));
    }
    cal_tb();
</script>
<script type="text/javascript">
	function PrintPage() {
		window.print();
	}
	    document.loaded = function(){
	}
	window.addEventListener('DOMContentLoaded', (event) => {
   		PrintPage()
		setTimeout(function(){ window.close() },750)
	});
</script>
</html>

