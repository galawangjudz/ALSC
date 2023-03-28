$(document).ready(function() {


    $(document).on('keyup', ".pay-date", function(e) {
		e.preventDefault();
		check_paydate();
		

	});	


    
});

function check_paydate(){
   
    const due_date = new Date($('.due-date').val());
    const pay_date = new Date($('.pay-date').val());
    const payment_type2 = $('.payment-type2').val();
    const pay_status = $('.pay-stat').val();
    const pay_stat_acro = pay_status.substring(0, 2);
    const interest_rate =  $('.int-rate').val();
    const underpay =  $('.under-pay').val();
    const excess =  $('.excess').val();
    const over_due_mode =  $('.over-due-mode').val();
    const monthly_payment =  $('.monthly-pay').val();
    const numStr = $('.amt-due').val();
    const monthly_pay  = parseFloat(numStr.replace(",", ""));
    

    //console.log(pay_stat_acro);
    if (pay_date > due_date) {
        const timeDiff = Math.abs(pay_date.getTime() - due_date.getTime());
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        //console.log(monthly_pay);
        const l_sur = (monthly_pay * ((0.6/360) * diffDays));

        const tot_amt_due = monthly_pay + l_sur;
        //console.log(tot_amt_due);
        $('#surcharge').val(l_sur.toFixed(2));
        $('#tot_amount_due').val(tot_amt_due.toFixed(2));
        $('#amount_paid').val(tot_amt_due.toFixed(2));
        //console.log(`${pa_status.substr(0,2)}`);
        //console.log(pay_status);
        console.log(`The payment is ${diffDays} days late. The late surcharge is ${l_sur}.`);

      
    }else if ((pay_stat_acro == 'MA') || ((pay_status == 'FPD') && (payment_type2 == 'Monthy Amortization')) && (pay_date < due_date)) {

       console.log(interest_rate);
       const timeDiff = Math.abs(due_date.getTime() - pay_date.getTime());
       const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

       
       if (interest_rate == 12){
            l_rebate_value = 0.02;
       }else if (interest_rate == 14){
            l_rebate_value = 0.0225;
       }else if (interest_rate == 15){
            l_rebate_value = 0.0225;
       } else if (interest_rate == 16){
            l_rebate_value = 0.025;
       } else if (interest_rate == 17){
            l_rebate_value = 0.025;
       } else if (interest_rate == 18){
            l_rebate_value = 0.025;
       }else if (interest_rate == 19){
            l_rebate_value = 0.025;
       }else if (interest_rate == 20){
            l_rebate_value = 0.025;
       }else if (interest_rate == 21){
            l_rebate_value = 0.025;
       } else if (interest_rate == 22){
            l_rebate_value = 0.0275;
       } else if (interest_rate == 23){
            l_rebate_value = 0.0275;
       }else if (interest_rate == 24){
            l_rebate_value = 0.03;
       }else{
            l_rebate_value = 0;
       }
       if (diffDays > 2){
            if (underpay == 1){
                l_rebate = (monthly_payment * l_rebate_value);
            }else{
                l_rebate = (monthly_pay * l_rebate_value);
            }

       }else{
            l_rebate = 0;
       }

       console.log(diffDays);
       console.log(l_rebate);
       $('#rebate_amt').val(l_rebate.toFixed(2));
       l_monthly = (monthly_pay - l_rebate);
       $('#tot_amount_due').val(l_monthly.toFixed(2));
       $('#amount_paid').val(l_monthly.toFixed(2));

    }else{
        if ((excess != -1) && (over_due_mode == 0)){
            return;
        }
        $('#tot_amount_due').val(monthly_pay.toFixed(2));
        $('#amount_paid').val(monthly_pay.toFixed(2));
        $('#surcharge').val('0.0');
        $('#rebate').val('0.0');
    }
    

}