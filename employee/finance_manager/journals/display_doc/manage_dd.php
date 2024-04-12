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
            text-align: left;
        }

        input {
            padding: 8px;
        }
        #searchInput{
            padding:0px;
        }
        .nav-dd{
            background-color:#007bff;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        }
        .nav-dd:hover{
            background-color:#007bff!important;
            color:white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
        }
    </style>
</head>
<body>
    <div style="border: solid 0.5px gainsboro; padding: 15px; border-radius: 10px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); color: #fff;">
        <div class="container-fluid">
            <input type="text" id="searchInput" placeholder="Enter Doc #" style="border: none; padding: 8px; border-radius: 5px;">
            <button id="showTableBtn" class="btn btn-flat btn-sm btn-secondary"><i class="fas fa-table"></i> Show Table</button>
        </div>
    </div>
    <br>
    <div class="card card-outline card-primary" style="display: none;">
        <div class="card-header">
            <h5 class="card-title"><b><i>General Ledger Transaction Details</b></i></h5>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="container-fluid">
                    <form action="" id="journal-form">
                        <div class="table-container">
                            <table id="firstTable" class="table-responsive-sm table-striped table-bordered">
                                <tbody></tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
     $(document).ready(function () {
        function formatNumber(number) {
            return number.toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function filterTable() {
            var searchTerm = $("#searchInput").val().trim().toUpperCase();
            $.ajax({
                url: 'journals/display_doc/get_dd.php', 
                method: 'POST',
                data: { search_term: searchTerm },
                dataType: 'json',
                success: function (data) {
                    updateTable(data);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateTable(data) {
            var container = $(".card .container-fluid");
            container.empty();

            if (data.length > 0) {
                var currentGroupId = null;
                var table = null;

                data.forEach(function (rowData, index) {
                    if (rowData.includes('<h4>Group ID:')) {
                        if (table !== null) {
                            container.append(table);
                        }
                        currentGroupId = extractGroupId(rowData);
                        container.append('<h4>' + rowData + '</h4>');

                        table = $('<table class="table-responsive-sm table-striped table-bordered"></table>');
                        //table.append('<thead><tr><th class="text-center">Document Date</th><th class="text-center">Account Code</th><th class="text-center">Account Name</th><th class="text-center">Debit</th><th class="text-center">Credit</th></tr></thead>');
                    } else {
                        if (table !== null) {
                            table.append('<tbody><tr>' + rowData + '</tr></tbody>');
                        }
                    }
                });
                if (table !== null) {
                    container.append(table);
                }
            } else {
                container.html('<p>No records found</p>');
            }

            $(".card").show();
        }

        function extractGroupId(header) {
            var match = header.match(/Group ID: (\d+)/);
            return match ? match[1] : null;
        }

        $(".card").hide();
        $("#showTableBtn").on("click", function () {
            filterTable();
        });
    });
    </script>
</body>
</html>