
<script>
function onlyLettersforRes() {
    const fieldIds = ["last_name", "first_name", "middle_name", "suffix_name", "citizenship"];
    const regex = /^[a-zA-Z\s\-]+$/;

    fieldIds.forEach(id => {
        const field = document.getElementById(id);
        if (field) {
            field.value = field.value.replace(/[^a-zA-Z\s\-]/g, "");
        }
    });
}


function numbersAndHypens(){
    var res_birthdate = document.getElementById("birth_day");
    var regex = /^[0-9\-]+$/;

    if (!regex.test(res_birthdate.value)) {
        res_birthdate.value = res_birthdate.value.replace(/[^0-9\-]/g, "");
    }
}


function numbersAndDecimal() {
    const inputIds = [
        "lot_disc", "floor_area", "h_price_per_sqm", "house_disc",
        "process_fee", "pf_month", "tcp_disc", "vat_percent", "reservation",
        "aircon_outlet_price","ac_grill_price","conv_outlet_price",
        "service_area_price","others_price","flrelev_price","down_percent",
        "no_payment","terms","interest_rate"
    ];

    const regex = /^[0-9.-]+$/;

    inputIds.forEach(id => {
        const input = document.getElementById(id);
        if (input && !regex.test(input.value)) {
            input.value = input.value.replace(/[^0-9.-]/g, "");
        }
    });
}


function limitContactNumberLengthRes() {
    var viberNoInputRes = document.getElementById("viber");

    function restrictInput(input) {
        var value = input.value.trim();
        if (value.startsWith('+')) {
            var cleanedValue = value.replace(/\D/g, '');
            if (cleanedValue.length > 12) {
                cleanedValue = cleanedValue.substring(0, 12);
            }
            input.value = '+' + cleanedValue;
        } else if (value.startsWith('0')) {
            var cleanedValue = value.replace(/\D/g, '');
            if (cleanedValue.length > 11) {
                cleanedValue = cleanedValue.substring(0, 11);
            }
            input.value = cleanedValue;
        } else {
            var cleanedValue = value.replace(/\D/g, '');
            if (cleanedValue.length > 13) {
                cleanedValue = cleanedValue.substring(0, 13);
            }
            input.value = cleanedValue;
        }
    }
    viberNoInputRes.addEventListener('input', function() {
        restrictInput(viberNoInputRes);
    });
}


function onlyLetters() {
    const inputIds = [
        "customer_last_name","customer_first_name","customer_middle_name",
        "customer_suffix_name","citizenship"
    ];

    const regex = /^[a-zA-Z\s\-']+$/;

    inputIds.forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.value = input.value.replace(/[^a-zA-Z\s\-']/g, "");
        }
    });
}

function validateContactNumber() {
    var contactNoInput = document.getElementById("contact_no");
    var contactNoValue = contactNoInput.value.trim();

    if (contactNoValue.length < 11) {
        return false; 
    }

    return true; 
}

function limitContactNumberLength() {
    var contactNoInput = document.getElementById("contact_no");
    var viberNoInput = document.getElementById("customer_viber");

    function restrictInput(input) {
        var value = input.value.trim();
        if (value.startsWith('+')) {
            var cleanedValue = value.replace(/\D/g, '');
            if (cleanedValue.length > 12) {
                cleanedValue = cleanedValue.substring(0, 12);
            }
            input.value = '+' + cleanedValue;
        } else if (value.startsWith('0')) {
            var cleanedValue = value.replace(/\D/g, '');
            if (cleanedValue.length > 11) {
                cleanedValue = cleanedValue.substring(0, 11);
            }
            input.value = cleanedValue;
        } else {
            var cleanedValue = value.replace(/\D/g, '');
            if (cleanedValue.length > 13) {
                cleanedValue = cleanedValue.substring(0, 13);
            }
            input.value = cleanedValue;
        }
    }
    contactNoInput.addEventListener('input', function() {
        restrictInput(contactNoInput);
    });

    viberNoInput.addEventListener('input', function() {
        restrictInput(viberNoInput);
    });
}

