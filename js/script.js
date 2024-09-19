// Function to populate table numbers in the form
async function populateTableNumbers() {
    try {
        const response = await fetch('./api/get_tafels.php');
        const tafels = await response.json();
        const tableSelect = document.getElementById('table-number');

        tafels.forEach(table => {
            const option = document.createElement('option');
            option.value = table.tafel_nummer;
            option.textContent = `Table ${table.tafel_nummer}`;
            tableSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Error fetching tables:', error);
    }
}

// Function to handle form submission
document.getElementById('reservation-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData);

    try {
        const response = await fetch('./api/add_reservation.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        });

        const result = await response.json();
        if (result.success) {
            alert('Reservation added successfully');
        } else {
            alert('Error adding reservation');
        }
    } catch (error) {
        console.error('Error adding reservation:', error);
    }
});

populateTableNumbers();
