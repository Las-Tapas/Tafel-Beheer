<?php
$servername = "localhost";
$username = "smul";
$password = "smul";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$guest_name = $_POST['guest-name'];
$people = $_POST['people'];
$table = $_POST['table'];
$date = $_POST['date'];
$time = $_POST['time'];
$deposit = $_POST['deposit'];

$sql = "INSERT INTO reservations (guest_name, people, table_number, date, time, deposit, status) VALUES ('$guest_name', $people, $table, '$date', '$time', $deposit, 'pending')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false]);
}

$conn->close();
?>
