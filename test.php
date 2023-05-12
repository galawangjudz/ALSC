<table id="my-table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Example loop to generate table rows
    for ($i = 1; $i <= 5; $i++) {
    ?>
    <tr id="row-<?php echo $i; ?>">
      <td><?php echo $i; ?></td>
      <td>John Doe <?php echo $i; ?></td>
      <td><button onclick="getTableRowId(<?php echo $i; ?>)">Get ID</button></td>
      <td><input type="text" id="test" name="test"></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<script>
function getTableRowId(rowNum) {
  // Get the row element by concatenating the ID string with the row number
  var row = document.getElementById("row-" + rowNum);
  
  // Get the ID attribute of the row element
  var rowId = row.getAttribute("id");
  
  // Log the row ID to the console
  document.getElementById("test").value=rowId;
}
</script>
