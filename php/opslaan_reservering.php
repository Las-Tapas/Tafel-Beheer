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

// Haal gegevens op uit het formulier
$customer_name = $_POST['customer_name'];
$contact_info = $_POST['contact_info'];
$people_number = $_POST['people_number'];
$table_id = $_POST['table_id'];
$reservation_time = $_POST['reservation_time'];

// Sla gegevens op in de database
$sql = "INSERT INTO reservations (customer_name, contact_info, people_number, table_id, reservation_time)
        VALUES ('$customer_name', '$contact_info', '$people_number', '$table_id', '$reservation_time')";

if ($conn->query($sql) === TRUE) {
    echo "Reservering succesvol toegevoegd!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
