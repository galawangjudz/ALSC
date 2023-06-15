<?php
function format_num($number){
	$decimals = 0;
	$num_ex = explode('.',$number);
	$decimals = isset($num_ex[1]) ? strlen($num_ex[1]) : 0 ;
	return number_format($number,$decimals);
}
$from = isset($_GET['from']) ? $_GET['from'] : date("Y-m-d",strtotime(date('Y-m-d')." -1 week"));
$to = isset($_GET['to']) ? $_GET['to'] : date("Y-m-d");
$preparer = isset($_GET['preparer']) ? $_GET['preparer'] : '';
?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">OR Logs</h3>
		<div class="card-tools">
		</div>
	</div>
	<div class="card-body">
        <div class="callout border-primary shadow rounded-0">
            <h4 class="text-muted">Filter Date</h4>
            <form action="" id="filter">
            <div class="row align-items-end">
                <div class="col-md-4 form-group">
                    <label for="from" class="control-label">Date From</label>
                    <input type="date" id="from" name="from" value="<?= $from ?>" class="form-control form-control-sm rounded-0">
                </div>
                <div class="col-md-4 form-group">
                    <label for="to" class="control-label">Date To</label>
                    <input type="date" id="to" name="to" value="<?= $to ?>" class="form-control form-control-sm rounded-0">
                </div>
                <div class="col-md-4 form-group">
                    <label for="preparer" class="control-label">Preparer</label>
                    <input type="text" id="preparer" name="preparer" value="<?= $preparer ?>" class="form-control form-control-sm rounded-0">
                </div>
                <div class="col-md-4 form-group">
                    <button class="btn btn-default bg-gradient-navy btn-flat btn-sm"><i class="fa fa-filter"></i> Filter</button>
			        <button class="btn btn-default border btn-flat btn-sm" id="print" type="button"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
            </form>
        </div>
        <div class="container-fluid" id="outprint">
            <style>
                th.p-0, td.p-0{
                    padding: 0 !important;
                }
            </style>
            <h3 class="text-center"><b><?= $_settings->info('name') ?></b></h3>
            <h4 class="text-center"><b>OR logs</b></h4>
            <?php if($from == $to): ?>
            <p class="m-0 text-center"><?= date("M d, Y" , strtotime($from)) ?></p>
            <?php else: ?>
            <p class="m-0 text-center"><?= date("M d, Y" , strtotime($from)). ' - '.date("M d, Y" , strtotime($to)) ?></p>
            <?php endif; ?>
            <hr>
			<table class="table table-hover table-bordered">
                <colgroup>
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Property ID</th>

                        <th>OR No.</th>
                        <th>Pay Date</th>
                        <th>Amt Paid</th>
                        <th>Preparer</th>
                        <th>Date Prepared</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
					<?php 
                    $i = 1;
					$total_debit = 0;
					$total_credit = 0;
                    echo $preparer;
                    //SELECT * FROM or_logs WHERE user = '$preparer' AND status = 0 AND gen_time BETWEEN '$from_date' AND '$to_date'
					$query = $conn->query("SELECT * FROM `or_logs` where user = '$preparer' and status = '1' and date(gen_time) BETWEEN '{$from}' and '{$to}' order by date(pay_date) asc");
					while($row = $query->fetch_assoc()):
					?>
					<tr>
                    <td>
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $row['property_id']; ?>
                    </td>
                    <td>
                        <?= $row['or_no']; ?>
                    </td>
                    <td>
                        <?= $row['pay_date']; ?>
                    </td>
                    <td>
                        <?= $row['amount_paid']; ?>
                    </td>
                    <td>
                        <?= $row['user']; ?>
                    </td>
                    <td>
                        <?= $row['gen_time']; ?>
                    </td>
                    <td>
                        <a href="/ALSC//report/print_soa.php?id=<?php echo $row["or_id"]; ?>" ,
                            target="_blank" class="btn btn-flat btn-primary btn-sm" style="width:100%;font-size:14px;"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                            OR</a>
                    </td>
					</tr>
					<?php endwhile; ?>
				</tbody>
              
			</table>

                <?php
                $lname = "";
                $fname = "";
                $username = "";
                $amt_pd=0;
            ?>
            <div class="card card-outline rounded-0 card-maroon" id="div_tally">
                <div class="card-body">
                    <div class="container-fluid">
                        <table class="table table-bordered table-stripped" id="data-table"
                            style="text-align:center;">
                            <?php
                            $query1 = "SELECT or_id,property_id,or_no,pay_date,user,gen_time,amount_paid, SUM(amount_paid) as amt_paid FROM or_logs WHERE status = 1 AND gen_time BETWEEN '{$from}' and '{$to}'";
                            $query_run1 = mysqli_query($conn, $query1);
                            while ($row1 = mysqli_fetch_assoc($query_run1)) {
                                $amt_pd = number_format($row1['amt_paid'], 2) . '<br>';
                            }

                            ?>
                            <?php
                        
                            $query2 = "SELECT * FROM users WHERE username = '$preparer'";
                            $query_run2 = mysqli_query($conn, $query2);
                            while ($row2 = mysqli_fetch_assoc($query_run2)) {
                                $lname = $row2['lastname'];
                                $fname = $row2['firstname'];
                                $username = $row2['username'];
                            }
                            ;

                            ?>
                            <label style="text-align:center;width:100%;">CASHIER SALES TALLY</label>
                            <br>
                            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                            <table class="table table-bordered table-stripped" id="data-table"
                                style="text-align:center;">
                                <tr>
                                    <td style="width:50%;"><label>Username:</label></td>
                                    <td>
                                        <?php echo $username; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><label>Full Name:</label></td>
                                    <td>
                                        <?php echo $fname; ?>
                                        <?php echo $lname; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><label>TOTAL COLLECTION:</label></td>
                                    <td>
                                        <?php echo $amt_pd; ?>
                                    </td>
                                </tr>
                            </table>
                            <label style="text-align:center;width:100%;">COLLECTION PERIOD</label>
                            <br>
                            <hr style="height:1px;border-width:0;color:gray;background-color:gray">
                            <table class="table table-bordered table-stripped" id="data-table"
                                style="text-align:center;">
                                <tr>
                                    <td style="width:50%;"><label>Date From: </label></td>
                                    <td>
                                        <?php echo $from; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;"><label>Date To: </label></td>
                                    <td>
                                        <?php echo $to; ?>
                                    </td>
                                </tr>
                            </table>
                        </table>
                    </div>
                </div>
            </div>


            


		</div>
	</div>

    
</div>
</div>
<script>
	$(document).ready(function(){
        $('#filter').submit(function(e){
            e.preventDefault()
            location.href="./?page=reports/or_logs&"+$(this).serialize();
        })
        $('#print').click(function(){
            start_loader()
            var _h = $('head').clone();
            var _p = $('#outprint').clone();
            var el = $('<div>')
            _h.find('title').text('OR logs - Print View')
            _h.append('<style>html,body{ min-height: unset !important;}</style>')
            el.append(_h)
            el.append(_p)
             var nw = window.open("","_blank","width=900,height=700,top=50,left=250")
             nw.document.write(el.html())
             nw.document.close()
             setTimeout(() => {
                 nw.print()
                 setTimeout(() => {
                     nw.close()
                     end_loader()
                 }, 200);
             }, 500);
        })
		
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
	})
	
</script>