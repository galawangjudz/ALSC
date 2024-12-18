<?php
// Include your database connection
include '../../config.php';


// Get POST data from the AJAX call
$prod_code = $_POST['prod_code'] ?? '';
$prod_block = $_POST['prod_block'] ?? '';
$prod_lot = $_POST['prod_lot'] ?? '';

// Extract the first 3 characters of $prod_code
$prod_code_prefix = substr($prod_code, 0, 3);

// Format $prod_block to 3 digits (e.g., 3 becomes 003)
$formatted_block = sprintf('%03d', $prod_block);

// Format $prod_lot to 2 digits (e.g., 4 becomes 04)
$formatted_lot = sprintf('%02d', $prod_lot);

// Combine into c_lot_id
$c_lot_lid = $prod_code_prefix . $formatted_block . $formatted_lot;


// Fetch data based on the provided inputs

$stmt = $conn->prepare("SELECT * FROM properties 
                        JOIN property_clients 
                        ON properties.property_id= property_clients.property_id
                        WHERE c_lot_lid = ?");
$stmt->bind_param("s", $c_lot_lid); // Replace 's' with the appropriate type if needed
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead>
            <tr>
                <th>Code</th>
                <th>Phase</th>
                <th>Block</th>
                <th>Lot</th>
                <th>Status</th>
            </tr>
          </thead>
          <tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row['c_site'] . '</td>
                <td>' . $prod_code . '</td>
                <td>' . $row['c_block'] . '</td>
                <td>' . $row['c_lot'] . '</td>
                <td>' . $row['c_status'] . '</td>
              </tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No data found.</p>';
}

?>
