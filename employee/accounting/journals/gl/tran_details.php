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
                    <col width="10%">
					<col width="10%">
					<col width="30%">
					<col width="30%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
                        <th>#</th>
						<th>VS No.</th>
						<th>Doc Type</th>
						<th>Doc No.</th>
						<th>Doc Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$qry = $conn->query("SELECT DISTINCT(vs_num),doc_type,doc_no,journal_date from `tbl_gl_trans` order by (`journal_date`) desc ");
					while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo ($row['vs_num'] == 0) ? '-' : $row['vs_num']; ?></td>
							<td><?php echo $row['doc_type'] ?></td>
							<td><?php echo $row['doc_no'] ?></td>
                            <td><?php echo date("Y-m-d H:i",strtotime($row['journal_date'])) ?></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id = "<?php echo $row['doc_no'] ?>"><span class="fa fa-info text-primary"></span>&nbsp;&nbsp;View</a>
				                  </div>
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
        $('.view_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=po/goods_receiving/gl_trans&id=' + dataId;
			window.location.href = redirectUrl;
		})
        $('.modal-title').css('font-size', '18px');
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
</script>