<?php
$checkout = true;
$cart_items = vae_store_cart_items();
//var_dump( $cart_items );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | Checkout</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<link href="lib/css/fb.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all" /> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all" /> <![endif]-->
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/jquery.fancybox.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>
</head>

<body id="checkoutPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
	  <div id="checkout">
	  	
	  	<v:flash />
	  
		<h2>Checkout</h2>
		<?php require_once('lib/includes/cartbox.html'); ?>

		<div id="orderNotes" class="col12">
			<div id="cartTools" class="col3">
				<a class="button" href="cart.php">Back to Cart</a>
			</div>

			<div id="orderTotals">
			  <dl>
	            <dt>Subtotal:</dt><dd>$<v:store:cart:subtotal /></dd>
	            <dt>Tax:</dt><dd>$<v:store:cart:tax /></dd>
	            <dt>Shipping:</dt><dd>$<v:store:cart:shipping /></dd>

  					<v:store:if_discount>
  				    <dt>Discount</dt><dd>($<v:store:cart:discount />)</dd>
  				  </v:store:if_discount>
				  
	            <dt class="total">TOTAL:</dt><dd class="total">$<v:store:cart:total /></dd>
	          </dl>
	        </div>
			
			<?
			$needs_custom_shipping = false;
			foreach( $cart_items as $cart_id => $it ) {
				$item = vae($it['id']);
				
				if( (string)$it['shipping_class'] == "custom" || count($cart_items) > 1) {
					$needs_custom_shipping = true;
				}
			}
			
			if( $needs_custom_shipping ): ?>
				
				<div class="alert">
					<v=/shop/custom_shipping_explanation>
				</div>
				
			<? endif; ?>
		</div>
		
		<div class="col12">
			<v:store:discount id="couponCode">
				<fieldset>
					<h3>Coupon Code:</h3>
					
					<p class="input small">
						<v:text_field type="text" id="coupon-code" class="text" name="discount" />
						<!-- <input type="submit" name="submit" value="Apply" id="submit-coupon" /> -->
					</p>
					
					<button type="submit" class="button">Apply Coupon</button>
				</fieldset>
			</v:store:discount>
		</div>


		<div id="completePurchase" class="col12">
		
		  <v:store:checkout redirect="/thanks" register_page="/register" email_confirmation="/emails/confirmation" email_received="/emails/received" email_shipping="/emails/shipping">
			<div id="paymentInfo" class="clear">
				<fieldset>
		          <h3>Payment Options</h3>
		          <p class="select small">
		            <label for="payment-type">Payment:</label>
		            <v:store:payment_methods_select />
		          </p>
		          <p class="select small" id="shipping-p">
		            <label for="shipping-type">Shipping:</label>
		            <v:store:shipping_methods_select />
		          </p>
		
			      <!--
			      <p class="input">
			        <label for="coupon-code">Coupon:</label>
			        <input type="text" name="coupon-code" value="" id="coupon-code" class="text" />
			        <input type="submit" name="submit" value="Apply" id="submit-coupon" />
			      </p>
			      -->
		        </fieldset>
		        
				<fieldset>
					<v:store:credit_card>
			          <h3>Credit Card Info</h3>
			          <p class="select small">
			            <label for="card-type">Card Type</label>
			            <v:store:credit_card_select name="cc_type" />
			          </p>
	
			          <p class="input">
			            <label for="card-number">Number</label>
			            <v:text_field name="cc_number" maxlength="16" id="card-number" class="text required" />
			          </p>
	
			          <p class="input expiration">
			            <label for="card-expiration">Expiration</label>
			            
						<v:text_field name="cc_month" maxlength="2" value="" id="card-expiration-month" class="text required" size="2" />
						<span class="slash">/</span>
						<v:text_field name="cc_year" value="" id="card-expiration-year" class="text required" size="2" maxlength="2" />
			          </p>
	
			          <p class="input cvv2">
			            <label for="cvv2">CVV2</label>
			            <v:text_field name="cc_cvv" value="" id="cvv2" class="text required" maxlength="4" />
			          </p>
					  <div class="whatIsThis"><a href="/images/cvv-card.jpg" rel="fancybox">What is this?</a></div>
					</v:store:credit_card>
		        </fieldset>

				<fieldset class="last">
		          <h3>Shipping Instructions</h3>
		          <p><v:text_area path="notes" rows="8" cols="20" /></p>
				</fieldset>
			</div>

		<v:store:user>
			<div id="orderInfo" class="clear">
				<div id="billing" class="info">
		          <h3>Billing Information</h3>
		          <a class="edit" href="register.php">(edit)</a>
		          <dl>
		            <dt>Name:</dt><dd><v:text path="billing_name" />&nbsp;</dd>
		            <dt>Company:</dt><dd><v:text path="billing_company" />&nbsp;</dd>
		            <dt>Address 1:</dt><dd><v:text path="billing_address" />&nbsp;</dd>
		            <dt>Address 2:</dt><dd><v:text path="billing_address_2" />&nbsp;</dd>
		            <dt>Country:</dt><dd><v:text path="billing_country" />&nbsp;</dd>
		            <dt>City:</dt><dd><v:text path="billing_city" />&nbsp;</dd>
		            <dt>State:</dt><dd><v:text path="billing_state" />&nbsp;</dd>
		            <dt>Zip:</dt><dd><v:text path="billing_zip" />&nbsp;</dd>
		            <dt>Phone:</dt><dd><v:text path="billing_phone" />&nbsp;</dd> 
		            <dt>Email:</dt><dd><v:text path="e_mail_address" />&nbsp;</dd> 
		          </dl>
				</div>

				<div id="shipping" class="info">
		          <h3>Shipping Information</h3>
		          <a class="edit" href="register.php">(edit)</a>
		          <dl>
		            <dt>Name:</dt><dd><v:text path="shipping_name" />&nbsp;</dd>
		            <dt>Company:</dt><dd><v:text path="shipping_company" />&nbsp;</dd>
		            <dt>Address 1:</dt><dd><v:text path="shipping_address" />&nbsp;</dd>
		            <dt>Address 2:</dt><dd><v:text path="shipping_address_2" />&nbsp;</dd>
		            <dt>Country:</dt><dd><v:text path="shipping_country" />&nbsp;</dd>
		            <dt>City:</dt><dd><v:text path="shipping_city" />&nbsp;</dd>
		            <dt>State:</dt><dd><v:text path="shipping_state" />&nbsp;</dd>
		            <dt>Zip:</dt><dd><v:text path="shipping_zip" />&nbsp;</dd>
		            <dt>Phone:</dt><dd><v:text path="shipping_phone" />&nbsp;</dd> 
		            <!-- <dt>Email:</dt><dd><v:text path="e_mail_address" />&nbsp;</dd> -->
		          </dl>
				</div>
			</v:store:user>

				<div id="orderSubmit">
		        	<button type="submit" class="button">Place Order</button>
				</div> 

				<div id="policyNav">
					<h3>Policies</h3>
					<ul>
					  <? $pages = vae('/about_pages'); ?>
					  <? $i=1; ?>
					  <? foreach($pages as $id=>$page): ?>
					    <? if($i>=2): ?>
					      <li><a href="<? echo vae_permalink($id); ?>"><? echo $page->title; ?></a></li>
					    <? endif; ?>
				      <? $i++; ?>
					  <? endforeach; ?>
					</ul>
				</div>
			</div>
		  </v:store:checkout> 
		</div>

	  </div>		

		
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
	
	<script type="text/javascript">
	// sorry.
	
	var has_other_than_custom_shipping = false;
	$('#shipping-p select option').each(function() {
	 if( $(this).html() != 'Custom Shipping ($0.00)' ) {
	   has_other_than_custom_shipping = true;
	 } else {
	   $(this).html('Custom Shipping');
	 }
	});
	
	if( has_other_than_custom_shipping ) {
  	$('#shipping-p select option').each(function() {
  	 if( $(this).html() == 'Custom Shipping' ) {
  	   $(this).remove();
  	 }
  	});
	}
	</script>
</body>
</html>