
<?php
require_once('./../../../config.php');
if (isset($_GET['id'])) {
    $gr_id = $_GET['id'];
    $qry = $conn->query("SELECT * from approved_order_items where gr_id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
    echo "GR #: " . $gr_id;
} else {

    echo "GR ID not provided in the URL.";
}
?>
<br>
Date Received: <?php echo $formatted_date = date('F j, Y', strtotime($date_purchased)); ?>
<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
    <thead>
        <tr>
            <th>Item Name</th>
            <th>Default Unit</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Total # of Prev Delivered Items</th>
            <th># of Current Delivered Items</th>
            <th>Current Outstanding</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $i = 1;
    $id = $_GET['id']; 
    $query = "SELECT aoi.default_unit, aoi.unit_price, aoi.quantity, aoi.outstanding, aoi.del_items, aoi.received, il.name
        FROM approved_order_items AS aoi
        INNER JOIN item_list AS il ON aoi.item_id = il.id
        WHERE aoi.gr_id = '$id'";
    $qry = $conn->query($query);
    //$totalReceivedPerItem = array();

    while ($row = $qry->fetch_assoc()):
        $itemName = $row["name"];
        $quantity = $row["quantity"];
        $outstanding = $row["outstanding"];

        // if (!isset($totalReceivedPerItem[$itemName])) {
        //     $totalReceivedPerItem[$itemName] = 0;
        // }

        //$totalReceivedPerItem[$itemName] = $quantity - $outstanding;
    ?>
        <tr>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["default_unit"] ?></td>
            <td><?php echo $row["unit_price"] ?></td>
            <td><?php echo $row["quantity"] ?></td>
            <td><?php echo ($row["quantity"] - $row["outstanding"]) - $row["del_items"] ?></td>
            <td><?php echo $row["del_items"] ?></td>
            <td><?php echo $row["outstanding"] ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<!-- 
<?php
foreach ($totalReceivedPerItem as $itemName => $totalReceived) {
    echo "Total Received for $itemName: $totalReceived<br>";
}
?> -->






