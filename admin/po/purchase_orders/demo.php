

<?php require("config.php"); 

$sql_supplier = "SELECT id, name FROM supplier_list;";
$result = mysqli_query($conn, $sql_supplier);
$suppliers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jumbled Words Unscramble Game (HTML, CSS, and JS) Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
    function getItem(item_code) {
    console.log("Opening XMLHttpRequest with URL: get_states.php?item_code=" + item_code); 
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "/ALSC/admin/po/purchase_orders/get_items.php?item_code=" + item_code, true);

    xhr.onreadystatechange = function() {
        console.log("ReadyState: " + xhr.readyState); 
        console.log("Status: " + xhr.status); 

        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Item Information:\n" + xhr.responseText);
            console.log("Request completed successfully");

            var items = JSON.parse(xhr.responseText);

            var itemDropdown = document.getElementById("item");

            itemDropdown.innerHTML = "<option value=''>Select Item</option>";

            itemDropdown.disabled = false;

            items.forEach(item => {
                var option = document.createElement("option");
                option.value = item.id;
                option.text = item.name;
                itemDropdown.appendChild(option);
            });
        }
    };
    
    xhr.send();
}

</script>
</head>
<body>
    <!-- Main -->
    <div class="container" style="max-width:800px">
        <?php if(!isset($_GET['iframe'])){?>
            <div class="text-center mb-5">
                <h1 class="fw-bolder mb-0">Dynamic Dependent Dropdown List<br>(JavaScript, PHP and MySQL)</h1>
                <p><a href="https://www.w3schools.in/" target="_blank">w3schools.in</a></p>
            </div>
        <?php } ?>
        <div class="card shadow-sm">
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="supplier_id">Supplier:</label>
						<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2" onchange="getItem(this.value)">
							<option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
							<?php 
							$supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
							while ($row = $supplier_qry->fetch_assoc()):
								$vatable = $row['vatable'];
							?>
							<option 
								value="<?php echo $row['id'] ?>" 
								data-vatable="<?php echo $vatable ?>"
								<?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> 
							><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
						<label for="item" class="form-label" aria-label="Default select example">Item</label>
                        <select id="item" name="item" class="form-select form-select-lg" disabled>
                            <option value="">Select Item</option>
                        </select>
                </form>
            </div>
        </div>
    </div>
</body>
</html>