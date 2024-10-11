<?php
include 'db_connection.php';

// Check if ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the current status of the task
    $sql = "SELECT status FROM tasks WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Get the current status
        $row = $result->fetch_assoc();
        $current_status = $row['status'];

        // Toggle status: if 'Belum', change to 'Sudah', and vice versa
        $new_status = ($current_status == 'Belum') ? 'Sudah' : 'Belum';

        // Update the status in the database
        $update_sql = "UPDATE tasks SET status='$new_status' WHERE id=$id";
        if ($conn->query($update_sql) === TRUE) {
            header('Location: index.php'); // Redirect back to the index page
        } else {
            echo "Error updating status: " . $conn->error;
        }
    } else {
        echo "Task not found.";
    }
} else {
    echo "No task ID provided.";
}

$conn->close();
?>
