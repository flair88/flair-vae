<?

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

$email = ( $_REQUEST['email_recipient_email'] ? $_REQUEST['email_recipient_email'] : '' );
$senderEmail = ( $_REQUEST['email_sender_email'] ? $_REQUEST['email_sender_email'] : $_REQUEST['inquiry_sender_email'] );

if(validEmail($email) || $_REQUEST['inquiry_message']):
	
	$mail = "Mail submitted at " . strftime("%B %d, %Y at %H:%M") . ":\n\n";
	  foreach ($_POST as $k => $v) 
	  {
      if($k!='redirect' && $k!='email_recipient_email'):
        $mail .= $k . " - " . $v . "\n";
      endif;
	  }  
	  
	  $address = $senderEmail;
	  $redirect = $_REQUEST['redirect'];
	  $to = $email;
	  
	  mail($to, $_POST['subject'], $mail, "From: ".$senderEmail."<".$address.">");
	
	  header('Content-Type: text/html');
	  
	  echo '<h2 class="final-message">Your request has been sent!</h2>';

//	  header('location:'.$redirect);

else:

	header('Content-Type: text/html');
	
//	$ref = $_SERVER['HTTP_REFERER'];
//	header('location:'.$ref);

endif;

?>