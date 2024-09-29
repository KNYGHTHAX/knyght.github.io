<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $linkToRemove = $_POST['link'];

    $links = file("links.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $updatedLinks = array_diff($links, [$linkToRemove]);
    file_put_contents("links.txt", implode(PHP_EOL, $updatedLinks));
}
