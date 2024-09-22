<?php
// api/find_table.php
require 'db.php';

$numberOfPeople = $_POST['number_of_people'];
$table = findAvailableTable($numberOfPeople);

if ($table) {
    echo json_encode(['status' => 'success', 'table_number' => $table['number']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No available tables found.']);
}
?>
