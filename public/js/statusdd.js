document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('status-filter').addEventListener('change', function() {
        var selectedStatus = this.value;

        var rows = document.querySelectorAll('.order-row');

        rows.forEach(function(row) {
            if (selectedStatus === 'all') {
                row.style.display = ""; // Show all rows
            } else if (row.getAttribute('data-status') == selectedStatus) {
                row.style.display = ''; // Show rows that match the selected status
            } else {
                row.style.display = 'none'; // Hide rows that do not match the selected status
            }
        });
    });
});