<?php
error_reporting(-1);
ini_set('display_errors', 'On');
if(isset($_POST['email'])) {

  // EDIT THE 2 LINES BELOW AS REQUIRED
  $email_from = "website@bethpalmer.co.uk";
  $email_to = "bethpalmerdesigns@gmail.com";
  $email_subject = "Website contact form";

  // form field names and their translations.
  // array variable name => Text to appear in the email
  $fields = array(
    'first-name' => 'Name',
    'last-name' => 'Surname',
    'email' => 'Email',
    'phone' => 'Phone',
    'company' => 'Company Name',
    'address1' => 'Address line 1',
    'address2' => 'Address line 2',
    'city' => 'City',
    'postcode' => 'Postcode',
    'company-does' => 'Line of business',
    'usp' => 'USPs',
    'target-audience' => 'Target audience',
    'expand-audience' => 'Expand target audience',
    'existing-site' => 'Existing site',
    'existing-site-analysis' => 'Existing site analysis',
    'deadline' => 'Project deadline',
    'budget' => 'Project budget',
    'check-motivation[]' => 'Motivation',
    'features' => 'Special features',
    'search' => 'Search terms',
    'testimonials' => 'Proof of excellence',
    'exisiting-logo' => 'Exisiting logo',
    'copy' => 'Copy',
    'CMS' => 'CMS',
    'support' => 'Support'
  ); 


  $email_message = "Form details below.\n\n";

  // the $email_message plan wasn't working, so I reverted to the $fields array plan as per the downloaded demo. So this file is now a combination of the 2. If I want to use it again, I will need to take one of these out.

  function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
  }

  $email_message .= "Name: ".clean_string($_POST["first-name"])."\n";
  $email_message .= "Surname: ".clean_string($_POST["last-name"])."\n";
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
  $email_message .= "Do you have en existing website? ".clean_string($_POST["existing-site"])."\n";
  $email_message .= "What do you like or dislike about your existing site? ".clean_string($_POST["existing-site-analysis"])."\n";
  $email_message .= "What is your project deadline? ".clean_string($_POST["deadline"])."\n";
  $email_message .= "Do you have a project budget? ".clean_string($_POST["budget"])."\n";

  $email_message .= "Motivation: ".implode(" ", $_POST['check-motivation'])."\n";

  $email_message .= "What special features will your site require? ".clean_string($_POST["features"])."\n";
  $email_message .= "Web search words and phrases: ".clean_string($_POST["search"])."\n";
  $email_message .= "Testimonials and proof of excellence: ".clean_string($_POST["testimonials"])."\n";
  $email_message .= "Exisiting logo and brand guidelines: ".clean_string($_POST["exisiting-logo"])."\n";
  $email_message .= "Website copy: ".clean_string($_POST["copy"])."\n";
  $email_message .= "CMS provision: ".clean_string($_POST["CMS"])."\n";
  $email_message .= "Support contract? ".clean_string($_POST["support"])."\n";

  // message that will be displayed when everything is OK :)
  $ok_message = 'Thank you. I appreciate your time. This information should be really useful in informing the quoting and development process. I will be in touch with you soon!';

  // If something goes wrong, we will display this message.
  $error_message = "Uh-oh, looks like there's been some kind of error. I'm so sorry. If the problem persists could you give me a call on 07523257537? Thank you.";
}

/*
 *  LET'S DO THE SENDING
 */

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $email_text = "You have a new message from your contact form\n=============================\n";

    // if the variable has content, then include it in the email
    // if(isset($email_message)) {
    //     $emailText .= "$email_message";
    // }
    
    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $email_from,
        'Reply-To: ' . $email_from,
        'Return-Path: ' . $email_from,
    );
    
    // Send email
    mail($email_to, $email_subject, $email_text, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $ok_message);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $error_message);
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