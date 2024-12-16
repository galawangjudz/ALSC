<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$usertype = $_settings->userdata('user_type');
if (!isset($usertype)) {
    include '404.html';
  exit;
}

$user_role = $usertype;

if ($user_role != 'IT Admin') {
    include '404.html';
  exit;
}

?>
<?php
if(isset($_GET['id'])){
    $prop_id = $_GET['id'];
    $user = $conn->query("SELECT * FROM t_av_payment where property_id =".$_GET['id']);
    foreach($user->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<div class="card card-outline rounded-0 card-maroon">
<h3 class="card-title" style="padding-top:10px; padding-left:10px;"><b>Property ID# <i><?php echo $prop_id ?></i> </b></h3>
    <div class="table-responsive">
        <table class="table table-bordered table-stripped" style="text-align:center;">
        
        <br>
            <thead style="font-size:14px;">
                <tr>
                    <th>Payment Amt</th>
                    <th style="width:25%;">Pay Date</th>
                    <th style="width:25%;">Due Date</th>
                    <th>Sales Invoice</th>
                    <th style="width:20%;">Amt Due</th>
                    <th>Interest</th>
                    <th>Rebate</th>
                    <th>Surcharge</th>
                    <th>Principal</th>
                    <th>Remaining Balance</th>
                    <th>Status</th>
                    <th>Account Status</th>
                </tr>
            </thead>
        <tbody style="font-size:14px;">
            <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM t_moved_av WHERE property_id =".$_GET['id']." ORDER BY trans_date DESC") ;
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
                    <td><?php echo $row["account_status"] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>