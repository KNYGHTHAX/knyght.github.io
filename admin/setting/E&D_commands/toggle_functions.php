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
    // Get the new values from the form
    $DL = isset($_POST['enableDL']) ? 'ON' : 'OFF';
    $SMS1 = isset($_POST['enableSMS1']) ? 'ON' : 'OFF';

	

    // Update the knyght.php file with the new values
    $content = "<?php\n";
    $content .= "\$DL = '$DL';\n";
    $content .= "\$SMS1 = '$SMS1';\n";
;
    $content .= "?>";

    file_put_contents("knyght.php", $content);

    // Redirect back to the form with a success message
    header("Location: toggle_form.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Toggle Functions</title>
</head>
<body>
    <h1>Toggle Functions On/Off</h1>
	
    <form method="post" action="toggle_functions.php">
        <label for="enableDL">Enable/Disable DL:</label>
        <label class="switch">
            <input type="checkbox" id="enableDL" name="enableDL" <?php echo $DL === 'ON' ? 'checked' : ''; ?>>
            <span class="slider round"></span>
        </label>

        <label for="enableSMS1">Enable/Disable SMS1:</label>
        <label class="switch">
            <input type="checkbox" id="enableSMS1" name="enableSMS1" <?php echo $SMS1 === 'ON' ? 'checked' : ''; ?>>
            <span class="slider round"></span>
        </label>

        <input type="submit" value="Save">
    </form>
</body>
</html>
