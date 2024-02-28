<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        input {
            padding: 8px;
        }
    </style>
</head>

<body>
<input type="text" id="searchInput" placeholder="Enter value to search">
    <button id="showTableBtn">Show Table</button>
    <div class="card card-outline card-primary" style="display: none;">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title"><b><i>General Ledger Transaction Details</b></i></h5>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <div class="container-fluid">
                    <form action="" id="journal-form">
                        <div class="table-container">
                            <table id="firstTable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Item No.</th>
                                        <th class="text-center">Document No</th>
                                        <th class="text-center">Document Date</th>
                                        <th class="text-center">Account Code</th>
                                        <th class="text-center">Account Name</th>
                                        <th class="text-center">Debit</th>
                                        <th class="text-center">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
    <?php
    $counter = 1;
    $stmt = $conn->prepare("SELECT gl.doc_no, gl.amount, gl.account, gl.journal_date, ac.name, gl.gtype
                            FROM tbl_gl_trans gl
                            INNER JOIN account_list ac ON gl.account = ac.code ORDER BY gl.gtype ASC, gl.account ASC;");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) :
    ?>
            <tr>
                <td class="text-center">
                    <span class="item_no"><?= $counter; ?></span>
                </td>
                <td class="text-center">
                    <span class="doc_no"><?= $row['doc_no']; ?></span>
                </td>
                <td class="text-center">
                    <span class="journal_date"><?= date('Y-m-d', strtotime($row['journal_date'])); ?></span>
                </td>
                <td>
                    <span class="account_code"><?= $row['account'] ?></span>
                </td>
                <td>
                    <span class="account_name"><?= $row['name'] ?></span>
                </td>
                <td class="debit_amount text-right">
                    <?= $row['gtype'] == 1 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '' ?>
                </td>
                <td class="credit_amount text-right">
                    <?= $row['gtype'] == 2 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '' ?>
                </td>
            </tr>
    <?php
        $counter++;
        endwhile;
    } else {
        echo '<tr><td colspan="7">No data available</td></tr>';
    }
    $stmt->close();
    ?>
</tbody>

                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right"><b>Total:</b></th>
                                        <th class="text-right total_debit">0.00</th>
                                        <th class="text-right total_credit">0.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-center"></th>
                                        <th colspan="5" class="text-center total-balance">0</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function () {
            function updateTotals() {
                var totalDebit = 0;
                var totalCredit = 0;

                $("#firstTable tbody tr:visible").each(function () {
                    var debit = parseFloat($(this).find(".debit_amount").text().replace(",", ""));
                    var credit = parseFloat($(this).find(".credit_amount").text().replace(",", ""));

                    totalDebit += isNaN(debit) ? 0 : debit;
                    totalCredit += isNaN(credit) ? 0 : credit;
                });

                $(".total_debit").text(formatNumber(totalDebit));
                $(".total_credit").text(formatNumber(totalCredit));
            }

            function formatNumber(number) {
                return number.toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
            function filterTable() {
                var searchTerm = $("#searchInput").val().toUpperCase();
                var rowsFound = false;

                $("#firstTable tbody tr").each(function () {
                    var row = $(this);
                    var found = false;
                    row.find("span").each(function () {
                        var cellText = $(this).text().toUpperCase();

                        if (cellText.includes(searchTerm)) {
                            found = true;
                            return false;
                        }
                    });
                    if (found) {
                        row.show();
                        rowsFound = true;
                    } else {
                        row.hide();
                    }
                });

                updateTotals();

                if (!rowsFound) {
                    $("#firstTable tbody").append('<tr><td colspan="7">No rows found</td></tr>');
                }
            }

            // Initially hide the table
            $(".card").hide();

            // Show table when button is clicked
            $("#showTableBtn").on("click", function () {
                $(".card").show();
                filterTable();
            });
        });
    </script>
</body>

</html>
