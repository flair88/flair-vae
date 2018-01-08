<? 
$ajax = $_REQUEST['ajax'];

if( $_REQUEST['id'] || $_REQUEST['cart_id'] ) {

	switch( $_REQUEST['method'] ) {
		case 'set_quantity':
			$cart_id = $_REQUEST['cart_id'];
			$qty = $_REQUEST['qty'];
			$cart_item = vae_store_cart_item($cart_id);
			$item = vae($cart_item['id']);
			
			$extra_message = '';
			
			if( $qty <= 0 ) {
				vae_store_remove_from_cart($cart_id);
			} else {

			   if( $qty > (int)(string)($item->inventory) ) {
			     $qty = (int)(string)($item->inventory);
			     $extra_message = 'The quantity you requested is currently not avaliable.';
			   }
			   
				vae_store_update_cart_item(
					$cart_id,
					array(
						'qty' => $qty
					)
				);
			}
			
			if( $ajax ) {
				$cart_item = vae_store_cart_item($cart_id);
				$cart_subtotal = array('cart_subtotal' => number_format(vae_store_cart_subtotal(),2));
				$cart_id = array('cart_id' => $cart_id, 'extra_message' => $extra_message );
				
				$response = array_merge( $cart_item, $cart_subtotal, $cart_id );
				
				if( is_null($response) ) {
					$response = array('remove_item'=>$cart_id);
				}
				
				echo json_encode( $response );
				
				exit;
			}
		break;
	
		default:
			$item = vae($_REQUEST['id']);
			
			$already_in_cart = false;
			foreach( vae_store_cart_items() as $cart_id => $cart_item ) {
				if( $cart_item['id'] == $item->id ) {
					$already_in_cart = array('id' => $cart_id, 'item' => $cart_item);
				}
			}
			
			if( $already_in_cart ) {
				header("Location: /cart.php?method=set_quantity&cart_id=" . $already_in_cart['id'] . "&qty=" . ( $already_in_cart['item']['qty'] + 1 ));
			} else {
			
				// var_dump( $_REQUEST );
				// var_dump( $already_in_cart );
				// var_dump( $item->id );
				// exit;
			 
			 if (!(string)$item->shipping_class):
			   if ((string)$item->weight):
			     $shipClass= "default";
			   else:
			     $shipClass = "custom"; 
			   endif;
			 else:
			   $shipClass = (string)$item->shipping_class;
			 endif;   
			
				vae_store_add_item_to_cart(
					$item->id,
					null,
					1,
					array(
						'name_field' => 'title',
						'inventory_field' => 'inventory',
						'price_field' => 'price',
						'weight_field' => 'weight',
						'weight' => ($shipClass == "flat") ? '1':'',
						'barcode' => (string)$item->item_number,
						'shipping_class' => (string)$shipClass,
						'category' => (string)$item->category->title,
						'notes' => (($_REQUEST['notes']) ? 'Purchased for '. $_REQUEST['notes'] : '')
					),
					null
				);
				
			}
		break;
	}
	
	header("Location: /cart.php");
}
/*
echo '<pre>';
print_r(vae_store_cart_items());
echo '</pre>'
*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | Cart</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<link href="lib/css/fb.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/jquery.fancybox.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>
</head>

<body id="cartPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
    <?php vae_include('/lib/includes/logo.php'); ?>
		<div id="cart" class="col5plus">
			<h2>Shopping Cart</h2>

			<form action="/register.php" method="post">
			<?php require_once('lib/includes/cartbox.html'); ?>
				
				<?php if( count(vae_store_cart_items()) <= 0 ): ?>
					<p align="center">Your cart is empty!</p>
				<? endif; ?>
				
				<div id="cartSubtotal" class="col5plus">Subtotal: $<span class="unitPrice"><v:store:cart:subtotal /></span></div>
				
				<div id="cartTools" class="col5plus">
					<ul>
						<li><a href="shop.php">Continue Shopping</a><span>|</span></li>
						<li><a href="register.php">Proceed to Checkout</a></li>
					</ul>     
				</div>
        <? if($item->shipping_class=='custom'): ?>
  				<div id="cartCustShip" >
  					<span>Custom Shipping</span>
  					<v:text path="/shop/custom_shipping_text" />
  				</div>	
        <? endif; ?>
			</form>
			
		</div>
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
