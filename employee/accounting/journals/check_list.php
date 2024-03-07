<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-cl{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-cl:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
	.radioLabel {
		margin-right: 10px; 
		font-style: italic;
	}

</style>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Checks List</b></i></h5>
		</div>
		<div class="card-body">
            <div class="container-fluid">
				<div class="container-fluid">
				<div class="filterBox d-flex justify-content-between align-items-center">
					<div class="filterOptions">
						<label>Filter: </label>
						<label class="radioLabel" style="padding-left:25px;"><input type="radio" name="filter_status" value="all" checked> All</label>
						<label class="radioLabel"><input type="radio" name="filter_status" value="claimed"> Claimed</label>
						<label class="radioLabel"><input type="radio" name="filter_status" value="unclaimed"> Unclaimed</label>
					</div>
					<button id="export-csv-btn" class="btn btn-success btn-sm"><i class="fas fa-file-export"></i> Export</button>
				</div>

				<hr>
				<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
					<!-- <colgroup>
						<col width="5%">
						<col width="20%">
						<col width="20%">
						<col width="25%">
						<col width="15%">
					</colgroup> -->
					<thead>
						<tr>
						<th>#</th>
						<th>CV #</th>
						<th>Voucher #</th>
						<th>ID/Code</th>
						<th>Check Date</th> 
						<th>Check #</th> 
						<th>Amount</th> 
						<th>Check Name</th> 
						<th style="display:none;">Status1</th> 
						<th>Status</th> 
						<th>Date/Time Claimed</th> 
						<th>Action</th> 
						</tr>
					</thead>
					<tbody>
						<?php 
							$i = 1;

							$qry = $conn->query("SELECT c.check_id, c.amount, a.c_num, a.v_num, a.supplier_id, a.check_date,c.check_num,c.check_name,c.c_status,c.date_updated FROM check_details c INNER JOIN cv_entries a ON c.c_num = a.c_num ORDER BY c.date_updated DESC;");

							while ($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo $row['c_num'] ?></td>
								<td class=""><?php echo $row['v_num'] ?></td>
								<td class=""><?php echo $row['supplier_id'] ?></td>
								<td class=""><?php echo date('Y-m-d', strtotime($row['check_date'])); ?></td>
								<td class=""><?php echo $row['check_num'] ?></td>
								<td class=""><?php echo number_format($row['amount'],2) ?></td>
								<td class=""><?php echo $row['check_name'] ?></td>
								<td class="" style="display:none;"><?php echo $row['c_status']; ?></td>
								<td class="">
									<?php 
										switch($row['c_status']){
											case 0:
												echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Unclaimed</span>';
												break;
											case 1:
												echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Claimed</span>';
												break;
											default:
												echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
												break;
										}
									?>
								</td>
								<td class="">
									<?php 
										echo ($row['c_status'] == 0) ? '-' : date('Y-m-d H:i:s', strtotime($row['date_updated']));
									?>
								</td>
								<td class="text-center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										<?php if ($row['c_status'] == 1): ?>
											<span class="fa fa-check text-primary"></span> Claimed
										<?php else: ?>
											<span class="fa fa-times text-secondary"></span> Unclaimed
										<?php endif; ?>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item claim_data" href="javascript:void(0)" data-id="<?php echo $row['check_id'] ?>" data-status="1">
											<span class="fa fa-check text-primary"></span> Claimed
										</a>
										<a class="dropdown-item unclaim_data" href="javascript:void(0)" data-id="<?php echo $row['check_id'] ?>" data-status="0">
											<span class="fa fa-times text-secondary"></span> Unclaimed
										</a>
										<button type="button" style="border:none;" class="dropdown-item print_data" data-id="<?php echo $row['c_num'] ?>"
												onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_check.php?id=<?php echo $row['check_id'] ?>', '_blank')"
												data-toggle="tooltip" data-placement="top" title="Print"> 
											<span class="fas fa-print"></span> Print
										</button>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>                
		</div>
	</div>
<script>
    $(document).ready(function () {
        var dataTable = $('#data-table').DataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });

		$('input[name="filter_status"]').change(function () {
            var statusFilter = $(this).val();
            console.log(statusFilter);
            dataTable.search('').draw();

            if (statusFilter === 'claimed') {
                dataTable.column(8).search("1").draw(); 
            } else if (statusFilter === 'unclaimed') {
                dataTable.column(8).search("0").draw(); 
            } else {
                dataTable.column(8).search('').draw(); 
            }
        });
        $('.table td, .table th').addClass('py-1 px-2 align-middle');
    });
</script>
<script>
    $('.claim_data').click(function(){
        _conf("Are you sure you want to update this check voucher details?","claim_cv",[$(this).attr('data-id')])
    })
	
    $('.unclaim_data').click(function(){
        _conf("Are you sure you want to update this check voucher details?","unclaimed_cv",[$(this).attr('data-id')])
    })
    $(document).ready(function(){
		$('.table').dataTable();
	})
	$('.table td, .table th').addClass('py-1 px-2 align-middle')
	$('.table').dataTable({
		columnDefs: [
			{ orderable: false, targets: 5 }
		],
	});
    function claim_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=claim_cv",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	function unclaimed_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=unclaimed_cv",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>
document.getElementById('export-csv-btn').addEventListener('click', function() {
   console.log('Export clicked');
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
    
    var table = document.querySelector('#data-table');
    var visibleRows = table.querySelectorAll('tbody tr:not([style*="display: none"])');

    var headerRow = table.querySelector('thead tr');
    var headerCols = headerRow.querySelectorAll('th');
    var headerData = [];
    var excludeColumns = ['Action']; 

    headerCols.forEach(function(col) {
        if (col && col.style && col.style.display !== 'none' && !excludeColumns.includes(col.innerText)) {
            headerData.push(col.innerText);
        }
    });

    var csvContent = "Bank Checks Status as of " + formattedDate + "\n\n";
    csvContent += headerData.join(',') + "\n";

    visibleRows.forEach(function(row) {
        var dataCols = row.querySelectorAll('td');
        var dataRow = [];
        dataCols.forEach(function(col, index) {
            if (col && col.style && headerCols[index] && headerCols[index].style && headerCols[index].style.display !== 'none' && !excludeColumns.includes(headerCols[index].innerText)) {
                var cellValue = col.innerText;
                if (col.cellIndex === 6) { 
                    cellValue = cellValue.replace(/,/g, '');
                }
                dataRow.push(cellValue);
            }
        });
        csvContent += dataRow.join(',') + "\n";
    });

    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = "Bank_Checks_Status" + '_asof_' + formattedDate + '.csv';

    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>
