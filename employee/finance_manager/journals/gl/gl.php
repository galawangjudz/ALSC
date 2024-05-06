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
            <table style="width:100%;">
                <tr>
                    <td style="width:21%;"><b>GL Account:</b> <input type="text" id="searchInput" placeholder="Account Code"></td>
                    <td><div id="displayName" style="font-weight:bold;"></div></td>
                    <td style="text-align:right;padding-right:5px"><button id="export-csv-btn" class="btn btn-success btn-sm"><i class="fas fa-file-export"></i> Export</button></td>
                </tr>
            </table>
        </div>
        <hr>
        <br>
        <table class="table table-bordered table-striped" id="data-table" style="text-align:center;width:100%;">
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
                COALESCE(je.name,s.short_name, CONCAT(t.c_first_name, ' ', t.c_middle_initial, ' ',t.c_last_name), CONCAT(pc.first_name, ' ',pc.middle_name, ' ' ,pc.last_name), CONCAT(u.firstname, ' ',u.lastname)) AS name,
                a.doc_type,
                a.account,
                a.doc_no,
                a.journal_date,
                a.amount,
                ac.code,
                ac.name AS acName,
                je.jv_num,
                vs.v_num,
                cv.c_num
            FROM
                tbl_gl_trans a
            JOIN tbl_gr_list b ON a.doc_no = b.doc_no
            JOIN account_list ac ON a.account = ac.code
            LEFT JOIN supplier_list s ON b.supplier_id = s.id
            LEFT JOIN t_agents t ON b.supplier_id = t.c_code
            LEFT JOIN property_clients pc ON b.supplier_id = pc.client_id
            LEFT JOIN users u ON b.supplier_id = u.user_code
            LEFT JOIN jv_entries je ON a.jv_num = je.jv_num
            LEFT JOIN vs_entries vs ON a.vs_num = vs.v_num
            LEFT JOIN cv_entries cv ON a.cv_num = cv.c_num
            WHERE a.c_status = 1 and a.c_status2 = 1
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
                    <td><?php echo date("Y-m-d", strtotime($row['journal_date'])) ?></td>

                    <td style="color: <?php echo $row['amount'] < 0 ? 'red' : 'inherit'; ?>"><?php echo $row['amount'] < 0 ? '(' . number_format(abs($row['amount']), 2, '.', ',') . ')' : number_format($row['amount'], 2, '.', ','); ?></td>
                    <td style="display:none;"><?php echo number_format($row['amount'], 2, '.', ','); ?></td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="table-container">
        <div id="totalAmountDisplay" style="font-weight:bold;border:solid 1px gainsboro;text-align:right;"></div>
    </div>
</div>

<script>
    var displayName = <?php echo json_encode($displayName); ?>;
    var displayCode = <?php echo json_encode($displayCode); ?>;
    console.log(displayName);
</script>
    
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
        if (col && col.style && col.style.display !== 'none') {
            headerData.push(col.innerText);
        }
    });
    
    var csvContent = displayName + " as of " + formattedDate + "\n" + "Account Code: " + displayCode + "\n\n";

    csvContent += headerData.join(',') + "\n";

    visibleRows.forEach(function(row) {
        var dataCols = row.querySelectorAll('td');
        var dataRow = [];
        
        dataCols.forEach(function(col, index) {
            if (col && col.style && headerCols[index] && headerCols[index].style && headerCols[index].style.display !== 'none') {
                var cellValue = col.innerText;
                if (col.cellIndex === 5 || col.cellIndex === 7) { 
                    cellValue = cellValue.replace(/,/g, '');
                }
                dataRow.push(cellValue);
                if (col.cellIndex === 4) {
                    acName = col.innerText; 
                }
            }
        });
        csvContent += dataRow.join(',') + "\n";
    });

    console.log("CSV Content:", csvContent); 

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
    const totalAmountDisplay = document.getElementById("totalAmountDisplay");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        let foundMatch = false;
        let totalAmount = 0;

        if (searchTerm === "") {
            displayName.textContent = "";
        } else {
            tableRows.forEach(function (row) {
                const accountColumn = row.querySelector("td:nth-child(4)").textContent.toLowerCase();
                const amountColumn = parseFloat(row.querySelector("td:nth-child(9)").textContent.replace(/,/g, ''));

                if (accountColumn.includes(searchTerm)) {
                    row.style.display = "";
                    displayName.textContent = row.dataset.acname;
                    totalAmount += amountColumn;
                    foundMatch = true;
                } else {
                    row.style.display = "none";
                }
            });
        }

        if (!foundMatch) {
            displayName.textContent = "";
        }

        totalAmountDisplay.textContent = "Total Amount: " + formatNumber(totalAmount);
    });

    function formatNumber(number) {
        return number.toLocaleString(undefined, { maximumFractionDigits: 2 });
    }
    function calculateTotalAmount() {
        let totalAmount = 0;

        tableRows.forEach(function (row) {
            const amountColumn = parseFloat(row.querySelector("td:nth-child(9)").textContent.replace(/,/g, ''));
            totalAmount += amountColumn;
        });

        totalAmountDisplay.textContent = "Total Amount: " + formatNumber(totalAmount);
    }
    calculateTotalAmount();
});

</script>
