document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('status-filter').addEventListener('change', function() {
        var selectedStatus = this.value;

        var rows = document.querySelectorAll('.order-row');

        rows.forEach(function(row) {
            if (selectedStatus === 'all') {
                row.style.display = '';
            } else if (row.getAttribute('data-status') === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
