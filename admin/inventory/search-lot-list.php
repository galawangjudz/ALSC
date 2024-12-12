<?php if ($_settings->chk_flashdata('success')): ?>
<script>
    alert_toast("<?php echo $_settings->flashdata('success'); ?>", 'success');
</script>
<?php endif; ?>

<?php
if (isset($_POST['clear'])) {
    // Clear POST data after form is cleared
    unset($_POST);
}

$l_site = 0;

$is_searched = isset($_POST['search_location']); // Flag to check if search was performed

if ($is_searched) {
    $c_acronym = $_POST['c_acronym'];
    $c_block = $_POST['c_block'];
    $c_lot = $_POST['c_lot'];

    // Use parameterized queries for security
    $qry = odbc_prepare($conn2, "
        SELECT 
            l.c_lid AS c_lid, 
            p.c_acronym AS c_acronym, 
            l.c_site AS c_site,
            l.c_block AS c_block, 
            l.c_remarks AS lot_c_remarks, 
            l.c_lot AS c_lot, 
            l.c_lot_area, 
            l.c_price_sqm, 
            l.c_status AS lot_status,
            h.c_lid AS house_c_lid,
            h.c_house_model,
            h.c_floor_area,
            h.c_h_price_sqm,
            h.c_status AS house_status,
            h.c_unit_status,
            h.c_remarks AS house_remarks
        FROM t_lots l
        JOIN t_projects p ON l.c_site = p.c_code
        LEFT JOIN t_house h 
            ON l.c_site = h.c_site 
           AND l.c_block = h.c_block 
           AND l.c_lot = h.c_lot
        WHERE p.c_acronym = ?
          AND l.c_block = ?
          AND l.c_lot = ?
        ORDER BY p.c_acronym, l.c_block, l.c_lot, h.c_lid ASC
    ");

    // Execute the query with parameters
    if (odbc_execute($qry, [$c_acronym, $c_block, $c_lot])) {
        if ($row = odbc_fetch_array($qry)) {
            // Populate the form with values from the query result
            // Lot details
            $l_lid = $row['c_lid'];
            $l_site = $row['c_site'];
            $l_acronym = $row['c_acronym'];
            $l_block = $row['c_block'];
            $l_lot = $row['c_lot'];
            $l_status = $row['lot_status'];
            $l_lot_area = $row['c_lot_area'];
            $l_price_sqm = $row['c_price_sqm'];
            $l_lcp = $row['c_lot_area'] * $row['c_price_sqm'];
            $l_remarks = $row['lot_c_remarks'];

            // House details (if available)
            $h_lid = $row['house_c_lid'];
            $h_house_model = $row['c_house_model'];
            $h_floor_area = $row['c_floor_area'];
            $h_price_sqm = $row['c_h_price_sqm'];
            $h_hcp = $row['c_floor_area'] * $row['c_h_price_sqm'];
            $h_status = $row['house_status'];
            $h_unit_status = $row['c_unit_status'];
            $h_remarks = $row['house_remarks'];
        } else {
            $error_message = "No results found for the selected location.";
        }
    } else {
        $error_message = "Query execution failed.";
    }

    // Fetch house lids, house models, and c_model by joining with t_model_house
    $query_house_lids = "
    SELECT h.c_lid, h.c_house_model, m.c_model 
    FROM t_house h
    LEFT JOIN t_model_house m ON h.c_house_model = m.c_acronym
    WHERE h.c_site = ? AND h.c_block = ? AND h.c_lot = ?
    ORDER BY h.c_lid ASC";
    $stmt = odbc_prepare($conn2, $query_house_lids);
    odbc_execute($stmt, [$l_site, $c_block, $c_lot]);

    // Fetch house lids, house models, and c_model into an array
    $house_lids = [];
    while ($row = odbc_fetch_array($stmt)) {
    $house_lids[] = [
        'c_lid' => $row['c_lid'],
        'c_house_model' => $row['c_house_model'],
        'c_model' => $row['c_model']
    ];
    }

}
?>

<style>
	.main_menu{
		float:left;
		width:227px;
		height:40px;
		line-height:40px;
		text-align:center;
		color:black!important;
		border-right:solid 3px white;
	}
	.main_menu:hover{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color:transparent;
    }
    #search-lot-link{
		border-bottom: solid 2px blue;
        background-color:#E8E8E8;
	}
	#lot-link{
		border-bottom: solid 2px blue;
        background-color:#E8E8E8;
	}
    .nav-inventory{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-inventory:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }

    .find-btn {
        width: 100%;
        height: 38px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 32px;
    }

    .other-btn {
        width: 100%;
        height: 38px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

</style>

<div class="card" id="container">
    <div class="navbar-menu">
        <a href="<?php echo base_url ?>admin/?page=inventory/search-lot-list" class="main_menu" id="search-lot-link">
            <i class="nav-icon fas fa-search"></i>&nbsp;&nbsp;&nbsp;Search Lot
        </a>
        <a href="<?php echo base_url ?>admin/?page=inventory/lot-list" class="main_menu" id="lot-link">
            <i class="nav-icon fas fa-square"></i>&nbsp;&nbsp;&nbsp;Lot Inventory
        </a>
        <a href="<?php echo base_url ?>admin/?page=inventory/model-list" class="main_menu" id="model-link">
            <i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;House Model List
        </a>
        <a href="<?php echo base_url ?>admin/?page=inventory/project-list" class="main_menu" id="project-link">
            <i class="nav-icon fas fa-map"></i>&nbsp;&nbsp;&nbsp;Project List
        </a>
    </div>
</div>

<!-- Lot Search Card -->
<div class="card card-outline" style="margin-bottom:20px;">
    <div class="card-header">
        <h5 class="card-title"><b><i>Search Location</i></b></h5>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="row">
                <div class="col-md-3">
                    <!-- Dropdown for ACRONYM -->
                    <div class="form-group">
                        <label for="c_acronym">Project</label>
                        <select class="form-control" name="c_acronym" id="c_acronym" required>
                            <option value="" disabled selected>Select Project</option>
                            <?php
                            // Fetch project acronyms for dropdown
                            $project_qry = odbc_exec($conn2, "SELECT DISTINCT c_acronym FROM t_projects ORDER BY c_acronym");
                            while ($proj = odbc_fetch_array($project_qry)): ?>
                                <option value="<?php echo $proj['c_acronym']; ?>" <?php echo isset($_POST['c_acronym']) && $_POST['c_acronym'] === $proj['c_acronym'] ? 'selected' : ''; ?>>
                                    <?php echo $proj['c_acronym']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- Input for Block -->
                    <div class="form-group">
                        <label for="c_block">Block</label>
                        <input type="number" class="form-control" name="c_block" id="c_block" placeholder="Enter Block" value="<?php echo isset($_POST['c_block']) ? $_POST['c_block'] : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- Input for Lot -->
                    <div class="form-group">
                        <label for="c_lot">Lot</label>
                        <input type="number" class="form-control" name="c_lot" id="c_lot" placeholder="Enter Lot" value="<?php echo isset($_POST['c_lot']) ? $_POST['c_lot'] : ''; ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <!-- Find Button -->
                    <div class="form-group">
                        <button type="submit" name="search_location" class="btn btn-primary btn-block find-btn">
                            <i class="fas fa-search"></i> Find Location
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-block other-btn delete-lot" data-lot-id="<?php echo $row['c_lid']; ?>">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <button type="button" id="edit-btn" class="btn btn-warning other-btn">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <!-- Clear Button -->
                        <button type="button" id="clear-btn" class="btn btn-secondary btn-block other-btn">
                            <i class="fas fa-eraser"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Alert Message When Location not found -->
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger mt-4" id="errorAlert" role="alert">
                <?php echo $error_message; ?>
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('errorAlert').style.display = 'none';
                }, 3000);
            </script>
        <?php endif; ?>

    </div>
