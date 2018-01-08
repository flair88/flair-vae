<?php

$_REQUEST['id'] = $id = $_REQUEST['product_id'];

ob_start();
  require_once 'share.txt.php';
  $text = ob_get_contents();
ob_end_clean();

ob_start();
  require_once 'share.html.php';
  $html = ob_get_contents();
ob_end_clean();

if( validEmail($_REQUEST['email_recipient_email']) ) {
  vae_multipart_mail($_REQUEST['email_sender_name'] . "<" . $_REQUEST['email_sender_email'] . ">", $_REQUEST['email_recipient_email'], 'Flair Home Collection: ' . $_REQUEST['email_subject'], $text, $html);
  
  echo '<h2 class="final-message">This item has been sent!</h2>';
} else {
  echo 'There was an issue with the email address you entered. Please try again.';
}

// lib
function validEmail($email)
{
  $isValid = true;
  $atIndex = strrpos($email, "@");
  if (is_bool($atIndex) && !$atIndex)
  {
     $isValid = false;
  }
  else
  {
     $domain = substr($email, $atIndex+1);
     $local = substr($email, 0, $atIndex);
     $localLen = strlen($local);
     $domainLen = strlen($domain);
     if ($localLen < 1 || $localLen > 64)
     {
        // local part length exceeded
        $isValid = false;
     }
     else if ($domainLen < 1 || $domainLen > 255)
     {
        // domain part length exceeded
        $isValid = false;
     }
     else if ($local[0] == '.' || $local[$localLen-1] == '.')
     {
        // local part starts or ends with '.'
        $isValid = false;
     }
     else if (preg_match('/\\.\\./', $local))
     {
        // local part has two consecutive dots
        $isValid = false;
     }
     else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
     {
        // character not valid in domain part
        $isValid = false;
     }
     else if (preg_match('/\\.\\./', $domain))
     {
        // domain part has two consecutive dots
        $isValid = false;
     }
     else if(!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/',str_replace("\\\\","",$local)))
     {
        // character not valid in local part unless
        // local part is quoted
        if (!preg_match('/^"(\\\\"|[^"])+"$/', str_replace("\\\\","",$local)))
        {
           $isValid = false;
        }
     }
     if($isValid && !(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A")))
     {
        // domain not found in DNS
        $isValid = false;
     }
  }
  return $isValid;
}

?>