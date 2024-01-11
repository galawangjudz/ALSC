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
                <!-- <col width="10%"> -->
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="30%">
                <col width="20%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th>#</th>
                    <th>GL No.</th>
                    <th>Doc No.</th>
                    <th>Account Code.</th>
                    <th>Name</th>
                    <th>Doc Date</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $i = 1;
                $qry = $conn->query("SELECT a.*, b.* FROM `tbl_gl_trans` AS a
                                    JOIN `account_list` AS b ON a.account = b.code
                                    ORDER BY a.`journal_date` DESC");
                while ($row = $qry->fetch_assoc()):
            ?>
                <tr>
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['doc_no'] ?></td>
                    <td><?php echo $row['account'] ?></td>
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
$(document).ready(function () {
    var dataTable = $('#data-table').DataTable({
    dom: 'lrtip', 
});
    $('.view_data').click(function () {
        var dataId = $(this).attr('data-id');
        var redirectUrl = '?page=po/goods_receiving/gl_trans&id=' + dataId;
        window.location.href = redirectUrl;
    });
    $('.table th,.table td').addClass('px-1 py-0 align-middle');
});

</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchInput");
        const displayName = document.getElementById("displayName");
        const tableRows = document.querySelectorAll("#data-table tbody tr");

        searchInput.addEventListener("input", function () {
            const searchTerm = searchInput.value.toLowerCase();

            tableRows.forEach(function (row) {
                const accountColumn = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                const nameColumn = row.querySelector("td:nth-child(5)").textContent;

                if (accountColumn.includes(searchTerm)) {
                    row.style.display = "";
                    displayName.textContent = nameColumn;
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>