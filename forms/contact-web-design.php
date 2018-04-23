<?php

// an email address that will be in the From field of the email.
$from = 'Demo contact form <website@bethpalmerdesigns.com>';

// an email address that will receive the email with the output of the form
$sendTo = 'Demo contact form <bethpalmerdesigns@gmail.com>';

// subject of the email
$subject = 'WEB DESIGN CONTACT from website';

// form field names and their translations.
// array variable name => Text to appear in the email
$fields = array(
    'first-name' => 'Name',
    'last-name' => 'Surname',
    'phone' => 'Phone',
    'email' => 'Email',
    'company' => 'Company name',
    'address1' => 'Address 1',
    'address2' => 'Address 2',
    'city' => 'City',
    'postcode' => 'Postcode',
    'wd-function' => 'Line of business',
    'wd-usp' => 'USPs',
    'wd-target-audience' => 'Target audience',
    'wd-expand-audience' => 'Expand target audience',
    'wd-existing-site' => 'Existing site',
    'wd-existing-site-analysis' => 'Existing site analysis',
    'wd-deadline' => 'Project deadline',
    'wd-budget' => 'Project budget',
    'wd-features' => 'Special features',
    'wd-search' => 'Search terms',
    'wd-testimonials' => 'Proof of excellence',
    'wd-exisiting-logo' => 'Exisiting logo',
    'wd-copy' => 'Copy',
    'wd-CMS' => 'CMS',
    'wd-support' => 'Support',
    'wd-source' => 'How contact found me'); 

$extra = "Motivation: ".implode(" ", $_POST['check-motivation'])."\n";

// message that will be displayed when everything is OK :)
$okMessage = 'Thank you. I appreciate your time. This information should be really useful in informing the quoting and development process. I will be in touch with you soon!';

// If something goes wrong, we will display this message.
$errorMessage = "Uh-oh, looks like there's been some kind of error. I'm so sorry. If the problem persists could you be a darling and let me know on 07523257537? Thank you.";

/*
 *  The SENDING bit
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "New message from WEB DESIGN contact form\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    if (isset($extra)) {
        $emailText .= "$extra";
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
