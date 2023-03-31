<?php 
    

$all_payments = load_data($prop_id, $pay_date);
$over_due    = $all_payments[0];
$total_amt_due = $all_payments[1];
$total_interest =  $all_payments[2];
$total_principal = $all_payments[3];
$total_surcharge = $all_payments[4];  
?>
        <table class="table2 table-bordered table-stripped">
                 <thead> 
                   <tr>
                       <th class="text-center" style="font-size:13px;">DUE DATE</th>
                       <th class="text-center" style="font-size:13px;">PAY DATE</th>
                       <th class="text-center" style="font-size:13px;">OR NO</th>
                       <th class="text-center" style="font-size:13px;">AMOUNT PAID</th> 
                       <th class="text-center" style="font-size:13px;">AMOUNT DUE</th>
                       <th class="text-center" style="font-size:13px;">INTEREST</th>
                       <th class="text-center" style="font-size:13px;">PRINCIPAL</th>
                       <th class="text-center" style="font-size:13px;">SURCHARGE</th>
                       <th class="text-center" style="font-size:13px;">REBATE</th>
                       <th class="text-center" style="font-size:13px;">PERIOD</th>
                       <th class="text-center" style="font-size:13px;">BALANCE</th>
                   </tr>
               </thead>
             <tbody>
           
                <?php 
                 foreach ($over_due as $l_data): ?>
                   <tr>
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[0] ?></td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[1] ?></td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[2] ?> </td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[3] ?> </td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[4] ?> </td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[5] ?> </td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[6] ?> </td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[7] ?> </td> 
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[8] ?> </td>  
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[9] ?> </td>  
                     <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[10] ?> </td>  
                   </tr>
                   <?php endforeach; ?>


