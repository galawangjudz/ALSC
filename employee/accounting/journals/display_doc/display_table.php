<?php
// your database connection code here
require_once('../../config.php');

$selected_doc_no = isset($_GET['id']) ? $_GET['id'] : '';

// Fetch data from the database based on doc_no
$jitems = $conn->query("SELECT gl.amount, gl.account, gl.journal_date, ac.name, gl.gtype
    FROM tbl_gl_trans gl
    INNER JOIN account_list ac ON gl.account = ac.code
    WHERE gl.doc_no = '$selected_doc_no'
    ORDER BY gl.gtype ASC, gl.account ASC;");

// Build HTML content for table rows
$rows = '';
$counter = 1;
while ($row = $jitems->fetch_assoc()) {
    $rows .= '<tr>
        <td class="text-center"><input type="text" id="item_no" value="' . $counter . '" style="border: none;background:transparent;text-align:center;" readonly></td>
        <td class="text-center"><input type="text" id="journal_date" value="' . date('Y-m-d', strtotime($row['journal_date'])) . '" style="border: none;background:transparent;" readonly></td>
        <td class=""><input type="text" name="account_code[]" value="' . $row['account'] . '" style="background-color:transparent;border:none;" readonly></td>
        <td class=""><span>' . $row['name'] . '</span></td>
        <td class="debit_amount text-right">' . ($row['gtype'] == 1 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '') . '</td>
        <td class="credit_amount text-right">' . ($row['gtype'] == 2 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '') . '</td>
    </tr>';
    $counter++;
}

echo $rows;
?>
