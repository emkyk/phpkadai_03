<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $task_name = $_POST['task_name'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET task_name = ?, due_date = ?, priority = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $task_name, $due_date, $priority, $status, $id);

    if ($stmt->execute()) {
        // 成功したら index.php にリダイレクト
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
