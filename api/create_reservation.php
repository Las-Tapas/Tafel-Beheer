<?php
header('Content-Type: application/json');
include 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$customer_name = $data['customer_name'];
$date = $data['date'];
$time = $data['time'];
$number_of_people = $data['number_of_people'];
$table_number = $data['table_number'];

$query = "INSERT INTO reservations (date, time, customer_name, number_of_people, table_number) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($query);

if ($stmt->execute([$date, $time, $customer_name, $number_of_people, $table_number])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
