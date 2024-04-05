<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission and save data to a file or database
    $name = $_POST['name'] ?? '';
    $comment = $_POST['comment'] ?? '';

    // Example: Save to a file
    $file = fopen("comments.txt", "a");
    fwrite($file, "Name: $name\nComment: $comment\n\n");
    fclose($file);
    
    // Redirect back to the index page after form submission
    header("Location: /index.php");
    exit;
}
?>
