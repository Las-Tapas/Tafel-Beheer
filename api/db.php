<?php
// api/db.php

$host = 'localhost'; // Your database host
$dbname = 'restaurant_db'; // Your database name
$username = 'smul'; // Your database username
$password = 'smul'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to add a reservation
function addReservation($data) {
    global $pdo;
    $sql = "INSERT INTO reservations (date, time, customer_name, number_of_people, table_number, status, deposit) VALUES (:date, :time, :customer_name, :number_of_people, :table_number, :status, :deposit)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

// Function to get all reservations
function getAllReservations() {
    global $pdo;
    $sql = "SELECT * FROM reservations";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to find an available table
function findAvailableTable($numberOfPeople) {
    global $pdo;
    $sql = "SELECT * FROM tables WHERE capacity >= :numberOfPeople AND status = 'available'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['numberOfPeople' => $numberOfPeople]);
    return $stmt->fetch();
}

// Function to confirm a reservation
function confirmReservation($data) {
    global $pdo;
    $sql = "UPDATE reservations SET status = 'confirmed' WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}
?>
