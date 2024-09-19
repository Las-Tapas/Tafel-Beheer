<?php
$servername = "localhost"; // Of je servernaam
$username = "smul"; // Je database gebruikersnaam
$password = "smul"; // Je database wachtwoord
$dbname = "restaurant_db"; // Je database naam

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ontvang de gegevens van de aanvraag
$table_number = intval($_POST['table_number']);
$number_of_people = intval($_POST['number_of_people']);
$customer_name = $conn->real_escape_string($_POST['customer_name']);
$contact_info = $conn->real_escape_string($_POST['contact_info']);

// Voeg de reservering toe aan de database
$sql = "INSERT INTO reserveringen (tafel_nummer, aantal_personen, klant_naam, contact_info, status)
        VALUES ($table_number, $number_of_people, '$customer_name', '$contact_info', 'confirmed')";

if ($conn->query($sql) === TRUE) {
    // Update de tafelstatus naar 'reserved'
    $sql_update = "UPDATE tafels SET status = 'reserved' WHERE tafel_nummer = $table_number";
    $conn->query($sql_update);
    
    echo json_encode([
        'status' => 'success'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error: ' . $conn->error
    ]);
}

$conn->close();
?>
