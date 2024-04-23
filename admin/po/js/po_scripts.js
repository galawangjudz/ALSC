function formatDecimal(input) {
    let sanitizedInput = input.value.replace(/[^0-9.]/g, '');
    let parts = sanitizedInput.split('.');

    if (parts[1] && parts[1].length > 2) {
        parts[1] = parts[1].slice(0, 2);
    }
    input.value = parts.join('.');
}

function showPendingPOsTable() {
    document.getElementById('pending-table').style.display = 'block';
    document.getElementById('approved-table').style.display = 'none';
    document.getElementById('declined-table').style.display = 'none';
    document.getElementById('review-table').style.display = 'none';

    document.getElementById('pending-link').style.borderBottom = 'solid 2px blue';
    document.getElementById('pending-link').style.backgroundColor = '#E8E8E8';
    document.getElementById('approved-link').style.borderBottom = 'none';
    document.getElementById('approved-link').style.backgroundColor = 'transparent';
    document.getElementById('declined-link').style.borderBottom = 'none';
    document.getElementById('declined-link').style.backgroundColor = 'transparent';
    document.getElementById('review-link').style.borderBottom = 'none';
    document.getElementById('review-link').style.backgroundColor = 'transparent';

    document.getElementById('main-title').textContent = 'List of Pending Purchase Orders';
}

function showApprovedPOsTable() {
    document.getElementById('pending-table').style.display = 'none';
    document.getElementById('approved-table').style.display = 'block';
    document.getElementById('declined-table').style.display = 'none';
    document.getElementById('review-table').style.display = 'none';

    document.getElementById('pending-link').style.borderBottom = 'none';
    document.getElementById('pending-link').style.backgroundColor = 'transparent';
    document.getElementById('approved-link').style.borderBottom = 'solid 2px blue';
    document.getElementById('approved-link').style.backgroundColor = '#E8E8E8';
    document.getElementById('declined-link').style.borderBottom = 'none';
    document.getElementById('declined-link').style.backgroundColor = 'transparent';
    document.getElementById('review-link').style.borderBottom = 'none';
    document.getElementById('review-link').style.backgroundColor = 'transparent';

    document.getElementById('main-title').textContent = 'List of Approved Purchase Orders';
}

function showDeclinedPOsTable() {
    document.getElementById('pending-table').style.display = 'none';
    document.getElementById('approved-table').style.display = 'none';
    document.getElementById('declined-table').style.display = 'block';
    document.getElementById('review-table').style.display = 'none';

    document.getElementById('pending-link').style.borderBottom = 'none';
    document.getElementById('pending-link').style.backgroundColor = 'transparent';
    document.getElementById('approved-link').style.borderBottom = 'none';
    document.getElementById('approved-link').style.backgroundColor = 'transparent';
    document.getElementById('declined-link').style.borderBottom = 'solid 2px blue';
    document.getElementById('declined-link').style.backgroundColor = '#E8E8E8';
    document.getElementById('review-link').style.borderBottom = 'none';
    document.getElementById('review-link').style.backgroundColor = 'transparent';

    document.getElementById('main-title').textContent = 'List of Declined Purchase Orders';
}

function showForReviewPOsTable() {
    document.getElementById('pending-table').style.display = 'none';
    document.getElementById('approved-table').style.display = 'none';
    document.getElementById('declined-table').style.display = 'none';
    document.getElementById('review-table').style.display = 'block';

    document.getElementById('pending-link').style.borderBottom = 'none';
    document.getElementById('pending-link').style.backgroundColor = 'transparent';
    document.getElementById('approved-link').style.borderBottom = 'none';
    document.getElementById('approved-link').style.backgroundColor = 'transparent';
    document.getElementById('declined-link').style.borderBottom = 'none';
    document.getElementById('declined-link').style.backgroundColor = 'transparent';
    document.getElementById('review-link').style.borderBottom = 'solid 2px blue';
    document.getElementById('review-link').style.backgroundColor = '#E8E8E8';

    document.getElementById('main-title').textContent = 'List of Purchase Orders for Revision';
}

