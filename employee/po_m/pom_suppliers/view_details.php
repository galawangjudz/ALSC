<?php
require_once('./../../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `supplier_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
    body{
        font-size:12px;
    }
    @media (min-width: 768px) {
        #uni_modal, #confirm_modal {
            display: none; 
            align-items: center;
            justify-content: center;
            margin: 0 140px;
        }
    }
    @media (min-width: 820px) {
        #uni_modal, #confirm_modal {
            display: none; 
            align-items: center;
            justify-content: center;
            margin: 0 160px;
        }
    }
    @media (min-width: 1024px) {
        #uni_modal, #confirm_modal {
            display: none; 
            align-items: center;
            justify-content: center;
            margin: 0 20px;
        }
    }
</style>
<div class="container fluid">
    <callout class="callout-primary">
        <dl class="row">
            <table class="table table-bordered">
                <tr>
                    <td style="width:150px;"><b>Supplier Name:</b></td>
                    <td><b><?php echo $name ?></b></td>
                </tr>
                <tr>
                    <td style="width:150px;"><b>Supplier Short Name:</b></td>
                    <td><b><?php echo $short_name ?></b></td>
                </tr>
                <!-- <tr>
                    <td style="width:150px;"><b>Category:</b></td>
                    <td>
                        <?php 
                            if ($category == 0) {
                                echo 'Goods';
                            } elseif ($category == 1) {
                                echo 'Services';
                            } 
                        ?>
                    </td>
                </tr> -->
                <tr>
                    <td><b>TIN #:</b></td>
                    <td><?php echo $tin ?></td>
                </tr>
                <tr>
                    <td><b>Address:</b></td>
                    <td><?php echo $address ?></td>
                </tr>
                <tr>
                    <td><b>Contact Person:</b></td>
                    <td><?php echo $contact_person ?></td>
                </tr>
                <tr>
                    <td><b>Contact #:</b></td>
                    <td><?php echo $contact ?></td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <td><b>Mode of Payment:</b></td>
                    <td>
                    <?php if($mop == 0): ?>
                        <span>Cash on Delivery</span>
                    <?php else: ?>
                        <span>Check</span>
                    <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Payment Terms:</b></td>
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
                            echo "No additional terms found.";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Tax Group:</b></td>
                    <td>
                        <?php 
                            if ($vatable == 0) {
                                echo 'Non-VAT';
                            } elseif ($vatable == 1) {
                                echo 'Zero-rated';
                            } elseif ($vatable == 2) {
                                echo 'Vatable';
                            }else {
                                echo '';
                            }
                        ?>
                    </td>
                </tr>
                <!-- <tr>
                    <td><b>Withholding Tax:</b></td>
                    <td><?php echo $wt ?>%</td>
                </tr> -->
                <tr>
                    <?php $formatted_date = date("F j, Y h:i:s A", strtotime($date_created)); ?>
                    <td><b>Date Created:</b></td>
                    <td><?php echo $formatted_date ?></td>
                </tr>
                <tr>
                    <td><b>Status:</b></td>
                    <td>
                    <?php if($status == 1): ?>
                        <span class="badge badge-success">Active</span>
                    <?php else: ?>
                        <span class="badge badge-secondary">Inactive</span>
                    <?php endif; ?>
                    </td>
                </tr>
            </table>
        </dl>
    </callout>
    <table style="width:100%;">
        <tr>
            <td>
                <button class="btn btn-dark btn-flat btn-default" type="button" style="width:100%; margin-left:5px;font-size:14px;" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </td>
        </tr>
    </table>
</div>