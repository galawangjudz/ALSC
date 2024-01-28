<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>General Ledger</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
            <div class="row mb-3">
            <table>
                <tr>
                    <td>GL Account: <input type="text" id="searchInput" placeholder="Account Code"></td>
                    <td><p id="displayName"></p></td>
                </tr>
            </table>
        </div>
        <hr>
        <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
            <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="8%">
                <col width="7%">
                <col width="25%">
                <col width="30%">
                <col width="10%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th>#</th>
                    <th>Doc Type</th>
                    <th>Doc No.</th>
                    <th>Account Code.</th>
                    <th>Account Name</th>
                    <th>Name</th>
                    <th>Doc Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $i = 1;
                // $qry = $conn->query("SELECT a.*, b.*, c.*, d.id AS supId, d.name
                // FROM `tbl_gl_trans` AS a
                // JOIN `account_list` AS b ON a.account = b.code
                // JOIN `tbl_gr_list` AS c ON a.doc_no = c.doc_no
                // JOIN `supplier_list` AS d ON c.supplier_id = d.id
                // ORDER BY a.`journal_date` DESC;
                // ");
                $qry = $conn->query("SELECT
                COALESCE(s.name, CONCAT(t.c_last_name, ', ', t.c_first_name, ' ',t.c_middle_initial), CONCAT(pc.last_name, ', ',pc.first_name, ' ' ,pc.middle_name), CONCAT(u.lastname, ', ',u.firstname)) AS name,
                a.doc_type, a.account,
                a.doc_no,
                a.journal_date,
                a.amount,
                ac.code,
                ac.name AS acName
                FROM
                    tbl_gl_trans a
                JOIN tbl_gr_list b ON a.doc_no = b.doc_no
                JOIN account_list ac ON a.account = ac.code
                LEFT JOIN supplier_list s ON b.supplier_id = s.id
                LEFT JOIN t_agents t ON b.supplier_id = t.c_code
                LEFT JOIN property_clients pc ON b.supplier_id = pc.client_id
                LEFT JOIN users u ON b.supplier_id = u.user_code
                ORDER BY a.journal_date DESC;
                ");
                while ($row = $qry->fetch_assoc()):
            ?>
                <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td><?php echo $row['doc_type'] ?></td>
                    <td><?php echo $row['doc_no'] ?></td>
                    <td><?php echo $row['account'] ?></td>
                    <td><?php echo $row['acName'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo date("Y-m-d H:i",strtotime($row['journal_date'])) ?></td>
                    <td><?php echo number_format($row['amount'], 2, '.', ','); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        </div>
		</div>
	</div>
</div>
<script>

    $('.view_data').click(function () {
        var dataId = $(this).attr('data-id');
        var redirectUrl = '?page=po/goods_receiving/gl_trans&id=' + dataId;
        window.location.href = redirectUrl;
    });
    $('.table th,.table td').addClass('px-1 py-0 align-middle');


</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const displayName = document.getElementById("displayName");
    const tableRows = document.querySelectorAll("#data-table tbody tr");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let foundMatch = false;

        if (searchTerm === "") {
            displayName.textContent = "";
        } else {
            tableRows.forEach(function (row) {
                const accountColumn = row.querySelector("td:nth-child(3)").textContent.toLowerCase();
                const nameColumn = row.querySelector("td:nth-child(4)").textContent;

                if (accountColumn.includes(searchTerm)) {
                    row.style.display = "";
                    displayName.textContent = nameColumn;
                    foundMatch = true;
                } else {
                    row.style.display = "none";
                }
            });
        }

        if (!foundMatch) {
            displayName.textContent = "";
        }
    });
});

</script>