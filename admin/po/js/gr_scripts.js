function showOpenPOsTable() {
    document.getElementById('open-purchase-orders-table').style.display = 'block';
    document.getElementById('closed-purchase-orders-table').style.display = 'none';
    document.getElementById('open-link').style.borderBottom = 'solid 2px blue';
    document.getElementById('open-link').style.backgroundColor = '#E8E8E8';
    document.getElementById('closed-link').style.borderBottom = 'none';
    document.getElementById('closed-link').style.backgroundColor = 'transparent';
    document.getElementById('purchase-orders-title').textContent = 'List of Open Purchase Orders';
}

function showClosedPOsTable() {
    document.getElementById('open-purchase-orders-table').style.display = 'none';
    document.getElementById('closed-purchase-orders-table').style.display = 'block';
    document.getElementById('closed-link').style.borderBottom = 'solid 2px blue';
    document.getElementById('closed-link').style.backgroundColor = '#E8E8E8';
    document.getElementById('open-link').style.borderBottom = 'none';
    document.getElementById('open-link').style.backgroundColor = 'transparent';
    document.getElementById('purchase-orders-title').textContent = 'List of Closed Purchase Orders';
}
