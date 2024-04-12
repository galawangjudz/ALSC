<?php 
require_once('../../config.php');
    $qry = $conn->query("SELECT * FROM `tbl_gr_list` where doc_no = '{$_GET['id']}'");
    if($qry->num_rows > 0){
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
    .paid_to_main{
        border:solid 1px gainsboro;
        padding:10px;
        border-radius:5px;
    }
    .paid_to{
        padding:10px;
    }
    .rdo-btn {
        display: flex;
        width: 100%;
    }
	.nav-tran{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-tran:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    .rdo-btn label {
        flex: 1;
        text-align: center; 
        margin: 0; 
        padding: 10px; 
        box-sizing: border-box; 
    }

    .rdo-btn input[type="radio"] {
        margin: 0;
        vertical-align: middle; 
    }
    .hidden {
        display: none;
    }
    .phase{
        width:30%;
    }
    .block, .lot{
        width:10%;
    }
    .loc-cont{
        style:inline-block;
        width:100%;
    }
    .table-container {
        width: 100%;
        overflow-x: auto; 
    }
</style>
<body onload="cal_tb()">
<div class="card card-outline card-primary">
	<div class="card-header">
		<h5 class="card-title"><b><i>General Ledger Transaction Details</b></i></h5>
	</div>

    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <form action="" id="journal-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    <table class="table table-responsive-sm table-striped table-bordered">
                        <colgroup>
                            <col width="25%">
                            <col width="25%">
                            <col width="50%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Transaction Date</th>
                                <th class="text-center">Document Number</th>
                                <th class="text-center">Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align:center;">
                            <?php 
                            $date_qry = $conn->query("SELECT tran_date
                                                    FROM tbl_gr_list 
                                                    WHERE doc_no = '{$_GET['id']}'");   
                            $date = $date_qry->fetch_array();
                            ?>
                                <td><b><?php echo $date['tran_date'] ?></b></td>
                                <td>
                                    <b><?php echo $doc_no ?></b>
                                </td>
                                <td>
                                <?php
                                $sup_qry = $conn->query("SELECT *
                                                            FROM supplier_list WHERE id = '{$supplier_id}'");   
                                    $supplier = $sup_qry->fetch_array();

                                    if ($supplier) {
                                        ?>
                                        <b><?php echo $supplier['name'] ?></b>
                                        <?php
                                    } else {
                                        $emp_qry = $conn->query("SELECT e.lastname, e.firstname
                                                                FROM users e 
                                                                INNER JOIN vs_entries p ON e.user_code = p.supplier_id 
                                                                WHERE p.supplier_id = '{$supplier_id}'");   
                                        $emp = $emp_qry->fetch_array();

                                        if ($emp) {
                                            ?>
                                            <b><?php echo strtoupper($emp['firstname'] . ' ' . $emp['lastname']) ?></b>
                                            <?php
                                        } else {
                                            $agent_qry = $conn->query("SELECT a.c_last_name, a.c_first_name
                                                                        FROM t_agents a 
                                                                        INNER JOIN vs_entries p ON a.c_code = p.supplier_id 
                                                                        WHERE p.supplier_id = '{$supplier_id}'");   
                                            $agent = $agent_qry->fetch_array();
                                            if ($agent) {
                                                ?>
                                                <b><?php echo strtoupper($agent['c_first_name'] . ' ' . $agent['c_last_name']) ?></b>
                                                <?php
                                            } else {

                                                $clients_qry = $conn->query("SELECT pp.first_name, pp.last_name
                                                                            FROM property_clients pp 
                                                                            INNER JOIN vs_entries p ON pp.client_id = p.supplier_id 
                                                                            WHERE p.supplier_id = '{$supplier_id}'");   
                                                $clients = $clients_qry->fetch_array();

                                                ?>
                                                <b><?php echo strtoupper($clients['first_name'] . ' ' . $clients['last_name']) ?></b>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-container">  
                        <table id="account_list" class="table-responsive-sm table-striped table-bordered">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="45%">
                                        <col width="10%">
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
                                            <th class="text-center">Item Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    if (!isset($id) || $id === null) :
                                        $counter = 1;
                                        $journalId = isset($_GET['id']) ? $_GET['id'] : null;
                                        $docNo = $_GET['id'];
                                        $jitems = $conn->query("SELECT gl.amount, gl.account, gl.journal_date, i.item_code, ac.name, g.type 
                                                                FROM tbl_gl_trans gl
                                                                INNER JOIN account_list ac ON gl.account = ac.code
                                                                INNER JOIN group_list g ON ac.group_id = g.id
                                                                LEFT JOIN item_list i ON i.id = gl.item_id
                                                                WHERE doc_no = $docNo
                                                                ORDER BY 
                                                                    g.type,
                                                                    CASE WHEN g.type = 2 THEN gl.account END ASC,
                                                                    i.item_code DESC");
                                        while($row = $jitems->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <input type="text" id="item_no" value="<?= $counter; ?>" style="border: none;background:transparent;" readonly>
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
                                            <?= $row['type'] == 1 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '' ?>
                                        </td>
                                        <td class="credit_amount text-right">
                                            <?= $row['type'] == 2 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '' ?>
                                        </td>
                                        <td class="text-right"><?= $row['item_code'] ?></td>
                                    </tr>
                                    <?php 
                                    $counter++;
                                    endwhile; ?>
                                    <?php endif; ?> 
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
    function cal_tb() {
        var debit = 0;
        var credit = 0;

        $('#account_list tbody tr').each(function () {
            if ($(this).find('.debit_amount').text() !== "") {
                debit += parseFloat(($(this).find('.debit_amount').text().replace(/,/g, ''))) || 0;
            }
            if ($(this).find('.credit_amount').text() !== "") {
                credit += parseFloat(($(this).find('.credit_amount').text().replace(/,/g, ''))) || 0;
            }
        });

        var formattedDebit = debit.toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });
        var formattedCredit = credit.toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });

        $('#account_list').find('.total_debit').text(formattedDebit);
        $('#account_list').find('.total_credit').text(formattedCredit);

        var totalBalance = (debit - credit).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });
        $('#account_list').find('.total-balance').text(totalBalance);
    }
</script>