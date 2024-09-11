<?php
$servername = "localhost";
$username = "smul";
$password = "smul";
$database = "restaurant_db";

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
