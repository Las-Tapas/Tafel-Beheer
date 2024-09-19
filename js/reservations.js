document.addEventListener('DOMContentLoaded', function () {
    fetch('../api/get_reservations.php')
        .then(response => response.json())
        .then(data => {
            const reservationsList = document.getElementById('reservations-list');
            reservationsList.innerHTML = '';
            data.forEach(reservation => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${reservation.date}</td>
                    <td>${reservation.time}</td>
                    <td>${reservation.guest_name}</td>
                    <td>${reservation.people}</td>
                    <td>${reservation.table}</td>
                    <td>${reservation.status}</td>
                    <td>${reservation.deposit}</td>
                `;
                reservationsList.appendChild(tr);
            });
        })
        .catch(error => console.error('Error fetching reservations:', error));
});
