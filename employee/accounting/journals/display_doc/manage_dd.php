<?php
require_once('../../config.php');
$account_arr = [];
$group_arr = [];
$selected_doc_no = isset($_GET['id']) ? $_GET['id'] : '';

$qry = $conn->query("SELECT * FROM `tbl_gl_trans` where doc_no = '$selected_doc_no'");
if ($qry->num_rows > 0) {
    $row = $qry->fetch_assoc();
    $po_id = $row['po_id'];
    $doc_no = $row['doc_no'];
    $docfirstDigit = substr($doc_no, 0, 1);
    $supplier_id = $row['supplier_id'];
    $vsStats = $row['vs_status'];
    $vsNo = $row['vs_num'];
}
?>

<style>
    .nav-dd {
        background-color: #007bff;
        color: white !important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }

    .nav-dd:hover {
        background-color: #007bff!important;
        color: white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
    }
</style>

<body>

    <div class="search-container">
        <form action="" method="GET" id="search-form">
            <label for="doc_no">Search by Doc No:</label>
            <input type="text" name="id" id="doc_no" value="<?= $selected_doc_no ?>">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title"><b><i>General Ledger Transaction Details</b></i></h5>
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <div class="container-fluid">
                    <form action="" id="journal-form">
                        <input type="hidden" name="id">

                        <div class="table-container">
                            <table id="account_list" class="table table-striped table-bordered">
                                <colgroup>
                                    <col width="5%">
                                    <col width="10%">
                                    <col width="10%">
                                    <col width="45%">
                                    <col width="10%">
                                    <col width="10%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="text-center">Item No.</th>
                                        <th class="text-center">Document Date</th>
                                        <th class="text-center">Account Code</th>
                                        <th class="text-center">Account Name</th>

                                        <th class="text-center">Debit</th>
                                        <th class="text-center">Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!isset($id) || $id === null) :
                                        $counter = 1;
                                        $docNo = $selected_doc_no;
                                        $jitems = $conn->query("SELECT gl.amount, gl.account, gl.journal_date, ac.name, gl.gtype
                                            FROM tbl_gl_trans gl
                                            INNER JOIN account_list ac ON gl.account = ac.code
                                            WHERE gl.doc_no = $docNo
                                            ORDER BY gl.gtype ASC, gl.account ASC;");
                                        while ($row = $jitems->fetch_assoc()) :
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="text" id="item_no" value="<?= $counter; ?>" style="border: none;background:transparent;text-align:center;" readonly>
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" id="journal_date" value="<?= date('Y-m-d', strtotime($row['journal_date'])); ?>" style="border: none;background:transparent;" readonly>
                                                </td>
                                                <td class="">
                                                    <input type="text" name="account_code[]" value="<?= $row['account'] ?>" style="background-color:transparent;border:none;" readonly>
                                                </td>
                                                <td class="">
                                                    <span><?= $row['name'] ?></span>
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
                                    endif;
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <tr>
                                            <th colspan="4" class="text-right"><b>Total:</b></th>
                                            <th class="text-right total_debit">0.00</th>
                                            <th class="text-right total_credit">0.00</th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" class="text-center"></th>
                                            <th colspan="4" class="text-center total-balance">0</th>
                                        </tr>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#search-form').submit(function (e) {
            e.preventDefault();
            var doc_no = $('#doc_no').val();
            console.log('Entered doc_no:', doc_no);

            window.location.href = '<?= base_url ?>/report/print_check_voucher.php?id=' + encodeURIComponent(doc_no);
        });
    });
</script>
