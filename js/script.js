document.addEventListener('DOMContentLoaded', () => {
    const tableFloorplan = document.getElementById('table-floorplan');
    const reservationsList = document.getElementById('reservations-list');
    const reservationForm = document.getElementById('reservation-form');

    function renderTables() {
        // Voorbeeld data, zou normaal uit een API komen
        const tables = [
            { id: 1, name: 'Table 1', reservations: ['12:00', '13:00'] },
            { id: 2, name: 'Table 2', reservations: ['12:30', '14:00'] },
            // meer tafels
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

    function handleFormSubmit(event) {
        event.preventDefault();

        const formData = new FormData(reservationForm);
        fetch('./reserve.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            // Update de UI
            renderTables();
            renderReservations();
        })
        .catch(error => console.error('Error:', error));
    }

    reservationForm.addEventListener('submit', handleFormSubmit);

    function renderReservations() {
        fetch('./get_reservations.php')
        .then(response => response.json())
        .then(data => {
            reservationsList.innerHTML = data.map(reservation => `
                <div class="reservation-item">
                    <p>Table ${reservation.table_id}</p>
                    <p>Time: ${reservation.reservation_time}</p>
                    <p>Customer: ${reservation.customer_name}</p>
                </div>
            `).join('');
        })
        .catch(error => console.error('Error:', error));
    }

    renderTables();
    renderReservations();
});
