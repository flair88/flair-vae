<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | Register</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>

	<script src="lib/js/underscore.js" type="text/javascript"></script>
	<script src="lib/js/form-copy.js" type="text/javascript"></script>
</head>

<body id="registerPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
		
	    <div id="register" class="clear">
		  <!-- <form action="checkout.php" method="post" id="registerForm"> -->
		  <v:store:register redirect="checkout.php" id="registerForm">
		
		    <fieldset id="billingInfo">
		      <h2>Billing Information</h2>

		      <p class="input">
		        <label for="billing_name">Name</label>
		        <v:text_field path="billing_name" class="text required name" name="billing_name" />
		      </p>

		      <p class="input">
		        <label for="billing_company">Company</label>
		        <v:text_field path="billing_company" id="billing_company" class="text" name="billing_company" />
		      </p>

		      <p class="input">
		        <label for="billing_address">Address</label>
		        <v:text_field path="billing_address" class="text required" id="billing_address" name="billing_address" />
		      </p>

		      <p class="input">
		        <label for="billing_address_2">Address 2</label>
		        <v:text_field path="billing_address_2" id="billing_address_2" name="billing_address_2" class="text" />
		      </p>

		      <p class="select">
		        <label for="billing_country">Country</label>
		        <v:country_select path="billing_country" class="required" id="billing_country" name="billing_country" />
		      </p>

		      <p class="input">                                                                                          
		        <label for="billing_city">City</label>
		        <v:text_field path="billing_city" id="billing_city" name="billing_city" class="text required" />
		      </p>

		      <p class="select medium share">
		        <label for="billing_state">State</label>
		        <v:state_select path="billing_state" id="billing_state" class="text required" required="us" />
		      </p>              

		      <!-- <p class="select small">
		        <label for="billing_state">State</label>
		        <select id="billing_state_AU" name="billing_state_AU" class="billing_state">
		          <option value="value">value</option>
		        </select>
		      </p> -->
		
		      <p class="input small">
		        <label for="billing_zip">Zip</label>
		        <v:text_field path="billing_zip" id="billing_zip" name="billing_zip" class="text small required" />
		      </p>

		      <p class="input medium">
		        <label for="billing_phone">Phone</label>
		        <v:text_field path="billing_phone" class="text required" name="billing_phone" />
		      </p>
		      
		      <p class="input">
		        <label for="b_e_mail_address">Email</label>
		        <v:text_field path="e_mail_address" id="b_e_mail_address" name="e_mail_address" class="text required email" />
		      </p>  
		      
		      <p class="input">
		        <label for="confirm_e_mail_address">Email Confirm</label>
		        <v:text_field path="confirm_e_mail_address" id="confirm_e_mail_address" name="confirm_e_mail_address" class="text required email" />
		      </p>
		    </fieldset>

		    <fieldset id="shippingInfo">
		      <h2>Shipping Information</h2>
  			  <a href="#" class="sameAs">(copy from billing)</a>
		      
		      <p class="input">
		        <label for="shipping_name">Name</label>
		        <v:text_field path="shipping_name" id="shipping_name" class="text required name" />
		      </p>

		      <p class="input">
		        <label for="shipping_company">Company</label>
		        <v:text_field path="shipping_company" id="shipping_company" class="text" name="shipping_company" />
		      </p>

		      <p class="input">
		        <label for="shipping_address">Address</label>
		        <v:text_field path="shipping_address" id="shipping_address" class="text required" name="shipping_address" />
		      </p>

		      <p class="input">
		        <label for="shipping_address_2">Address 2</label>
		        <v:text_field path="shipping_address_2" id="shipping_address_2" class="text" name="shipping_address_2" />
		      </p>

		      <p class="select">
		        <label for="shipping_country">Country</label>
		        <v:country_select path="shipping_country" class="required" name="shipping_country" />
		      </p>

		      <p class="input">                                                                                          
		        <label for="shipping_city">City</label>
		        <v:text_field path="shipping_city" class="text required" name="shipping_city" id="shipping_city" />
		      </p>

		      <p class="select medium share input">
		        <label for="shipping_state">State</label>
		        <v:state_select path="shipping_state" id="shipping_state" class="text required" required="us" />
		      </p>              

		      <!-- <p class="select small">
		        <label for="shipping_state">State</label>
		        <select id="shipping_state_AU" name="shipping_state_AU" class="shipping_state">
		          <option value="value">value</option>
		        </select>
		      </p> -->
		
		      <p class="input small">
		        <label for="shipping_zip">Zip</label>
        		<v:text_field path="shipping_zip" class="text small required" name="shipping_zip" id="shipping_zip" />
		      </p>

		      <p class="input medium">
		        <label for="shipping_phone">Phone</label>
		        <v:text_field path="shipping_phone" class="text required" name="shipping_phone" />
		      </p>

		    </fieldset>
			
			<!-- <p class="backToCartBtn"><button type="submit" class="button">Back to Cart</button></p> -->
			<div id="cartTools" class="col12">
				<ul>
					<li class="return">
						<a class="button" href="cart.php">Back to Cart</a>
					</li>
					<li class="proceed">
						<button type="submit" class="button">Proceed to Checkout</button>
					</li>
				</ul>
			</div>

		  <!-- </form> -->
		  </v:store:register>

		  <div class="clear"></div>
		</div>
	</div><!-- #page -->

	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
