<?	$_title = '| Thank You'; 
include('lib/includes/head.html');  
		
function print_items($user){
  $i = 0; 
  foreach ($user->items as $item): 
    $items .=  ($i > 0) ? "," . $item->id: $item->id; 
    $i++; 
  endforeach; 
  return $items;
}
function makeCode(){
	return substr(md5(rand()), 0, 8);
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

function sendMail($address, $price, $name, $code){
  if(validEmail($address)): 
  
    $subject = "Your FLAIR Home Collection Gift Card";
    $to = $address;
    
    $mail = $name . ", your coupon for $" . $price . " was created.\n\n";
    $mail .= "Your coupon code is: ". $code . "\n\n";
    $mail .= "You may redeem your coupon on the checkout page of http://flairhomecollection.com or in person at the Flair store.";
         
    $name = "Flair Home Collection";   
    $from = "info@flairhomecollection.com";
     
    mail($to, $subject, $mail, "From: ".$name."<".$from.">");  
  else:
 
 
  endif;
}

/*
		

echo '<pre>';
print_r(vae_store_recent_order());
echo '</pre>';
*/

$items = vae_store_recent_order();	

foreach ($items as $item):
  $notes = explode("#", $item['notes']);
  if (strlen($notes[1])):
    $registryId = $notes[1];
    $itemId = $item['id'];
    
    $additems = print_items($user); 
    vae_update($registryId, array('purchased_items' =>"$itemId,$additems"));          
    
    $items = print_items($user); 
    $curritems = explode(",", $items);
    
    foreach($curritems as $key => $value):
     if($value == $itemId ):
      unset($curritems[$key]);
     endif;
    endforeach; 
    $removeitems = implode(",", $curritems);
    
    if ($removeitems != ""):
      vae_update($registryId, array('items' =>"$removeitems"));   
    else:
      vae_update($registryId, array('items' =>"661767"));
    endif;
  endif;
  

//Check Order Data for Gift Card
	if ($item['category'] == 'Gift Cards'):
		
		session_start(); 
		//Generate Coupon Code
		$code = makeCode();
		$order = vae_store_recent_order(true);
		$orderId = $order['id'];

		//Make Sure code isn't already existing
		while (vae_store_find_coupon_code($code)):
			$code = makeCode();
		endwhile;
 		
 		//Make sure they are not generating a duplicate code
 		if ($_SESSION['GIFT'] != $orderId):
 		$name = $order['billing_name'];
 		$price = $item['price'];
 		// Create Code
 			vae_store_create_coupon_code(array(
				'code' => $code, 
				'description' => 'Gift Card for ' . $name . ' for $' . $price,
				'fixed_amount' => $item['price'],
				'voucher' => 1
				)); 
			$_SESSION['GIFT'] = $orderId;	
			sendMail($order['email'], $price, $name, $code);
		
		endif;
			endif;
endforeach;

?>

<body id="thankYou">
	<?php require_once('lib/includes/header.html'); ?>
	
	<div id="page">
	
	 <div id="pageHeader" class="col12">
	   <v:img path="/thank_you_text/header_image" image_size="Header" />
	 </div>


    <div id="primeContent" class="col5plus">
			<h2><v=/thank_you_text/title></h2>
			<v:text path="/thank_you_text/text" />
		</div>

	</div>
	
<?php vae_include('/lib/includes/footer.html'); ?>
	
</body>
</html>