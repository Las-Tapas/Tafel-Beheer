document.getElementById('reservation-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const customerName = document.getElementById('customer-name').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const numberOfPeople = document.getElementById('number-of-people').value;
    const tableNumber = document.getElementById('table-number').value;

    const formData = {
        customer_name: customerName,
        date: date,
        time: time,
        number_of_people: numberOfPeople,
        table_number: tableNumber
    };

    fetch('../api/create_reservation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('message');
        if (data.success) {
            messageDiv.textContent = 'Reservering succesvol opgeslagen!';
            messageDiv.style.color = 'green';
        } else {
            messageDiv.textContent = 'Er is een fout opgetreden. Probeer het opnieuw.';
            messageDiv.style.color = 'red';
        }
    })
    .catch(error => {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = 'Er is een fout opgetreden. Probeer het opnieuw.';
        messageDiv.style.color = 'red';
    });
});
