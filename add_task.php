<?php
include 'db_config.php'; // データベース接続設定の読み込み

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから送信されたデータを取得
    $task_name = $_POST['task_name'];
    $due_date = $_POST['due_date'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    // タスクをデータベースに追加するためのSQL文を準備
    $stmt = $conn->prepare("INSERT INTO tasks (task_name, due_date, priority, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $task_name, $due_date, $priority, $status);

    // SQL文を実行
    if ($stmt->execute()) {
        // 成功したら index.php にリダイレクト
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close(); // ステートメントを閉じる
    $conn->close(); // データベース接続を閉じる
    exit();
}
?>
