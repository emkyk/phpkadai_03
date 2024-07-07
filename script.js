document.addEventListener('DOMContentLoaded', function() {
    // モーダル要素
    var modal = document.getElementById('editModal');
    var span = document.getElementsByClassName('close')[0];

    // 編集リンクにイベントリスナーを追加
    document.querySelectorAll('.edit-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');
            const taskName = row.querySelector('td[data-label="Task Name"]').textContent;
            const dueDate = row.querySelector('td[data-label="Due Date"]').textContent;
            const priority = row.querySelector('td[data-label="Priority"]').textContent;
            const status = row.querySelector('td[data-label="Status"]').textContent;

            document.getElementById('edit_id').value = id;
            document.getElementById('edit_task_name').value = taskName;
            document.getElementById('edit_due_date').value = dueDate;
            document.getElementById('edit_priority').value = priority;
            document.getElementById('edit_status').value = status;

            modal.style.display = 'block';
        });
    });

    // 編集フォームの送信イベント
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const id = document.getElementById('edit_id').value;
        const taskName = document.getElementById('edit_task_name').value;
        const dueDate = document.getElementById('edit_due_date').value;
        const priority = document.getElementById('edit_priority').value;
        const status = document.getElementById('edit_status').value;

        // デバッグメッセージ
        console.log('Saving task:', { id, taskName, dueDate, priority, status });

        // AJAXリクエストを作成してタスクを更新
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_task.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // デバッグメッセージ
                console.log('Update successful:', xhr.responseText);

                // 更新後の値をセルに設定
                const row = document.querySelector(`tr[data-id="${id}"]`);
                row.querySelector('td[data-label="Task Name"]').textContent = taskName;
                row.querySelector('td[data-label="Due Date"]').textContent = dueDate;
                row.querySelector('td[data-label="Priority"]').textContent = priority;
                row.querySelector('td[data-label="Status"]').textContent = status;

                // モーダルを非表示にする
                modal.style.display = 'none';
            } else {
                console.error('An error occurred:', xhr.statusText);
            }
        };
        xhr.send(`id=${id}&task_name=${encodeURIComponent(taskName)}&due_date=${encodeURIComponent(dueDate)}&priority=${encodeURIComponent(priority)}&status=${encodeURIComponent(status)}`);
    });

    // キャンセルボタンのイベント
    document.getElementById('cancelEdit').addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // モーダルを閉じる
    span.onclick = function() {
        modal.style.display = 'none';
    };

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

    // 削除リンクにイベントリスナーを追加
    document.querySelectorAll('.delete-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');

            // AJAXリクエストを作成してタスクを削除
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'delete_task.php?id=' + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    row.remove();
                } else {
                    console.error('An error occurred:', xhr.statusText);
                }
            };
            xhr.send();
        });
    });

    // ステータストグルリンクにイベントリスナーを追加
    document.querySelectorAll('.toggle-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');

            // AJAXリクエストを作成してタスクのステータスをトグル
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'toggle_status.php?id=' + id, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const statusCell = row.querySelector('td[data-label="Status"]');
                    statusCell.textContent = statusCell.textContent === 'Pending' ? 'Completed' : 'Pending';
                    row.classList.toggle('completed');
                } else {
                    console.error('An error occurred:', xhr.statusText);
                }
            };
            xhr.send();
        });
    });
});
