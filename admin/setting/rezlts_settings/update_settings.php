<?php
session_start();
ini_set('display_errors', 1);


// Check if user has passed OTP verification
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    // Redirect user to login page
    header("Location: ../../dashboard/login.php");
    exit;
}
?><?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    include "bot_settings.php";

    // Modify the settings based on the action
    if ($action == "add" || $action == "update") {
        // Update the variables with new values
        $email = htmlspecialchars($_POST["email"]);
        $telegramToken = htmlspecialchars($_POST["telegram_token"]);
        $chatId = htmlspecialchars($_POST["chat_id"]);
        $whatsappPhone = htmlspecialchars($_POST["whatsapp_phone"]);
        $whatsappApikey = htmlspecialchars($_POST["whatsapp_apikey"]);
		$discordWebhook = htmlspecialchars($_POST["discord_webhook"]);
    } elseif ($action == "remove") {
        // Reset the variables to default values
        $email = "Email Address";
        $telegramToken = "Bot Token";
        $chatId = "Chat Id";
        $whatsappPhone = "Ur Whatsapp No";
        $whatsappApikey = "Key";
		$discordWebhook = "discord webhook";
		

        // Write the updated settings back to bot_settings.php
        $settings = <<<EOD
<?php
\$email = "$email";
\$api = "$telegramToken";
\$chatid = "$chatId";
\$phone = "$whatsappPhone";
\$apikey = "$whatsappApikey";
\$discordWebhook = "$discordWebhook"; 
?>
EOD;

        file_put_contents("bot_settings.php", $settings);

        echo "Settings removed successfully!";
        exit; // Stop further execution
    }

    // Write the updated settings back to bot_settings.php
    $settings = <<<EOD
<?php
\$email = "$email";
\$api = "$telegramToken";
\$chatid = "$chatId";
\$phone = "$whatsappPhone";
\$apikey = "$whatsappApikey";
\$discordWebhook = "$discordWebhook"; 
?>
EOD;

    file_put_contents("bot_settings.php", $settings);

    echo "Settings $action successfully!";
}
?>
<?php

ini_set('display_errors', 1);


// Check if user has passed OTP verification
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    // Redirect user to login page
    header("Location: ../../dashboard/login.php");
    exit;
}
?><?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];

    include "bot_settings.php";

    // Modify the settings based on the action
    if ($action == "add" || $action == "update") {
        // Update the variables with new values
        $email = htmlspecialchars($_POST["email"]);
        $telegramToken = htmlspecialchars($_POST["telegram_token"]);
        $chatId = htmlspecialchars($_POST["chat_id"]);
        $whatsappPhone = htmlspecialchars($_POST["whatsapp_phone"]);
        $whatsappApikey = htmlspecialchars($_POST["whatsapp_apikey"]);
		$discordWebhook = htmlspecialchars($_POST["discord_webhook"]);
    } elseif ($action == "remove") {
        // Reset the variables to default values
        $email = "Email Address";
        $telegramToken = "Bot Token";
        $chatId = "Chat Id";
        $whatsappPhone = "Ur Whatsapp No";
        $whatsappApikey = "Key";
		$discordWebhook = "Your Discord Webhook URL";
		

        // Write the updated settings back to bot_settings.php
        $settings = <<<EOD
<?php
\$email = "$email";
\$api = "$telegramToken";
\$chatid = "$chatId";
\$phone = "$whatsappPhone";
\$apikey = "$whatsappApikey";
\$discordWebhook = "$discordWebhook"; 
?>
EOD;

        file_put_contents("bot_settings.php", $settings);

        echo "Settings removed successfully!";
        exit; // Stop further execution
    }

    // Write the updated settings back to bot_settings.php
    $settings = <<<EOD
<?php
\$email = "$email";
\$api = "$telegramToken";
\$chatid = "$chatId";
\$phone = "$whatsappPhone";
\$apikey = "$whatsappApikey";
\$discordWebhook = "$discordWebhook"; 
?>
EOD;

    file_put_contents("bot_settings.php", $settings);

    echo "Settings $action successfully!";
}
?>
