document.addEventListener('DOMContentLoaded', function () {
    fetch('../api/get_tafels.php')
        .then(response => response.json())
        .then(data => {
            const tablesRow = document.getElementById('tables-row');
            tablesRow.innerHTML = '';
            data.forEach(table => {
                const div = document.createElement('div');
                div.classList.add('table');
                div.dataset.status = table.status;
                div.innerHTML = `
                    <p>Table ${table.tafel_nummer}</p>
                    <div class="tooltip">
                        ${table.status === 'available' ? 'Available' : table.status === 'reserved' ? `Reserved by ${table.guest_name} for ${table.people} people` : `Occupied by ${table.guest_name} for ${table.people} people`}
                    </div>
                `;
                tablesRow.appendChild(div);
            });
        })
        .catch(error => console.error('Error fetching tables:', error));
});
