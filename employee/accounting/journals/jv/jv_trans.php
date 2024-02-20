<?php 
require_once('../../config.php');
$account_arr = [];
$group_arr = [];


    $qry = $conn->query("SELECT * FROM `tbl_gr_list` where doc_no = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $row = $qry->fetch_assoc();
        $po_id = $row['po_id'];
        $doc_no = $row['doc_no'];
        $docfirstDigit = substr($doc_no, 0, 1);
        $supplier_id = $row['supplier_id'];
        $vsStats = $row['vs_status'];
        $vsNo = $row['vs_num'];
        }
// echo "PO: " . $po_id . "<br>";
// echo "Doc_No: " . $doc_no . "<br>";
// echo "Sup: " . $supplier_id . "<br>";
// echo "vsStats: " . $vsStats . "<br>";
// echo "vs No: " . $vsNo . "<br>";
?>
<?php
function format_num($number){
	$decimals = 0;
	$num_ex = explode('.',$number);
	$decimals = isset($num_ex[1]) ? strlen($num_ex[1]) : 0 ;
	return number_format($number,$decimals);
}
?>
<style>
    .paid_to_main{
        border:solid 1px gainsboro;
        padding:10px;
        border-radius:5px;
    }
    .paid_to{
        padding:10px;
    }
    .rdo-btn {
        display: flex;
        width: 100%;
    }

    .rdo-btn label {
        flex: 1;
        text-align: center; 
        margin: 0; 
        padding: 10px; 
        box-sizing: border-box; 
    }

    .rdo-btn input[type="radio"] {
        margin: 0;
        vertical-align: middle; 
    }
    .hidden {
        display: none;
    }
    .phase{
        width:30%;
    }
    .block, .lot{
        width:10%;
    }
    .loc-cont{
        style:inline-block;
        width:100%;
    }
    .table-container {
        width: 100%;
        overflow-x: auto; 
    }
</style>

