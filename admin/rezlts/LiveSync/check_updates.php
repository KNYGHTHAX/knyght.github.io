<?php
// check_updates.php
$currentContent = file_get_contents("LG.txt");
$clientLastContent = isset($_GET['lastContent']) ? $_GET['lastContent'] : '';

if ($currentContent !== $clientLastContent) {
    // Send 'updates available' response with the new content
    echo 'updates_available|' . $currentContent;
} else {
    // Send 'no updates' response
    echo 'no_updates';
}
?>
