
<script>

    ////New Client Module
    function onlyLetters() {
    var lname = document.getElementById("customer_last_name");
    var fname = document.getElementById("customer_first_name");
    var mname = document.getElementById("customer_middle_name");
    var sname = document.getElementById("customer_suffix_name");

    var regex = /^[a-zA-Z\s\-']+$/;

    if (!regex.test(lname.value)) {
        lname.value = lname.value.replace(/[^a-zA-Z\s\-']/g, "");
    }

    if (!regex.test(fname.value)) {
        fname.value = fname.value.replace(/[^a-zA-Z\s\-']/g, "");
    }

    if (!regex.test(mname.value)) {
        mname.value = mname.value.replace(/[^a-zA-Z\s\-']/g, "");
    }

    if (!regex.test(sname.value)) {
        sname.value = sname.value.replace(/[^a-zA-Z\s\-']/g, "");
    }
}

function limitContactNumberLength() {
    var contactNoInput = document.getElementById("contact_no");
    var value = contactNoInput.value.trim();
    
    if (value.startsWith('+')) {

        var cleanedValue = value.replace(/\D/g, '');
        

        if (cleanedValue.length > 15) {
            cleanedValue = cleanedValue.substring(0, 15);
        }
        
   
        contactNoInput.value = '+' + cleanedValue;
    } else if (value.startsWith('0')) {

        var cleanedValue = value.replace(/\D/g, '');
        
   
        if (cleanedValue.length > 11) {
            cleanedValue = cleanedValue.substring(0, 11);
        }
        
        contactNoInput.value = cleanedValue;
    } 
}

</script>

