document.addEventListener("DOMContentLoaded", function() {
    // Verwijder de hardcoded tafels
    const floorplan = document.getElementById('table-floorplan');

    // Haal de tafels op uit de database via fetch API
    fetch('../php/fetch_tables.php')
        .then(response => response.json())
        .then(data => {
            // Controleer of er een fout is opgetreden
            if (data.error) {
                console.error(data.error);
                floorplan.innerHTML = `<p>${data.error}</p>`;
                return;
            }

            // Maak dynamisch tafels aan en voeg ze toe aan de plattegrond
            data.forEach(table => {
                const tableDiv = document.createElement('div');
                tableDiv.className = 'table';
                tableDiv.dataset.number = table.number;
                tableDiv.dataset.status = table.status;

                // Voeg inhoud toe aan de tafeldiv (nummer en status)
                tableDiv.innerHTML = `
                    <p>Tafel ${table.number}</p>
                    <p>Status: ${table.status}</p>
                `;

                // Stel de kleur in op basis van de status
                if (table.status === 'reserved') {
                    tableDiv.style.backgroundColor = 'orange';
                } else if (table.status === 'occupied') {
                    tableDiv.style.backgroundColor = 'red';
                } else {
                    tableDiv.style.backgroundColor = 'green';
                }

                // Voeg de tafeldiv toe aan de plattegrond
                floorplan.appendChild(tableDiv);
            });
        })
        .catch(error => {
            console.error('Error fetching tables:', error);
            floorplan.innerHTML = `<p>Error loading tables.</p>`;
        });
});
