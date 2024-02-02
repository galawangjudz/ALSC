<?php 
require_once('./../../../config.php');
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$username = $_settings->userdata('username');
$usertype = $_settings->userdata('user_type');
?>
<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $user = $conn->query("SELECT g.*,o.* from tbl_gr_list g INNER JOIN approved_order_items o on g.gr_id = o.gr_id where g.po_id = '{$_GET['id']}'");
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
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
<body onload="lcp()">
<div class="card card-outline rounded-0 card-maroon">
<table class="table table-striped table-hover table-bordered" style="width: 100%">
            <thead>
                <tr>
                    <th>GR #</th>
                    <th>Remaining Balance</th>
                    <th>Date/Time Received</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            $qry = $conn->query("SELECT o.date_purchased,g.doc_no,g.gr_id, g.po_id, SUM(o.outstanding * o.unit_price) AS total_amount
                                FROM tbl_gr_list g
                                INNER JOIN approved_order_items o ON g.gr_id = o.gr_id
                                WHERE g.po_id = '{$_GET['id']}'
                                GROUP BY g.gr_id, g.po_id");
            while ($row = $qry->fetch_assoc()):
            ?>
            <tr>
                <!-- <td>
                    <a class="basic-link view_gr" data-id="<?php echo $row['gr_id'] ?>" data-po-id="<?php echo $row['po_id'] ?>">GR - <?php echo $row['gr_id'] ?></a>
                </td> -->
                <td>
                    <a data-id="<?php echo $row['gr_id'] ?>" data-po-id="<?php echo $row['po_id'] ?>">GR - <?php echo $row['gr_id'] ?></a>
                </td>
                <td><?php echo number_format($row['total_amount']) ?></td>
                <td><?php echo $row["date_purchased"] ?></td>
                <td align="center">
                    <!-- <div class="dropdown-menu" role="menu"> -->
                        <a class="basic-link view_gr" data-id="<?php echo $row['gr_id'] ?>" data-po-id="<?php echo $row['po_id'] ?>" style="cursor:pointer;"><span class="fa fa-solid fa-info"></span> View Details</a>
                        <!-- <div class='dropdown-divider'></div> -->
                        <?php
                            $docNoValue = $row['doc_no'];
                        ?>
                        <!-- <a class="dropdown-item gl_data" href="javascript:void(0)" data-id="<?php echo $docNoValue; ?>"><span class="fa fa-file-export"></span> View GL Journal Entries for this Delivery</a> -->
                    <!-- </div> -->
                </td>
            </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
</div>

</body>
<script>
    $(document).ready(function(){
		$('.gl_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=fm_goods_receiving/gl_trans&id=' + dataId;
			window.location.href = redirectUrl;
			
		})
	});
$('.view_gr').click(function(){
    var grId = $(this).attr('data-id');
    var poId = $(this).data('po-id'); 

    uni_modal_right("<i class='fa fa-info'></i> GR Details", 'fm_goods_receiving/view_gr_details.php?id=' + grId + '&po_id=' + poId, "mid-large");
});


</script>