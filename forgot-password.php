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
 	<script src="lib/js/jquery.validate.imin.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>

	<script src="lib/js/underscore.js" type="text/javascript"></script>
	<script src="lib/js/form-copy.js" type="text/javascript"></script>
</head>

<body id="registerPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
		  <? $image = vae("/gift_registry/image"); ?>
		    <img src="<?= vae_data_url().vae_sizedimage($image, "Top"); ?>" class="registerImg" />
	    <div id="register" class="clear">
<fieldset id="billingInfo">
      <h2>Forgot your Password ?</h2>

      <v:users:forgot email_field="email" path="/gift_registry/registries" redirect="/recover-password" required="email">
        <p class="input">
          <label for="email">Enter your email address to reset it.</label>
          <v:text_field path="email" id="email" class="text"  />
        </p>
        <button class="right-button" type="submit"/>Reset Password</button>
      </v:users:forgot>	

    </fieldset>     
				    <fieldset id="shippingInfo" class="registry-column-2">
      <?= vae("/gift_registry/text");?></br>  
      <a class="right-button" href="/gift-registry"><button type="button"/>Login</button></a>
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

