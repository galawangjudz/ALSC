<?php
if ($_settings->chk_flashdata('success')) :
    ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<style>
    .view_data:hover span.badge {
        background-color: #007bff!important;
        color: white!important;
        border-color: #007bff!important;
    }
    .link_data:hover span.badge {
        background-color: #28a745!important;
        color: white!important;
        border-color: #28a745!important;
    }
    .unlink_data:hover span.badge {
        background-color:#dc3545!important;
        color: white!important;
        border-color: #dc3545!important;
    }
	.nav-items{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-items:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>

<link rel="stylesheet" href="css/items.css">

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i>List of Items/Services</b></i></h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <?php
                if (isset($_GET['supplier_id'])) {
                    $supplierId = $_GET['supplier_id'];
                    $qry = $conn->prepare("SELECT * FROM `item_list` WHERE `supplier_id` = ? and account_code = 0 ORDER BY (`date_created`) DESC");
                    $qry->bind_param("s", $supplierId);
                    $qry->execute();
                    $result = $qry->get_result();

                    if ($result->num_rows > 0) {
                        echo '<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;font-size:13px;">
                            <colgroup>
                                <col width="5%">
                                <col width="12%">
                                <col width="22%">
                                <col width="22%">
                                <col width="17%">
                                <col width="8%">
                                <col width="6%">
                                <col width="15%">
                            </colgroup>
                            <thead>
                                <tr class="bg-navy disabled">
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Supplier</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>';

                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            $row['description'] = html_entity_decode($row['description']);
                            echo '<tr>
                                <td class="text-center">' . $i++ . '</td>
                                <td>' . $row['item_code'] . '</td>
                                <td>';
                            $qry_get_price = $conn->query("SELECT * from approved_order_items where item_id = '" . $row['id'] . "'");
                            if ($qry_get_price->num_rows > 0) {
                                echo "<a class='basic-link view_item_price_history' data-id='" . $row['id'] . "' data-name='" . $row['name'] . "'>" . $row['name'] . "</a>";
                            } else {
                                echo $row['name'];
                            }
                            echo '</td>
                                <td class="truncate-3" title="' . $row['description'] . '">' . $row['description'] . '</td>
                                <td>';
                            $supplierId = $row['supplier_id'];
                            $query = "SELECT * FROM supplier_list WHERE id = '$supplierId'";
                            $supplierData = $conn->query($query)->fetch_assoc();
                            echo $supplierData['name'];
                            echo '</td>
                                <td>' . $row['date_created'] . '</td>
                                <td class="text-center">';
                                    echo ($row['status'] == 1) ? '<span class="badge rounded-circle p-2" style="background-color:white; color:#007bff; border:1px solid gainsboro;"><i class="fa fa-check" aria-hidden="true"></i></span>' : '<span class="badge rounded-circle p-2" style="background-color:white; color:#dc3545; border:1px solid gainsboro;"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>';
                                    echo '</td>
                                        <td align="center">';
                                    echo ($row['account_code'] == 0) ? '<a class="link_data" href="javascript:void(0)" data-id="' . $row['id'] . '"><span class="badge badge-danger"><i class="fa fa-link" aria-hidden="true"></i></span></a>' : '<a class="link_data" href="javascript:void(0)" data-id="' . $row['id'] . '"><span class="badge badge-primary"><i class="fa fa-link fa-lg" aria-hidden="true"></i></span></a>';
                                    echo '<a class="view_data" href="javascript:void(0)" data-id="' . $row['id'] . '"><span class="badge badge-info"><i class="fa fa-eye"></i></span></a>
                                </td>
                            </tr>';
                        }
                        echo '</tbody></table>';
                    } else {
                        echo '<p>No items found for the specified supplier.</p>';
                    }
                    $qry->close();
                } else {
                    ?>
                    <table class="table table-hover table-bordered" id="data-table" style="text-align:center;width:100%;font-size:13px;">
                        <colgroup>
                            <col width="5%">
                            <col width="12%">
                            <col width="22%">
                            <col width="22%">
                            <col width="17%">
                            <col width="8%">
                            <col width="6%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled">
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Supplier</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT * from `item_list` order by (`date_created`) desc");
                            while ($row = $qry->fetch_assoc()) :
                                $row['description'] = html_entity_decode($row['description']);
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td><?php echo $row['item_code'] ?></td>
                                    <td>
                                        <?php
                                        $qry_get_price = $conn->query("SELECT * from approved_order_items where item_id = '" . $row['id'] . "'");
                                        if ($qry_get_price->num_rows > 0) {
                                            echo "<a class='basic-link view_item_price_history' data-id='" . $row['id'] . "' data-name='" . $row['name'] . "'>" . $row['name'] . "</a>";
                                        } else {
                                            echo $row['name'];
                                        }
                                        ?>
                                    </td>
                                    <td class='truncate-3' title="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></td>
                                    <td>
                                        <?php
                                        $supplierId = $row['supplier_id'];
                                        $query = "SELECT * FROM supplier_list WHERE id = '$supplierId'";
                                        $result = $conn->query($query);

                                        if ($result) {
                                            $supplierData = $result->fetch_assoc();
                                            echo $supplierData['name'];
                                        } else {
                                            echo "Error: " . $conn->error;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['date_created'] ?></td>
                                    <td class="text-center">
                                        <?php if ($row['status'] == 1) : ?>
                                            <span class="badge rounded-circle p-2" style="background-color:white; color:#007bff; border:1px solid gainsboro;" data-toggle="tooltip" data-placement="top" title="Active"><i class="fa fa-check fa-lg" aria-hidden="true"></i></span>
                                        <?php else : ?>
                                            <span class="badge rounded-circle p-2" style="background-color:white; color:#dc3545; border:1px solid gainsboro;" data-toggle="tooltip" data-placement="top" title="Inactive"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($row['account_code'] == 0) : ?>
                                            <a class="unlink_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge rounded-circle p-2" style="background-color:white; color:#dc3545; border:1px solid gainsboro;" data-toggle="tooltip" data-placement="top" title="Link"><i class="fa fa-link fa-lg" aria-hidden="true"></i></span></a>
                                        <?php else : ?>
                                            <a class="link_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
                                                <span class="badge rounded-circle p-2" style="background-color: white; color: #28a745; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Link">
                                                    <i class="fa fa-link fa-lg" aria-hidden="true"></i>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <a class="view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge rounded-circle p-2" class="badge rounded-circle p-2" style="background-color:white; color:#007bff; border:1px solid gainsboro;" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye fa-lg"></i></span></a>
                                        <!-- <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
                                            Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button> -->
                                        <!-- <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-info text-primary"></span> View</a> -->
                                        <!-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a> -->
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.view_item_price_history').click(function () {
            uni_modal_right("<i class='fa fa-info'></i> Price History", "po/items/item_price_history.php?id=" + $(this).attr('data-id') + "&name=" + $(this).attr('data-name'), "mid-large");
        });
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> Details", "po/items/view_details.php?id=" + $(this).attr('data-id'), "")
        })
        $('.link_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit Details", "po/items/manage_item.php?id=" + $(this).attr('data-id'))
        })
        $('.modal-title').css('font-size', '18px');
        $('.table th,.table td').addClass('px-1 py-0 align-middle')
        $('#data-table').dataTable();
    })

    function delete_item($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_item",
            method: "POST",
            data: {
                id: $id
            },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>
