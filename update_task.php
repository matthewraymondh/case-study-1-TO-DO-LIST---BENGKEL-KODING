<?php
include 'db_connection.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Get the current task data
    $sql = "SELECT * FROM tasks WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $task = $row['task'];
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Task</h2>
        
        <!-- Task Update Form -->
        <form action="update_task.php?id=<?php echo $id; ?>" method="POST">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="task" value="<?php echo $task; ?>" required>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text">Start Date</label>
                <input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>" required>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text">End Date</label>
                <input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>" required>
            </div>
            <button class="btn btn-success" type="submit">Update Task</button>
        </form>
    </div>
</body>
</html>

<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $updated_task = $_POST['task'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Update the task in the database
    $sql = "UPDATE tasks SET task='$updated_task', start_date='$start_date', end_date='$end_date' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: index.php'); // Redirect back to index.php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