</div>

<form name="save-lot" id="manage-lot">
<div class="row">
    <!-- Lot Details Card -->
    <div class="col-12 col-md-6">
        <div class="card card-outline" style="width: 100%; margin-bottom: 30px;">
            <div class="card-header">
                <h5 class="card-title"><b><i>Lot Details</i></b></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Project -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="project" class="form-label" style="width: 150px;">Project</label>
                            <select class="form-control" name="project" id="project" required 
                                <?php echo $is_searched ? 'disabled' : ''; ?>>
                                <option value="" disabled selected>Select Project</option>
                                <?php
                                $project_qry = odbc_exec($conn2, "SELECT DISTINCT c_acronym FROM t_projects ORDER BY c_acronym");
                                while ($proj = odbc_fetch_array($project_qry)): ?>
                                    <option value="<?php echo $proj['c_acronym']; ?>" <?php echo isset($_POST['c_acronym']) && $_POST['c_acronym'] === $proj['c_acronym'] ? 'selected' : ''; ?>>
                                        <?php echo $proj['c_acronym']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Block -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="block" class="form-label" style="width: 150px;">Block</label>
                            <input type="text" class="form-control" name="block" id="block" 
                                value="<?php echo isset($l_block) ? $l_block : '' ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- Lot -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="lot" class="form-label" style="width: 150px;">Lot</label>
                            <input type="text" class="form-control" name="lot" id="lot" 
                                value="<?php echo isset($l_lot) ? $l_lot : '' ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- Lot Area -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="lot_area" class="form-label" style="width: 150px;">Lot Area</label>
                            <input type="text" class="form-control" name="lot_area" id="lot_area" 
                                value="<?php echo isset($l_lot_area) ? number_format($l_lot_area, 1) : '' ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- Price/sqm -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="price_sqm" class="form-label" style="width: 150px;">Price/sqm</label>
                            <input type="text" class="form-control" name="price_sqm" id="price_sqm" 
                                value="<?php echo isset($l_price_sqm) ? number_format($l_price_sqm, 2) : '' ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- LCP -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="lcp" class="form-label" style="width: 150px;">LCP</label>
                            <input type="text" class="form-control" name="lcp" id="lcp" 
                                value="<?php echo isset($l_lcp) ? number_format($l_lcp, 2) : '' ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="status" class="form-label" style="width: 150px;">Status</label>
                            <select class="form-control" name="status" id="status" <?php echo $is_searched ? 'disabled' : ''; ?>>
                                <option value="">Select Status</option>
                                <option value="Available" <?php echo isset($l_status) && $l_status == 'Available' ? 'selected' : ''; ?>>Available</option>
                                <option value="Reserved" <?php echo isset($l_status) && $l_status == 'Reserved' ? 'selected' : ''; ?>>Reserved</option>
                                <option value="Pre-Reserved" <?php echo isset($l_status) && $l_status == 'Pre-Reserved' ? 'selected' : ''; ?>>Pre-Reserved</option>
                                <option value="Sold" <?php echo isset($l_status) && $l_status == 'Sold' ? 'selected' : ''; ?>>Sold</option>
                                <option value="Packaged" <?php echo isset($l_status) && $l_status == 'Packaged' ? 'selected' : ''; ?>>Packaged</option>
                                <option value="On Hold" <?php echo isset($l_status) && $l_status == 'On Hold' ? 'selected' : ''; ?>>On Hold</option>
                            </select>
                        </div>

                        <!-- Lot ID -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="lid" class="form-label" style="width: 150px;">Lot ID</label>
                            <input type="text" class="form-control" name="lid" id="lid" 
                                value="<?php echo isset($l_lid) ? $l_lid : '' ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- Remarks -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="remarks" class="form-label" style="width: 150px;">Remarks</label>
                            <textarea class="form-control" name="remarks" id="remarks" rows="4" 
                                    <?php echo $is_searched ? 'readonly' : ''; ?>><?php echo isset($l_remarks) ? $l_remarks : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- House Details Card -->
    <div class="col-12 col-md-6">
        <div class="card card-outline" style="width: 100%; margin-bottom: 30px;">
            <div class="card-header">
                <h5 class="card-title"><b><i>House Details</i></b></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <!-- House Lid -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="house_lid" class="form-label" style="width: 150px;">Selection</label>
                            <select name="house_lid" id="house_lid" class="form-control">
                                <?php
                                // Fetch house lids, house models, and c_model from the database
                                foreach ($house_lids as $house) {
                                    echo "<option value=\"{$house['c_lid']}\" " . ($h_lid == $house['c_lid'] ? 'selected' : '') . ">[{$house['c_house_model']}]  {$house['c_model']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <hr style="border-top: 1px solid #ccc; margin-bottom: 52px;">

                        <!-- House Model -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_house_model" class="form-label" style="width: 150px;">House Model</label>
                            <select class="form-control" name="h_house_model" id="h_house_model" 
                                <?php echo $is_searched ? 'disabled' : ''; ?>>
                                <option value="" disabled selected>Select Model</option>
                                <?php
                                $house_model_qry = odbc_exec($conn2, "SELECT c_acronym, c_model FROM t_model_house ORDER BY c_model");
                                while ($house_model = odbc_fetch_array($house_model_qry)): ?>
                                    <option value="<?php echo $house_model['c_acronym']; ?>" 
                                        <?php echo isset($h_house_model) && $h_house_model === $house_model['c_acronym'] ? 'selected' : ''; ?>>
                                        <?php echo $house_model['c_model']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- House Floor Area -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_floor_area" class="form-label" style="width: 150px;">Floor Area</label>
                            <input type="text" class="form-control" name="h_floor_area" id="h_floor_area" 
                                value="<?php echo isset($h_floor_area) ? number_format(round($h_floor_area, 2), 2) : ''; ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- House Price/sqm -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_price_sqm" class="form-label" style="width: 150px;">Price/sqm</label>
                            <input type="text" class="form-control" name="h_price_sqm" id="h_price_sqm" 
                                value="<?php echo isset($h_price_sqm) ? number_format($h_price_sqm, 2) : ''; ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- House HCP -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_hcp" class="form-label" style="width: 150px;">H C P</label>
                            <input type="text" class="form-control" name="h_hcp" id="h_hcp" 
                                value="<?php echo isset($h_hcp) ? number_format($h_hcp, 2) : ''; ?>" 
                                <?php echo $is_searched ? 'readonly' : ''; ?>>
                        </div>

                        <!-- House Status -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_status" class="form-label" style="width: 150px;">Status</label>
                            <select class="form-control" name="h_status" id="h_status" <?php echo $is_searched ? 'disabled' : ''; ?>>
                                <option value="">Select Status</option>
                                <option value="Available" <?php echo isset($h_status) && $h_status == 'Available' ? 'selected' : ''; ?>>Available</option>
                                <option value="Reserved" <?php echo isset($h_status) && $h_status == 'Reserved' ? 'selected' : ''; ?>>Reserved</option>
                                <option value="Pre-Reserved" <?php echo isset($h_status) && $h_status == 'Pre-Reserved' ? 'selected' : ''; ?>>Pre-Reserved</option>
                                <option value="Sold" <?php echo isset($h_status) && $h_status == 'Sold' ? 'selected' : ''; ?>>Sold</option>
                                <option value="Packaged" <?php echo isset($h_status) && $h_status == 'Packaged' ? 'selected' : ''; ?>>Packaged</option>
                                <option value="On Hold" <?php echo isset($h_status) && $h_status == 'On Hold' ? 'selected' : ''; ?>>On Hold</option>
                            </select>
                        </div>

                        <!-- House Unit Status -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_unit_status" class="form-label" style="width: 150px;">Unit Status</label>
                            <select class="form-control" name="h_unit_status" id="h_unit_status" <?php echo $is_searched ? 'disabled' : ''; ?>>
                                <option value="">Select Status</option>
                                <option value="For Approval" <?php echo isset($h_unit_status) && $h_unit_status == 'For Approval' ? 'selected' : ''; ?>>For Approval</option>
                                <option value="For Construction" <?php echo isset($h_unit_status) && $h_unit_status == 'For Construction' ? 'selected' : ''; ?>>For Construction</option>
                                <option value="For Costing" <?php echo isset($h_unit_status) && $h_unit_status == 'For Costing' ? 'selected' : ''; ?>>For Costing</option>
                                <option value="For Refurbish" <?php echo isset($h_unit_status) && $h_unit_status == 'For Refurbish' ? 'selected' : ''; ?>>For Refurbish</option>
                                <option value="Ready for Occupancy" <?php echo isset($h_unit_status) && $h_unit_status == 'Ready for Occupancy' ? 'selected' : ''; ?>>Ready for Occupancy</option>
                            </select>
                        </div>

                        <!-- House Remarks -->
                        <div class="form-group mb-3 d-flex align-items-center">
                            <label for="h_remarks" class="form-label" style="width: 150px;">Remarks</label>
                            <textarea class="form-control" name="h_remarks" id="h_remarks" rows="4" 
                                    <?php echo $is_searched ? 'readonly' : ''; ?>><?php echo isset($h_remarks) ? $h_remarks : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary" id="echoButton">Echo Form Data</button>
</form>

<div id="formOutput" style="margin-top: 20px;"></div>

<script>
document.getElementById('echoButton').addEventListener('click', function() {
    // Gather all form elements
    const formElements = document.forms['save-lot'].elements;
    
    let formData = '';
    // Loop through the form elements to get their values
    for (let i = 0; i < formElements.length; i++) {
        const element = formElements[i];
        if (element.type !== 'button' && element.type !== 'submit') {
            formData += `<strong>${element.name}</strong>: ${element.value}<br>`;
        }
    }

    // Display the data in the div
    document.getElementById('formOutput').innerHTML = formData;
});
</script>


<script>
    $(document).ready(function() {
        // Trigger house details fetch when a new house lid is selected
        $('#house_lid').change(function() {
            fetchHouseDetails();
        });
    });

    function fetchHouseDetails() {
    var houseLid = $('#house_lid').val();
    console.log("Selected House Lid: ", houseLid); // Debugging line

    // Empty fields if no House Lid is selected
    if (!houseLid) {
        $('#h_house_model').val('');
        $('#h_floor_area').val('');
        $('#h_price_sqm').val('');
        $('#h_status').val('');
        $('#h_unit_status').val('');
        $('#h_remarks').val('');
        return;
    }

    // Send AJAX request to fetch house details
    $.ajax({
        type: 'GET',
        url: _base_url_ + "admin/inventory/fetch_house_details.php",
        data: { house_lid: houseLid },
        dataType: 'json',
        success: function(response) {
            console.log("Response: ", response); // Debugging line
            if (response.success) {
                // Populate the fields with fetched data
                $('#h_house_model').val(response.house_model);
                $('#h_floor_area').val(response.floor_area);
                $('#h_price_sqm').val(response.price_sqm);
                $('#h_hcp').val(response.hcp);
                $('#h_status').val(response.status);
                $('#h_unit_status').val(response.unit_status);
                $('#h_remarks').val(response.remarks);
            } else {
                // Handle errors if no details are found
                $('#h_house_model').val('');
                $('#h_floor_area').val('');
                $('#h_price_sqm').val('');
                $('#h_status').val('');
                $('#h_unit_status').val('');
                $('#h_remarks').val('');
                alert(response.message || 'No house details found');
            }
        },
        error: function(xhr, status, error) {
            // Handle error if AJAX request fails
            console.log("AJAX error:", status, error); // Debugging line
            $('#h_house_model').val('');
            $('#h_floor_area').val('');
            $('#h_price_sqm').val('');
            $('#h_status').val('');
            $('#h_unit_status').val('');
            $('#h_remarks').val('');
            alert('An error occurred while fetching house details.');
        }
    });
}
</script>

<script>
    // Function to toggle edit mode
    function toggleEditMode(button) {
        // Select the fields to enable/disable
        const locationFields = document.querySelectorAll('#lot_area, #price_sqm, #lcp, #status, #lid, #remarks, #h_floor_area, #h_house_model, #h_price_sqm, #h_hcp, #h_status, #h_unit_status, #h_remarks');

        // Check the current state based on the button text or attributes
        const isEditing = button.dataset.editing === "true"; // Use data attribute for state management

        if (isEditing) {
            // Disable the fields by adding 'readonly' and 'disabled' attributes
            locationFields.forEach(field => {
                field.setAttribute('readonly', 'true');
                field.setAttribute('disabled', 'true');
            });

            // Update button state and text
            button.innerHTML = '<i class="fas fa-edit"></i>Edit';
            button.dataset.editing = "false";
        } else {
            // Enable the fields by removing 'readonly' and 'disabled' attributes
            locationFields.forEach(field => {
                field.removeAttribute('readonly');
                field.removeAttribute('disabled');
            });

            // Update button state and text
            button.innerHTML = '<i class="fas fa-edit"></i>Disable Edit';
            button.dataset.editing = "true";
        }

        // Optionally disable the button temporarily for UX
        button.disabled = true;
        setTimeout(() => button.disabled = false, 300); // Re-enable button after 300ms
    }

    document.getElementById('edit-btn').addEventListener('click', function () {
        // Check if the location search has been performed (via the data-searched attribute)
        const isSearched = this.getAttribute('data-searched') === 'true';
        
        // If location has not been searched, check if fields are filled
        if (!isSearched) {
            // Check if a search was performed (location data exists)
            /* const locationFields = document.querySelectorAll('#block, #lot, #lot_area, #price_sqm, #lcp, #status, #project, #lid'); */
            const locationFields = document.querySelectorAll('#block, #lot, #lid');
            let isLocationFilled = Array.from(locationFields).every(field => field.value.trim() !== '');

            // If location is not filled, show an alert
            if (!isLocationFilled) {
                alert('Please search for a location first before editing.');
                return; // Prevent the editing process from proceeding
            }
        }

        toggleEditMode(this);
    });


    document.getElementById('clear-btn').addEventListener('click', function () {
        document.querySelector('form').reset();

        // Trigger PHP form reset and prevent data from being re-submitted
        const form = document.querySelector('form');
        const clearInput = document.createElement('input');
        clearInput.type = 'hidden';
        clearInput.name = 'clear';
        clearInput.value = '1';
        form.appendChild(clearInput);

        // Submit form to trigger redirect
        form.submit();

        // Optionally, reset the "Find Location" button if it was disabled or changed
        document.querySelector('button[name="search_location"]').disabled = false;

        // Reset the "Edit" button if needed
        const editButton = document.getElementById('edit-btn');
        editButton.innerHTML = '<i class="fas fa-edit"></i> Edit'; // Reset button text and icon back to "Edit"
        editButton.disabled = false; // Enable the button again
    });
</script>

<script>
    document.getElementById('c_block').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');  // Remove any non-numeric characters
    });

    document.getElementById('c_lot').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');  // Remove any non-numeric characters
    });
