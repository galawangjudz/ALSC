<?php 
require_once('../../../config.php');
//include('../../../inc/common.php');   


function ftom($value) {
    return number_format($value, 2);
}

function mtof($value) {
    $m_value = str_replace(",", "", $value);
    // Convert to float and format with two decimal places
    return (float)$m_value;
}
function ftoa($f_value) {
    return number_format((float)$f_value, 2, '.', '');
}


$g_site = [];
$g_acro = [];

function get_site_code($acronym, $cnx) {
    global $g_site;

    if (empty($g_site)) {
        $sql = "SELECT c_acronym, c_code FROM t_projects ORDER BY c_acronym ASC";
        $result = $cnx->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $acronym_strip = strtoupper(str_replace('-', '', $row['c_acronym']));
                $g_site[$acronym_strip] = $row['c_code'];
            }
        }
    }

    $acronym_strip = strtoupper(str_replace('-', '', $acronym));
    return array_key_exists($acronym_strip, $g_site) ? $g_site[$acronym_strip] : 0;
}

function get_site_acronym($code, $cnx) {
    global $g_acro;

    if (empty($g_acro)) {
        $sql = "SELECT c_code, c_acronym FROM t_projects ORDER BY c_code ASC";
        $result = $cnx->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $g_acro[$row['c_code']] = $row['c_acronym'];
            }
        }
    }

    return array_key_exists($code, $g_acro) ? $g_acro[$code] : 'none';
}


function get_site_name($code, $conn) {
    // Prepare the SQL query
    $code = str_replace("'", "''", $code);
    $sql = sprintf("SELECT c_name FROM t_projects WHERE c_code = '%s'", $code);
    // Execute the SQL query
    $result = odbc_exec($conn, $sql);
    if (!$result) {
        die("Query execution failed: " . odbc_errormsg($conn));
    }

    // Fetch the results into an array
    $items = [];
    while ($row = odbc_fetch_array($result)) {
        $items[] = $row;
    }
        
    // Close the connection
    odbc_close($conn);

    // Optional: Display the fetched data (for debugging purposes)
    foreach ($items as $item) {
        echo "Code: " . $item['c_code'] . ", Name: " . $item['c_first_name'] . " " . $item['c_middle_initial'] . " " . $item['c_last_name'] . ", Position: " . $item['c_position'] . ", Network: " . $item['c_network'] . ", Division: " . $item['c_division'] . "<br>";
    }


}


// Get the agent code from POST request
if (isset($_GET['id'])) {

$c_code = $_GET['id'];
$print_date = $_GET['print_date'];
$agent_name = $_GET['agent_name'];



// SQL query to fetch commission details
$sql = "SELECT c_commission_amount, c_net_commission,c_due_comm, c_prev_comm, c_prev_comm_amt, c_buyers_name, c_rate, c_account_no, c_print_date
        FROM t_new_commission_log
        WHERE c_code = $1 AND c_print_date = $2
        ORDER BY c_print_date DESC;";

// Execute the query with the parameters
$result = pg_query_params($cnx, $sql, array($c_code, $print_date));

// Initialize an array to store commission details
$commissionDetails = [];

if ($result && pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        // Store each row of commission details in an array
        $commissionDetails[] = $row;
    }
}
// SQL query to fetch agent details
$sql_agent = "SELECT c_withholding_tax, c_network, c_division, c_position
              FROM t_agents
              WHERE c_code = $1;";

// Execute the query with the parameters
$result_agent = pg_query_params($cnx, $sql_agent, array($c_code));

// Initialize an array to store agent details
$agentDetails = [];

if ($result_agent && pg_num_rows($result_agent) > 0) {
    $agentDetails = pg_fetch_assoc($result_agent);
}

// Close connection
pg_close($cnx);
}




?>
<style>
    .header {
        text-align: left;
        margin-bottom: 20px;
    }
    .header h1, .header p {
        margin: 0;
    }
    .header p {
        margin-top: 5px;
    }
    .right-align {
            text-align: right;
    }
</style>

<div class="container mt-5">
    <div class="header">
        <h3> Asian Land Strategies Corporation </h3>
        <p>Agent ID: <?php echo $c_code; ?></p>
        <p>Broker/Agent: <?php echo $agent_name; ?></p>
        <p>Cutoff Date: <?php echo $print_date; ?></p>
        <?php if (!empty($agentDetails)) { ?>
        <p>Withholding Tax: <?php echo isset($agentDetails['c_withholding_tax']) ? $agentDetails['c_withholding_tax'] : 10; ?>%</p>
        <p>Network: <?php echo $agentDetails['c_network']; ?></p>
        <p>Division: <?php echo $agentDetails['c_division']; ?></p>
        <p>Position: <?php echo $agentDetails['c_position']; ?></p>
    <?php } ?>
    </div>
    <div class="table-responsive">
        <table id="commissionTable" class="table table-bordered table-striped">
            <colgroup>
                <col width="3%">
                <col width="8%">
                <col width="15%">
                <col width="10%">
                <col width="5%">
                <col width="10%">
                <col width="5%">
                <col width="10%">
            </colgroup>
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Account No</th>
                    <th style="text-align: center;">Buyers Name</th>
                    <th style="text-align: center;">Net TCP</th>
                    <th style="text-align: center;">Commission Rate</th>
                    <th style="text-align: center;">Prev. Commission</th>
                    <th style="text-align: center;">Due Commission</th>
                    <th style="text-align: center;">Net Commission Still Due</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($commissionDetails)) {
                    $i = 1;
                    $totalNetCommissionDue = 0;
                    $totalWithholdingTax = 0;

                    foreach ($commissionDetails as $row) {
                        $netCommissionDue = $row['c_commission_amount'] - $row['c_prev_comm_amt'];
                        $withholdingTax = $netCommissionDue * ((isset($agentDetails['c_withholding_tax']) ? $agentDetails['c_withholding_tax'] : 10)/100); 
                        $totalNetCommissionDue += $netCommissionDue;
                        $totalWithholdingTax += $withholdingTax;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['c_account_no']; ?></td>
                            <td><?php echo $row['c_buyers_name']; ?></td>
                            <td class="right-align"><?php echo ftom($row['c_net_commission'] / ($row['c_rate'] / 100)); ?></td>
                            <td class="right-align"><?php echo $row['c_rate'] .'%' ?></td>
                            <td class="right-align"><?php echo ftom($row['c_prev_comm_amt']). ' ('. ftom($row['c_prev_comm']) . '%)'; ?></td>
                            <td class="right-align"><?php echo $row['c_due_comm'] . '%'; ?></td>
                            <td class="right-align"><?php echo ftom($netCommissionDue); ?></td>
                        </tr>
                <?php
                        $i++;
                    }
                ?>
                    <tr>
                        <td colspan="7"><strong>Sub Total Net Commission Still Due</strong></td>
                        <td class="right-align"><strong><?php echo ftom($totalNetCommissionDue); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="7"><strong>Total Withholding Tax ( <?php echo isset($agentDetails['c_withholding_tax']) ? $agentDetails['c_withholding_tax'] : 10; ?>% )</strong></td>
                        <td class="right-align"><strong><?php echo ftom($totalWithholdingTax); ?></strong></td>
                    </tr>
                    <tr>
                        <td colspan="7"><strong>Total Net Commission Due </strong></td>
                        <td class="right-align"><strong><?php echo ftom($totalNetCommissionDue - $totalWithholdingTax); ?></strong></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td colspan="8">No commission details found</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
