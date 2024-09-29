<?php
session_start();


// Function to generate OTP
function generateOTP() {
    return mt_rand(100000, 999999);
}

// Function to send OTP via Telegram bot
function sendOTPByTelegramBot($bot_token, $chat_id, $otp) {
    $url = "https://api.telegram.org/bot$bot_token/sendMessage";
    $data = [
        'chat_id' => $chat_id,
        'text' => "Your OTP is: $otp"
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === false) {
        return false;
    } else {
        return true;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If OTP is submitted
    if (isset($_POST["otp"])) {
        $submitted_otp = htmlspecialchars($_POST["otp"]);
        
        // Check if submitted OTP matches the stored OTP
        if (isset($_SESSION['otp']) && $_SESSION['otp'] == $submitted_otp) {
            // OTP verification successful, grant access
            
            // Set otp_verified session variable to true
            $_SESSION['otp_verified'] = true;

            // Redirect to another page
            header("Location: admin.php");
            exit;
        } else {
            // OTP verification failed
            $access_granted = false;
            $verification_message = 'Invalid OTP.';
        }
    } elseif (isset($_POST["generate_otp"])) {
        // Generate OTP
        $otp = generateOTP();
        $_SESSION['otp'] = $otp; // Store OTP in session for verification later
        
        // Send OTP to Telegram bot
        $bot_token = '6798831211:AAHuJSGHJeNIoi4Gq3bYFIAzGxlm2Hfk2Us'; // Replace with your Telegram bot token
        $chat_id = '788438592'; // Replace with your Telegram chat ID
        if (sendOTPByTelegramBot($bot_token, $chat_id, $otp)) {
            $message = 'OTP sent successfully to Telegram bot.';
        } else {
            $message = 'Failed to send OTP to Telegram bot.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: #000; /* Dark background */
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(0, 128, 0, 0.5); /* Matte green color with transparency */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"] {
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
        }

        input[type="submit"] {
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            background-color: #007700; /* Green color */
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #005500; /* Darker green color on hover */
        }

        p {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!isset($access_granted) || !$access_granted): ?>
            <form method="post">
                <?php if (isset($message)): ?>
                    <p><?php echo $message; ?></p>
                <?php endif; ?>
                <input type="submit" name="generate_otp" value="Generate Login Code">
            </form>
            <br>
            <?php if (isset($verification_message)): ?>
                <p><?php echo $verification_message; ?></p>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['otp'])): ?>
            <form method="post">
                <label for="otp">Enter OTP</label>
                <input autocomplete="off" type="text" id="otp" name="otp" required>
                <input type="submit" value="Verify Login">
            </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
