<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .nav-models{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-models:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
    .dataTables_wrapper .dataTables_length,
	.dataTables_wrapper .dataTables_info {
		text-align: left !important;
	}
</style>
<?php
$usertype = $_settings->userdata('position');
if (!isset($usertype)) {
    include '404.html';
  exit;
}
$user_role = $usertype;
if ($user_role != 'CHIEF OF OPERATION') {
    include '404.html';
  exit;
}
?>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>House Models List</b></i></h5>
		</div>
		<div class="card-body">
            <!-- <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;"> -->
            <div class="table-container">
                <table class="table table-bordered table-striped" id="data-table">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Model</th>
                        <th>Acronym</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM t_model_house ORDER BY c_code ASC");
                            while($row = $qry->fetch_assoc()):  
                        ?>
                        <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["c_code"] ?></td>
                        <td><?php echo $row["c_model"] ?></td>
                        <td><?php echo $row["c_acronym"] ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
	        </div>                
            </div>
	    </div>
<!-- <script>
    $(document).ready(function(){
		$('.table').dataTable();
	})
</script> -->