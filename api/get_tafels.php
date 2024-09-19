<?php
$servername = "localhost";
$username = "smul";
$password = "smul";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tafels";
$result = $conn->query($sql);

$tafels = [];
while ($row = $result->fetch_assoc()) {
    $tafels[] = $row;
}

echo json_encode($tafels);

$conn->close();
?>
