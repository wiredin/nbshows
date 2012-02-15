<?php

$show_url="http://".$_SERVER['SERVER_NAME']."/editshow/?h=$hash";

// multiple recipients
$to  = $_POST['your_email'];

// subject
$subject = "URL to EDIT/DELETE: $band_string";
// message
$message = "
<p>Here is the link to edit/delete your show listing:<br>
<a href='$show_url'>$show_url</a></p>

<p>If have any questions just reply to this email!</p>

<p>-NBshows email robot</p>

";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'From: NBshows <shows@nbshows.org>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
?>
