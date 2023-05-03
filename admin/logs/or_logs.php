
<style>
	.main_menu{
		float:left;
		width:227px;
		height:40px;
		line-height:40px;
		text-align:center;
		color:black!important;
		border-right:solid 3px white;
	}
	.main_menu:hover{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
	#container{
		margin-right:auto;
		margin-left:auto;
		width:100%;
		position:relative;
		padding-left:250px;
		padding-right:250px;
		background-color:transparent;
	}
	#lot-link{
		border-bottom: solid 2px blue;
        background-color:#E8E8E8;
	}
    .nav-inventory{
    background-color:#007bff;
    color:white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
</style>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title">OR Logs</h5>
		</div>
		<div class="card-body">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Property ID</th>
                       
                        <th>OR No.</th>
                        <th>Pay Date</th>
                        <th>Amt Paid</th>
                        <!-- 
                        <th>Amt Due</th>
                        <th>Surcharge</th>
                        <th>Interest</th>
                        <th>Principal</th>
                        <th>Rebate</th>
                        <th>Remaining Balance</th>
                        <th>Mode of Payment</th>
                        <th>Check Date</th>
                        <th>Branch</th> -->
                        <th>Preparer</th>
                        <th>Date Prepared</th>
				        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT *
                            FROM or_logs");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["property_id"] ?></td>

                        <td><?php echo $row["or_no"] ?></td>
                        <td><?php echo $row["pay_date"] ?></td>

                        <td><?php echo $row["amount_paid"] ?></td>
                        <!-- <td><?php echo $row["amount_due"] ?></td>
                        <td><?php echo $row["surcharge"] ?></td>
                        <td><?php echo $row["interest"] ?></td>
                        <td><?php echo $row["principal"] ?></td>
                        <td><?php echo $row["rebate"] ?></td>
                        <td><?php echo $row["remaining_balance"] ?></td>
                        <td><?php echo $row["mode_of_payment"] ?></td>
                        <td><?php echo $row["check_date"] ?></td>
                        <td><?php echo $row["branch"] ?></td> -->


                        <td><?php echo $row["user"] ?></td>
                        <td><?php echo $row["gen_time"] ?></td>
                        
                        <td>
                            <a href="<?php echo base_url ?>/report/print_soa.php?id=<?php echo $row["or_id"]; ?>", target="_blank" class="btn btn-primary btn-sm" style="width:100%;">Print OR</a>
                        </td>

                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
	            </div>                
            </div>
	</div>
    <script>

$(document).ready(function(){
		
        $('.table').dataTable();
        
    })
    </script>