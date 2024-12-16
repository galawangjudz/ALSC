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

            //$l_print_date = date('Y-m-d');
            $l_print_date = '2024-12-18';
            $sql = "SELECT 
                    t_commission.c_code, 
                    t_commission.c_amount, 
                    t_commission.c_account_no, 
                    t_commission.c_rate,
                    properties.c_net_tcp, 
                    properties.c_down_percent, 
                    property_clients.first_name,
                    property_clients.last_name, 
                    t_commission.c_sale
                    FROM 
                        t_agents
                    LEFT JOIN 
                        t_commission 
                        ON t_agents.c_code = t_commission.c_code
                    LEFT JOIN 
                        properties 
                        ON t_commission.c_account_no = properties.property_id
                    LEFT JOIN 
                        property_clients 
                        ON properties.property_id = property_clients.property_id
                    WHERE 
                        t_commission.c_code IS NOT NULL 
                        OR t_commission.c_amount IS NOT NULL 
                        OR t_commission.c_account_no IS NOT NULL 
                        OR t_commission.c_rate IS NOT NULL
                        OR properties.c_net_tcp IS NOT NULL 
                        OR properties.c_down_percent IS NOT NULL 
                        OR property_clients.first_name IS NOT NULL 
                        OR property_clients.last_name IS NOT NULL 
                        OR t_commission.c_sale IS NOT NULL
                    ORDER BY 
                        t_commission.c_date_of_sale";
                                
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $l_code = $row['c_code'];
                    $l_rate = $row['c_rate'];
                    $l_net_tcp = $row['c_net_tcp'];
                    $l_down_per = $row['c_down_percent'];
                    $l_first_name = $row['first_name'];
                    $l_last_name = $row['last_name'];
                    $l_buyer_name = $row['last_name'] ."," . $row['first_name'] ;
                    $l_comm_type = $row['c_sale'];
                    $l_amount = $row['c_amount'];
                    $l_acc_no = $row['c_account_no'];


                     // Query to calculate total payments
                    $sql2 = "SELECT SUM(COALESCE(principal, 0)) + SUM(COALESCE(rebate, 0)) AS total_payment
                    FROM property_payments
                    WHERE property_id = ?";
                    $stmt = $conn->prepare($sql2);
                    $stmt->bind_param("s", $l_acc_no);
                    $stmt->execute();
                    $result2 = $stmt->get_result();
                    $payments = $result2->fetch_assoc();
                    $l_principal = floatval($payments['total_payment']);

                    // Calculate total down payment
                    $l_tot_dp = $l_net_tcp * ($l_down_per / 100);

              
                    
                    // Commission calculation
                    if ($l_tot_dp == 0.0) {
                        $l_val = 80.0;
                        
                    } else {
                        if ($l_principal >= $l_tot_dp) {
                            $l_val = 80.0;
                        } else {
                            $l_val = number_format(($l_principal / $l_tot_dp) * 80.0,2);
                        }
                        
                       
                    }

                    if ($l_principal >= $l_net_tcp) {
                        $l_val = 100.0;
                      
                    }

                    if ($l_comm_type == 7) {
                        $l_val = 100.0;
                     
                    }
                
                    // Normalize $l_val
                    if ($l_val >= 20.0 && $l_val <= 39.99) {
                        $l_val = 20.0;
                    } elseif ($l_val >= 40.0 && $l_val <= 59.99) {
                        $l_val = 40.0;
                    } elseif ($l_val >= 60.0 && $l_val <= 79.99) {
                        $l_val = 60.0;
                    } elseif ($l_val >= 80.0 && $l_val <= 99.99) {
                        $l_val = 80.0;
                    } elseif ($l_val >= 100.0) {
                        $l_val = 100.0;
                    } else {
                        $l_val = 0.0;
                    }

                    $l_get_comm = $l_amount * ($l_val / 100);
                    
                   
                   // Assuming $conn is a valid MySQLi connection
                    $sql3 = "SELECT c_due_comm, c_commission_amount, c_prev_comm_amt, c_commission_count
                    FROM t_new_commission_log
                    WHERE c_account_no = ? AND c_code = ?
                    ORDER BY c_commission_count DESC
                    LIMIT 1";

                    $stmt = $conn->prepare($sql3);
                    $stmt->bind_param("ss", $l_acc_no, $l_code);
                    $stmt->execute();
                    $result3 = $stmt->get_result();
                    $commission_log = $result3->fetch_assoc();

                    if ($commission_log) {
                        $l_prev_comm = $commission_log['c_due_comm'];
                        $l_prev_amt = $commission_log['c_commission_amount'];
                        $l_comm_count = $commission_log['c_commission_count'];
                    } else {
                        $l_prev_comm = 0.0;
                        $l_prev_amt = 0.0;
                        $l_comm_count = 0;
                    }
                   

                    $l_data = [
                        'l_val' => $l_val,
                        'l_get_comm' => $l_get_comm,
                        'l_tot_dp' => $l_tot_dp,
                        'l_prev_comm' => $l_prev_comm,
                        'l_prev_amt' => $l_prev_amt,
                        'l_comm_count' => $l_comm_count
                    ];

                    $l_due_comm = $l_data['l_val'];
                    $l_comm_amt = $l_data['l_get_comm'];
                    $l_tot_dp = $l_data['l_tot_dp'];
                    $l_prev_comm = $l_data['l_prev_comm'];
                    $l_prev_amt = $l_data['l_prev_amt'];
                    $l_comm_count = $l_data['l_comm_count'];

                  

                   $l_comm_count++;

                   if ($l_due_comm > $l_prev_comm) {
                            $insert_sql = "
                                INSERT INTO t_new_commission_log (c_code, c_account_no, c_buyers_name, c_commission_amount, c_rate,
                                                                c_net_commission, c_prev_comm, c_due_comm, c_print_date, c_prev_comm_amt,
                                                                c_commission_count)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                            ";

                            $stmt = $conn->prepare($insert_sql);

                            // Assuming all variables have been defined previously:
                            $stmt->bind_param(
                                'sssdssddssi', // Example type string matching the variables below
                                $l_code,
                                $l_acc_no,
                                $l_buyer_name,
                                $l_comm_amt,
                                $l_rate,
                                $l_amount,
                                $l_prev_comm,
                                $l_due_comm,
                                $l_print_date,
                                $l_prev_amt,
                                $l_comm_count
                            );

                            $stmt->execute();
                    }
               
                   
                }
            } else {
                echo "<p>No results found.</p>";
            }
            
        
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
                
                    $print_date = isset($_GET['print_date']) ? $_GET['print_date'] : date('Y-m-d');


                    // SQL query
                    $sql = "SELECT 
                                t_agents.c_code,
                                t_new_commission_log.c_print_date,
                                CONCAT(t_agents.c_first_name, ' ', t_agents.c_last_name) AS agent_name,
                                t_agents.c_network AS network,
                                t_agents.c_division AS division,
                                SUM(t_new_commission_log.c_commission_amount) AS total_amount,
                                AVG(t_new_commission_log.c_rate) AS avg_rate,
                                COUNT(*) AS commission_count
                            FROM 
                                t_agents
                            RIGHT JOIN 
                                t_new_commission_log ON t_agents.c_code = t_new_commission_log.c_code
                            LEFT JOIN 
                                properties ON t_new_commission_log.c_account_no = properties.property_id
                            WHERE 
                                t_new_commission_log.c_print_date = '$print_date'
                            GROUP BY 
                                t_agents.c_code, 
                                t_new_commission_log.c_print_date, 
                                t_agents.c_first_name, 
                                t_agents.c_last_name, 
                                t_agents.c_network, 
                                t_agents.c_division
                            ORDER BY 
                                t_agents.c_code, 
                                t_new_commission_log.c_print_date;
                            ";


                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td class="col-id"><?php echo $i++; ?></td>
                                        <td class="col-agent-code"><?php echo $row['c_code']; ?></td>
                                        <td class="col-agent-name"><?php echo $row['agent_name']; ?></td>
                                        <td class="col-print-date"><?php echo $row['c_print_date']; ?></td>
                                        <td class="col-total-commission " style="text-align: right;"><?php echo number_format($row['total_amount'], 2); ?></td>
                                        <td class="col-avg-rate" style="text-align: right;"><?php echo number_format($row['avg_rate'], 2); ?></td>
                                        <td class="col-commission-count" style="text-align: center;"><?php echo $row['commission_count']; ?></td>
                                        <td class="col-action" style="text-align: center;">
                                            <button type="button"   class="btn btn-primary view_data" data-id="<?php echo $row['c_code']; ?>" data-print-date="<?php echo $row['c_print_date']; ?>" data-agent-name="<?php echo $row['agent_name']; ?>" href="javascript:void(0)">
                                                <span class="fa fa-eye"></span>
                                            </button>
                                            <!-- Additional buttons like print, delete can be added here -->
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>No results found</td></tr>";
                            }

                            // Close MySQLi connection
                            mysqli_close($conn);
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
