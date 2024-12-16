<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .hidden-button {
        display: none;
    }
    .nav-new-comm{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-new-comm:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<style>
    .col-id { width: 5%; }
    .col-agent-code { width: 10%; }
    .col-agent-name { width: 20%; }
    .col-print-date { width: 15%; }
    .col-total-commission { width: 15%; }
    .col-avg-rate { width: 10%; }
    .col-commission-count { width: 5%; }
    .col-action { width: 15%; }
</style>


    <div class="container mt-5" style="margin-bottom:50px;">
    <div class="card mt-3">
        <h2 class="text-blue h4">New Commission Voucher</h2>
        <?php
        if (isset($_POST['gen_comm'])) {
             // Command to run the Python script
            $command = 'python C:\xampp\htdocs\ALSC_SALES\admin\buyers_account\commission_voucher\generate_commission.py 2>&1';
            
            // Execute the command and capture the output in $output array
            $output = [];
           

            exec($command, $output);
            
            // Display the result
            echo "<h4>Result:</h4>";
            echo "<pre>" . implode("\n", $output) . "</pre>";
          
        }
        ?>
        <form method="post" action="">
            <button type="submit" name="gen_comm" class="btn btn-primary">Generate New Commission</button>
        </form>
    <hr>
    <div class="card-body">

        <div class="container">
            <div class="col-md-6">     
            <form action="" id="filter">
                <div class="form-group">
                    <label for="print-date">Select Cut-off Date:</label>
                    <input type="hidden" id="page" name="page" value="clients/commission_voucher/" class="form-control form-control-sm rounded-0">
                    <input type="date" id="print-date" name="print_date" class="form-control" value="<?php echo isset($_GET['print_date']) ? $_GET['print_date'] : date('Y-m-d'); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
            </div>
        </div>
        <div class="container-fluid">
            <div class="table-responsive">
            <table class="table table-bordered table-striped" id="data-table" style="text-align:center;width:100%;">
                <thead>
                    <tr>
                        <th class="col-id">#</th>
                        <th class="col-agent-code">Agent Code</th>
                        <th class="col-agent-name">Agent Name</th>
                        <th class="col-print-date">Cut-off Date</th>
                        <th class="col-total-commission">Total Commission</th>
                        <th class="col-avg-rate">Avg Rate</th>
                        <th class="col-commission-count"># of Commission</th>
                        <th class="col-action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Check connection
                    if (!$cnx) {
                        die("Connection failed: " . pg_last_error());
                    }

                    // Get the selected print date from the form submission
                    $print_date = isset($_GET['print_date']) ? $_GET['print_date'] : date('Y-m-d');


                    // SQL query
                    $sql = "SELECT t_agents.c_code,
                                t_new_commission_log.c_print_date,
                                t_agents.c_first_name || ' ' || t_agents.c_last_name AS agent_name,
                                t_agents.c_network AS network,
                                t_agents.c_division AS division,
                                SUM(t_new_commission_log.c_commission_amount) AS total_amount,
                                AVG(t_new_commission_log.c_rate) AS avg_rate,
                                COUNT(*) AS commission_count
                            FROM t_agents
                            RIGHT JOIN t_new_commission_log ON t_agents.c_code = t_new_commission_log.c_code
                            LEFT JOIN t_buyers_account ON t_new_commission_log.c_account_no = t_buyers_account.c_account_no
                            WHERE t_new_commission_log.c_print_date = '$print_date'
                            GROUP BY t_agents.c_code, 
                                    t_new_commission_log.c_print_date, 
                                    t_agents.c_first_name, 
                                    t_agents.c_last_name, 
                                    t_agents.c_network, 
                                    t_agents.c_division
                            ORDER BY t_agents.c_code, 
                                    t_new_commission_log.c_print_date;
                            ";

                    $result = pg_query($cnx, $sql);

                    if ($result && pg_num_rows($result) > 0) {
                        $i = 1;
                        while ($row = pg_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td class="col-id"><?php echo $i++; ?></td>
                                <td class="col-agent-code"><?php echo $row['c_code']; ?></td>
                                <td class="col-agent-name"><?php echo $row['agent_name']; ?></td>
                                <td class="col-print-date"><?php echo $row['c_print_date']; ?></td>
                                <td class="col-total-commission"><?php echo number_format($row['total_amount'], 2); ?></td>
                                <td class="col-avg-rate"><?php echo number_format($row['avg_rate'], 2); ?></td>
                                <td class="col-commission-count"><?php echo $row['commission_count']; ?></td>
                                <td class="col-action">
                                    <button type="button" class="btn btn-primary view_data" data-id ="<?php echo $row['c_code'] ?>" data-print-date ="<?php echo $row['c_print_date'] ?>" data-agent-name="<?php echo $row['agent_name'] ?>" href="javascript:void(0)">
                                        <span class="fa fa-eye"></span>
                                    </button>
                                   <!--  <button type="button" class="btn btn-success print_data" data-id ="<?php echo $row['c_code'] ?>" data-print-date ="<?php echo $row['c_print_date'] ?>" data-agent-name="<?php echo $row['agent_name'] ?>" href="javascript:void(0)">
                                        <span class="fa fa-print"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete_data" data-id ="<?php echo $row['c_code']?>" href="javascript:void(0)">
                                        <span class="fa fa-trash"></span> 
                                    </button> -->
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='8'>No results found</td></tr>";
                    }

                    // Close connection
                    pg_close($cnx);
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<style>
    #uni_modal_right .modal-content {
        font-size: 14px; /* Adjust the font size as needed */
    }

    #uni_modal_right .table td,
    #uni_modal_right .table th {
        vertical-align: middle; /* Ensure content is vertically centered */
    }
