<?php
// the message
$to = "kmoreland909@gmail.com";
$subject = "test";
$message = "test message";
$headers = "From:Ksanmartin909@gmail.com";

// use wordwrap() if lines are longer than 70 characters

// send email
mail($to, $subject, $message, $headers);
?>