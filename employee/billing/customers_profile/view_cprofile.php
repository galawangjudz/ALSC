<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    //$qry = $conn->query("SELECT i.*,x.c_active FROM t_csr_buyers i inner join t_csr_view x on i.c_csr_no = x.c_csr_no inner join customers_profile c on i.buyer_id = c.buyer_id WHERE i.c_csr_no = '{$_GET['id']}'");
    $qry = $conn->query("SELECT i.*,x.* FROM t_csr_buyers i inner join t_csr_view x on i.c_csr_no = x.c_csr_no WHERE i.c_csr_no = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<?php
$query2 = "SELECT * FROM t_csr_buyers WHERE c_csr_no = '{$_GET['id']}'";
$result2 = mysqli_query($conn, $query2);

if ($result2) {
    $buyer_counter = 0; 
    $displayTitle = false; 

    while ($row = mysqli_fetch_assoc($result2)) {
        $buyer_count = $row['c_buyer_count'];
        $customer_last_name = $row['last_name'];
        $customer_suffix_name = $row['suffix_name'];
        $customer_first_name = $row['first_name'];
        $customer_middle_name = $row['middle_name'];

        $cust_fullname = sprintf('%s %s, %s %s', $customer_last_name, $customer_suffix_name, $customer_first_name, $customer_middle_name);

        echo '<div class="view_box">';
        echo '<div class="float-left col-md-12">';
        echo '<table class="table table-bordered">';
        echo '<tr>';
        echo '<td style="width: 200px;"><b>Full Name (Buyer ' . ($buyer_counter + 1) . '): </b></td>';
        echo '<td>' . $cust_fullname . '</td>';
        echo '</tr>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
        echo '<div class="space"></div>';

        $buyer_counter++;
    }

    if ($buyer_counter > 1) {
        $displayTitle = true;
    }

    if ($displayTitle) {
        echo '<div class="title" style="text-align:center;font-weight:bold;">Principal Buyer\'s Information</div><br/>';
    }
}
?>

<div class="container-fluid">
    <table class="table table-bordered" id="data-table">
        <tr>
            <td style="width: 200px;">
                <b>Location:</b>
            </td>
            <td>
                <?= isset($c_acronym) ? $c_acronym : '' ?> Block <?= isset($c_block) ? $c_block : '' ?> Lot <?= isset($c_lot) ? $c_lot : '' ?>
            </td>
        </tr>
        
        <tr>
            <td style="width: 200px;">
                <b>Address:</b>
            </td>
            <td>
                <?= isset($address) ? html_entity_decode($address) : '' ?>, <?= isset($zip_code) ? $zip_code : '' ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">
                <b>Contact Number:</b>
            </td>
            <td>
                <?= isset($contact_no) ? html_entity_decode($contact_no) : '' ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">
                <b>Email Address:</b>
            </td>
            <td>
                <?= isset($email) ? html_entity_decode($email) : '' ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;">
                <b>Status:</b>
            </td>
            <td>
                <?php 
                $status = isset($c_active) ? $c_active : 0;
                    switch($status){
                        case 0:
                            echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>';
                            break;
                        case 1:
                            echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Active</span>';
                            break;
                        default:
                            echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
                                break;
                    }
                ?>
            </td>
        </tr>
    </table>
    <?php 
        $c_qry = $conn->query("SELECT * FROM customers_profile WHERE buyer_id = '$buyer_id'");
        if($c_qry->num_rows > 0){
            $res = $c_qry->fetch_array();
            foreach($res as $k => $v){
                if(!is_numeric($k))
                $$k = $v;
            }
        }
    ?>
    <table class="table table-bordered" id="data-table">
        <tr>
            <td style="width: 200px;"><b>Payment Terms:</b></td>
            <td>
                <?php
                $terms_qry = $conn->prepare("SELECT * FROM `payment_terms` WHERE terms_indicator = ?");
                $terms_qry->bind_param("i", $terms);
                $terms_qry->execute();
                $result = $terms_qry->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $recValue = $row['terms'];
                        echo $recValue . "<br>"; 
                    }
                } else {
                    echo "Not yet added.";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td style="width: 200px;"><b>Vatable?</b></td>
            <td>
                <?php if (isset($vatable) && $vatable == 0): ?>
                    <span class="badge badge-secondary">No</span>
                <?php elseif (isset($vatable) && $vatable == 12): ?>
                    <span class="badge badge-primary">Yes</span>
                <?php else: ?>
                    Not yet added
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div>
