<?php 
/* include '../../config.php'; */
require_once('../../../config.php');
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>

	table tr{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 60%;
  border:solid 1px;
  padding-left:10px!important;
  border:solid 1px gainsboro;
}
table td{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 20%;
  border:solid 1px gainsboro;
  padding:5px;
}
.table td, .table th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.table tr:nth-child(even) {
  background-color: #dddddd;
}
.tabs {
  list-style: none;
  margin: 0;
  padding: 0;
}
</style>
<?php
$usertype = $_settings->userdata('user_type');
// if (!isset($usertype)) {
//     include '404.html';
//   exit;
// }

$user_role = $usertype;

// if ($user_role != 'IT Admin') {
//     include '404.html';
//   exit;
// }

?>
<?php

if(isset($_GET['id'])){
    // Remove the first 2 characters from $_GET['id']
    $id = substr($_GET['id'], 2);

    $qry = $conn->query("SELECT * FROM `t_av_summary` where c_av_no = '$id'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}

?>

<div class="card card-outline rounded-0 card-maroon">
    <h3 class="card-title" style="padding-top:10px; padding-left:10px;"><b>Application Voucher ID#: <i><?php echo $id ?></i> </b></h3>
    <div class="table-responsive">
        <table class="table table-bordered table-stripped" style="text-align:center;">
        <br>
            <thead style="font-size:12px;">
                <tr>
                    <th>Payment Amt</th>
                    <th>Pay Date</th>
                    <th>Due Date</th>
                    <th>SI NO</th>
                    <th >Amt Due</th>
                    <th>Interest</th>
                    <th>Rebate</th>
                    <th>Surcharge</th>
                    <th>Principal</th>
                    <th>Remaining Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
        <tbody style="font-size:12px;">
            <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM t_av_breakdown WHERE av_no = '{$_GET['id']}' ORDER BY payment_count ASC") ;
                        while($row = $qry->fetch_assoc()):
                    ?>
                <tr>
                    <td><?php echo number_format($row["payment_amount"],2) ?></td>
                    <td><?php echo $row["pay_date"] ?></td>
                    <td><?php echo $row["due_date"] ?></td>
                    <td><?php echo $row["or_no"] ?></td>
                    <td><?php echo number_format($row["amount_due"],2) ?></td>
                    <td><?php echo number_format($row["interest"],2) ?></td>
                    <td><?php echo number_format($row["rebate"],2) ?></td>
                    <td><?php echo number_format($row["surcharge"],2) ?></td>
                    <td><?php echo number_format($row["principal"],2) ?></td>
                    <td><?php echo number_format($row["remaining_balance"],2) ?></td>
                    <td><?php echo $row["status"] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>