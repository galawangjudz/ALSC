<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .nav-inventory{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-inventory:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
	<div class="navbar-menu" style="width: 100%; display: flex; justify-content: center; max-width: 1200px; margin: 0 auto;">
        <a href="<?php echo base_url ?>agent_user/?page=agent_inventory/lots_list" class="main_menu" style="border-left:solid 3px white;"><i class="nav-icon fas fa-square"></i>&nbsp;&nbsp;&nbsp;Lot Inventory</a>
        <a href="<?php echo base_url ?>agent_user/?page=agent_inventory/models_list" class="main_menu" id="model-link"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;House Model List</a>
        <a href="<?php echo base_url ?>agent_user/?page=agent_inventory/projects_list" class="main_menu"><i class="nav-icon fas fa-map"></i>&nbsp;&nbsp;&nbsp;Project List</a>
    </div>
</div>
<?php
$usertype = $_settings->userdata('user_type');
if (!isset($usertype)) {
    include '404.html';
  exit;
}
$user_role = $usertype;
if ($user_role != 'Agent') {
    include '404.html';
  exit;
}
?>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>House Models List</b></i></h5>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
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
<script>
    $(document).ready(function(){
		$('.table').dataTable();
	})
</script>