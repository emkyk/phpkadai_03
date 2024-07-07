<?php
include 'db_config.php'; // データベース接続設定の読み込み

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // タスクを削除するためのSQL文を準備
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);

    // SQL文を実行
    if ($stmt->execute()) {
        echo "Task deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // ステートメントを閉じる
    $conn->close(); // データベース接続を閉じる
    exit();
}
?>
