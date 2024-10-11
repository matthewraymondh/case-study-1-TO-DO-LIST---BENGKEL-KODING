<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-completed {
            background-color: #28a745; /* Green */
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: #ffc107; /* Yellow */
            color: black;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">To-Do List</h2>
        
        <!-- Task Form -->
        <form action="add_task.php" method="POST" class="mb-3">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="task" placeholder="Enter a new task" required>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text">Start Date</label>
                <input type="date" class="form-control" name="start_date" required>
            </div>
            <div class="input-group mb-3">
                <label class="input-group-text">End Date</label>
                <input type="date" class="form-control" name="end_date" required>
            </div>
            <button class="btn btn-primary" type="submit">Add Task</button>
        </form>

        <!-- Task Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'db_connection.php';

                    // Retrieve tasks from the database
                    $sql = "SELECT * FROM tasks ORDER BY id DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['task'] . "</td>";
                            echo "<td>
                                <span class='" . ($row['status'] == 'Sudah' ? 'status-completed' : 'status-pending') . "'>
                                    " . $row['status'] . "
                                </span>
                            </td>";
                            echo "<td>" . $row['start_date'] . "</td>";
                            echo "<td>" . $row['end_date'] . "</td>";
                            echo "<td>
                                <a href='update_task.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Update</a>
                                <a href='delete_task.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                <a href='toggle_status.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Toggle Status</a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No tasks found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer with copyright notice -->
    <div class="footer">
        <p>&copy; 2024 Matthew Raymond A11.2021.13275. All Rights Reserved.</p>
    </div>
</body>
</html>
