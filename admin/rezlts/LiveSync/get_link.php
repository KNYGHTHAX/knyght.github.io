<?php
$links = file("links.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (!empty($links)) {
    echo $links[0];
} else {
    echo ""; // No link available
}
