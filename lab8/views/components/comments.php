<div id="comments">
    <?php
    // Read comments from file
    $comments_file = __DIR__ . '/../../handlers/comments.txt'; // Путь к файлу с комментариями

    if (file_exists($comments_file)) {
        $comments = file($comments_file);

        if (!empty($comments)) {
            foreach ($comments as $comment) {
                echo '<div class="comment">' . htmlspecialchars($comment) . '</div>'; // Вывод комментариев
            }
        } else {
            echo '<p>No comments yet.</p>'; // Сообщение, если нет комментариев
        }
    } else {
        echo '<p>Comments file not found.</p>'; // Сообщение, если файл с комментариями не найден
    }
    ?>
</div>
