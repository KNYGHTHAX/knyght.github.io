<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['link'])) {
    $link = $_POST['link'];

    // Store the link in a file
    file_put_contents("links.txt", $link . PHP_EOL, FILE_APPEND);
}

// Redirect back to the send form
header("Location: send_form.php");
exit;
?>
