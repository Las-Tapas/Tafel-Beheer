<?php
include 'db.php';

$sql = "SELECT id AS table_id, reservation_time, customer_name FROM tables WHERE status = 'Reserved'";
$result = $conn->query($sql);

$reservations = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($reservations);

$conn->close();
?>
