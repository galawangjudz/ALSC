<?php
require_once('./../../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT g.*,o.* from tbl_gr_list g INNER JOIN approved_order_items o on g.gr_id = o.gr_id where g.po_id = '{$_GET['id']}' ");
    while($row=$qry->fetch_assoc()){
        $gr_id = $row['gr_id'];
        $po_id = $row['po_id'];
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container fluid">
    <div class="card-header">
        <b><i><?php echo $po_id; ?></i></b>
        <b><i><?php echo $gr_id; ?></i></b>
    </div>
    <table class="table table-bordered table-stripped" style="text-align:center;font-size:14px;">
        <thead>
            <tr>
                <th>G.R. #</th>
                <th>Remaining Balance</th>
                <th>Date/Time Purchased</th>

            </tr>
        </thead>
        <tbody>
        <?php 
        $i = 1;
        $qry = $conn->query("SELECT o.date_purchased,g.gr_id, g.po_id, SUM(o.outstanding * o.unit_price) AS total_amount
                            FROM tbl_gr_list g
                            INNER JOIN approved_order_items o ON g.gr_id = o.gr_id
                            WHERE g.po_id = '{$_GET['id']}'
                            GROUP BY g.gr_id, g.po_id");
        while ($row = $qry->fetch_assoc()):
        ?>
        <tr>
            <td>
                <a class="basic-link view_gr" data-id="<?php echo $row['gr_id'] ?>"><?php $_GET['id'] ?></a>
            </td>
            <td><?php echo number_format($row['total_amount'],2) ?></td>
            <td><?php echo $row["date_purchased"] ?></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script>
$('.view_gr').click(function(){
    uni_modal_right("<i class='fa fa-info'></i> GR Details", 'po/goods_receiving/view_gr_details.php?id='+$(this).attr('data-id'), "mid-large");
});


</script>