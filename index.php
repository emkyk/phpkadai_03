<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management System</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <style>
        .hidden { display: none; }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Management System</h1>
        <form id="taskForm" method="post" action="add_task.php">
            <div class="form-group">
                <label for="task_name">Task Name:</label>
                <input type="text" id="task_name" name="task_name" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority:</label>
                <select id="priority" name="priority" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                </select>
            </div>
            <button type="submit">Add Task</button>
        </form>
        <table id="taskTable">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_config.php';
                $result = $conn->query("SELECT * FROM tasks ORDER BY due_date ASC");
                while ($row = $result->fetch_assoc()) {
                    $completedClass = $row['status'] == 'Completed' ? 'class="completed"' : '';
                    echo "<tr data-id='" . $row['id'] . "' $completedClass>";
                    echo "<td data-label='Task Name'>" . htmlspecialchars($row['task_name']) . "</td>";
                    echo "<td data-label='Due Date'>" . htmlspecialchars($row['due_date']) . "</td>";
                    echo "<td data-label='Priority'>" . htmlspecialchars($row['priority']) . "</td>";
                    echo "<td data-label='Status'>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td data-label='Actions'>
                            <a href='#' class='edit-link' data-id='" . $row['id'] . "'>Edit</a> |
                            <a href='delete_task.php?id=" . $row['id'] . "' class='delete-link' data-id='" . $row['id'] . "'>Delete</a> |
                            <a href='toggle_status.php?id=" . $row['id'] . "' class='toggle-link' data-id='" . $row['id'] . "'>Toggle Status</a>
                          </td>";
                    echo "</tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <!-- モーダルウィンドウの編集フォーム -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Edit Task</h2>
                <form id="editForm">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_task_name">Task Name:</label>
                        <input type="text" id="edit_task_name" name="task_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_due_date">Due Date:</label>
                        <input type="date" id="edit_due_date" name="due_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_priority">Priority:</label>
                        <select id="edit_priority" name="priority" required>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_status">Status:</label>
                        <select id="edit_status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit">Save Changes</button>
                    <button type="button" id="cancelEdit">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
