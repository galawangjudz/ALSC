<?php
require_once('./../../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `item_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container fluid">
    <callout class="callout-primary">
        <dl class="row">
            <table class="table table-bordered">
                <tr>
                    <td>Item Name:</dt></td>
                    <td><?php echo $name ?></dd></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><?php echo $description ?></td>
                </tr>
                <tr>
                    <td>Available Unit/s:</td>
                    <td><?php echo $default_unit ?></td>
                </tr>
                <tr>
                    <td>Last Date Canvassed:</td>
                    <td><?php echo date("F j, Y",strtotime($last_date_canvassed)) ?></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <?php if($status == 1): ?>
                            <span class="badge badge-success">Active</span>
                        <?php else: ?>
                            <span class="badge badge-secondary">Inactive</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </dl>
    </callout>
    <table style="width:100%;">
        <tr>
            <td>
                <button class="btn btn-dark btn-flat btn-default" type="button" style="width:100%; margin-left:5px;font-size:14px;" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </td>
        </tr>
    </table>
</div>