<?php
include 'db_config.php'; // データベース接続設定の読み込み

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 現在のタスクのステータスを取得
    $result = $conn->query("SELECT status FROM tasks WHERE id = $id");
    $task = $result->fetch_assoc();
    $new_status = ($task['status'] == 'Completed') ? 'Pending' : 'Completed';

    // タスクのステータスをトグルするためのSQL文を準備
    $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $id);

    // SQL文を実行
    if ($stmt->execute()) {
        echo "Task status toggled successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // ステートメントを閉じる
    $conn->close(); // データベース接続を閉じる
    exit();
}
?>
