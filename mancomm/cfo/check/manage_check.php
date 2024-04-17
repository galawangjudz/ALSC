<?php
require_once('../../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * FROM check_details WHERE c_num = {$_GET['id']};");

    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
        $existingDetails = true;
    } else {
        $existingDetails = false;
    }
}
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
    body {
        font-size: 14px;
    }

    .form-control {
        font-size: 14px;
    }
</style>
    <h5 class="card-title"><b><i>Check List</b></i></h5>
    <table id="check-details-table" class="table table-bordered table-stripped">
        <tr>
            <th>Check Name</th>
            <th>Check #</th>
            <th>Amount</th>
            <th>Check Date</th>
            <th>Check Status</th>
        </tr>
        <?php
        $global_c_num = "";
        $query = "SELECT a.c_num,b.c_status, b.check_num, b.check_date, b.amount, a.check_name FROM check_details b LEFT JOIN cv_entries a ON b.c_num = a.c_num WHERE b.c_num = {$_GET['id']}";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $global_c_num = $row['c_num'];
                echo '<tr>';
                echo '<td>' . $row['check_name'] . '</td>';
                echo '<td>' . $row['check_num'] . '</td>';
                echo '<td>' . number_format($row['amount'], 2) . '</td>';
                echo '<td>' . $row['check_date'] . '</td>';
                echo '<td>';
                switch($row['c_status']){
                    case 0:
                        echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Unclaimed</span>';
                        break;
                    case 1:
                        echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Claimed</span>';
                        break;
                    default:
                        echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
                        break;
                }
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="5">No existing checks found.</td></tr>';
        }
        ?>
    </table>
    <?php 
$qry_edit = $conn->query("SELECT * FROM cv_entries
                          WHERE c_num = '" . $_GET['id'] . "' 
                          AND c_status != 2");
if ($qry_edit->num_rows > 0): ?>
    <hr style="background-color: #3498db; height: 5px;">
    <button id="toggle-form-btn" class="btn btn-flat btn-sm btn-secondary"><i class="fas fa-money-check-alt"></i> Create New Check</button>
<?php endif; ?>

    <form action="" id="check-form" style="display: none;">
    <br>
    <input type="hidden"" name="c_num" id="c_num" class="form-control rounded-0" value="<?= $_GET['id']; ?>" required>
    <?php 
        $i = 1;

        $qry = $conn->query("SELECT DISTINCT a.check_name, a.check_date, c.amount 
        FROM cv_entries a 
        LEFT JOIN check_details b ON a.c_num = b.c_num 
        LEFT JOIN cv_items c ON a.c_num = c.journal_id 
        LEFT JOIN account_list d ON c.account_id = d.code 
        WHERE a.c_num = '{$_GET['id']}' AND d.name = 'Accounts Payable Trade';
        ");

        while ($row = $qry->fetch_assoc()):
    ?>
    
        <table class="table table-bordered table-stripped">
            <tr>
                <td>
                    <label for="check_name" class="control-label">Check Name:</label>
                </td>
                <td>
                    <input type="text" name="check_name" id="check_name" class="form-control rounded-0" value="<?php echo $row['check_name'] ?>" required>
                </td>   
            </tr>
            <tr>
                <td>
                    <label for="check_num" class="control-label">Check #:</label>
                </td>
                <td>
                    <input type="text" name="check_num" id="check_num" class="form-control rounded-0" value="" required>
                </td>   
            </tr>
            <tr>
                <td>
                    <label for="amount" class="control-label">Amount:</label>
                </td>
                <td>
                <input type="hidden" name="amount" id="amount" class="form-control rounded-0" value="<?php echo $row['amount'] ?>" required readonly>
                <input type="text" id="amount1" class="form-control rounded-0" value="<?php echo number_format($row['amount'],2) ?>" required oninput="updateAmount()" onblur="formatAmount()">
                </td>   
            </tr>
            <tr>
                <td>
                    <label for="check_date" class="control-label">Check Date:</label>
                </td>
                <td>
                    <input type="date" name="check_date" id="check_date" class="form-control rounded-0" value="<?php echo date('Y-m-d', strtotime($row['check_date'])); ?>" required>
                </td>   
            </tr>
        </table>
        <?php endwhile; ?>
    </form>


<script>
    function updateAmount() {
        var amount1Value = document.getElementById("amount1").value;

        document.getElementById("amount").value = amount1Value;
    }

    function formatAmount() {
        var amount1Value = document.getElementById("amount1").value;

        var formattedValue = parseFloat(amount1Value).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        document.getElementById("amount1").value = formattedValue;
    }
    $(function () {
        $('#toggle-form-btn').click(function () {
            $('#check-form').toggle();
            toggleModalFooter();
        });

        $('#close-form-btn').click(function () {
            $('#check-form').hide();
            toggleModalFooter();
        });

        function toggleModalFooter() {
            if ($('#check-form').is(':visible')) {
                $('.modal-footer').show();
            } else {
                $('.modal-footer').hide();
            }
        }

        toggleModalFooter();

        $('#toggle-form-btn').click(function () {
            toggleModalFooter();
        });
    });

    $(function () {
        $('#check-form').submit(function (e) {
        e.preventDefault();

        var check_name = $('#check_name').val().trim();
        var check_num = $('#check_num').val().trim();
        var amount = $('#amount').val().trim();
        var check_date = $('#check_date').val().trim();

        if (check_name === '' || check_num === '' || amount === '' || check_date === '') {
            alert_toast('<i class="fas fa-exclamation-triangle fa-lg"></i> Please fill in all required fields.', 'Warning');
            return;
        }

            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_check",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: function (err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (typeof resp === 'object') {
                        if (resp.status === 'success') {
                            //location.reload();
                            location.replace('./?page=journals/check_list')
                        } else if (resp.status === 'failed' && resp.msg) {
                            var el = $('<div>');
                            el.addClass('alert alert-danger err-msg').text(resp.msg);
                            _this.prepend(el);
                            el.show('slow');
                            $("html, body").animate({ scrollTop: 0 }, 'fast');
                        } else {
                            alert_toast('An error occurred', 'error');
                            console.log(resp);
                        }
                    } else {
                        alert_toast('Invalid response format from the server', 'error');
                    }
                    end_loader();
                }
            });
        });
    });
</script>
