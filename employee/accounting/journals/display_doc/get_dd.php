<?php
require_once('../../../../config.php');

$searchTerm = $_POST['search_term'];

$stmt = $conn->prepare("SELECT gl.gtype, gl.gr_id, gl.doc_no, gl.amount, gl.account, gl.journal_date, ac.name, gl.gtype
FROM tbl_gl_trans gl
INNER JOIN account_list ac ON gl.account = ac.code
WHERE gl.doc_no LIKE ? AND gl.c_status = 1
ORDER BY gl.gr_id ASC, gl.gtype ASC, gl.account ASC
");
$searchTerm = '%' . $searchTerm . '%';
$stmt->bind_param('s', $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$rows = array();

if ($result->num_rows > 0) {
    $currentGroupId = null;

    while ($row = $result->fetch_assoc()) {
        $grId = $row['gr_id'];

        if ($grId !== $currentGroupId) {
            if ($currentGroupId !== null) {
                $rows[] = '<tr>
                                <td colspan="3" class="text-right"><b>Total:</b></td>' .
                                '<td class="text-right total_debit">' . formatNumber($totalDebit) . '</td>' .
                                '<td class="text-right total_credit">' . formatNumber($totalCredit) . '</td>
                            </tr></tbody></table>';
            }

            $currentGroupId = $grId;
            $totalDebit = $totalCredit = 0; 

            $rows[] = '<h4>Group ID: ' . $grId . '</h4>';
            $rows[] = '<table id="firstTable" class="table-responsive-sm table-striped table-bordered">
                            <thead><tr><th class="text-center">Document Date</th><th class="text-center">Account Code</th><th class="text-center">Account Name</th><th class="text-center">Debit</th><th class="text-center">Credit</th></tr></thead>
                            <tbody>';
        }

        $debitColumn = ($row['gtype'] == 1) ? '<td class="debit_amount text-right">' . formatNumber(abs($row['amount'])) . '</td>' : '<td class="debit_amount text-right"></td>';
        $creditColumn = ($row['gtype'] == 2) ? '<td class="credit_amount text-right">' . formatNumber(abs($row['amount'])) . '</td>' : '<td class="credit_amount text-right"></td>';

        $rows[] = '<tr>
                    <td class="text-center"><span class="journal_date">' . $row['journal_date'] . '</span></td>
                    <td><span class="account_code">' . $row['account'] . '</span></td>
                    <td><span class="account_name">' . $row['name'] . '</span></td>'
                    . $debitColumn . $creditColumn .
                  '</tr>';

        $totalDebit += $row['gtype'] == 1 ? abs($row['amount']) : 0;
        $totalCredit += $row['gtype'] == 2 ? abs($row['amount']) : 0;
    }

    $rows[] = '<tr>
                    <td colspan="3" class="text-right"><b>Total:</b></td>' .
                    '<td class="text-right total_debit">' . formatNumber($totalDebit) . '</td>' .
                    '<td class="text-right total_credit">' . formatNumber($totalCredit) . '</td>
                </tr></tbody></table>';
} else {
    $rows[] = '<p>No records found</p>';
}

$stmt->close();

echo json_encode($rows);

function formatNumber($number) {
    return number_format($number, 2, '.', '');
}
?>
