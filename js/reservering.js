document.addEventListener('DOMContentLoaded', () => {
    const reservationsList = document.getElementById('reservations-list');

    // Function to fetch and display reservations
    function fetchReservations() {
        fetch('../php/get_reservations.php')  // Verwijzing naar PHP-bestand dat reserveringen ophaalt uit de database
            .then(response => response.json())
            .then(data => {
                reservationsList.innerHTML = '';  // Maak de lijst eerst leeg
                if (data.length > 0) {
                    data.forEach(reservation => {
                        // Voor elke reservering, maak een element aan en voeg deze toe aan de lijst
                        const reservationItem = document.createElement('div');
                        reservationItem.classList.add('reservation-item');
                        reservationItem.innerHTML = `
                            <p><strong>Table:</strong> ${reservation.table_id}</p>
                            <p><strong>Time:</strong> ${reservation.reservation_time}</p>
                            <p><strong>Customer:</strong> ${reservation.customer_name}</p>
                        `;
                        reservationsList.appendChild(reservationItem);
                    });
                } else {
                    reservationsList.innerHTML = '<p>No reservations found for today.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching reservations:', error);
                reservationsList.innerHTML = '<p>Error loading reservations. Please try again later.</p>';
            });
    }

    // Initial fetch when page loads
    fetchReservations();
});
