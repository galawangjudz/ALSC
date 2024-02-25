<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
    $usertype = $_settings->userdata('user_type'); 
    $type = $_settings->userdata('user_code');
    $level = $_settings->userdata('type');
    $department = $_settings->userdata('department');
    // echo "USERTYPE" . $usertype;
    // echo "TYPE" . $type;
    // echo "LEVEL" . $level;
    // echo $department;
?>

<head>
    <style>
        .bold-text {
            font-weight: bold;
        }
        .nav-gr {
            background-color: #007bff;
            color: white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
        }
        .nav-gr:hover {
            background-color: #007bff!important;
            color: white!important;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
        }
        #approved-link {
            font-weight: bold;
        }
        #purchase-orders-title {
            font-style: italic;
            font-weight: bold;
        }
        .main_menu {
            width: 300px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            color: black!important;
            border-right: solid 3px white;
            margin-right: 0; /* Remove right margin */
        }
        .main_menu:hover {
            border-bottom: solid 2px blue;
            background-color: #E8E8E8;
        }
        #container {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: transparent;
        }
        .navbar-menu-wrapper {
            display: flex;
            justify-content: center;
        }
        .navbar-menu {
            text-align: center;
        }
        .navbar-menu a {
            margin: 0; /* Reset margin for all buttons */
        }
    </style>
    <script>
        function showOpenPOsTable() {
            document.getElementById('open-purchase-orders-table').style.display = 'block';
            document.getElementById('closed-purchase-orders-table').style.display = 'none';
            document.getElementById('open-link').style.borderBottom = 'solid 2px blue';
            document.getElementById('open-link').style.backgroundColor = '#E8E8E8';
            document.getElementById('closed-link').style.borderBottom = 'none';
            document.getElementById('closed-link').style.backgroundColor = 'transparent';
            document.getElementById('purchase-orders-title').textContent = 'List of Open Purchase Orders';
        }

        function showClosedPOsTable() {
            document.getElementById('open-purchase-orders-table').style.display = 'none';
            document.getElementById('closed-purchase-orders-table').style.display = 'block';
            document.getElementById('closed-link').style.borderBottom = 'solid 2px blue';
            document.getElementById('closed-link').style.backgroundColor = '#E8E8E8';
            document.getElementById('open-link').style.borderBottom = 'none';
            document.getElementById('open-link').style.backgroundColor = 'transparent';
            document.getElementById('purchase-orders-title').textContent = 'List of Closed Purchase Orders';
        }
        showOpenPOsTable();
    </script>
</head>
<div class="card" id="container">
    <div class="navbar-menu-wrapper">
        <div class="navbar-menu">
            <a href="javascript:void(0);" onclick="showOpenPOsTable()" class="main_menu" id="open-link" style="border-left:solid 3px white;"><i class="nav-icon fa fa-cart-arrow-down"></i>&nbsp;&nbsp;&nbsp;Open POs</a>
            <a href="javascript:void(0);" onclick="showClosedPOsTable()" class="main_menu" id="closed-link"><i class="nav-icon fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Closed POs</a>
        </div>
    </div>
</div>

