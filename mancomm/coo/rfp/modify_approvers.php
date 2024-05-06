<?php
require_once('../../../config.php');

if(isset($_GET['rfp_no']) && $_GET['rfp_no'] > 0) {
    $rfp_no = $_GET['rfp_no'];
    echo "RFP Number: $rfp_no";
} else {
    echo "RFP number not provided.";
}
?>


<body onload=initialize()">
    <div class="card card-outline card-primary">

        <div class="card-body">
            
                <br><hr><br>
               
                    <div class="card-body" style="border:1px solid gainsboro;">
                        <label for="" class="control-label"># of Approvers: </label>
                        <?php 
                        $rfp_query = $conn->prepare("SELECT status1, status2, status3, status4, status5, status6, status7 FROM tbl_rfp WHERE rfp_no = ?");
                        $rfp_query->bind_param("i", $_GET['rfp_no']);
                        $rfp_no = $_GET['rfp_no'];
                        $rfp_query->execute();
                        $rfp_result = $rfp_query->get_result();

                        $user_codes_from_db = array();

                        while ($row = $rfp_result->fetch_assoc()) {
                            foreach ($row as $status) {
                                if (!empty($status)) {
                                    $user_codes_from_db[] = $status;
                                }
                            }
                        }
                        
                        $total_count = count($user_codes_from_db);
                        ?>
                        
                                                <input type="number" id="inputValue" value="<?php echo $total_count; ?>" style="width:50px;background-color:yellow;border:none;text-align:center;" readonly><hr>
                                                <!-- <button type="button" id="addApproverButton" class="btn btn-primary btn-sm ml-2">Add</button> -->
                        <div class="container-fluid approversDiv">
                            <?php
                            for ($i = 0; $i < $total_count; $i++) {
                                $approver_qry = $conn->query("SELECT * FROM `users` WHERE division = 'SPVR' OR division = 'MNGR' OR position = 'EXECUTIVE ASSISTANT TO THE COO'");
                                echo '<div class="approver-row">';
                                echo '<label for="status' . ($i + 1) . '">Approver ' . ($i + 1) . ':</label>';
                                echo '<select id="status' . ($i + 1) . '" class="custom-select custom-select-sm rounded-0 select2" name="status' . ($i + 1) . '">';

                                while ($row = $approver_qry->fetch_assoc()) {
                                    $selected = ($user_codes_from_db[$i] == $row['user_code']) ? 'selected' : '';
                                                                        echo '<option value="' . $row['user_code'] . '" ' . $selected . '>' . $row['firstname'] . ' ' . $row['lastname'] . '</option>';
                                }
                                echo '</select>';
                                //echo '<button type="button" id="removeApproverButton' . ($i + 1) . '" class="btn btn-danger btn-sm removeApproverButton">Remove</button>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                 
                </div>
        <div>
    <div>
</body>

<?php 
if (isset($_GET['id']) == ''){ 
    echo '<script>';
    echo 'window.onload = function() {';
    echo 'var inputValue = document.getElementById("inputValue").value;'; 
    echo 'var section = "' . $_settings->userdata('section') . '";'; 
    
    echo 'if (section === "Accounting") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["10184", "10030", "20124", "10055"];';
    echo '} else if (section === "Billing") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["20016", "10030", "20124", "10055"];';
    echo '} else if (section === "Const. and Impln.") {';
    echo '    inputValue = 5; '; 
    echo '    var selects = ["10006", "10114", "10051", "20124", "10055"];';
    echo '} else if (section === "Documentation and Loan") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["20084", "10009", "20124", "10055"];';
    echo '} else if (section === "IT") {';
    echo '    inputValue = 3; '; 
    echo '    var selects = ["20181", "20124", "10055"];';
    echo '} else if (section === "Legal") {';
    echo '    inputValue = 3; '; 
    echo '    var selects = ["10102", "20124", "10055"];';
    echo '} else if (section === "Audit") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["20018", "10030","20124", "10055"];';
    echo '} else if (section === "Inventory Control") {';
    echo '    inputValue = 5; '; 
    echo '    var selects = ["20017", "20003", "10009","20124", "10055"];';
    echo '} else if (section === "General Services") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["10143", "10070","20124", "10055"];';
    echo '} else if (section === "Marketing") {';
    echo '    inputValue = 5; '; 
    echo '    var selects = ["10100", "10114","10051","20124", "10055"];';
    echo '} else if (section === "Corporate Communications") {';
    echo '    inputValue = 3; '; 
    echo '    var selects = ["10131","20124", "10055"];';
    echo '} else if (section === "Personnel") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["10041","10070","20124", "10055"];';
    echo '} else if (section === "Project Admin") {';
    echo '    inputValue = 5; '; 
    echo '    var selects = ["20001","10114","10051","20124", "10055"];';
    echo '} else if (section === "Treasury") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["10017","10007","20124", "10055"];';
    echo '} else if (section === "CALS") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["10012","10030","20124", "10055"];';
    echo '} else if (section === "Contracts and Doc.") {';
    echo '    inputValue = 5; '; 
    echo '    var selects = ["10026","10114","10051","20124", "10055"];';
    echo '} else if (section === "Design and Devt.") {';
    echo '    inputValue = 5; '; 
    echo '    var selects = ["10026","10114","10051","20124", "10055"];';
    echo '} else if (section === "Purchasing") {';
    echo '    inputValue = 4; '; 
    echo '    var selects = ["10015","10030","20124", "10055"];';
    echo '} else if (section === "Technical Planning") {';
    echo '    inputValue = 6; '; 
    echo '    var selects = ["20186","10026","10114","10051","20124", "10055"];';
    echo '} else if (section === "Permits and Licenses") {';
    echo '    inputValue = 3; '; 
    echo '    var selects = ["10009","20124", "10055"];';
    echo '} else if (section === "Electrical") {';
    echo '    inputValue = 6; '; 
    echo '    var selects = ["10038","10026", "10114","10051","20124", "10055"];';
    echo '}';
    
    echo 'var container = document.querySelector(".approversDiv");';
    echo 'var originalSelect = document.getElementById("status1_orig");';
    echo 'container.innerHTML = "";';
    echo 'var clonedSelectContainer = document.createElement("div");';
    echo 'clonedSelectContainer.className = "clonedSelectContainer";';
    echo 'for (var i = 1; i < inputValue; i++) { ';
    echo '    var clonedSelect = originalSelect.cloneNode(true);';
    echo '    clonedSelect.id = "status" + (i + 1); ';
    echo '    clonedSelect.name = "status" + (i + 1); ';
    echo '    clonedSelect.selectedIndex = 0;';
    echo '    clonedSelect.value = selects[i - 1];'; 
    echo '    clonedSelectContainer.appendChild(cloneSelectWithLabel(clonedSelect, (i + 1)));';
    echo '}';
    
    echo 'if (inputValue > 1) {';
    echo '    container.appendChild(cloneSelectWithLabel(originalSelect, 1)); ';
    echo '    container.appendChild(clonedSelectContainer);';
    echo '} else {';
    echo '    container.appendChild(cloneSelectWithLabel(originalSelect, 1)); ';
    echo '}';
    
    echo 'document.querySelectorAll(".custom-select").forEach(function (select, index) {';
    echo '    select.style.display = "block";';
    echo '    select.value = selects[index];'; 
    echo '});';
    
    echo '};';
    echo '</script>';
} 
?>
<script>
    function getUrlParameter(name) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(window.location.href);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    document.querySelectorAll('.removeApproverButton').forEach(function(button, index) {
        button.addEventListener('click', function() {
        console.log('Remove button clicked for select #' + (index + 1));
        var selectName = 'status' + (index + 1);
        console.log('Removed select: ' + selectName);

        var selectValue = document.getElementById(selectName).value;
        console.log('Value of select to be removed: ' + selectValue);
        
        var removedSelect = document.getElementById(selectName);
        if (removedSelect) {
            removedSelect.parentNode.removeChild(removedSelect);
        }

        var selects = document.querySelectorAll('.approver-row select');
        for (var i = 0; i < selects.length; i++) {
            selects[i].setAttribute('name', 'status' + (i + 1));
            console.log('Updated select: status' + (i + 1));
        }

        var allSelectValues = {};
        for (var i = 1; i <= 7; i++) {
            var select = document.querySelector('select[name="status' + i + '"]');
            if (select) {
                allSelectValues['status' + i] = select.value;
            }
        }
        
        console.log('All select values:', allSelectValues);
        var rfp_no = getUrlParameter('id');
        console.log('RFP number: ' + rfp_no);
        
        var xhr1 = new XMLHttpRequest();
        xhr1.open('POST', 'rfp/update_approvers.php', true);
        xhr1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr1.onreadystatechange = function() {
            if (xhr1.readyState === 4 && xhr1.status === 200) {
                console.log(xhr1.responseText);
            }
        };
       
        var payload = 'removedSelect=' + selectName + '&rfp_no=' + rfp_no;
        for (var key in allSelectValues) {
            payload += '&' + key + '=' + allSelectValues[key];
        }
        
        xhr1.send(payload);
    });
});


</script>

<script>
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('removeApproverButton')) {
        var approverRow = event.target.parentElement;
        var removedApproverId = approverRow.querySelector('select').id;
        var removedPosition = parseInt(removedApproverId.replace('status', ''));
        
        approverRow.remove();

        // Update the IDs and names of the remaining select elements
        var selectElements = document.querySelectorAll('.approversDiv select');
        selectElements.forEach(function(selectElement, index) {
            var currentPosition = index + 1;
            var newId = 'status' + currentPosition;
            selectElement.id = newId;
            selectElement.name = newId;
        });

        // Update the for attribute of the labels
        var labelElements = document.querySelectorAll('.approversDiv label');
        labelElements.forEach(function(labelElement, index) {
            var currentPosition = index + 1;
            labelElement.setAttribute('for', 'status' + currentPosition);
            labelElement.textContent = 'Approver ' + currentPosition + ':';
        });
    }
});

