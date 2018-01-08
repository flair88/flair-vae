<?	

$_title = '| Thank You'; 
include('lib/includes/head.html');

function makeCode(){
	return substr(md5(rand()), 0, 8);
}

//Check Order Data for Gift Card
foreach (vae_store_recent_order($all_data = false) as $item):
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
 		
 		// Create Code
 			vae_store_create_coupon_code(array(
				'code' => $code, 
				'description' => 'Gift Card for ' . $order['billing_name'] . ' for $' . $item['price'],
				'fixed_amount' => $item['price'],
				'voucher' => 1
				)); 
			$_SESSION['GIFT'] = $orderId;	
		endif;				 
	endif;
endforeach; 	

?>

<body id="thankYou">
	<?php vae_include('/lib/includes/header.html'); ?>
	
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