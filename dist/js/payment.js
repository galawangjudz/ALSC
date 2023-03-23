$(document).ready(function() {


    $(document).on('keyup', ".pay-date", function(e) {
		e.preventDefault();
		check_paydate();
		

	});	





});

function check_paydate(){
   
    const due_date = new Date($('.due-date').val());
    const pay_date = new Date($('.pay-date').val());
    const numStr = $('.amt-due').val();
    const monthly_pay  = parseFloat(numStr.replace(",", ""));
    
    if (pay_date > due_date) {
        const timeDiff = Math.abs(pay_date.getTime() - due_date.getTime());
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        console.log(monthly_pay);
        const l_sur = (monthly_pay * ((0.6/360) * diffDays));

        const tot_amt_due = monthly_pay + l_sur;
        console.log(tot_amt_due);
        $('#surcharge').val(l_sur.toFixed(2));
        $('#tot_amount_due').val(tot_amt_due.toFixed(2));
        $('#amount_paid').val(tot_amt_due.toFixed(2));
    
        console.log(`The payment is ${diffDays} days late. The late surcharge is ${l_sur}.`);
    }
    



}