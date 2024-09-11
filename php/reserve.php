<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $table_id = intval($_POST['table_id']);
    $reservation_time = $_POST['reservation_time'];
    $customer_name = $_POST['customer_name'];

    $sql = "UPDATE tables SET status = 'Reserved', reservation_time = ?, customer_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $reservation_time, $customer_name, $table_id);
    
    if ($stmt->execute()) {
        echo "Reservation updated successfully";
    } else {
        echo "Error updating reservation: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