</script>

<script>
    document.getElementById('addApproverButton').addEventListener('click', function() {
        var approversDiv = document.querySelector('.approversDiv');
        var totalCount = approversDiv.querySelectorAll('.approver-row').length + 1;

        var newApproverRow = document.createElement('div');
        newApproverRow.classList.add('approver-row');

        var newLabel = document.createElement('label');
        newLabel.setAttribute('for', 'status' + totalCount);
        newLabel.textContent = 'Approver ' + totalCount + ':';
        
        var newSelect = document.createElement('select');
        newSelect.setAttribute('id', 'status' + totalCount);
        newSelect.setAttribute('class', 'custom-select custom-select-sm rounded-0 select2');
        newSelect.setAttribute('name', 'status' + totalCount);

        <?php
        $approver_qry = $conn->query("SELECT * FROM `users` WHERE division = 'SPVR' OR division = 'MNGR' OR position = 'EXECUTIVE ASSISTANT TO THE COO'");
        while ($row = $approver_qry->fetch_assoc()) {
            echo 'var option = document.createElement("option");';
            echo 'option.value = "' . $row['user_code'] . '";';
            echo 'option.text = "' . $row['lastname'] . ', ' . $row['firstname'] . '";';
            echo 'newSelect.appendChild(option);';
        }
        ?>
        newApproverRow.appendChild(newLabel);
        newApproverRow.appendChild(newSelect);
        approversDiv.appendChild(newApproverRow);
    });

</script>
<script>
    function handleAddApprover() {
        var inputValue = document.getElementById('inputValue');
        var addApproverButton = document.getElementById('addApproverButton');
        
        function checkLimitAndDisableButton() {
            var currentCount = parseInt(inputValue.value);
            if (currentCount >= 7) {
                addApproverButton.disabled = true; 
            }
        }

        addApproverButton.addEventListener('click', function() {
            var currentCount = parseInt(inputValue.value);
            if (currentCount < 7) {
                var newCount = currentCount + 1;
                inputValue.value = newCount;
                checkLimitAndDisableButton(); 
            } else {
                checkLimitAndDisableButton(); 
            }
        });
        checkLimitAndDisableButton();
    }
    window.addEventListener('load', handleAddApprover);
</script>
