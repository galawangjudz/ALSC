<?php
require_once('../../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM property_clients WHERE client_id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <table class="table table-bordered" id="data-table">
        <tr>
            <td style="width: 200px;">
            <?php 
                $buyer_qry = $conn->query("SELECT i.*, x.* FROM property_clients i LEFT JOIN family_members x ON i.client_id = x.client_id WHERE i.client_id = '{$_GET['id']}'");
                if($buyer_qry->num_rows > 0){
                ?>
                <b>Principal Buyer:</b>
                <?php }else{ ?>
                    <b>Name:</b>
            <?php }?>
            </td>
            <td>
                <b><?php echo $last_name; ?>, <?php echo $first_name; ?> <?php echo $middle_name; ?> <?php echo $suffix_name; ?></b>
            </td>
        </tr>
        <tr>
            <?php 
            $counter = 2;
            $fam_qry = $conn->query("SELECT i.*, x.* FROM property_clients i INNER JOIN family_members x ON i.client_id = x.client_id WHERE i.client_id = '{$_GET['id']}'");
            echo $conn->error;
            while($row = $fam_qry->fetch_assoc()):
            ?>
            <td style="width: 200px;">
                <b>Buyer <?php echo $counter; ?>:</b>
            </td>
            <td>
                <?php echo $row['last_name']; ?>, <?php echo $row['first_name'] ?> <?php echo $row['middle_name'] ?> <?php echo $row['suffix_name'] ?>
            </td>
        </tr>
        <?php 
        $counter++;
        endwhile; ?>
    </table>
    <?php 
        $buyer_qry = $conn->query("SELECT i.*, x.* FROM property_clients i LEFT JOIN family_members x ON i.client_id = x.client_id WHERE i.client_id = '{$_GET['id']}'");
        if($buyer_qry->num_rows > 1){
        ?>
        <b><div style="text-align:center;">Principal Buyer's Information</div></b>
    <?php } ?>
    <table class="table table-bordered" id="data-table">
        <tr>
            <td style="width: 200px;">
                <b>Address:</b>
            </td>
            <td>
                <?= isset($address) ? html_entity_decode($address) : '' ?>, <?= isset($zip_code) ? $zip_code : '' ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">
                <b>Contact Number:</b>
            </td>
            <td>
                <?= isset($contact_no) ? html_entity_decode($contact_no) : '' ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">
                <b>Email Address:</b>
            </td>
            <td>
                <?= isset($email) ? html_entity_decode($email) : '' ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">
                <b>Status:</b>
            </td>
            <td>
                <?php 
                $status = isset($c_active) ? $c_active : 0;
                    switch($status){
                        case 0:
                            echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>';
                            break;
                        case 1:
                            echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Active</span>';
                            break;
                        default:
                            echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
                                break;
                    }
                ?>
            </td>
        </tr>
    </table>
</div>
