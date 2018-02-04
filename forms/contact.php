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
$fields = array('name' => 'Name', 'surname' => 'Surname', 'phone' => 'Phone', 'email' => 'Email', 'company' => 'Company Name', 'address1' => 'Address line 1', 'address2' => 'Address line 2', 'city' => 'City', 'postcode' => 'Postcode', 'company-does' => 'What does your company do?', 'usp' => 'What makes your service unique?', 'target-audience' => 'What is your target audience?', 'expand-audience' => 'Do you want to expand your target audience?', 'deadline' => 'What is your project deadline?', 'budget' => 'Do you have a project budget?', 'search' => 'Web search words and phrases:', 'testimonials' => 'Testimonials and proof of excellence:', 'exisiting-logo' => 'Exisiting logo and brand guidelines:', 'training' => 'CMS training?', 'support' => 'Support contract?', 'awareness' => 'Motivation: Awareness', 'contact-point' => 'Motivation: Customer contact point', 'image' => 'Motivation: Online Image', 'sell' => 'Motivation: Sell products / services', 'loyalty' => 'Motivation: Customer loyalty', 'multi-language' => 'Motivation: Multiple languages', 'promote' => 'Motivation: Promote latest product / service', 'other-motivation' => 'Motivation: Other motivation', 'motivation-reason' => 'Motivation: State reason'); 

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
