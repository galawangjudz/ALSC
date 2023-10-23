<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .nav-projects{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-projects:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>
<?php
$usertype = $_settings->userdata('user_type');
if (!isset($usertype)) {
    include '404.html';
  exit;
}
$user_role = $usertype;
if ($user_role != 'COO') {
    include '404.html';
  exit;
}
?>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Project List</b></i></h5>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Acronym</th>
                        <th>Address</th>
                        <th>Province</th>
                        <th>Zip</th>
                        <th>Rate</th>
                        <th>Reservation</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT * FROM t_projects ORDER BY c_code ASC");
                            while($row = $qry->fetch_assoc()):  
                        ?>
                        <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row["c_code"] ?></td>
                        <td><?php echo $row["c_name"] ?></td>
                        <td><?php echo $row["c_acronym"] ?></td>
                        <td><?php echo $row["c_address"] ?></td>
                        <td><?php echo $row["c_province"] ?></td>
                        <td><?php echo $row["c_zip"] ?></td>
                        <td><?php echo $row["c_rate"] ?></td>
                        <td><?php echo number_format($row["c_reservation"],2) ?></td>
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