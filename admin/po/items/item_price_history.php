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
<button id="export-btn">Export to Excel</button>

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
document.getElementById('export-btn').addEventListener('click', function() {
    // Define the table element to be exported
    var table = document.querySelector('#item-table');

    // Create a new Workbook
    var wb = XLSX.utils.book_new();
    
    // Convert the table to a worksheet and add it to the Workbook
    var ws = XLSX.utils.table_to_sheet(table);
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    // Generate the Excel file as a Blob
    var blob = XLSX.write(wb, { bookType: 'xlsx', type: 'blob' });

    // Create a download link and trigger the download
    var url = window.URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'exported_data.xlsx';0
    a.style.display = 'none';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
});
</script>
