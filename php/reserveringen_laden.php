<?php
// Database verbinding
$servername = "localhost";
$username = "smul";
$password = "smul";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal reserveringen op
$sql = "SELECT table_id, reservation_time FROM reservations";
$result = $conn->query($sql);

$reservations = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

echo json_encode($reservations);

$conn->close();
?>