function calculateAge() {
    var dob = document.getElementById("birth_day").value;
    if (dob) {
        var birthDate = new Date(dob);
        var currentDate = new Date();
        var age = currentDate.getFullYear() - birthDate.getFullYear();
        if (
            currentDate.getMonth() < birthDate.getMonth() ||
            (currentDate.getMonth() === birthDate.getMonth() && currentDate.getDate() < birthDate.getDate())
        ) {
            age--;
        }
        document.getElementById("customer_age").innerHTML = age;
    } else {
        document.getElementById("customer_age").innerHTML = "";
    }
}

///////INVESTMENT VALUE
function radioButtonCtrl(){
    var typeText = document.getElementById("type_text");
     ///House
     var floorArea = document.getElementById("floor_area");
    var houseSqm = document.getElementById("h_price_per_sqm");
    var houseDisc = document.getElementById("house_disc");
    var houseDiscAmt =document.getElementById("house_disc_amt");
    var houseModelSelect = document.querySelector('select[name="house_model"]');

    ///Lot
    var lotPhase = document.getElementById("l_site");
    var lotBlock = document.getElementById("l_block");
    var lotLot = document.getElementById("l_lot");
    var lotDisc = document.getElementById("lot_disc");
    var lotArea = document.getElementById("lot_area");
    var lotPrice = document.getElementById("price_per_sqm");
    var lotAmt = document.getElementById("amount");
    var lotDiscAmt = document.getElementById("lot_disc_amt");
    var lotLCP = document.getElementById("lcp");
    var findButton = document.getElementById("btnfind");

    ///Add Cost
    var ac20 = document.getElementById("id20");
    var ac40 = document.getElementById("id40");
    var ac60 = document.getElementById("id60");
    var ac_outlets = document.getElementById("aircon_outlets");
    var ac_outlets_price = document.getElementById("aircon_outlet_price");
    var ac_grill = document.getElementById("ac_grill");
    var ac_grill_price = document.getElementById("ac_grill_price");
    var ac_conv_outlet = document.getElementById("conv_outlet");
    var ac_conv_outlet_price = document.getElementById("conv_outlet_price");
    var service_area = document.getElementById("service_area");
    var service_area_price  = document.getElementById("service_area_price");
    var others = document.getElementById("others");
    var others_price = document.getElementById("others_price");
    var floor_elev_price = document.getElementById("flrelev_price");
    var ac_outlet_subtotal = document.getElementById("ac_outlet_subtotal");
    var ac_grill_subtotal = document.getElementById("ac_grill_subtotal");
    var ac_conv_subtotal = document.getElementById("conv_outlet_subtotal");
    var ac_service_subtotal = document.getElementById("service_subtotal");
    var ac_others_subtotal = document.getElementById("others_subtotal");
    var addcost_total = document.getElementById("add_cost_total");

    //Payment
    var process_fee = document.getElementById("process_fee");
    var pf_month = document.getElementById("pf_month");
    var tcp_disc = document.getElementById("tcp_disc");
    var tcp_disc_amt = document.getElementById("tcp_disc_amt");
    var tcp_total = document.getElementById("total_tcp");
    var vat_percent = document.getElementById("vat_percent");
    var vat_cmptd = document.getElementById("vat_amt_computed");
    var net_tcp = document.getElementById("net_tcp");

    if (typeText.value === "1") {
                
        lotDisc.readOnly = false;

        floorArea.readOnly = true;
        houseSqm.readOnly = true;
        houseDisc.readOnly = true;
        houseModelSelect.disabled = true;
        // houseModelSelect.value = "";
        // houseModelSelect.classList.add("readonly-select");

        // floorArea.value = 0;
        // houseSqm.value = 0;
        // houseDisc.value = 0;
        // houseModelSelect.selectedIndex = 0;
        // houseDiscAmt.value = 0;
        // hcp.value = 0;

        // lotPhase.value='';
        // lotBlock.value='';
        // lotLot.value='';
        // lotDisc.value='';
        // lotArea.value='';
        // lotPrice.value='';
        // lotAmt.value='';
        // lotDiscAmt.value='';
        // lotLCP.value='';
        
        // ac_outlets.value = 0;
        // ac_outlets_price.value = 0;
        // ac_grill.value = 0;
        // ac_grill_price.value = 0;
        // ac_conv_outlet.value = 0;
        // ac_conv_outlet_price.value = 0;
        // service_area.value = 0;
        // service_area_price.value = 0;
        // others.value = 0;
        // others_price.value = 0;
        // floor_elev_price.value = 0;

        ac20.disabled = true;
        ac40.disabled = true;
        ac60.disabled = true;
        ac20.checked = false;
        ac40.checked = false;
        ac60.checked = false;

        ac_outlets.readOnly = true;
        ac_outlets_price.readOnly = true;
        ac_grill.readOnly = true;
        ac_grill_price.readOnly = true;
        ac_conv_outlet.readOnly = true;
        ac_conv_outlet_price.readOnly = true;
        service_area.readOnly = true;
        service_area_price.readOnly = true;
        others.readOnly = true;
        others_price.readOnly = true;
        floor_elev_price.readOnly = true;

        // process_fee.value = 0;
        // pf_month.value = 0;
        // tcp_disc.value = 0;
        // tcp_disc_amt.value = 0;
        // tcp_total.value = 0;
        // vat_percent.value = 0;
        // vat_cmptd.value = 0;
        // net_tcp.value = 0;
        // ac_outlet_subtotal.value = 0;
        // ac_grill_subtotal.value = 0;
        // ac_conv_subtotal.value = 0;
        // ac_service_subtotal.value = 0;
        // ac_others_subtotal.value = 0;
        // addcost_total.value = 0;

        houseModelSelect.style.backgroundColor = "#e9ecef";
        findButton.disabled = false;

    } else if (typeText.value === "2" || typeText.value === "4") {
        floorArea.readOnly = false;
        houseSqm.readOnly = false;
        houseDisc.readOnly = false;
        houseModelSelect.disabled = false;
        houseModelSelect.value = "";
        houseModelSelect.style.backgroundColor = "white";

        lotDisc.readOnly = true;

        // floorArea.value = 0;
        // houseSqm.value = 0;
        // houseDisc.value = 0;
        // houseModelSelect.selectedIndex = 0;
        // houseDiscAmt.value = 0;
        // hcp.value = 0;

        // lotPhase.value='';
        // lotBlock.value='';
        // lotLot.value='';
        // lotDisc.value='';
        // lotArea.value='';
        // lotPrice.value='';
        // lotAmt.value='';
        // lotDiscAmt.value='';
        // lotLCP.value='';

        // ac_outlets.value = 0;
        // ac_outlets_price.value = 0;
        // ac_grill.value = 0;
        // ac_grill_price.value = 0;
        // ac_conv_outlet.value = 0;
        // ac_conv_outlet_price.value = 0;
        // service_area.value = 0;
        // service_area_price.value = 0;
        // others.value = 0;
        // others_price.value = 0;
        // floor_elev_price.value = 0;

        ac20.disabled = true;
        ac40.disabled = true;
        ac60.disabled = true;
        ac20.checked = false;
        ac40.checked = false;
        ac60.checked = false;

        ac_outlets.readOnly = true;
        ac_outlets_price.readOnly = true;
        ac_grill.readOnly = true;
        ac_grill_price.readOnly = true;
        ac_conv_outlet.readOnly = true;
        ac_conv_outlet_price.readOnly = true;
        service_area.readOnly = true;
        service_area_price.readOnly = true;
        others.readOnly = true;
        others_price.readOnly = true;
        floor_elev_price.readOnly = true;
        
        // process_fee.value = 0;
        // pf_month.value = 0;
        // tcp_disc.value = 0;
        // tcp_disc_amt.value = 0;
        // tcp_total.value = 0;
        // vat_percent.value = 0;
        // vat_cmptd.value = 0;
        // net_tcp.value = 0;
        // ac_outlet_subtotal.value = 0;
        // ac_grill_subtotal.value = 0;
        // ac_conv_subtotal.value = 0;
        // ac_service_subtotal.value = 0;
        // ac_others_subtotal.value = 0;
        // addcost_total.value = 0;

        findButton.disabled = true;

    } else if (typeText.value === "3") {
        floorArea.readOnly = false;
        houseSqm.readOnly = false;
        houseDisc.readOnly = false;
        houseModelSelect.disabled = false;
        houseModelSelect.value = "";
        houseModelSelect.style.backgroundColor = "white";

        lotDisc.readOnly = false;

        // floorArea.value = 0;
        // houseSqm.value = 0;
        // houseDisc.value = 0;
        // houseModelSelect.selectedIndex = 0;
        // houseDiscAmt.value = 0;
        // hcp.value = 0;

        // lotPhase.value='';
        // lotBlock.value='';
        // lotLot.value='';
        // lotDisc.value='';
        // lotArea.value='';
        // lotPrice.value='';
        // lotAmt.value='';
        // lotDiscAmt.value='';
        // lotLCP.value='';

        // ac_outlets.value = 0;
        // ac_outlets_price.value = 0;
        // ac_grill.value = 0;
        // ac_grill_price.value = 0;
        // ac_conv_outlet.value = 0;
        // ac_conv_outlet_price.value = 0;
        // service_area.value = 0;
        // service_area_price.value = 0;
        // others.value = 0;
        // others_price.value = 0;
        // floor_elev_price.value = 0;

        ac20.disabled = false;
        ac40.disabled = false;
        ac60.disabled = false;
        ac20.checked = false;
        ac40.checked = false;
        ac60.checked = false;

        ac_outlets.readOnly = false;
        ac_outlets_price.readOnly = false;
        ac_grill.readOnly = false;
        ac_grill_price.readOnly = false;
        ac_conv_outlet.readOnly = false;
        ac_conv_outlet_price.readOnly = false;
        service_area.readOnly = false;
        service_area_price.readOnly = false;
        others.readOnly = false;
        others_price.readOnly = false;
        floor_elev_price.readOnly = false;

        // process_fee.value = 0;
        // pf_month.value = 0;
        // tcp_disc.value = 0;
        // tcp_disc_amt.value = 0;
        // tcp_total.value = 0;
        // vat_percent.value = 0;
        // vat_cmptd.value = 0;
        // net_tcp.value = 0;
        // ac_outlet_subtotal.value = 0;
        // ac_grill_subtotal.value = 0;
        // ac_conv_subtotal.value = 0;
        // ac_service_subtotal.value = 0;
        // ac_others_subtotal.value = 0;
        // addcost_total.value = 0;

        findButton.disabled = false;

    }else if (typeText.value === "5") {
        floorArea.readOnly = true;
        houseSqm.readOnly = true;
        houseDisc.readOnly = true;
        houseModelSelect.disabled = true;
        houseModelSelect.value = "";
        houseModelSelect.classList.add("readonly-select");

        ac20.disabled = false;
        ac40.disabled = false;
        ac60.disabled = false;
        ac_outlets.readOnly = false;
        ac_outlets_price.readOnly = false;
        ac_grill.readOnly = false;
        ac_grill_price.readOnly = false;
        ac_conv_outlet.readOnly = false;
        ac_conv_outlet_price.readOnly = false;
        service_area.readOnly = false;
        service_area_price.readOnly = false;
        others.readOnly = false;
        others_price.readOnly = false;
        floor_elev_price.readOnly = false;

        ac20.disabled = false;
        ac40.disabled = false;
        ac60.disabled = false;
        ac20.checked = false;
        ac40.checked = false;
        ac60.checked = false;

        // floorArea.value = 0;
        // houseSqm.value = 0;
        // houseDisc.value = 0;
        // houseModelSelect.selectedIndex = 0;
        // houseDiscAmt.value = 0;
        // hcp.value = 0;

        // lotPhase.value='';
        // lotBlock.value='';
        // lotLot.value='';
        // lotDisc.value='';
        // lotArea.value='';
        // lotPrice.value='';
        // lotAmt.value='';
        // lotDiscAmt.value='';
        // lotLCP.value='';

        // ac_outlets.value = 0;
        // ac_outlets_price.value = 0;
        // ac_grill.value = 0;
        // ac_grill_price.value = 0;
        // ac_conv_outlet.value = 0;
        // ac_conv_outlet_price.value = 0;
        // service_area.value = 0;
        // service_area_price.value = 0;
        // others.value = 0;
        // others_price.value = 0;
        // floor_elev_price.value = 0;

        // process_fee.value = 0;
        // pf_month.value = 0;
        // tcp_disc.value = 0;
        // tcp_disc_amt.value = 0;
        // tcp_total.value = 0;
        // vat_percent.value = 0;
        // vat_cmptd.value = 0;
        // net_tcp.value = 0;
        // ac_outlet_subtotal.value = 0;
        // ac_grill_subtotal.value = 0;
        // ac_conv_subtotal.value = 0;
        // ac_service_subtotal.value = 0;
        // ac_others_subtotal.value = 0;
        // addcost_total.value = 0;
    }
}


