<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php


if(isset($_GET['id'])){
    $client_info = $conn->query("SELECT x.*,y.* FROM property_clients x INNER JOIN properties y ON x.property_id = y.property_id where x.property_id = '{$_GET['id']}' ");    
    while($row=$client_info->fetch_assoc()){
        $client_id = $row['client_id'];
        $property_id = $row['property_id'];
        $last_name = $row['last_name'];
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $suffix_name = $row['suffix_name'];
        $acc_status =  $row['c_account_status'];
        $dos = $row['c_date_of_sale'];
        $balance = $row['c_balance'];
    }
}
?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}
.container-fluid p{
    margin: unset
}
#uni_modal .modal-footer{
    display: none;
} 

</style>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	</div>
	<div class="card-body">
    <div class="container-fluid">
    <table class="table table-striped table-hover table-bordered" id="data-table">
        <tr>
            <td><b>Client ID: </b></td><td><?php echo $client_id?></td>
        </tr>
        <tr>
            <td><b>Property ID: </b></td><td><?php echo $property_id ?></td>
        </tr>
        <tr>
            <td><b>Full Name: </b></td><td><?php echo $first_name ?> <?php echo $middle_name ?> <?php echo $last_name ?> <?php echo $suffix_name ?></td>
        </tr>
        <tr>
            <td><b>Account Status: </b></td><td><?php echo $acc_status ?></td>
        </tr>
        <tr>
            <td><b>Date of Sale: </b></td><td><?php echo $dos ?></td>
        </tr>

    </table>
    <div class="row-xs-3"> 
        <table style="width:100%">
            <tr>
                <td>
                    <button type="button" style="width:100%;font-size:14px;" class="btn btn-flat btn-secondary" data-dismiss="modal" style="font-size:14px;"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close</button>
                </td>
            </tr>
        </table>
    </div>
    </div>
	</div>
</div>
