<?php 
 $to = $_REQUEST['sendto <bethpalmerdesigns@gmail.com>'] ; 
 $from = $_REQUEST['Email'] ; 
 $name = $_REQUEST['Name'] ; 
 $headers = "From: $from"; 
 $subject = "Web Contact Data"; 

 $fields = array(); 
 $fields{"Name"} = "Name"; 
 $fields{"Company"} = "Company"; 
 $fields{"Email"} = "Email"; 
 $fields{"Phone"} = "Phone"; 
 $fields{"list"} = "Mailing List"; 
 $fields{"Message"} = "Message"; 

$selectedProjects  = 'None';
if(isset($_POST['projects']) && is_array($_POST['projects']) && count($_POST['projects']) > 0){
    $selectedProjects = implode(', ', $_POST['projects']);
}

 $body = "We have received the following information:\n\n"; foreach($fields as $a => $b){   $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }

$body .= 'Selected Projects: ' . $selectedProjects;

 $headers2 = "From: noreply@YourCompany.com"; 
 $subject2 = "Thank you for contacting us"; 
 $autoreply = "Thank you for contacting us. Somebody will get back to you as soon as possible, usualy within 48 hours. If you have any more questions, please consult our website at www.oursite.com";

 if($from == '') {print "You have not entered an email, please go back and try again";} 
 else { 
 if($name == '') {print "You have not entered a name, please go back and try again";} 
 else { 
 $send = mail($to, $subject, $body, $headers); 
 $send2 = mail($from, $subject2, $autoreply, $headers2); 
 if($send) 
 {print "Success";} 
 else 
 {print "We encountered an error sending your mail, please notify webmaster@YourCompany.com"; } 
 }
}
 ?>