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
include "bot_settings.php"; // Include the settings file to get the values of variables

// Initialize variables with default values if they are not set
$email = isset($email) ? $email : "Email Address";
$api = isset($api) ? $api : "Bot Token";
$chatid = isset($chatid) ? $chatid : "Chat Id";
$phone = isset($phone) ? $phone : "Ur Whatsapp No";
$apikey = isset($apikey) ? $apikey : "Key";
$discordWebhook = isset($discordWebhook) ? $discordWebhook : "discord webhook";
?><!DOCTYPE html>
<html>
<head>
    <title>Manage Bot Settings</title>
    <style>
        body {
            background-color: #121212;
            color: #00ff00;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #00ff00;
            text-align: center;
            margin-top: 20px;
        }
        form {
            background-color: #222;
            border: 2px solid #00ff00;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
        }
        label {
            color: #00ff00;
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"], input[type="email"] {
            background-color: #333;
            border: 1px solid #00ff00;
            color: #00ff00;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 15px;
            box-sizing: border-box; /* Ensures padding and border are included in width */
        }
        input[type="submit"] {
            background-color: #00ff00;
            color: #000;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #009900;
        }
        .success-message {
            color: #00ff00;
            text-align: center;
            margin-top: 10px;
        }
        .dashboard-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        /* Style for the tooltip buttons */
        .tooltip-button {
            background-color: #00ff00;
            color: #000;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-left: 5px;
        }

        /* Style for the tooltip content */
        .tooltip-content {
            display: none;
            position: absolute;
            background-color: rgba(0, 255, 0, 0.8);
            color: #000;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
            white-space: nowrap;
            z-index: 1;
        }
    </style>
</head><meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>
    <h1>Manage Bot Settings</h1>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo '<div class="success-message">Settings added successfully!</div>';
        }
    ?>
    <form method="post" action="update_settings.php">
        <label for="action">  <button class="tooltip-button" onmouseover="showTooltip('action-tooltip')" onmouseout="hideTooltip('action-tooltip')">?</button>
        <div class="tooltip-content" id="action-tooltip">Select an action from the list</div>Action:</label>
        <select id="action" name="action" required>
            <option value="add">Add Data</option>
           
            <option value="remove">Remove Data</option>
        </select>
      

        <label for="email">Email: <button class="tooltip-button" onmouseover="showTooltip('email-tooltip')" onmouseout="hideTooltip('email-tooltip')">?</button>
        <div class="tooltip-content" id="email-tooltip">Enter your email address</div></label>
        <input type="email" id="email" name="email" value="<?= $email ?>">
       

        <label for="telegram_token">Telegram Bot Token:<button class="tooltip-button" onmouseover="showTooltip('telegram-tooltip')" onmouseout="hideTooltip('telegram-tooltip')">?</button>
        <div class="tooltip-content" id="telegram-tooltip">Enter your Telegram Bot Token "use @BotFather to create telegram bot"</div></label>
        <input type="text" id="telegram_token" name="telegram_token" value="<?= $api ?>">

        <label for="chat_id">Telegram Chat ID: <button class="tooltip-button" onmouseover="showTooltip('chat-tooltip')" onmouseout="hideTooltip('chat-tooltip')">?</button>
        <div class="tooltip-content" id="chat-tooltip">Enter your Telegram Chat ID "Get Chat Id From @RawDataBot"</div></label>
        <input type="text" id="chat_id" name="chat_id" value="<?= $chatid ?>">
		
       <label for="discord_webhook">Discord Webhook URL: <button class="tooltip-button" onmouseover="showTooltip('discord-webhook-tooltip')" onmouseout="hideTooltip('discord-webhook-tooltip')">?</button>
<div class="tooltip-content" id="discord-webhook-tooltip">Enter your Discord Webhook URL</div></label>
<input type="text" id="discord_webhook" name="discord_webhook" value="<?= $discordWebhook ?>">

        
<b><small> Instruction to setup whatsapp to recive rezlts <a target="_blank" href="https://i.imgur.com/sj1akbO.png" style="color: #00ff00;">Open Guide</a>
</small> </b>
<br>
<br>
        <label for="whatsapp_phone">WhatsApp Phone Number:<button class="tooltip-button" onmouseover="showTooltip('whatsapp-phone-tooltip')" onmouseout="hideTooltip('whatsapp-phone-tooltip')">?</button>
        <div class="tooltip-content" id="whatsapp-phone-tooltip">Enter your WhatsApp Phone Number</div></label>
        <input type="text" id="whatsapp_phone" name="whatsapp_phone" value="<?= $phone ?>">
        

        <label for="whatsapp_apikey">WhatsApp API Key: <button class="tooltip-button" onmouseover="showTooltip('whatsapp-apikey-tooltip')" onmouseout="hideTooltip('whatsapp-apikey-tooltip')">?</button>
        <div class="tooltip-content" id="whatsapp-apikey-tooltip">Enter your WhatsApp API Key</div></label>
        <input type="text" id="whatsapp_apikey" name="whatsapp_apikey" value="<?= $apikey ?>">
       

        <input type="submit" value="Submit">
    </form>
    <a href="../../dashboard/" class="dashboard-button">Go to Dashboard</a>

    <script>
        function showTooltip(tooltipId) {
            var tooltip = document.getElementById(tooltipId);
            tooltip.style.display = "block";
        }

        function hideTooltip(tooltipId) {
            var tooltip = document.getElementById(tooltipId);
            tooltip.style.display = "none";
        }
    </script>
</body>
</html>
