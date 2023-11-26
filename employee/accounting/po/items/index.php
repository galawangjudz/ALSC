<?php
if ($_settings->chk_flashdata('success')) :
    ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<style>
    .link_data .badge i {
        transition: font-size 0.3s ease-in-out;
    }

    .link_data:hover .badge i {
        font-size: 1em;
    }

    .view_data .badge i {
        transition: font-size 0.3s ease-in-out;
    }

    .view_data:hover .badge i {
        font-size: 1em;
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
                        echo '<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
                            <colgroup>
                                <col width="5%">
                                <col width="12%">
                                <col width="22%">
                                <col width="22%">
                                <col width="20%">
                                <col width="12%">
                                <col width="6%">
                                <col width="8%">
                            </colgroup>
                            <thead>
                                <tr class="bg-navy disabled">
                                    <th>#</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
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
                            echo ($row['status'] == 1) ? '<span class="badge rounded-pill badge-primary"><i class="fa fa-check fa-xs" aria-hidden="true"></i></span>' : '<span class="badge rounded-pill badge-secondary"><i class="fa fa-times fa-xs" aria-hidden="true"></i></span>';
                            echo '</td>
                                <td align="center">';
                            echo ($row['account_code'] == 0) ? '<a class="link_data" href="javascript:void(0)" data-id="' . $row['id'] . '"><span class="badge rounded-pill badge-danger"><i class="fa fa-link fa-xs" aria-hidden="true"></i></span></a>' : '<a class="link_data" href="javascript:void(0)" data-id="' . $row['id'] . '"><span class="badge rounded-pill badge-primary"><i class="fa fa-link fa-xs" aria-hidden="true"></i></span></a>';
                            echo '<a class="view_data" href="javascript:void(0)" data-id="' . $row['id'] . '"><span class="badge rounded-pill badge-info"><i class="fa fa-eye fa-xs"></i></span></a>
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
                    <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
                        <colgroup>
                            <col width="5%">
                            <col width="12%">
                            <col width="22%">
                            <col width="22%">
                            <col width="20%">
                            <col width="12%">
                            <col width="6%">
                            <col width="8%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled">
                                <th>#</th>
                                <th>Item Code</th>
                                <th>Item Name</th>
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
                                            <span class="badge rounded-pill badge-primary"><i class="fa fa-check fa-xs" aria-hidden="true"></i></span>
                                        <?php else : ?>
                                            <span class="badge rounded-pill badge-secondary"><i class="fa fa-times fa-xs" aria-hidden="true"></i></span>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center">
                                        <?php if ($row['account_code'] == 0) : ?>
                                            <a class="link_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge rounded-pill badge-danger"><i class="fa fa-link fa-xs" aria-hidden="true"></i></span></a>
                                        <?php else : ?>
                                            <a class="link_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge rounded-pill badge-primary"><i class="fa fa-link fa-xs" aria-hidden="true"></i></span></a>
                                        <?php endif; ?>

                                        <a class="view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="badge rounded-pill badge-info"><i class="fa fa-eye fa-xs"></i></span></a>
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
        $('.view_item_price_history').click(function () {
            uni_modal_right("<i class='fa fa-info'></i> Price History", "po/items/item_price_history.php?id=" + $(this).attr('data-id') + "&name=" + $(this).attr('data-name'), "mid-large");
        });
        $('.view_data').click(function () {
            uni_modal("<i class='fa fa-info-circle'></i> Item's Details", "po/items/view_details.php?id=" + $(this).attr('data-id'), "")
        })
        $('.link_data').click(function () {
            uni_modal("<i class='fa fa-edit'></i> Edit Item's Details", "po/items/manage_item.php?id=" + $(this).attr('data-id'))
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
