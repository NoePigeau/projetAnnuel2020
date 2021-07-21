<?php

session_start();
require('../config.php');

if(!isset($_POST['email']) || empty($_POST['email']) ){
 echo 'Entrer un email valide';
 exit;
}
$email = $_POST['email'];
 
$file =  "listusers.xml";
$content = file_get_contents($file);
  
   
$to = $email;
          $subject = "Liste Des utilisateurs";
          $headers = "From: PRT Fitness <prtfitness@vps781082.ovh.net>" . "\r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-Type: multipart/mixed;" . "\r\n";
          $headers .= "Content-Transfer-Encoding: 7bit" . "\r\n";
         
          $body .= $content . "\r\n";
          mail($to,$subject,$body,$headers);

echo 'mail envoye';
exit;

?>