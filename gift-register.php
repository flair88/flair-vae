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
	<? vae_include('/lib/includes/header.html'); 

	?>
	<div id="page">
		  <? $image = vae("/gift_registry/image"); ?>
		  <img src="<?= vae_data_url().vae_sizedimage($image, "Top"); ?>"/>
	    
	    <div id="register" class="clear new">
		  <form method="post" action="/gift-registry-thank-you.php" id="giftRegisterForm">

		
		    <fieldset id="billingInfo">
		      <h2>Register for your FLAIR gift registry</h2>

		      <p class="input">
		        <label for="name">Name</label>
		        <v:text_field path="name" class="text required name" />
		      </p>
	      <p class="input">
		        <label for="title">Registry Title</label>
		        <v:text_field path="title" class="text required name" />
		      </p>
		    
		      <p class="input">
		        <label for="email">Email</label>
		        <v:text_field path="email" id="email" class="text required email" />
		      </p>

		      <p class="input">
		        <label for="password">Password</label>
		        <v:password_field path="password" id="password"  class="text required" />
		      </p>
		      <p class="input">
		        <label for="confirm_password">Confirm Password</label>
		        <v:password_field path="confirm_password" id="confirm_password"  class="text required" />
		      </p>
          <input type="hidden" name="sign_up" value="1"/>

          <button type="submit" class="button giftRegister">Register</button>
        </fieldset>

    		<fieldset id="shippingInfo" class="registry-column-2">
          <?= nl2br(vae("/gift_registry/register_page_text")); ?></br>  
          <a class="right-button" href="/gift-registry"><button type="button"/>Already have an account?</button></a>
        </fieldset>  
		      
			<!-- <p class="backToCartBtn"><button type="submit" class="button">Back to Cart</button></p> -->


		  <!-- </form> -->
      </form>


		  <div class="clear"></div>
		</div>
	</div><!-- #page -->

	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
