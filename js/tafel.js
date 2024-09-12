document.addEventListener('DOMContentLoaded', () => {
    const tableFloorplan = document.getElementById('table-floorplan');

    function renderTables() {
        const tables = [
            { id: 1, name: 'Table 1', reservations: ['12:00', '13:00'] },
            { id: 2, name: 'Table 2', reservations: ['12:30', '14:00'] }
        ];

        tableFloorplan.innerHTML = tables.map(table => `
            <div class="table-item">
                <h4>${table.name}</h4>
                <div class="hover-menu">
                    <h5>Upcoming Reservations:</h5>
                    <ul>
                        ${table.reservations.map(res => `<li>${res}</li>`).join('')}
                    </ul>
                </div>
            </div>
        `).join('');
    }

    renderTables();
});
