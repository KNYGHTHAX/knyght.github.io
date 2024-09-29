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
    $LSL = isset($_POST['enableLSL']) ? 'ON' : 'OFF';

    // Update the knyght.php file with the new values
    $content = "<?php\n";
    $content .= "\$LSL = '$LSL';\n";
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
	 <label for="enableAIOC">AIO Console:</label>
        <label class="switch">
            <input type="checkbox" id="enableAIOC" name="enableAIOC" <?php echo $AIOC === 'ON' ? 'checked' : ''; ?>>
            <span class="slider round"></span>
        </label>
        


        <input type="submit" value="Save">
    </form>
    <form method="post" action="toggle_functions.php">
	
        <label for="enableLG">Login Section:</label>
        <label class="switch">
            <input type="checkbox" id="enableLSL" name="enableLSL" <?php echo $LSL === 'ON' ? 'checked' : ''; ?>>
            <span class="slider round"></span>
        </label>



        <input type="submit" value="Save">
    </form>
</body>
</html>
