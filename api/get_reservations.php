<?php
// api/get_reservations.php
require 'db.php';

$reservations = getAllReservations();
echo json_encode($reservations);
?>