document.addEventListener("DOMContentLoaded", function () {
    var radioButtons = document.querySelectorAll('input[type="radio"][name="chkOption3"]');
    var typeText = document.getElementById("type_text");


    ///House
    var floorArea = document.getElementById("floor_area");
    var houseSqm = document.getElementById("h_price_per_sqm");
    var houseDisc = document.getElementById("house_disc");
    var houseDiscAmt =document.getElementById("house_disc_amt");
    var houseModelSelect = document.querySelector('select[name="house_model"]');

    ///Lot
    var lotPhase = document.getElementById("l_site");
    var lotBlock = document.getElementById("l_block");
    var lotLot = document.getElementById("l_lot");
    var lotDisc = document.getElementById("lot_disc");
    var lotArea = document.getElementById("lot_area");
    var lotPrice = document.getElementById("price_per_sqm");
    var lotAmt = document.getElementById("amount");
    var lotDiscAmt = document.getElementById("lot_disc_amt");
    var lotLCP = document.getElementById("lcp");
    var findButton = document.getElementById("btnfind");

    ///Add Cost
    var ac20 = document.getElementById("id20");
    var ac40 = document.getElementById("id40");
    var ac60 = document.getElementById("id60");
    var ac_outlets = document.getElementById("aircon_outlets");
    var ac_outlets_price = document.getElementById("aircon_outlet_price");
    var ac_grill = document.getElementById("ac_grill");
    var ac_grill_price = document.getElementById("ac_grill_price");
    var ac_conv_outlet = document.getElementById("conv_outlet");
    var ac_conv_outlet_price = document.getElementById("conv_outlet_price");
    var service_area = document.getElementById("service_area");
    var service_area_price  = document.getElementById("service_area_price");
    var others = document.getElementById("others");
    var others_price = document.getElementById("others_price");
    var floor_elev_price = document.getElementById("flrelev_price");
    var ac_outlet_subtotal = document.getElementById("ac_outlet_subtotal");
    var ac_grill_subtotal = document.getElementById("ac_grill_subtotal");
    var ac_conv_subtotal = document.getElementById("conv_outlet_subtotal");
    var ac_service_subtotal = document.getElementById("service_subtotal");
    var ac_others_subtotal = document.getElementById("others_subtotal");
    var addcost_total = document.getElementById("add_cost_total");

    //Payment
    var process_fee = document.getElementById("process_fee");
    var pf_month = document.getElementById("pf_month");
    var tcp_disc = document.getElementById("tcp_disc");
    var tcp_disc_amt = document.getElementById("tcp_disc_amt");
    var tcp_total = document.getElementById("total_tcp");
    var vat_percent = document.getElementById("vat_percent");
    var vat_cmptd = document.getElementById("vat_amt_computed");
    var net_tcp = document.getElementById("net_tcp");



    radioButtons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            console.log("Radio button changed");
            typeText.value = this.value;

            if (this.value === "1") {
                
                lotDisc.readOnly = false;

                floorArea.readOnly = true;
                houseSqm.readOnly = true;
                houseDisc.readOnly = true;
                houseModelSelect.disabled = true;
                houseModelSelect.value = "";
                houseModelSelect.classList.add("readonly-select");

                floorArea.value = 0;
                houseSqm.value = 0;
                houseDisc.value = 0;
                houseModelSelect.selectedIndex = 0;
                houseDiscAmt.value = 0;
                hcp.value = 0;

                lotPhase.value='';
                lotBlock.value='';
                lotLot.value='';
                lotDisc.value='';
                lotArea.value='';
                lotPrice.value='';
                lotAmt.value='';
                lotDiscAmt.value='';
                lotLCP.value='';
                
                ac_outlets.value = 0;
                ac_outlets_price.value = 0;
                ac_grill.value = 0;
                ac_grill_price.value = 0;
                ac_conv_outlet.value = 0;
                ac_conv_outlet_price.value = 0;
                service_area.value = 0;
                service_area_price.value = 0;
                others.value = 0;
                others_price.value = 0;
                floor_elev_price.value = 0;

                ac20.disabled = true;
                ac40.disabled = true;
                ac60.disabled = true;
                ac20.checked = false;
                ac40.checked = false;
                ac60.checked = false;

                ac_outlets.readOnly = true;
                ac_outlets_price.readOnly = true;
                ac_grill.readOnly = true;
                ac_grill_price.readOnly = true;
                ac_conv_outlet.readOnly = true;
                ac_conv_outlet_price.readOnly = true;
                service_area.readOnly = true;
                service_area_price.readOnly = true;
                others.readOnly = true;
                others_price.readOnly = true;
                floor_elev_price.readOnly = true;

                process_fee.value = 0;
                pf_month.value = 0;
                tcp_disc.value = 0;
                tcp_disc_amt.value = 0;
                tcp_total.value = 0;
                vat_percent.value = 0;
                vat_cmptd.value = 0;
                net_tcp.value = 0;
                ac_outlet_subtotal.value = 0;
                ac_grill_subtotal.value = 0;
                ac_conv_subtotal.value = 0;
                ac_service_subtotal.value = 0;
                ac_others_subtotal.value = 0;
                addcost_total.value = 0;

                houseModelSelect.style.backgroundColor = "#e9ecef";
                findButton.disabled = false;

            } else if (this.value === "2" || this.value === "4") {
                floorArea.readOnly = false;
                houseSqm.readOnly = false;
                houseDisc.readOnly = false;
                houseModelSelect.disabled = false;
                houseModelSelect.value = "";
                houseModelSelect.style.backgroundColor = "white";

                lotDisc.readOnly = true;

                floorArea.value = 0;
                houseSqm.value = 0;
                houseDisc.value = 0;
                houseModelSelect.selectedIndex = 0;
                houseDiscAmt.value = 0;
                hcp.value = 0;

                lotPhase.value='';
                lotBlock.value='';
                lotLot.value='';
                lotDisc.value='';
                lotArea.value='';
                lotPrice.value='';
                lotAmt.value='';
                lotDiscAmt.value='';
                lotLCP.value='';

                ac_outlets.value = 0;
                ac_outlets_price.value = 0;
                ac_grill.value = 0;
                ac_grill_price.value = 0;
                ac_conv_outlet.value = 0;
                ac_conv_outlet_price.value = 0;
                service_area.value = 0;
                service_area_price.value = 0;
                others.value = 0;
                others_price.value = 0;
                floor_elev_price.value = 0;

                ac20.disabled = true;
                ac40.disabled = true;
                ac60.disabled = true;
                ac20.checked = false;
                ac40.checked = false;
                ac60.checked = false;

                ac_outlets.readOnly = true;
                ac_outlets_price.readOnly = true;
                ac_grill.readOnly = true;
                ac_grill_price.readOnly = true;
                ac_conv_outlet.readOnly = true;
                ac_conv_outlet_price.readOnly = true;
                service_area.readOnly = true;
                service_area_price.readOnly = true;
                others.readOnly = true;
                others_price.readOnly = true;
                floor_elev_price.readOnly = true;
                
                process_fee.value = 0;
                pf_month.value = 0;
                tcp_disc.value = 0;
                tcp_disc_amt.value = 0;
                tcp_total.value = 0;
                vat_percent.value = 0;
                vat_cmptd.value = 0;
                net_tcp.value = 0;
                ac_outlet_subtotal.value = 0;
                ac_grill_subtotal.value = 0;
                ac_conv_subtotal.value = 0;
                ac_service_subtotal.value = 0;
                ac_others_subtotal.value = 0;
                addcost_total.value = 0;

                findButton.disabled = true;

            } else if (this.value === "3") {
                floorArea.readOnly = false;
                houseSqm.readOnly = false;
                houseDisc.readOnly = false;
                houseModelSelect.disabled = false;
                houseModelSelect.value = "";
                houseModelSelect.style.backgroundColor = "white";

                lotDisc.readOnly = false;

                floorArea.value = 0;
                houseSqm.value = 0;
                houseDisc.value = 0;
                houseModelSelect.selectedIndex = 0;
                houseDiscAmt.value = 0;
                hcp.value = 0;

                lotPhase.value='';
                lotBlock.value='';
                lotLot.value='';
                lotDisc.value='';
                lotArea.value='';
                lotPrice.value='';
                lotAmt.value='';
                lotDiscAmt.value='';
                lotLCP.value='';

                ac_outlets.value = 0;
                ac_outlets_price.value = 0;
                ac_grill.value = 0;
                ac_grill_price.value = 0;
                ac_conv_outlet.value = 0;
                ac_conv_outlet_price.value = 0;
                service_area.value = 0;
                service_area_price.value = 0;
                others.value = 0;
                others_price.value = 0;
                floor_elev_price.value = 0;

                ac20.disabled = false;
                ac40.disabled = false;
                ac60.disabled = false;
                ac20.checked = false;
                ac40.checked = false;
                ac60.checked = false;

                ac_outlets.readOnly = false;
                ac_outlets_price.readOnly = false;
                ac_grill.readOnly = false;
                ac_grill_price.readOnly = false;
                ac_conv_outlet.readOnly = false;
                ac_conv_outlet_price.readOnly = false;
                service_area.readOnly = false;
                service_area_price.readOnly = false;
                others.readOnly = false;
                others_price.readOnly = false;
                floor_elev_price.readOnly = false;

                process_fee.value = 0;
                pf_month.value = 0;
                tcp_disc.value = 0;
                tcp_disc_amt.value = 0;
                tcp_total.value = 0;
                vat_percent.value = 0;
                vat_cmptd.value = 0;
                net_tcp.value = 0;
                ac_outlet_subtotal.value = 0;
                ac_grill_subtotal.value = 0;
                ac_conv_subtotal.value = 0;
                ac_service_subtotal.value = 0;
                ac_others_subtotal.value = 0;
                addcost_total.value = 0;

                findButton.disabled = false;

            }else if (this.value === "5") {
                floorArea.readOnly = true;
                houseSqm.readOnly = true;
                houseDisc.readOnly = true;
                houseModelSelect.disabled = true;
                houseModelSelect.value = "";
                houseModelSelect.classList.add("readonly-select");

                ac20.disabled = false;
                ac40.disabled = false;
                ac60.disabled = false;
                ac_outlets.readOnly = false;
                ac_outlets_price.readOnly = false;
                ac_grill.readOnly = false;
                ac_grill_price.readOnly = false;
                ac_conv_outlet.readOnly = false;
                ac_conv_outlet_price.readOnly = false;
                service_area.readOnly = false;
                service_area_price.readOnly = false;
                others.readOnly = false;
                others_price.readOnly = false;
                floor_elev_price.readOnly = false;

                ac20.disabled = false;
                ac40.disabled = false;
                ac60.disabled = false;
                ac20.checked = false;
                ac40.checked = false;
                ac60.checked = false;

                floorArea.value = 0;
                houseSqm.value = 0;
                houseDisc.value = 0;
                houseModelSelect.selectedIndex = 0;
                houseDiscAmt.value = 0;
                hcp.value = 0;

                lotPhase.value='';
                lotBlock.value='';
                lotLot.value='';
                lotDisc.value='';
                lotArea.value='';
                lotPrice.value='';
                lotAmt.value='';
                lotDiscAmt.value='';
                lotLCP.value='';

                ac_outlets.value = 0;
                ac_outlets_price.value = 0;
                ac_grill.value = 0;
                ac_grill_price.value = 0;
                ac_conv_outlet.value = 0;
                ac_conv_outlet_price.value = 0;
                service_area.value = 0;
                service_area_price.value = 0;
                others.value = 0;
                others_price.value = 0;
                floor_elev_price.value = 0;

                process_fee.value = 0;
                pf_month.value = 0;
                tcp_disc.value = 0;
                tcp_disc_amt.value = 0;
                tcp_total.value = 0;
                vat_percent.value = 0;
                vat_cmptd.value = 0;
                net_tcp.value = 0;
                ac_outlet_subtotal.value = 0;
                ac_grill_subtotal.value = 0;
                ac_conv_subtotal.value = 0;
                ac_service_subtotal.value = 0;
                ac_others_subtotal.value = 0;
                addcost_total.value = 0;
            }
        });
    });
});



</script>

