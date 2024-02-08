<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif; ?>
<style>
	.nav-gl{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-gl:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>General Ledger</b></i></h3>
	</div>
    <br>

	<div class="card-body">
		<div class="container-fluid">
            <div class="row mb-3">
            <table>
                <tr>
                    <td><b>GL Account:</b> <input type="text" id="searchInput" placeholder="Account Code"></td>
                    <td><div id="displayName" style="padding-left:20px;font-weight:bold;"></div></td>
                </tr>
            </table>
        </div>
        <hr>
        <button id="export-csv-btn" class="btn btn-success btn-sm"><i class="fas fa-file-export"></i> Export</button>
        <br><br>
        <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
            <!-- <colgroup>
                <col width="5%">
                <col width="5%">
                <col width="8%">
                <col width="7%">
                <col width="25%">
                <col width="30%">
                <col width="10%">
                <col width="10%">
            </colgroup> -->
            <thead>
                <tr>
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
                $displayName = ''; 
                $displayCode = '';

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
                    $displayName = $row['acName']; 
                    $displayCode = $row['code']; 
            ?>
                <tr data-acname="<?php echo htmlspecialchars($row['acName']); ?>">
                    <td class="text-center"><?php echo $i++; ?></td>
                    <td><?php echo $row['doc_type'] ?></td>
                    <td><?php echo $row['doc_no'] ?></td>
                    <td><?php echo $row['account'] ?></td>
                    <td><?php echo $row['acName'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo date("Y-m-d H:i", strtotime($row['journal_date'])) ?></td>
                    <td><?php echo number_format($row['amount'], 2, '.', ','); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    var displayName = <?php echo json_encode($displayName); ?>;
    var displayCode = <?php echo json_encode($displayCode); ?>;
    console.log(displayName);
</script>
        </table>
        </div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>
document.getElementById('export-csv-btn').addEventListener('click', function() {
   
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();
    
    var table = document.querySelector('#data-table');
    var visibleRows = table.querySelectorAll('tbody tr:not([style*="display: none"])');

    var headerRow = table.querySelector('thead tr');
    var headerCols = headerRow.querySelectorAll('th');
    var headerData = [];
    headerCols.forEach(function(col) {
        headerData.push(col.innerText);
    });
    
    var csvContent = displayName + " as of " + formattedDate + "\n" + "Account Code: " + displayCode + "\n\n";


    csvContent += headerData.join(',') + "\n";

    visibleRows.forEach(function(row) {
        var dataCols = row.querySelectorAll('td');
        var dataRow = [];
        dataCols.forEach(function(col) {
            var cellValue = col.innerText;
            if (col.cellIndex === 5 || col.cellIndex === 7) { 
                cellValue = cellValue.replace(/,/g, '');
            }
            dataRow.push(cellValue);
            if (col.cellIndex === 4) {
                acName = col.innerText; 
            }
        });
        csvContent += dataRow.join(',') + "\n";
    });

    var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    var link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = acName + '_asof_' + formattedDate + '.csv';

    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});
</script>
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
                const accountColumn = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                const nameColumn = row.querySelector("td:nth-child(5)").textContent;

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
