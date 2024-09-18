<?php
header('Content-Type: application/json');

// Include de databaseverbinding
include 'db.php';

// Haal tafels op uit de database
$sql = "SELECT * FROM tafels";
$result = $conn->query($sql);

$tables = array();
$current_time = new DateTime();
$offset_time = new DateTime();
$offset_time->modify('+15 minutes');

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservation_time = new DateTime($row['reservation_time']);
        $status = 'available';

        if ($row['reservation_time'] && $current_time >= $reservation_time && $current_time < $reservation_time->modify('+15 minutes')) {
            $status = 'reserved';
        } elseif ($current_time >= $reservation_time) {
            $status = 'occupied';
        }

        $tables[] = array(
            'number' => $row['number'],
            'status' => $status,
            'seats' => $row['seats'],
            'reserved_by' => $row['reserved_by'] ?? 'N/A',
            'reservation_time' => $row['reservation_time'] ?? null
        );
    }
} else {
    echo json_encode(['error' => 'No tables found']);
    exit;
}

$conn->close();

// Verstuur de gegevens als JSON
echo json_encode($tables);
?>
