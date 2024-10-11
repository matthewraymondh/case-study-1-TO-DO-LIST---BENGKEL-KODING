<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "INSERT INTO tasks (task, status, start_date, end_date) 
            VALUES ('$task', 'Belum', '$start_date', '$end_date')";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); // Redirect back to the main page after adding
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
