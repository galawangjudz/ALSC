

<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

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
		padding-left:50px;
		padding-right:50px;
		background-color:transparent;
	}
	#pl-link{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
	.dropdown:hover .dropdown-menu {
		display: block;
		margin-top:40px;
		float:left;
		width:227px;
		height:130px;
		line-height:30px;
		text-align:center;
		color:black!important;
	}
	.dropdown-menu li a{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
	}
	.dropdown-menu li a:hover{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
		background-color:#E8E8E8;
	}
	#res-link1{
		color: currentColor;
		cursor: not-allowed;
		opacity: 0.5;
		text-decoration: none;
		pointer-events: none;
	}
    #uni_modal_2{
        width:150%;
        height:100%;
        margin:auto;
		margin-left:-25%;
		margin-right:auto;
    } 
    .nav-av {
    background-color: #007bff;
    color: white !important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-av:hover {
        background-color: #007bff !important;
    }
</style>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h3 class="card-title"><b><i>AV Logs</b></i></h3>
		</div>
		<div class="card-body">
            <div class="container-fluid">
			<div class="table-responsive">
                <table class="table table-bordered table-stripped" style="text-align:center;font-size:14px;">
                    <thead>
                        <tr>
                        <th>AV No.</th>
						<th>Property ID</th>
                        <th>AV Date</th>
                        <th>AV Amount</th>
						<th>Total Principal</th>
                        <th>Total Interest</th>
                        <th>Total Rebate</th>
						<th>Total Surcharge</th>
						<th>Other Deductions</th>
                      <!--   <th>New Account No</th> -->
                        <th>Remarks</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM t_av_summary ORDER BY c_av_date DESC") ;
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <td><?php echo $row["c_av_no"] ?></a></td>
						<td><?php echo $row["property_id"] ?></a></td>
                        <td><?php echo $row["c_av_date"] ?></td>
                        <td><?php echo number_format($row["c_av_amount"],2) ?></td>
						<td><?php echo number_format($row["c_principal"],2) ?></td>
						<td><?php echo number_format($row["c_interest"],2) ?></td>
                        <td><?php echo number_format($row["c_rebate"],2) ?></td>
                        <td><?php echo number_format($row["c_surcharge"],2) ?></td>
						<td><?php echo number_format($row["c_deductions"],2) ?></td>
                     <!--    <td><?php echo $row["c_new_acc_no"] ?></td> -->
                        <td><?php echo $row["c_remarks"] ?></td>
                        <td><a class="btn btn-flat btn-sm view_av btn-info" data-id="<?php echo $row['c_av_no'] ?>"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Details</a>
						<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['id'] . '" value="4" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
										<i class="fa fa-thumbs-up" aria-hidden="true"></i>
										<span class="tooltip">Approved</span>
										</a>
							<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;"  data-id="<?php echo $row['c_av_no'] ?>" id="view_tooltip">
									<i class="fa fa-thumbs-down" aria-hidden="true"></i>
									<span class="tooltip">Disapproved</span>
						</a>
						</td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
					</div>                     
            </div>

	</div>
<script>
$(document).ready(function() {
    $('.table').dataTable(
        {
                "ordering": false
        }
    ); 
});
$('.view_av').click(function(){
	uni_modal_2('<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View AV', 'clients/application_voucher/av_modal.php?id=' + $(this).attr('data-id'), 'mid-large');
})
</script>