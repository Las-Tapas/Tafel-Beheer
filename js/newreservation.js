document.getElementById('reservation-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('../api/add_reservation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Reservation added successfully!');
            window.location.href = '../index.html'; // Redirect to dashboard
        } else {
            alert('Failed to add reservation.');
        }
    })
    .catch(error => console.error('Error:', error));
});
