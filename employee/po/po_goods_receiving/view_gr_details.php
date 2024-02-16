
<?php
require_once('../../../config.php');
if (isset($_GET['id'])) {
    $gr_id = $_GET['id'];
    $qry = $conn->query("SELECT * from approved_order_items where gr_id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
    echo "<b>GR #: </b><i> $gr_id</i>";
}
?>
<style>
    .table-container {
        width: 100%;
        overflow-x: auto; 
    }

    .table {
        width: 100%;
        margin-bottom: 0; 
    }
</style>
<br>
<b>Date Received: </b><i><?php echo $formatted_date = date('F j, Y', strtotime($date_purchased)); ?></i>
<br>
<div class="table-container">
    <table class="table table-striped table-hover table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th style="width:25%">Item Name</th>
                <th style="width:25%">Unit of Measurement</th>
                <th style="width:15%">Unit Price</th>
                <th style="width:15%">Quantity</th>
                <th style="width:15%">Total # of Prev Delivered Items</th>
                <th style="width:15%"># of Delivered Items</th>
                <th style="width:20%">Outstanding</th>
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
                <td style="width:25%;"><?php echo $row["name"] ?></td>
                <td><?php echo $row["default_unit"] ?></td>
                <td><?php echo number_format($row["unit_price"]) ?></td>
                <td><?php echo $row["quantity"] ?></td>
                <td><?php echo ($row["quantity"] - $row["outstanding"]) - $row["del_items"] ?></td>
                <td><?php echo $row["del_items"] ?></td>
                <td><?php echo $row["outstanding"] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<!-- 
<?php
foreach ($totalReceivedPerItem as $itemName => $totalReceived) {
    echo "Total Received for $itemName: $totalReceived<br>";
}
?> -->






