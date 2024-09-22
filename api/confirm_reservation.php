<?php
// api/confirm_reservation.php
require 'db.php';

$data = [
    'date' => $_POST['date'],
    'time' => $_POST['time'],
    'customer_name' => $_POST['customer_name'],
    'number_of_people' => $_POST['number_of_people'],
    'table_number' => $_POST['table_number'],
    'status' => 'pending', // Change as needed
    'deposit' => $_POST['deposit'] // Optional
];

addReservation($data);
echo json_encode(['status' => 'success']);
?>
