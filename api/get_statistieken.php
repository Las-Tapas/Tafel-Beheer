<?php
header('Content-Type: application/json');

$host = 'localhost'; // Je database host
$dbname = 'restaurant_db'; // Je database naam
$username = 'smul'; // Je database gebruiker
$password = 'smul'; // Je database wachtwoord

// Maak verbinding met de database
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Verkrijg statistieken
$vandaag = date('Y-m-d');
$zeven_dagen = date('Y-m-d', strtotime('+7 days'));

// Aantal reserveringen
$reservaties_aantal = $pdo->query('SELECT COUNT(*) FROM reserveringen')->fetchColumn();

// Totaal aantal gasten
$gasten_aantal = $pdo->query('SELECT SUM(aantal_personen) FROM reserveringen')->fetchColumn();

// Aantal reserveringen voor de komende 7 dagen
$reserveringen_7_dagen = $pdo->prepare('SELECT COUNT(*) FROM reserveringen WHERE datum BETWEEN :vandaag AND :zeven_dagen');
$reserveringen_7_dagen->execute(['vandaag' => $vandaag, 'zeven_dagen' => $zeven_dagen]);
$reserveringen_7_dagen_aantal = $reserveringen_7_dagen->fetchColumn();

echo json_encode([
    'reservations_count' => $reservaties_aantal,
    'guests_count' => $gasten_aantal,
    'next_7_days_reservations' => $reserveringen_7_dagen_aantal
]);
