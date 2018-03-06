<?php
/*
 *  CONFIGURE EVERYTHING HERE
 */

// an email address that will be in the From field of the email.
$from = 'Web design contact form <contact@bethpalmer.co.uk>';

// an email address that will receive the email with the output of the form
$sendTo = 'Web design contact form <bethpalmerdesigns@gmail.com>';

// subject of the email
$subject = 'New message from web design contact form';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'company' => 'Company Name', 'address1' => 'Address line 1', 'address2' => 'Address line 2', 'city' => 'City', 'postcode' => 'Postcode', 'company-does' => 'What does your company do?', 'usp' => 'What makes your service unique?', 'target-audience' => 'What is your target audience?', 'expand-audience' => 'Do you want to expand your target audience?', 'deadline' => 'What is your project deadline?', 'budget' => 'Do you have a project budget?', 'search' => 'Web search words and phrases:', 'testimonials' => 'Testimonials and proof of excellence:', 'exisiting-logo' => 'Exisiting logo and brand guidelines:', 'training' => 'CMS training?', 'support' => 'Support contract?'); 
// Added for checkbox solution
$selectedMotivations = 'None';
if(issit($_POST['check-motivation']) && is_array($_POST['check-motivation']) && count($_POST['check-motivation']) >0){
    $selectedMotivations = implode(', ', $_POST['check-motivation']);
}
// Checkbox solution ends here

// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "You have a new message from your contact form\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
            $emailText .= "'Motivations: '. $selectedMotivations";
        }
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Send email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}




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
$email_message .= "Surname: ".clean_string($_POST["surname"])."\n";
$email_message .= "Email: ".clean_string($_POST["email"])."\n";
$email_message .= "Telephone: ".clean_string($_POST["phone"])."\n";
$email_message .= "Company Name: ".clean_string($_POST["company"])."\n";
$email_message .= "Address line 1: ".clean_string($_POST["address1"])."\n";
$email_message .= "Address line 2: ".clean_string($_POST["address2"])."\n";
$email_message .= "City: ".clean_string($_POST["city"])."\n";
$email_message .= "Postcode: ".clean_string($_POST["postcode"])."\n";
$email_message .= "What does your company do? ".clean_string($_POST["company-does"])."\n";
$email_message .= "What makes your service unique? ".clean_string($_POST["usp"])."\n";
$email_message .= "What is your target audience? ".clean_string($_POST["target-audience"])."\n";
$email_message .= "Do you want to expand your target audience? ".clean_string($_POST["expand-audience"])."\n";
$email_message .= "What is your project deadline? ".clean_string($_POST["deadline"])."\n";
$email_message .= "Do you have a project budget? ".clean_string($_POST["budget"])."\n";

$email_message .= "Motivation: ".implode(" ", $_POST['check-motivation'])."\n";

$email_message .= "Web search words and phrases: ".clean_string($_POST["search"])."\n";
$email_message .= "Testimonials and proof of excellence: ".clean_string($_POST["testimonials"])."\n";
$email_message .= "Exisiting logo and brand guidelines: ".clean_string($_POST["exisiting-logo"])."\n";
$email_message .= "CMS training? ".clean_string($_POST["training"])."\n";
$email_message .= "Support contract? ".clean_string($_POST["support"])."\n";


// message that will be displayed when everything is OK :)
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';

// If something goes wrong, we will display this message.
$errorMessage = 'There was an error while submitting the form. Please try again later';

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "You have a new message from your contact form\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
            $emailText .= "'Motivations: '. $selectedMotivations";
        }
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Send email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers); 
?>

<!-- include your own success html here -->
<!-- <center>
<img src="images/logo.png" />
  <br>
  <br>
  Thank you for contacting us.  We will be in touch.<br>
<br>
 <a href="index.html">HOME</a></center> -->

<?php
}
?>