</style>
<style>
    
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid black;
    }

    th, td {
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #0038a5;
        color: white;

    }
    td{
        background-color: none;
    }

    .hidden-button {
        display: none;
    }
 
    .long-textbox {
        width: 60%;
    }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
    }
    .highlight {
        background-color: yellow !important;
    }
    .card-header {
        background-color: whitesmoke;
        color: black;
    }

    .card-title {
        font-weight: bold;
    }

    .nav-tabs .nav-link.active {
        background-color: #0038a5;
        color: white;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-group input {
        width: 100%;
    }
    .form-group textarea{
        width: 100%;
        /* Set min-height to control the number of rows */
        min-height: 20em; /* Adjust this value as needed */
        max-height: 8em; /* Adjust this value as needed */
        resize: vertical; /* Allow vertical resizing of textarea */
        overflow-y: auto; /* Add scrollbar if content exceeds max-height */
    }

    .btn-primary {
        background-color: #0038a5;
        border-color: #0038a5;
    }

    .btn-primary:hover {
        background-color: #660000;
        border-color: #660000;
    }

    .hidden-button {
        display: none;
    }
</style>
<script>
  $(document).ready(function() {
	$('#data-table').DataTable();
	});
	
    $('.view_data').click(function(){
		uni_modal_right("Commission Details","clients/commission_voucher/agent_commission.php?id="+$(this).attr('data-id')+"&print_date="+$(this).attr('data-print-date')+"&agent_name="+$(this).attr('data-agent-name'),'mid-large')
	})
	$('.delete_data').click(function(){
    _conf("Are you sure you want to delete this permanently?", "delete_agent", [$(this).attr('data-id')])
	})
    

	function delete_agent($id){
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Commission_Master.php?f=delete_agent",
			method: "POST",
			data: {id: $id},
			dataType: "json",
			error: function(err) {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp === 'object' && resp.status === 'success') {
					alert_toast(resp.msg, 'success');
					setTimeout(function() {
						location.reload();
					}, 2000);
				} else {
					alert_toast(resp.msg || "An error occurred.", 'error'); // Display default error message if msg is undefined
					end_loader();
				}
			}
		});
	}

</script>
