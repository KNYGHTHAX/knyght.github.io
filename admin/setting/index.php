<?php
session_start();

// Check if the user is logged in (you can adjust the condition as needed)
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Redirect to the login page or display an error message
    header("Location: ../login/"); // Change "login.php" to your login page URL
    exit;
}
// Initialize the $showChangePasswordForm variable
$showChangePasswordForm = false;

$passwordFile = "../INC.txt"; // Define the file to read/write the password

// Function to change the password and save it to the file
function changePassword($newPassword) {
    global $passwordFile;
    file_put_contents($passwordFile, $newPassword);
}

// Function to read the password from the file
function readPassword() {
    global $passwordFile;
    return trim(file_get_contents($passwordFile));
}

// Check if a login form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["password"])) {
    $enteredPassword = $_POST["password"];

    // Read the correct password from the file
    $correctPassword = readPassword();

    // Check if the entered password matches the correct password
    if ($enteredPassword === $correctPassword) {
        // Password is correct, set a session variable to indicate login success
        $_SESSION["loggedin"] = true;
    } else {
        // Password is incorrect, show an error message
        $errorMessage = "Incorrect password.";
    }
}

// Check if a password change form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["new_password"])) {
    $newPassword = $_POST["new_password"];
    
    // Change the password and save it to the file
    changePassword($newPassword);
    
    // Update the correct password for checking
    $correctPassword = $newPassword;
    
    // Display a success message
    $passwordChangedMessage = "Password changed successfully. You will be redirected to the login page in 3 seconds.";
    
    // Add JavaScript to redirect after 3 seconds
    echo "<script>
        setTimeout(function() {
            window.location.href = '../login/'; // Change 'login.php' to your login page URL
        }, 3000);
    </script>";
}

// If the user is already logged in, do not redirect, but set a flag to show the change password form
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $showChangePasswordForm = true;
}

// Check if the entered password matches the correct password after a password change
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["password"])) {
    $enteredPassword = $_POST["password"];

    if ($enteredPassword === $correctPassword) {
        // Password is correct, continue to the welcome page
        header("Location: ../dashboard/"); // Change "welcome.php" to the desired file
        exit;
    } else {
        // Password is incorrect, show an error message
        $errorMessage = "Incorrect password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #333;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #02FF6A;
        }

        .login-container {
            background-color: #444;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 10px;
            color: #02FF6A;
        }

        .login-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            background-color: #555;
            color: #fff;
            border-radius: 5px;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #02FF6A;
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #02C45A;
        }

        .message {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <h1>Change Admin Panel Password</h1>
    
    <br><br><br>
    <div class="login-container">
        <?php
        if (isset($errorMessage)) {
            echo "<p class='message' style='color:red'>$errorMessage</p>";
        }
        if (isset($passwordChangedMessage)) {
            echo "<p class='message' style='color:green'>$passwordChangedMessage</p>";
        }
        ?>
        <?php if (!$showChangePasswordForm): ?>
            <form method="post">
                <label for="password"><b>Password:</b></label>
                <input type="password" name="password" required>
                <br>
                <input type="submit" value="Login">
            </form>
        <?php else: ?>
            <!-- Password change form -->
            <form method="post">
                <label for="new_password"><b>New Password:</b></label>
                <input type="password" name="new_password" required>
                <br>
                <input type="submit" value="Change Password">
				<br>
				<br>
				
            </form><a href="../dashboard/"><button class="green-button">Goto Dashboard</button></a>
        <?php endif; ?>
    </div>
</body>

</html>

