<?php
include "db_config.php";
$category_id = $_POST["category_id"];
$result = mysqli_query($conn, "SELECT * FROM categories where parent_id = $category_id");
?>
<option value="">Select Sub Category</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    ?>
    <option value="<?php echo $row["id"]; ?>"><?php echo $row["category"]; ?></option>
    <?php
}
?>