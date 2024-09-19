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

// Ontvang het aantal personen van de aanvraag (bijvoorbeeld via POST)
$number_of_people = intval($_POST['number_of_people']);

// Vind een beschikbare tafel
$sql = "
    SELECT tafel_nummer 
    FROM tafels 
    WHERE aantal_personen >= $number_of_people 
      AND status = 'available' 
    ORDER BY aantal_personen 
    LIMIT 1
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Als er een beschikbare tafel wordt gevonden
    $row = $result->fetch_assoc();
    $table_number = $row['tafel_nummer'];
    
    echo json_encode([
        'status' => 'success',
        'table_number' => $table_number
    ]);
} else {
    // Als er geen tafel beschikbaar is
    echo json_encode([
        'status' => 'error',
        'message' => 'No available table found for ' . $number_of_people . ' people.'
    ]);
}

$conn->close();
?>
