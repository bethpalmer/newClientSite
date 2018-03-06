<?php
error_reporting(-1);
ini_set('display_errors', 'On');
if(isset($_POST['email'])) {

// EDIT THE 2 LINES BELOW AS REQUIRED
$email_to = "bethpalmerdesigns@gmail.com";
$email_subject = "Contact form";
$email_from = "website@bethpalmer.co.uk";

$email_message = "Form details below.\n\n";

function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$email_message .= "Name: ".clean_string($_POST["name"])."\n";
$email_message .= "Email: ".clean_string($_POST["email"])."\n";
$email_message .= "Telephone: ".clean_string($_POST["phone"])."\n";
$email_message .= "Motivation: ".implode(" ", $_POST['check-motivation'])."\n";
// $email_message .= "Comments: ".clean_string($_POST["comments"])."\n";


// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers); 
?>

<!-- include your own success html here -->
<center>
<img src="images/logo.png" />
  <br>
  <br>
  Thank you for contacting us.  We will be in touch.<br>
<br>
 <a href="index.html">HOME</a></center>

<?php
}
?>