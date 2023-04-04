
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function(){
            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth:true,
                changeYear:true
            });
        });
        </script>
    </head>
    <body>

    <form method="post" action="http://localhost/ALSC/admin/?page=clients/sample">
        date from: <br>
        <input type="text" name="datefrom" value="" class="datepicker">
        <br>
        date to:<br>
        <input type="text" name="dateto" value="" class="datepicker">
        <br>
        Amount Due:<br>
        <input type="text" name="pment_needed" id="pment_needed" value="" class="">
        <br>
        Amount Paid:<br>
        <input type="text" name="amt" id="amt" value="" class="">
        <br><br>
        <input type="submit" value="Submit">
    </form>

    <p>


    <?php
    if(!empty($_POST['datefrom']) AND !empty($_POST['dateto'])):
    $date1 = new DateTime($_POST['datefrom']);
    $date2 = new DateTime($_POST['dateto']);
    $interval = $date1->diff($date2);
    $pment = $_POST['amt'];
    $pment_needed = $_POST['pment_needed'];
    $m_count = $interval->m;
    $res0 = $pment - $pment_needed;


    $res1 = $res0/$m_count;
    echo number_format($res1,2);

    $numRows = $m_count; // set the number of rows to 5

        echo '<table>';

        for ($i = 0; $i < $numRows; $i++) {
            echo '<tr>';
            // generate the HTML code for each cell in the row
            echo '<td>Cell 1</td>';
            echo '<td>Cell 2</td>';
            echo '</tr>';
        }

        echo '</table>';

    endif;

    
    ?>
    <br><br>
    <?php



    ?>
    <form method="post">
        <input type="submit" class="btn btn-flat btn-sm btn-default bg-maroon" name="ctp" value="Credit to Principal">
        <button class="btn btn-flat btn-sm btn-default bg-maroon">Next MA</button>
    </form>

    <?php
        if(array_key_exists('ctp',$_POST)){
            button();
        }
        function button(){
            $due = $_POST['pment_needed'];
            $pmt = $_POST['amt'];

            $double_val = $due * 2;
            echo $double_val;
        }
    ?>


        <input type="submit" name="ctp" value="click">

</p>



<?php
        
?>
</body>
</html>