<?php if ($level > 3 and  $usertype != "Purchasing Officer" and $usertype != "Purchasing Supervisor"){ ?>
<div class="card card-outline card-primary">
	<div class="card-header">
        <input type="hidden" value="<?php echo $type; ?>">
        <h5 class="card-title" id="purchase-orders-title">List of Open Purchase Orders</h5>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
            <div id="open-purchase-orders-table" style="display: none;">
                <table class="table table-hover table-striped" style="text-align:center;">
                        <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>P.O. #</th>
                            <th>Supplier</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                                //$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated) ");
                                $qry = $conn->query("SELECT u.*, po.*, s.name as sname
                                FROM `po_approved_list` po
                                INNER JOIN `supplier_list` s ON po.supplier_id = s.id
                                INNER JOIN `users` u ON (po.receiver_id = u.user_code OR po.receiver2_id = u.user_code)
                                WHERE po.status = 1 AND (po.receiver_id = '$type' OR po.receiver2_id = '$type')
                                GROUP BY po.po_no
                                ORDER BY po.date_created DESC;
                                ");
                                while($row = $qry->fetch_assoc()):
                                    $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                                    $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                    <td class=""><?php echo $row['po_no'] ?></td>
                                    <td class=""><?php echo $row['sname'] ?></td>
                                    <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                    <td>
                                        <?php 
                                            switch ($row['status']) {
                                                case '1':
                                                    echo '<span class="badge badge-success">Open</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-secondary">Closed</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    
                                    <td align="center">
                                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="?page=pom_goods_receiving/received_items&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
                                            <?php
                                                $qry_get_gr = $conn->query("SELECT g.*, o.* FROM tbl_gr_list g INNER JOIN approved_order_items o ON g.gr_id = o.gr_id WHERE g.po_id = '" . $row['id'] . "'");
                                                if ($qry_get_gr->num_rows > 0) {
                                                    echo "<div class='dropdown-divider'></div>";
                                                    echo "<a class='dropdown-item gr-list' gr-id='" . $row["id"] . "'><span class='fa fa-list text-primary'></span> GR List</a>";
                                                }
                                                ?>                                            
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
            </div>
            <div id="closed-purchase-orders-table" style="display: none;">
                <table class="table table-hover table-striped" style="text-align:center;">
                        <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>P.O. #</th>
                            <th>Supplier</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                                //$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated) ");
                                $qry = $conn->query("SELECT u.*, po.*, s.name as sname
                                FROM `po_approved_list` po
                                INNER JOIN `supplier_list` s ON po.supplier_id = s.id
                                INNER JOIN `users` u ON (po.receiver_id = u.user_code OR po.receiver2_id = u.user_code)
                                WHERE po.status = 0 AND (po.receiver_id = '$type' OR po.receiver2_id = '$type')
                                GROUP BY po.po_no
                                ORDER BY po.date_created DESC;
                                ");
                                while($row = $qry->fetch_assoc()):
                                    $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                                    $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                    <td class=""><?php echo $row['po_no'] ?></td>
                                    <td class=""><?php echo $row['sname'] ?></td>
                                    <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                    <td>
                                        <?php 
                                            switch ($row['status']) {
                                                case '1':
                                                    echo '<span class="badge badge-success">Open</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-secondary">Closed</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    
                                    <td align="center">
                                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <!-- <a class="dropdown-item" href="?page=pom_goods_receiving/received_items&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
                                        <?php
                                        $qry_get_gr = $conn->query("SELECT g.*, o.* FROM tbl_gr_list g INNER JOIN approved_order_items o ON g.gr_id = o.gr_id WHERE g.po_id = '" . $row['id'] . "'");
                                        if ($qry_get_gr->num_rows > 0) {
                                            // echo "<div class='dropdown-divider'></div>";
                                            echo "<a class='dropdown-item gr-list' gr-id='" . $row["id"] . "'><span class='fa fa-list text-primary'></span> GR List</a>";
                                        }
                                        ?>      
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
            </div>
		</div>
		</div>
	</div>
</div>
 <?php }else{ ?>
    <div class="card card-outline card-primary">
	<div class="card-header">
        <input type="hidden" value="<?php echo $type; ?>">
        <h5 class="card-title" id="purchase-orders-title">List of Open Purchase Orders</h5>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
            <div id="open-purchase-orders-table" style="display: none;">
                <table class="table table-hover table-striped" style="text-align:center;">
                        <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>P.O. #</th>
                            <th>Supplier</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                                //$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated) ");
                                $qry = $conn->query("SELECT po.*, s.name as sname
                                FROM `po_approved_list` po
                                INNER JOIN `supplier_list` s ON po.supplier_id = s.id
                                WHERE po.status = 1
                                GROUP BY po.po_no
                                ORDER BY po.date_created DESC;
                                ");
                                while($row = $qry->fetch_assoc()):
                                    $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                                    $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                    <td class=""><?php echo $row['po_no'] ?></td>
                                    <td class=""><?php echo $row['sname'] ?></td>
                                    <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                    <td>
                                        <?php 
                                            switch ($row['status']) {
                                                case '1':
                                                    echo '<span class="badge badge-success">Open</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-secondary">Closed</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    
                                    <td align="center">
                                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="?page=pom_goods_receiving/received_items&id=<?php echo $row['id'] ?>"><span class="fa fa-box-check text-primary"></span> Receive</a>
                                            <?php
                                                $qry_get_gr = $conn->query("SELECT g.*, o.* FROM tbl_gr_list g INNER JOIN approved_order_items o ON g.gr_id = o.gr_id WHERE g.po_id = '" . $row['id'] . "'");
                                                if ($qry_get_gr->num_rows > 0) {
                                                    echo "<div class='dropdown-divider'></div>";
                                                    echo "<a class='dropdown-item gr-list' gr-id='" . $row["id"] . "'><span class='fa fa-list text-primary'></span> GR List</a>";
                                                }
                                                ?>                                            
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
            </div>
            <div id="closed-purchase-orders-table" style="display: none;">
                <table class="table table-hover table-striped" style="text-align:center;">
                        <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>P.O. #</th>
                            <th>Supplier</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                                //$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated) ");
                                $qry = $conn->query("SELECT po.*, s.name as sname
                                FROM `po_approved_list` po
                                INNER JOIN `supplier_list` s ON po.supplier_id = s.id
                                WHERE po.status = 0 
                                GROUP BY po.po_no
                                ORDER BY po.date_created DESC;
                                ");
                                while($row = $qry->fetch_assoc()):
                                    $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                                    $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                    <td class=""><?php echo $row['po_no'] ?></td>
                                    <td class=""><?php echo $row['sname'] ?></td>
                                    <td class="text-right"><?php echo number_format($row['total_amount']) ?></td>
                                    <td>
                                        <?php 
                                            switch ($row['status']) {
                                                case '1':
                                                    echo '<span class="badge badge-success">Open</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-secondary">Closed</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    
                                    <td align="center">
                                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                Action
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <!-- <a class="dropdown-item" href="?page=pom_goods_receiving/received_items&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a> -->
                                        <?php
                                        $qry_get_gr = $conn->query("SELECT g.*, o.* FROM tbl_gr_list g INNER JOIN approved_order_items o ON g.gr_id = o.gr_id WHERE g.po_id = '" . $row['id'] . "'");
                                        if ($qry_get_gr->num_rows > 0) {
                                            // echo "<div class='dropdown-divider'></div>";
                                            echo "<a class='dropdown-item gr-list' gr-id='" . $row["id"] . "'><span class='fa fa-list text-primary'></span> GR List</a>";
                                        }
                                        ?>      
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                </table>
            </div>
		</div>
		</div>
	</div>
</div>
<?php } ?>
<script>
	$(document).ready(function(){
        $('.gr-list').click(function(){
            uni_modal_right("GR List",'pom_goods_receiving/gr_list.php?id='+$(this).attr('gr-id'),"mid-large")
        })
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this rent permanently?","delete_po",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","pom_purchase_orders/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_po($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
