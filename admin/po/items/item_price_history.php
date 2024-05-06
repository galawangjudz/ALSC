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
}
?>
<br><br>
<button id="export-csv-btn" class="btn btn-success btn-sm"><i class="fas fa-file-export"></i> Export</button>
<br><br>
<table class="table table-striped table-hover table-bordered" style="width: 100%" id="item-table">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>

document.getElementById('export-csv-btn').addEventListener('click', function() {
    var itemName = "<?php echo $item_name; ?>";
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();

    var table = document.querySelector('#item-table');
    var rows = table.querySelectorAll('tr');
    var csvContent = "data:text/csv;charset=utf-8,";

    csvContent += itemName + " Purchase History as of " + formattedDate + "\n";

    rows.forEach(function(row) {
    var headerCols = row.querySelectorAll('th');
    var dataCols = row.querySelectorAll('td');
    
    var headerData = [];
    var dataRow = [];

    headerCols.forEach(function(col) {
        headerData.push(col.innerText);
    });

    dataCols.forEach(function(col) {
        dataRow.push(col.innerText);
    });

    var csvHeader = headerData.join('|');
    var csvDataRow = dataRow.join('|');
    
    csvContent += csvHeader + "\n";
    csvContent += csvDataRow
});
    var encodedUri = encodeURI(csvContent);
    var link = document.createElement('a');
    link.setAttribute('href', encodedUri);

    link.setAttribute('download', itemName + '_PurchaseHistory_asof_' + formattedDate + '.csv');

    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>