<body onload="cal_tb()">
<div class="card card-outline card-primary">
	<div class="card-header">
		<h5 class="card-title"><b><i>General Ledger Transaction Details</b></i></h5>
	</div>

    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <form action="" id="journal-form">
                    <input type="hidden" name="id" value="<?= isset($id) ? $id :'' ?>">
                    
                    <table class="table table-striped table-bordered">
                        <colgroup>
                            <col width="25%">
                            <col width="25%">
                            <col width="50%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th class="text-center">Transaction Date</th>
                                <th class="text-center">Document Number</th>
                                <th class="text-center">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="text-align:center;">
                            <?php 
                            $date_qry = $conn->query("SELECT tran_date
                                                    FROM tbl_gr_list 
                                                    WHERE doc_no = '{$_GET['id']}'");   
                            $date = $date_qry->fetch_array();
                            ?>
                                <td><b><?php echo $date['tran_date'] ?></b></td>
                                <td>
                                    <b><?php echo $doc_no ?></b>
                                </td>
                                <td>
                                    <?php 
                                    $name_qry = $conn->query("SELECT jve.name
                                                            FROM jv_entries jve LEFT JOIN tbl_gl_trans gl
                                                            ON gl.vs_num = jve.jv_num WHERE gl.doc_no = '{$_GET['id']}'");   
                                    $name_row = $name_qry->fetch_array();
                                    $name = $name_row['name'];
                                    ?>
                                    <b><?php echo $name; ?></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>


                    <div class="table-container">  
                        <table id="account_list" class="table table-striped table-bordered">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="10%">
                                        <col width="10%">
                                        <col width="45%">
                                        <col width="10%">
                                        <col width="10%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-center">Item No.</th>
                                            <th class="text-center">Document Date</th>
                                            <th class="text-center">Account Code</th>
                                            <th class="text-center">Account Name</th>

                                            <th class="text-center">Debit</th>
                                            <th class="text-center">Credit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if (!isset($id) || $id === null) :
                                            $counter = 1;
                                            $journalId = isset($_GET['id']) ? $_GET['id'] : null;
                                            $docNo = $_GET['id'];
                                            $jitems = $conn->query("SELECT gl.amount, gl.account, gl.journal_date, ac.name, gl.gtype
                                            FROM tbl_gl_trans gl
                                            INNER JOIN account_list ac ON gl.account = ac.code
                                            WHERE gl.doc_no = $docNo
                                            ORDER BY gl.gtype ASC, gl.account ASC;");
                                            while($row = $jitems->fetch_assoc()):
                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <input type="text" id="item_no" value="<?= $counter; ?>" style="border: none;background:transparent;text-align:center;" readonly>
                                            </td>
                                            <td class="text-center">
                                                <input type="text" id="journal_date" value="<?= date('Y-m-d', strtotime($row['journal_date'])); ?>" style="border: none;background:transparent;" readonly>
                                            </td>
                                            <td class="">
                                                <input type="text" name="account_code[]" value="<?= $row['account'] ?>" style="background-color:transparent;border:none;" readonly>
            
                                            </td>
                                            <td class="">
                                                <span><?= $row['name'] ?></span>
                                            </td>
                                            <td class="debit_amount text-right">
                                                <?= $row['gtype'] == 1 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '' ?>
                                            </td>
                                            <td class="credit_amount text-right">
                                                <?= $row['gtype'] == 2 ? preg_replace('/\.0+$/', '', number_format(abs($row['amount']), 2)) : '' ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        $counter++;
                                        endwhile; ?>
                                        <?php endif; ?> 
                                    </tbody>
                            <tfoot>
                                <tr>
                                    <tr>
                                        <th colspan="4" class="text-right"><b>Total:</b></th>
                                        <th class="text-right total_debit">0.00</th>
                                        <th class="text-right total_credit">0.00</th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-center"></th>
                                        <th colspan="4" class="text-center total-balance">0</th>
                                    </tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function formatNumberWithCommas(number) {
        return number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    $(document).ready(function () {

        function updateTotals() {
            $('table[id^="account_list_"]').each(function () {
                var tableId = $(this).attr('id');
                var grId = tableId.replace('account_list_', '');

                var totalDebit = 0;
                var totalCredit = 0;


                $('#' + tableId + ' tbody tr').each(function () {
                    var debit = parseFloat($(this).find('.debit_amount').text().replace(',', '')) || 0;
                    var credit = parseFloat($(this).find('.credit_amount').text().replace(',', '')) || 0;

                    totalDebit += debit;
                    totalCredit += credit;
                });

                $('#' + tableId + ' .total_debit').text(formatNumberWithCommas(totalDebit));
                $('#' + tableId + ' .total_credit').text(formatNumberWithCommas(totalCredit));

                var balance = totalDebit - totalCredit;
                $('#' + tableId + ' .total-balance').text(balance.toFixed(2));
            });
        }
        updateTotals();
    });
</script>
<script>
    var account = $.parseJSON('<?= json_encode($account_arr) ?>');
    var group = $.parseJSON('<?= json_encode($group_arr) ?>');

    function cal_tb() {
        var debit = 0;
        var credit = 0;

        $('#account_list tbody tr').each(function () {
            if ($(this).find('.debit_amount').text() !== "") {
                debit += parseFloat(($(this).find('.debit_amount').text().replace(/,/g, ''))) || 0;
            }
            if ($(this).find('.credit_amount').text() !== "") {
                credit += parseFloat(($(this).find('.credit_amount').text().replace(/,/g, ''))) || 0;
            }
        });

        var formattedDebit = debit.toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });
        var formattedCredit = credit.toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });

        $('#account_list').find('.total_debit').text(formattedDebit);
        $('#account_list').find('.total_credit').text(formattedCredit);

        var totalBalance = (debit - credit).toLocaleString('en-US', { style: 'decimal', maximumFractionDigits: 2 });
        $('#account_list').find('.total-balance').text(totalBalance);
    }

    $(function () {
        if ('<?= isset($id) ?>' == 1) {
            cal_tb();
        }
        $('#account_list th, #account_list td').addClass('align-middle px-2 py-1');
        var counter = 1; 

        $('#add_to_list').click(function () {
            var account_id = $('#account_id').val();
            var account_code = $('#account_code').val();
            var group_id = $('#group_id').val();
            var amount = $('#amount').val();

            
             if (account_code.trim() === '') {
                alert('Please enter an account code.'); 
                return; 
            }
            if (amount.trim() === '') {
                alert('Please enter amount.'); 
                return; 
            }

            var tr = $($('noscript#item-clone').html()).clone();
            var account_data = !!account[account_id] ? account[account_id] : {};
            var group_data = !!group[group_id] ? group[group_id] : {};

            tr.find('#item_no').val(counter);
            tr.find('input[name="account_code[]"]').val(account_code); 
            tr.find('input[name="account_id[]"]').val(account_id);
            tr.find('input[name="group_id[]"]').val(group_id);
            tr.find('input[name="amount[]"]').val(amount);


            tr.find('.account').text(!!account_data.name ? account_data.name : "N/A");
            tr.find('.group').text(!!group_data.name ? group_data.name : "N/A");
            if (!!group_data.type && group_data.type == 1)
                tr.find('.debit_amount').text(parseFloat(amount).toLocaleString('en-US', { style: 'decimal' }));
            else
                tr.find('.credit_amount').text(parseFloat(amount).toLocaleString('en-US', { style: 'decimal' }));

            $('#account_list').append(tr);


            tr.find('.delete-row').click(function () {
                $(this).closest('tr').remove();
                cal_tb();
            });
            cal_tb();
            
            $('#account_code').val('').trigger('change');
            $('#account_id').val('').trigger('change');
            $('#group_id').val('').trigger('change');
            $('#amount').val('').trigger('change');

            counter++;
        });


        $('#journal-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.pop-msg').remove();
            var el = $('<div>');
            el.addClass("pop-msg alert");
            el.hide();
            if ($('#account_list tbody tr').length <= 0) {
                el.addClass('alert-danger').text(" Account Table is empty.");
                _this.prepend(el);
                el.show('slow');
                $('html, body').animate({ scrollTop: 0 }, 'fast');
                return false;
            }
            // if ($('#account_list tfoot .total-balance').text() != '0') {
            //     el.addClass('alert-danger').text(" Trial Balance is not equal.");
            //     _this.prepend(el);
            //     el.show('slow');
            //     $('html, body').animate({ scrollTop: 0 }, 'fast');
            //     return false;
            // }
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=manage_cv",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					//alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
              
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>