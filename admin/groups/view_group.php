<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `group_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <table class="table table-striped table-hover table-bordered" id="data-table">
        <tr>
            <td>
                <b>Group:</b>
            </td>
            <td>
                <?= isset($name) ? $name : '' ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Description:</b>
            </td>
            <td>
                <?= isset($description) ? ($description) : '' ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Group Type:</b>
            </td>
            <td>
                <?= isset($type) ? ($type == 1 ? 'Debit' : 'Credit') : 'N/A' ?>
            </td>
        </tr>
        <tr>
            <td>
                <b>Status:</b>
            </td>
            <td>
                <?php 
                $status = isset($status) ? $status : 0;
                    switch($status){
                        case 0:
                            echo '<span class="badge badge-danger bg-gradient-danger rounded-pill" style="font-size:14px;width:50%;">Inactive</span>';
                            break;
                        case 1:
                            echo '<span class="badge badge-primary bg-gradient-primary rounded-pill" style="font-size:14px;width:50%;">Active</span>';
                            break;
                        default:
                            echo '<span class="badge badge-default border rounded-pill" style="font-size:14px;width:50%;">N/A</span>';
                                break;
                    }
                ?>
            </td>
        </tr>
    </table>
        
    <div>
        <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal" style="width:100%;font-size:14px;"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
    </div>
</div>