</script>

<script>
    // Function to calculate LCP
    function calculateLCP() {
        const lotArea = parseFloat(document.getElementById('lot_area').value.replace(/,/g, '') || 0);
        const priceSqm = parseFloat(document.getElementById('price_sqm').value.replace(/,/g, '') || 0);
        const lcp = lotArea * priceSqm;
        
        // Format the result as a number with commas and update the LCP field
        document.getElementById('lcp').value = isNaN(lcp) ? '' : lcp.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Attach event listeners
    document.getElementById('lot_area').addEventListener('blur', calculateLCP);
    document.getElementById('price_sqm').addEventListener('blur', calculateLCP);
</script>

<script>
    $('.delete-lot').click(function(){
        _conf("Are you sure you want to remove lot?","delete_lot",[$(this).attr('data-lot-id')])
    }) 

    function delete_lot($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Inventory_Master.php?f=delete_lot",
            method:"POST",
            data:{id: $id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success: function(resp){
                    if (resp.status == 'success'){
                        alert_toast(resp.msg, 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else if (!!resp.msg){
                        el.addClass("alert-danger");
                        el.text(resp.msg);
                        _this.prepend(el);
                    } else {
                        el.addClass("alert-danger");
                        el.text("An error occurred due to unknown reason.");
                        _this.prepend(el);
                    }
                    el.show('slow');
                    $('html, body, .modal').animate({scrollTop:0}, 'fast');
                    end_loader();
                }
        })
    }

    $(document).ready(function() {
        $('#manage-lot').submit(function(e) {
            e.preventDefault();
            var _this = $(this);

            start_loader();

            $.ajax({
                url:_base_url_+"classes/Inventory_Master.php?f=save_lot",
                data: new FormData(_this[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                },
                success: function(resp) {
                    console.log(resp);
                    if (resp && resp.status === 'success') {
                        alert_toast(resp.msg, 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else if (resp && resp.status === 'failed' && resp.msg) {
                        alert_toast(resp.msg, 'error');
                    } else {
                        alert_toast("An unexpected error occurred", 'error');
                    }
                    end_loader();
                }
            });
        });
    });
</script>