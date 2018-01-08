<?
function create_code() {
  $r = rand(10e16, 10e20);
  $code = base_convert($r, 10, 36);
  return $code;
}
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


function connect(){
  $dbhost = 'localhost';
  $dbuser = 'flair_1';
  $dbpass = '84f217c53';
  
  $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
  
  $dbname = 'flair_1';
  mysql_select_db($dbname);
}

function sendMail($address, $hash){
  if(validEmail($address)): 
  
    $subject = "Your FLAIR Gift Registry Confirmation";
    $to = $address;
    
    $mail = "Please click below to verify your Flair Gift Registry.\n\n";
    $mail .= "http://flairhomecollection.com/verify/index.php?hid=".$hash."\n\n";
    $mail .= "Please note that your registry cannot be created until you have verified.";
         
    $name = "Flair Home Collection";   
    $from = "info@flairhomecollection.com";
     
    mail($to, $subject, $mail, "From: ".$name."<".$from.">");  
  else:
 
 
  endif;
}

function sendadminMail($address){
  if(validEmail($address)): 
  
    $subject = "A new FLAIR registry has been created!";
    $to = $address;
    
    $mail = "A new registry has been created.";
    $registries = vae("/gift_registry/");
    $registry = $registries->get("registry", array('limit'=>1));
    $mail .= $registry->name . " : " . $registry->registry_title;
         
    $name = "Flair Home Collection";   
    $from = "info@flairhomecollection.com";
     
    mail($to, $subject, $mail, "From: ".$name."<".$from.">");  
  else:
 
 
  endif;
}

function q($query)
{
  $r = mysql_query($query);
  while($row = mysql_fetch_assoc($r))
  {
    $results[] = $row;
  }
  return $results;
}

?>