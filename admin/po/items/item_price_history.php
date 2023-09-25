<?php
require_once('./../../../config.php');
if (isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $item_name = $_GET['name'];
    $qry = $conn->query("SELECT * from approved_order_items where item_id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
    echo "<b>Item Name: </b> <i style='background-color: yellow;padding-left:25px;padding-right:25px;'>$item_name</i>";

} else {

    echo "ITEM ID not provided in the URL.";
}
?>
<br><br>
<table class="table table-striped table-hover table-bordered" style="width: 100%">
    <thead>
        <tr>
            <th>Unit Price</th>
            <th>Date Purchased</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $i = 1;
    $id = $_GET['id']; 
    $query = "SELECT aoi.default_unit, aoi.unit_price, MAX(aoi.date_purchased) AS recent_date_purchased, i.name
    FROM `approved_order_items` aoi
    INNER JOIN `item_list` i ON aoi.item_id = i.id
    WHERE aoi.item_id = '$id'
    GROUP BY aoi.default_unit, aoi.unit_price, i.name
    ORDER BY recent_date_purchased DESC, aoi.unit_price DESC;
    ";
    $qry = $conn->query($query);

    while ($row = $qry->fetch_assoc()):
    ?>
        <tr>
            <td><?php echo number_format($row["unit_price"], 2, '.', ',') ?></td>
            <td><?php echo date("F j, Y", strtotime($row["recent_date_purchased"])); ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
