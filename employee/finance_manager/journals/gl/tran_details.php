<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-tran{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-tran:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
	.view_data:hover span.badge {
        background-color: #007bff!important;
        color: white!important;
        border-color: #007bff!important;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>Transaction Details</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="25%">
					<col width="20%">
					<!-- <col width="10%"> -->
					<col width="20%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
                        <th>#</th>
						<!-- <th>VS No.</th> -->
						<th>Doc Type</th>
						<th>Doc No.</th>
						<th>PO No.</th>
						<!-- <th>GR No.</th> -->
						<th>Doc Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$qry = $conn->query("SELECT DISTINCT(doc_type),doc_no,journal_date,po_id from `tbl_gl_trans` WHERE c_status = 1 and c_status2 = 1 order by (`journal_date`) desc ");
					while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['doc_type'] ?></td>
							<td><?php echo $row['doc_no'] ?></td>
							<td><?php echo ($row['doc_type'] == 'AP' || $row['doc_type'] == 'JV') ? '-' : $row['po_id']; ?></td>
							<!-- <td><?php echo ($row['doc_type'] == 'AP' || $row['doc_type'] == 'GR') ? $row['gr_id'] : '-' ?></td> -->
                            <td><?php echo date("Y-m-d H:i",strtotime($row['journal_date'])) ?></td>
							<td align="center">
				                <a class="view_data" href="javascript:void(0)" data-id = "<?php echo $row['doc_no'] ?>"><span class="badge rounded-circle p-2" style="background-color:white; color:#007bff; border:1px solid gainsboro;" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye fa-lg"></i></span></a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

    $('.view_data').click(function() {
        var docNo = $(this).data('id').toString();

        if (docNo.substring(0, 1) === '4') {
            var redirectUrl = '?page=journals/jv/jv_trans&id=' + docNo;
			
        }else if (docNo.substring(0, 1) === '3') {
            var redirectUrl = '?page=po/goods_receiving/transaction_details/cv_trans&id=' + docNo;
			
        } else if (docNo.substring(0, 1) === '2') {
            var redirectUrl = '?page=po/goods_receiving/transaction_details/ap_trans&id=' + docNo;
			
        } else if (docNo.substring(0, 1) === '1') {
            var dataId = $(this).data('id');
            var redirectUrl = '?page=po/goods_receiving/transaction_details/gl_trans&id=' + dataId;
           
        }
		window.location.href = redirectUrl;
    });

    $('.modal-title').css('font-size', '18px');
    $('.table th,.table td').addClass('px-1 py-0 align-middle')
    $('.table').dataTable();
});

</script>