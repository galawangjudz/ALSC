<?php
require_once('./../../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT i.*, o_approved.date_purchased, o_approved.item_id, o_approved.unit_price FROM `item_list` AS i LEFT JOIN `approved_order_items` AS o_approved ON i.id = o_approved.item_id WHERE i.id = {$_GET['id']} ORDER BY o_approved.date_purchased DESC LIMIT 1");
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
                    <td><b>Item Name:</b></dt></td>
                    <td><b><?php echo $name ?></b></dd></td>
                </tr>
                <tr>
                    <td><b>Description:</b></td>
                    <td><?php echo $description ?></td>
                </tr>
                <tr>
                    <td><b>Unit of Measurement:</b></td>
                    <td><?php echo $default_unit ?></td>
                </tr>
                <tr>
                    <td><b>Last Date Purchased:</b></td>
                    <td>
                        <?php
                        if (!empty($date_purchased)) {
                            echo date("F j, Y", strtotime($date_purchased));
                        } else {
                            echo "<span class='badge badge-primary'>Not yet purchased</span>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Last Purchased Price:</b></td>
                    <td>
                        <?php 
                    if(!empty($unit_price)) {
                        echo number_format($unit_price, 2, '.', ','); 
                    }else{
                        echo "<span class='badge badge-secondary'>0</span>";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td><b>Status:</b></td>
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